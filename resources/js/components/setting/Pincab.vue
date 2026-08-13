<template>
  <v-app>
    <v-container fluid>
      <v-row no-gutters class="justify-content-md-center">
        <v-col cols="12" md="10">
          <v-card class="pa-2 mx-auto" v-if="$gate.isAdmin()">
            <v-toolbar color="indigo lighten-1" dark shaped>
              <v-toolbar-title class="font-weight-bold">
                <v-icon left>mdi-user-tie</v-icon> Data Pemimpin Cabang (Pincab)
              </v-toolbar-title>
              <v-spacer></v-spacer>
              <v-btn small color="success" dark @click="newModal">
                <v-icon left>mdi-plus-box</v-icon> Tambah Pincab
              </v-btn>
            </v-toolbar>

            <!-- Table -->
            <div class="card-body table-responsive p-0 mt-3">
              <v-data-table
                :headers="headers"
                :items="pincabList"
                :search="search"
                dense
                class="elevation-3"
              >
                <template v-slot:item.index="{ index }">
                  {{ index + 1 }}
                </template>

                <template v-slot:top>
                  <v-toolbar flat>
                    <v-spacer></v-spacer>
                    <v-text-field
                      v-model="search"
                      append-icon="mdi-magnify"
                      label="Cari Kode / Nama Pimpinan..."
                      single-line
                      hide-details
                      style="max-width: 300px;"
                    ></v-text-field>
                  </v-toolbar>
                </template>

                <!-- Action buttons -->
                <template v-slot:item.actions="{ item }">
                  <v-icon small color="blue" class="mr-2" @click="editModal(item)">
                    mdi-pencil
                  </v-icon>
                  <v-icon small color="red" @click="deletePincab(item.id)">
                    mdi-delete
                  </v-icon>
                </template>
              </v-data-table>
            </div>
          </v-card>

          <div v-if="!$gate.isAdmin()">
            <not-found></not-found>
          </div>
        </v-col>
      </v-row>

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
              <h5 class="modal-title" v-show="!editmode">Tambah Pemimpin Cabang</h5>
              <h5 class="modal-title" v-show="editmode">Edit Pemimpin Cabang</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <v-form @submit.prevent="editmode ? updatePincab() : createPincab()" ref="form" v-model="valid">
              <div class="modal-body">
                <div class="form-group">
                  <v-text-field
                    v-model="editedItem.kode_kantor"
                    label="Kode Kantor (misal: 001)"
                    outlined
                    required
                    dense
                    prepend-icon="mdi-numeric"
                  ></v-text-field>
                </div>

                <div class="form-group">
                  <v-text-field
                    v-model="editedItem.nama_pimpinan"
                    label="Nama Pemimpin Cabang"
                    outlined
                    required
                    dense
                    prepend-icon="mdi-account-tie"
                  ></v-text-field>
                </div>
              </div>

              <div class="modal-footer">
                <v-btn color="error" elevation="2" type="button" data-dismiss="modal">
                  <v-icon left>mdi-cancel</v-icon> Batal
                </v-btn>
                <v-btn color="success" elevation="2" v-show="editmode" type="submit">
                  <v-icon left>mdi-pencil</v-icon> Ubah
                </v-btn>
                <v-btn color="primary" elevation="2" v-show="!editmode" type="submit">
                  <v-icon left>mdi-plus-box</v-icon> Tambah
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
    pincabList: [],
    editedItem: {
      id: "",
      kode_kantor: "",
      nama_pimpinan: "",
    },
  }),

  computed: {
    headers() {
      let headers = [
        { text: "No", value: "index", align: "center", sortable: false },
        { text: "Kode Kantor", value: "kode_kantor", align: "center" },
        { text: "Nama Pemimpin Cabang", value: "nama_pimpinan" },
      ];
      if (this.$gate.isAdmin()) {
        headers.push({ text: "Aksi", value: "actions", sortable: false, align: "center" });
      }
      return headers;
    },
  },

  created() {
    this.$Progress.start();
    this.initialize();
    this.$Progress.finish();
  },

  methods: {
    initialize() {
      if (this.$gate.isAdmin()) {
        axios
          .get("api/pincab")
          .then((response) => {
            this.pincabList = response.data.data;
          })
          .catch((err) => console.log(err));
      }
    },

    newModal() {
      this.editmode = false;
      this.editedItem = { id: "", kode_kantor: "", nama_pimpinan: "" };
      $("#addNew").modal("show");
    },

    editModal(item) {
      this.editmode = true;
      this.editedItem = Object.assign({}, item);
      $("#addNew").modal("show");
    },

    createPincab() {
      this.$Progress.start();
      axios
        .post("api/pincab", this.editedItem)
        .then((response) => {
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.initialize();
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Gagal menambah data pincab!",
          });
        })
        .finally(() => this.$Progress.finish());
    },

    updatePincab() {
      this.$Progress.start();
      axios
        .put(`api/pincab/${this.editedItem.id}`, this.editedItem)
        .then((response) => {
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.initialize();
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Gagal memperbarui data pincab!",
          });
        })
        .finally(() => this.$Progress.finish());
    },

    deletePincab(id) {
      Swal.fire({
        title: "Yakin dihapus?",
        text: "Data Pemimpin Cabang ini akan dihapus!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, Hapus!",
      }).then((result) => {
        if (result.value) {
          axios
            .delete(`api/pincab/${id}`)
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
  },
};
</script>

<style scoped>
</style>
