<template>
  <v-app>
    <v-container fluid>
      <v-row no-gutters class="justify-content-md-center">
        <v-col cols="11">
          <v-card
            class="pa-2 mx-auto"
            v-if="$gate.isAdmin() || $gate.isPelayanan() || $gate.isBisnis()"
          >
            <v-toolbar src="images/banner-biru-pelayanan.jpg" dark shaped>
              <v-toolbar-title> Permohonan ke Divisi Operasional </v-toolbar-title>
              <v-spacer></v-spacer>
              <v-btn small color="indigo" dark @click="newModal" v-if="$gate.isAdmin() || $gate.isPelayanan()">
                <v-icon>mdi-file-upload</v-icon> Upload File
              </v-btn>
            </v-toolbar>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <v-data-table
                :headers="headers"
                :items="permoperasional"
                :search="search"
                justify="center"
                dense
                class="elevation-3"
              >
                <template v-slot:footer.prepend>
                  <v-btn
                    color="success"
                    dark
                    class="ma-2"
                    small
                    @click="initialize()"
                  >
                    Refresh
                    <v-icon right dark> mdi-reload </v-icon>
                  </v-btn>
                </template>
                <template v-slot:item.index="{ index }">
                  {{ index + 1 }}
                </template>

                <template v-slot:top>
                  <v-toolbar flat>
                    <v-spacer></v-spacer>
                    <v-spacer></v-spacer>
                    <v-spacer></v-spacer>
                    <v-spacer></v-spacer>
                    <v-text-field
                      v-model="search"
                      append-icon="mdi-magnify"
                      label="Cari File"
                      single-line
                      hide-details
                      loading="grey"
                    ></v-text-field>
                  </v-toolbar>
                </template>
                <!-- warna status -->
                <template v-slot:item.statuspermohonan="{ item }">
                <v-chip :color="getColor(item.statuspermohonan)">
                    {{ item.statuspermohonan }}
                </v-chip>
                </template>
                <!-- tombol download -->
                <template v-slot:item.file="{ item }">
                  <v-card-actions class="justify-center">
                    <v-icon
                      small
                      color="blue"
                      class="mr-4"
                      @click="downloadFile(item.id, item.file)"
                    >
                      mdi-download
                    </v-icon>
                  </v-card-actions>
                </template>
                <template v-slot:item.file_disetujui="{ item }">
                  <v-card-actions class="justify-center">
                    <v-icon
                      small
                      color="blue"
                      class="mr-4"
                      @click="
                        downloadFileDisetujui(item.id, item.file_disetujui)
                      "
                    >
                      mdi-download
                    </v-icon>
                  </v-card-actions>
                </template>
                <template v-slot:item.file_spk="{ item }">
                  <v-card-actions class="justify-center">
                    <v-icon
                      small
                      color="blue"
                      class="mr-4"
                      @click="downloadFileSpk(item.id, item.file_spk)"
                    >
                      mdi-download
                    </v-icon>
                  </v-card-actions>
                </template>
                <!-- tombol edit -->
                <template v-slot:item.edit="{ item }">
                  <v-card-actions class="justify-center">
                    <v-icon small color="green" @click="editModal(item)">
                      mdi-pencil
                    </v-icon>
                  </v-card-actions>
                </template>
                <!-- tombol hapus -->
                <template v-slot:item.actions="{ item }">
                  <v-icon
                    small
                    class="mr-4"
                    color="red"
                    right
                    @click="deleteUser(item.id)"
                  >
                    mdi-delete
                  </v-icon>
                </template>
              </v-data-table>
            </div>
            <!-- /.card-body -->
            <!-- <div class="card-footer">
                  <pagination :data="users" @pagination-change-page="getResults"></pagination>
              </div> -->
          </v-card>
        </v-col>
      </v-row>

      <div v-if="!$gate.isAdmin() && !$gate.isPelayanan() && !$gate.isBisnis()">
        <not-found></not-found>
      </div>

      <!-- Modal -->
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
              <h5 class="modal-title" v-show="!editmode">Upload File</h5>
              <h5 class="modal-title" v-show="editmode">Update Status</h5>
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
              @submit.prevent="editmode ? updateUser() : createUser()"
              ref="form"
              v-model="valid"
              lazy-validation
            >
              <!-- <form @submit.prevent="editmode ? updateUser() : createUser()"> -->
              <div class="modal-body">
                <input
                  v-model="editedItem.kantor_id"
                  type="hidden"
                  name="kantor_id"
                />
                <input
                  v-model="editedItem.status_id"
                  type="hidden"
                  name="status_id"
                />
                <input v-model="csrf" type="hidden" name="_token" />

                <div class="form-group input-group">
                  <v-col cols="12" sm="12" md="12">

                    <v-text-field
                      v-model="editedItem.namafile"
                      :rules="nameRules"
                      name="namafile"
                      label="Surat Permohonan"
                      placeholder="Nama File: surat permohonan"
                      outlined
                      required
                      dense
                      prepend-icon="mdi-file"
                      @keydown="pencetKeyboard($event)"
                    ></v-text-field>
                    <has-error :form="form" field="namafile"></has-error>

                    <!-- tgl_permohonan -->
                    <template>
                      <v-row>
                        <v-col cols="12" sm="12" md="12">
                          <v-menu
                            ref="menu1"
                            v-model="menu1"
                            :close-on-content-click="false"
                            :nudge-right="40"
                            transition="scale-transition"
                            offset-y
                            min-width="auto"
                          >
                            <template v-slot:activator="{ on, attrs }">
                              <v-text-field
                                v-model="dateFormatted"
                                @blur="
                                  tgl_permohonan = parseDate(dateFormatted)
                                "
                                :rules="tgl_permohonanRules"
                                label="Tanggal"
                                placeholder="Tanggal"
                                prepend-icon="mdi-calendar"
                                v-bind="attrs"
                                v-on="on"
                                outlined
                                required
                                readonly
                                dense
                              ></v-text-field>
                            </template>
                            <v-date-picker
                              v-model="tgl_permohonan"
                              elevation="15"
                              @input="menu1 = false"
                              year-icon="calendar-blank"
                              locale="id-ID"
                            ></v-date-picker>
                          </v-menu>
                        </v-col>
                      </v-row>
                    </template>
                    <has-error :form="form" field="tgl_permohonan"></has-error>
                    <!-- <input type="file" @change="uploadFile"> -->
                    <template>
                      <v-file-input
                        v-model="file"
                        color="deep-purple accent-4"
                        counter
                        label="Upload File"
                        placeholder="Ambil File"
                        prepend-icon="mdi-paperclip"
                        outlined
                        dense
                        show-size
                        accept=".pdf"
                      >
                        <template v-slot:selection="{ index, text }">
                          <v-chip
                            v-if="index < 2"
                            color="deep-purple accent-4"
                            dark
                            label
                            small
                          >
                            {{ text }}
                          </v-chip>

                          <span
                            v-else-if="index === 2"
                            class="text-overline grey--text text--darken-3 mx-2"
                          >
                            +{{ files.length - 2 }} File(s)
                          </span>
                        </template>

                      </v-file-input>
                    </template>
                    <has-error :form="form" field="file"></has-error>


                    <template>
                                    <v-radio-group
                                    v-model="editedItem.status_id" :mandatory="false"
                                    row
                                    prepend-icon="mdi-format-list-bulleted-type"
                                    v-if="$gate.isAdmin()"
                                    >
                                    <template v-slot:label>
                                        <div><strong class="text-h6 text-bold">Status :</strong></div>
                                    </template>
                                    <v-radio
                                        label="Disetujui"
                                        value="2"

                                    ></v-radio>
                                    <v-radio
                                        label="Ditolak"
                                        value="3"
                                    ></v-radio>
                                    <v-radio
                                        label="Selesai"
                                        value="4"
                                    ></v-radio>
                                    </v-radio-group>

                            </template>

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
                  <v-icon>mdi-file-cancel</v-icon>
                  Batal
                </v-btn>
                <v-btn
                  color="success"
                  elevation="2"
                  v-show="editmode"
                  type="submit"
                >
                  <v-icon>mdi-pencil</v-icon>
                  Update
                </v-btn>
                <v-btn
                  color="primary"
                  elevation="2"
                  v-show="!editmode"
                  type="submit"
                >
                  <v-icon>mdi-file-upload</v-icon>
                  Upload
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
  data: (vm) => ({
    csrf: document
      .querySelector('meta[name="csrf-token"]')
      .getAttribute("content"),
    editmode: false,
    dialog: false,
    dialogDelete: false,
    search: "",
    permoperasional: [],
    valid: true,

    editedItem: {
      id: "",
      kantor_id: "",
      namafile: "",
      status_id: "",
    },
    file: null,
    file_disetujui: null,
    file_spk: null,


    pesaneror: [],

    nameRules: [(v) => !!v || "Nama File Belum Diisi"],
    menu1: false,
    menu2: false,

    dateFormatted: vm.formatDate(
      new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10)
    ),
    tgl_permohonan: new Date(
      Date.now() - new Date().getTimezoneOffset() * 60000
    )
      .toISOString()
      .substr(0, 10),
    tgl_permohonanRules: [(v) => !!v || "Tanggal realisasi belum diisi"],
    // fileRules: [(v) => !!v || "File belum dimasukan"],
    //file: '',
    form: new Form({
      id: "",
      kantor_id: "",
      namafile: "",
      tgl_permohonan: "",
      file: "",
    }),
  }),

  computed: {
    headers() {
      let headers = [
        {
          text: "No",
          value: "index",
          align: "center",
          sortable: false,
        },

        {
          text: "Nama File",
          value: "namafile",
        },
        { text: "Tanggal Permohonan", value: "tgl_permohonan" },
        { text: "Tanggal Disetujui/Ditolak", value: "tgl_setujutolak" },
        { text: "Tanggal Selesai", value: "tgl_acc" },
        { text: "Status", value: "statuspermohonan"},
      ];
      headers.push({
        text: "File Permohonan",
        value: "file",
        sortable: false,
        align: "center",
      });


      if (this.$gate.isAdmin()) {
        headers.push({
        text: "Update Status",
        value: "edit",
        sortable: false,
        align: "center",
        });

        headers.push({ text: "Hapus", value: "actions", sortable: false });
      }
      return headers;
    },
    computedDateFormatted() {
      return this.formatDate(this.tgl_permohonan);
    },

    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    },
  },

  watch: {
    tgl_permohonan(val) {
      this.dateFormatted = this.formatDate(this.tgl_permohonan);
    },
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },
  //     beforeCreate: function() {

  //     console.log(this.$kantor_id)
  //   },
  created() {
    this.$Progress.start();
    //console.log(this.kantor_id)
    this.initialize();
    this.$Progress.finish();
  },

  methods: {
    getColor (statuspermohonan) {
        if (statuspermohonan === 'Selesai') return 'green'
        else if (statuspermohonan === 'Ditolak') return 'red'
        else return 'orange'
    },

    pencetKeyboard: function (evt) {
      evt = evt ? evt : window.event;
      var charCode = evt.which ? evt.which : evt.keyCode;
      //nomer wungkul
      //if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
      //tidak boleh tombol '/' dan '\'
      if (charCode === 191 || charCode === 220) {
        evt.preventDefault();
      } else {
        return true;
      }
    },
    formatDate(tgl_permohonan) {
      if (!tgl_permohonan) return null;

      const [year, month, day] = tgl_permohonan.split("-");
      return `${day}/${month}/${year}`;
    },
    parseDate(tgl_permohonan) {
      if (!tgl_permohonan) return null;

      const [day, month, year] = tgl_permohonan.split("/");
      return `${year}-${month.padStart(2, "0")}-${day.padStart(2, "0")}`;
    },
    initialize() {
      this.$Progress.start();

      if (this.$gate.isAdmin() || this.$gate.isPelayanan() || this.$gate.isBisnis()) {
        axios.get("api/permoperasional").then((response) => {
          this.permoperasional = response.data.data;
          this.editedItem.kantor_id = this.$kantor_id;
          // this.form.fill
          // console.log(this.kredit);
          // console.log(this.kantor_id)
        });
      }

      this.$Progress.finish();
    },
    editModal(item) {
      this.editmode = true;
      // this.$refs.form.reset()
      $("#addNew").modal("show");
      //this.form.fill(item);
      this.editedItem.id = item.id;
      this.editedItem.kantor_id = this.$kantor_id;
      this.editedItem.status_id = item.status_id;
      this.editedItem.namafile = item.namafile;
    },
    newModal() {
      this.editmode = false;
      $("#addNew").modal("show");
      this.$refs.form.reset();
      this.editedItem.namafile = "";
      this.pesaneror = "";
    },
    createUser() {
      this.$refs.form.validate();
      this.$Progress.start();
      // e.preventDefault();
      const config = {
        headers: { "content-type": "multipart/form-data" },
      };
      // //this.append('file', this.file);
      const formData = new FormData();
      formData.set("kantor_id", this.editedItem.kantor_id);
      formData.set("namafile", this.editedItem.namafile);
      formData.set("tgl_permohonan", this.tgl_permohonan);
      formData.set("file", this.file);
      formData.set("status_id", 5);
      // formData.append('file', this.file);
      // console.log(this.file);
      axios
        .post("api/permoperasional", formData, config)
        .then((response) => {
          $("#addNew").modal("hide");

          Toast.fire({
            icon: "success",
            title: response.data.message,
          });

          this.$Progress.finish();
          this.initialize();
        })
        .catch((error) => {
          //Swal.fire("Failed!", data.message, "warning");
          var errors = error.response.data.errors;
          // Loop this object and pring Key or value or both
          for (const [key, value] of Object.entries(errors)) {
            // console.log(`${key}: ${value}`);
            Toast.fire({
              icon: "error",
              title: value,
              //title : "Gagal upload, ulangi..."
            });
          }
        });
    },
    downloadFile(id, file) {
      axios({
        url: "api/permoperasional/download/" + id,
        method: "GET",
        responseType: "blob",
      })
        .then((response) => {
          var fileUrl = window.URL.createObjectURL(new Blob([response.data]));
          var fileLink = document.createElement("a");
          fileLink.href = fileUrl;

          fileLink.setAttribute("download", "tabfile.zip");
          fileLink.download = file;
          document.body.appendChild(fileLink);

          fileLink.click();
        })
        .catch(() => {
          Swal.fire("Gagal Download!", "File tidak ada...", "warning");
        });
    },
    downloadFileDisetujui(id, file_disetujui) {
      axios({
        url: "api/permoperasional/filesetuju/" + id,
        method: "GET",
        responseType: "blob",
      })
        .then((response) => {
          var fileUrl = window.URL.createObjectURL(new Blob([response.data]));
          var fileLink = document.createElement("a");
          fileLink.href = fileUrl;

          fileLink.setAttribute("download", "tabfile.zip");
          fileLink.download = file_disetujui;
          document.body.appendChild(fileLink);
            // console.log(fileLink.download)
          fileLink.click();
        })
        .catch(() => {
          Swal.fire(
            "Gagal Download!",
            "File disetujui belum diupload.",
            "warning"
          );
        });
    },
    downloadFileSpk(id, file_spk) {
      axios({
        url: "api/permoperasional/filespk/" + id,
        method: "GET",
        responseType: "blob",
      })
        .then((response) => {
          var fileUrl = window.URL.createObjectURL(new Blob([response.data]));
          var fileLink = document.createElement("a");
          fileLink.href = fileUrl;

          fileLink.setAttribute("download", "tabfile.zip");
          fileLink.download = file_spk;
          document.body.appendChild(fileLink);

          fileLink.click();
        })
        .catch(() => {
          Swal.fire("Gagal Download!", "File SPK belum diupload.", "warning");
        });
    },
    updateUser() {
      const config = {
        headers: {
          accept: "application/json",
          "Accept-Language": "en-US,en;q=0.8",
          "content-type": "multipart/form-data",
        },
        // headers: {'X-Custom-Header': 'value'}
      };
      this.$refs.form.validate();
      this.$Progress.start();
      //console.log(this.editedItem.id)
      const formData = new FormData();
      // formData.set('kantor_id', this.editedItem.kantor_id)
      formData.set('namafile', this.editedItem.namafile)

      if (this.$gate.isAdmin() || this.$gate.isPelayanan()) {
        formData.set("tgl_acc", this.tgl_permohonan);
        formData.set("file_spk", this.file);
      }
      if (this.$gate.isAdmin() || this.$gate.isBisnis()) {
        formData.set("tgl_setujutolak", this.tgl_permohonan);
        formData.set("file_disetujui", this.file);
      }
      //formData.set("file_disetujui", this.file);
      formData.set("status_id", this.editedItem.status_id);
      formData.append("_method", "PUT");

       //console.log(formData);
      axios
        .post("api/permoperasional/" + this.editedItem.id, formData, config)
        //axios.put('api/stock/27',formData)
        .then((response) => {
          //console.log(this.editedItem.id);
          // success
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.$Progress.finish();
          //  Fire.$emit('AfterCreate');

          this.initialize();
        })
        .catch((error) => {
          console.log(error);
          this.$Progress.fail();
        });
    },
    deleteUser(id) {
      Swal.fire({
        title: "Yakin dihapus?",
        text: "Jika dihapus data hilang!",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, Hapus!",
      }).then((result) => {
        // Send request to the server
        if (result.value) {
          this.form
            .delete("api/permoperasional/" + id)
            .then(() => {
              Swal.fire("Dihapus!", "Data telah dihapus.", "success");
              // Fire.$emit('AfterCreate');
              this.initialize();
            })
            .catch((data) => {
              Swal.fire("Failed!", data.message, "warning");
            });
        }
      });
    },
  },
};
</script>
