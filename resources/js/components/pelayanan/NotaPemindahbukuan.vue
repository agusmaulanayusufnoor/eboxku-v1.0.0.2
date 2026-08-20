<template>
  <v-app>
    <v-container fluid>
      <v-row no-gutters class="justify-content-md-center">
        <v-col cols="11">
          <v-card
            class="pa-2 mx-auto"
            v-if="$gate.isAdmin() || $gate.isPelayanan() || $gate.isTeller()"
          >
            <v-toolbar
              color="rgb(39,154,187)"
              dark
              shaped
            >
              <v-toolbar-title>
                <v-icon left>mdi-file-invoice</v-icon> Nota Pemindahbukuan
              </v-toolbar-title>
              <v-spacer></v-spacer>
              <v-btn
                v-if="$gate.isAdmin() || $gate.isPelayanan() || $gate.isTeller()"
                small
                color="indigo"
                dark
                @click="newModal"
              >
                <v-icon>mdi-plus</v-icon> Tambah Data
              </v-btn>
            </v-toolbar>

            <!-- FILTER SECTION -->
            <div class="px-4 pt-6 pb-2">
              <v-row align="center">
                <v-col v-if="$gate.isAdmin()" cols="12" sm="4" md="2">
                  <v-select
                    v-model="nama_kantor"
                    :items="namaKantor"
                    item-value="nama_kantor"
                    item-text="nama_kantor"
                    label="Kantor"
                    hide-details
                    clearable
                    dense
                    outlined
                    ref="cbkantor"
                    :return-object="false"
                    @click="getKantor()"
                    @change="applyFilter()"
                  ></v-select>
                </v-col>

                <v-col cols="12" sm="4" md="2">
                  <v-select
                    v-model="filterJenis"
                    :items="jenisTransaksiOptions"
                    label="Jenis"
                    clearable
                    hide-details
                    dense
                    outlined
                    @change="applyFilter()"
                  ></v-select>
                </v-col>

                <v-col cols="12" sm="4" md="2">
                  <v-menu
                    v-model="menuFrom"
                    :close-on-content-click="false"
                    transition="scale-transition"
                    offset-y
                    min-width="auto"
                  >
                    <template v-slot:activator="{ on, attrs }">
                      <v-text-field
                        v-model="filterTglAwal"
                        label="Dari"
                        append-icon="mdi-calendar"
                        hide-details
                        dense
                        outlined
                        readonly
                        v-bind="attrs"
                        v-on="on"
                      ></v-text-field>
                    </template>
                    <v-date-picker
                      v-model="filterTglAwal"
                      @input="menuFrom = false"
                      locale="id-ID"
                    ></v-date-picker>
                  </v-menu>
                </v-col>

                <v-col cols="12" sm="4" md="2">
                  <v-menu
                    v-model="menuTo"
                    :close-on-content-click="false"
                    transition="scale-transition"
                    offset-y
                    min-width="auto"
                  >
                    <template v-slot:activator="{ on, attrs }">
                      <v-text-field
                        v-model="filterTglAkhir"
                        label="Sampai"
                        append-icon="mdi-calendar"
                        hide-details
                        dense
                        outlined
                        readonly
                        v-bind="attrs"
                        v-on="on"
                      ></v-text-field>
                    </template>
                    <v-date-picker
                      v-model="filterTglAkhir"
                      @input="menuTo = false"
                      locale="id-ID"
                    ></v-date-picker>
                  </v-menu>
                </v-col>

                <v-col cols="auto" class="d-flex align-center">
                  <v-btn icon small color="indigo" @click="applyFilter()">
                    <v-icon small>mdi-filter</v-icon>
                  </v-btn>
                  <v-btn icon small color="orange" @click="resetFilter()">
                    <v-icon small>mdi-refresh</v-icon>
                  </v-btn>
                </v-col>

                <v-spacer></v-spacer>

                <v-col cols="12" sm="4" md="2">
                  <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Cari"
                    hide-details
                    dense
                    outlined
                  ></v-text-field>
                </v-col>
              </v-row>
            </div>

            <div class="card-body table-responsive p-0">
              <v-data-table
                :headers="headers"
                :items="notaList"
                :search="search"
                justify="center"
                dense
                class="elevation-3"
              >
                <template v-slot:footer.prepend>
                  <v-btn color="success" dark class="ma-2" small @click="refresh()">
                    Refresh
                    <v-icon right dark> mdi-reload </v-icon>
                  </v-btn>
                </template>

                <template v-slot:item.index="{ index }">
                  {{ index + 1 }}
                </template>

                <template v-slot:item.nominal="{ item }">
                  {{ formatRupiah(item.nominal) }}
                </template>

                <template v-slot:item.cetak="{ item }">
                  <v-card-actions class="justify-center">
                    <v-tooltip bottom>
                      <template v-slot:activator="{ on, attrs }">
                        <v-icon
                          small
                          color="red"
                          v-bind="attrs"
                          v-on="on"
                          @click="cetakPdf(item.id)"
                        >
                          mdi-file-pdf-box
                        </v-icon>
                      </template>
                      <span>Cetak PDF</span>
                    </v-tooltip>
                  </v-card-actions>
                </template>

                <template v-slot:item.actions="{ item }">
                  <v-icon
                    small
                    color="blue"
                    class="mr-2"
                    @click="editModal(item)"
                  >
                    mdi-pencil
                  </v-icon>
                  <v-icon
                    v-if="$gate.isAdmin()"
                    small
                    color="red"
                    @click="deleteNota(item.id)"
                  >
                    mdi-delete
                  </v-icon>
                </template>
              </v-data-table>
            </div>
          </v-card>
        </v-col>
      </v-row>

      <div v-if="!$gate.isAdmin() && !$gate.isPelayanan() && !$gate.isTeller()">
        <not-found></not-found>
      </div>

      <!-- Modal Add/Edit -->
      <div
        class="modal fade"
        id="addNew"
        tabindex="-1"
        role="dialog"
        aria-labelledby="addNew"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" v-show="!editmode">Tambah Nota Pemindahbukuan</h5>
              <h5 class="modal-title" v-show="editmode">Edit Nota Pemindahbukuan</h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <v-form
              @submit.prevent="editmode ? updateNota() : createNota()"
              ref="form"
              v-model="valid"
              lazy-validation
            >
              <div class="modal-body">
                <div class="form-group">
                  <v-col cols="12" sm="12" md="12">
                    <v-select
                      v-model="editedItem.jenis_transaksi"
                      :items="jenisTransaksiOptions"
                      label="Jenis Transaksi"
                      outlined
                      required
                      dense
                      prepend-icon="mdi-tag"
                      :rules="[(v) => !!v || 'Jenis transaksi harus dipilih']"
                    ></v-select>

                    <v-text-field
                      v-model="editedItem.nominal"
                      label="Nominal"
                      outlined
                      required
                      dense
                      prepend-icon="mdi-cash"
                      type="number"
                      :rules="[(v) => !!v || 'Nominal harus diisi', (v) => v > 0 || 'Nominal harus lebih dari 0']"
                    ></v-text-field>

                    <v-text-field
                      v-model="editedItem.keterangan"
                      label="Keterangan"
                      outlined
                      dense
                      prepend-icon="mdi-text"
                    ></v-text-field>
                  </v-col>
                </div>
              </div>

              <div class="modal-footer">
                <v-btn
                  color="error"
                  elevation="2"
                  type="button"
                  data-dismiss="modal"
                >
                  <v-icon>mdi-cancel</v-icon> Batal
                </v-btn>
                <v-btn
                  color="success"
                  elevation="2"
                  v-show="editmode"
                  type="submit"
                >
                  <v-icon>mdi-pencil</v-icon> Ubah
                </v-btn>
                <v-btn
                  color="primary"
                  elevation="2"
                  v-show="!editmode"
                  type="submit"
                >
                  <v-icon>mdi-plus</v-icon> Tambah
                </v-btn>
              </div>
            </v-form>
          </div>
        </div>
      </div>
    </v-container>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    search: "",
    editmode: false,
    valid: true,
    nama_kantor: "",
    namaKantor: [],
    notaList: [],
    filterJenis: "",
    filterTglAwal: "",
    filterTglAkhir: "",
    menuFrom: false,
    menuTo: false,
    editedItem: {
      id: "",
      jenis_transaksi: "",
      nominal: 0,
      keterangan: "",
    },
    jenisTransaksiOptions: [
      "Setoran Tabungan",
      "Transfer Antar Rekening",
      "Titipan Transfer",
      "Anggaran",
      "Rekonsiliasi",
      "Antar Kantor",
      "Amortisasi",
    ],
  }),

  computed: {
    headers() {
      let headers = [
        { text: "No", value: "index", align: "center", sortable: false },
        { text: "Kantor", value: "nama_kantor", align: "start" },
        { text: "User", value: "user_name", align: "start" },
        { text: "Jenis Transaksi", value: "jenis_transaksi" },
        { text: "Nominal", value: "nominal", align: "end" },
        { text: "Keterangan", value: "keterangan" },
        { text: "Tanggal", value: "created_at" },
      ];
      headers.push({
        text: "Cetak",
        value: "cetak",
        sortable: false,
        align: "center",
      });
      if (this.$gate.isAdmin()) {
        headers.push({
          text: "Hapus",
          value: "actions",
          sortable: false,
          align: "center",
        });
      } else if (this.$gate.isPelayanan() || this.$gate.isTeller()) {
        headers.push({
          text: "Edit",
          value: "actions",
          sortable: false,
          align: "center",
        });
      }
      return headers;
    },
  },

  created() {
    this.$Progress.start();
    this.initialize();
    if (this.$gate.isAdmin()) {
      this.getKantor();
    }
    this.$Progress.finish();
  },

  methods: {
    getKantor() {
      axios
        .get("api/teller/getkantor")
        .then((response) => {
          this.namaKantor = response.data.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
    formatRupiah(value) {
      if (!value) return "Rp 0";
      let val = parseFloat(value);
      return "Rp " + val.toLocaleString("id-ID", { minimumFractionDigits: 0, maximumFractionDigits: 0 });
    },

    initialize() {
      this.$Progress.start();
      if (this.$gate.isAdmin() || this.$gate.isPelayanan() || this.$gate.isTeller()) {
        axios.get("api/nota-pemindahbukuan").then((response) => {
          this.notaList = response.data.data;
        });
      }
      this.$Progress.finish();
    },

    refresh() {
      this.resetFilter();
    },

    applyFilter() {
      this.$Progress.start();
      let params = {};
      if (this.nama_kantor && this.$gate.isAdmin()) {
        params.nama_kantor = this.nama_kantor;
      }
      if (this.filterJenis) {
        params.jenis_transaksi = this.filterJenis;
      }
      if (this.filterTglAwal) {
        params.tgl_awal = this.filterTglAwal;
      }
      if (this.filterTglAkhir) {
        params.tgl_akhir = this.filterTglAkhir;
      }
      if (Object.keys(params).length > 0) {
        axios
          .get("api/nota-pemindahbukuan/filter", { params })
          .then((response) => {
            this.notaList = response.data.data;
          })
          .catch((error) => {
            console.log(error.response.data);
          });
      } else {
        this.initialize();
      }
      this.$Progress.finish();
    },

    resetFilter() {
      this.nama_kantor = "";
      this.filterJenis = "";
      this.filterTglAwal = "";
      this.filterTglAkhir = "";
      if (this.$refs.cbkantor) {
        this.$refs.cbkantor.reset();
      }
      this.initialize();
    },

    newModal() {
      this.editmode = false;
      this.editedItem = { id: "", jenis_transaksi: "", nominal: 0, keterangan: "" };
      $("#addNew").modal("show");
    },

    editModal(item) {
      this.editmode = true;
      this.editedItem = Object.assign({}, item);
      $("#addNew").modal("show");
    },

    createNota() {
      this.$Progress.start();
      axios
        .post("api/nota-pemindahbukuan", this.editedItem)
        .then((response) => {
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.initialize();
        })
        .catch((error) => {
          var errors = error.response.data.errors;
          for (const [key, value] of Object.entries(errors)) {
            Toast.fire({ icon: "error", title: value });
          }
        })
        .finally(() => this.$Progress.finish());
    },

    updateNota() {
      this.$Progress.start();
      axios
        .put("api/nota-pemindahbukuan/" + this.editedItem.id, this.editedItem)
        .then((response) => {
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.initialize();
        })
        .catch((error) => {
          var errors = error.response.data.errors;
          for (const [key, value] of Object.entries(errors)) {
            Toast.fire({ icon: "error", title: value });
          }
        })
        .finally(() => this.$Progress.finish());
    },

    deleteNota(id) {
      Swal.fire({
        title: "Yakin dihapus?",
        text: "Jika dihapus data hilang!",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, Hapus!",
      }).then((result) => {
        if (result.value) {
          axios
            .delete("api/nota-pemindahbukuan/" + id)
            .then(() => {
              Swal.fire("Dihapus!", "Data telah dihapus.", "success");
              this.initialize();
            })
            .catch(() => {
              Swal.fire("Gagal!", "Gagal menghapus data", "error");
            });
        }
      });
    },

    cetakPdf(id) {
      axios({
        url: "/api/nota-pemindahbukuan/cetak/" + id,
        method: "GET",
        responseType: "blob",
      })
        .then((response) => {
          var fileUrl = window.URL.createObjectURL(
            new Blob([response.data], { type: "application/pdf" })
          );
          var fileLink = document.createElement("a");
          fileLink.href = fileUrl;
          var disposition = response.headers["content-disposition"];
          var filename = "nota.pdf";
          if (disposition && disposition.indexOf("filename=") !== -1) {
            filename = disposition.split("filename=")[1].replace(/"/g, "").trim();
          }
          fileLink.setAttribute("download", filename);
          document.body.appendChild(fileLink);
          fileLink.click();
          window.URL.revokeObjectURL(fileUrl);
        })
        .catch(() => {
          Swal.fire("Gagal!", "Gagal mencetak PDF", "error");
        });
    },
  },
};
</script>
