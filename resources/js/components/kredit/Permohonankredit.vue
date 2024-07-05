<template>
  <v-app>
    <v-container fluid>
      <v-row no-gutters class="justify-content-md-center">
        <v-col cols="11">
          <v-card
            class="pa-2 mx-auto"
            v-if="$gate.isAdmin() || $gate.isKredit() || $gate.isBisnis() || $gate.isPelayanan()"
          >
            <v-toolbar src="images/banner-red.jpg" dark shaped>
              <v-toolbar-title> Permohonan Kredit </v-toolbar-title>
              <v-spacer></v-spacer>
              <v-btn
                small
                color="indigo"
                dark
                @click="newModal"
                v-if="$gate.isAdmin() || $gate.isKredit() || $gate.isPelayanan()"
              >
                <v-icon>mdi-file-upload</v-icon> Upload File
              </v-btn>
            </v-toolbar>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <v-data-table
                :headers="headers"
                :items="permohonankredit"
                :search="search"
                justify="center"
                dense
                class="elevation-3"
              >
              <template v-slot:body.append>
                    <tr class="fs-3">
                        <th class="text-center text-xl-h1" colspan="8">Total</th>
                        <td class="pink--text font-weight-bold">{{ formatCurrency(sumField('jml_permohonan')) }}</td>
                        <td class="pink--text font-weight-bold">{{ formatCurrency(sumField('jml_realisasi')) }}</td>
                    </tr>
                </template>

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
                <template
              v-for="header in headers.filter((header) =>
                header.hasOwnProperty('formatter')
              )"
              v-slot:[`item.${header.value}`]="{ header, value }"
            >
              {{ header.formatter(value) }}
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

      <div v-if="!$gate.isAdmin() && !$gate.isKredit() && !$gate.isBisnis() && !$gate.isPelayanan()">
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
                      v-model="editedItem.no_ktp"
                      :rules="noktpRules"
                      name="no_ktp"
                      label="Nomor KTP"
                      placeholder="No. KTP harus diisi"
                      counter
                      maxlength="16"
                      outlined
                      required
                      dense
                      prepend-icon="mdi-file"
                      @keydown="noktpKeyboard($event)"
                      hint=""
                      persistent-hint
                      :error-messages="pesaneror"
                    ></v-text-field>
                    <has-error :form="form" field="no_ktp"></has-error>
                    <v-text-field
                      v-model="editedItem.no_rekening"
                      name="no_rekening"
                      label="Nomor Rekening kredit"
                      placeholder="No. Rekening Tanpa Titik"
                      counter
                      maxlength="12"
                      outlined
                      required
                      dense
                      prepend-icon="mdi-file"
                      @keydown="norekKeyboard($event)"
                      hint=""
                      persistent-hint
                    ></v-text-field>
                    <has-error :form="form" field="no_rekening"></has-error>
                    <v-text-field
                      v-model="editedItem.namafile"
                      :rules="nameRules"
                      name="namafile"
                      label="Nama Nasabah"
                      placeholder="Nama File: 'nama_nasabah'"
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
                    <v-currency-field
                      v-model="editedItem.jml_permohonan"
                      name="jml_permohonan"
                      label="Jumlah Permohonan"
                      placeholder="Jumlah Permohonan Kredit"
                      counter
                      v-show="!editmode"
                      maxlength="16"
                      outlined
                      required
                      dense
                      prepend-icon="mdi-currency-usd"
                      prefix="Rp. "
                      @keydown="noktpKeyboard($event)"
                      hint=""
                      persistent-hint
                      :error-messages="pesaneror"
                    ></v-currency-field>
                    <has-error :form="form" field="jml_permohonan"></has-error>
                    <v-currency-field
                      v-model="editedItem.jml_realisasi"
                      name="jml_realisasi"
                      v-show="editmode"
                      label="Jumlah Realisasi"
                      placeholder="Jumlah Realisasi Kredit"
                      counter
                      maxlength="16"
                      outlined
                      required
                      dense
                      prepend-icon="mdi-currency-usd"
                      prefix="Rp. "
                      @keydown="noktpKeyboard($event)"
                      hint=""
                      persistent-hint
                      :error-messages="pesaneror"
                    ></v-currency-field>
                    <has-error :form="form" field="jml_realisasi"></has-error>
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
                        v-model="editedItem.status_id"
                        :mandatory="false"
                        row
                        prepend-icon="mdi-format-list-bulleted-type"
                      >
                        <template v-slot:label>
                          <div>
                            <strong class="text-h6 text-bold">Status :</strong>
                          </div>
                        </template>
                        <v-radio
                          label="Analisa"
                          value="1"
                          v-if="$gate.isAdmin() || $gate.isKredit() || $gate.isPelayanan()"
                        ></v-radio>
                        <v-radio
                          label="Disetujui"
                          value="2"
                          v-if="$gate.isAdmin() || $gate.isBisnis()"
                        ></v-radio>
                        <v-radio
                          label="Ditolak"
                          value="3"
                          v-if="$gate.isAdmin() || $gate.isBisnis()"
                        ></v-radio>
                        <v-radio
                          label="Selesai"
                          value="4"
                          v-if="$gate.isAdmin() || $gate.isKredit() || $gate.isPelayanan()"
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
    permohonankredit: [],
    valid: true,

    editedItem: {
      id: "",
      kantor_id: "",
      no_ktp: "",
      no_rekening: "",

      namafile: "",
      status_id: "",
      jml_permohonan: 0,
      jml_realisasi: 0,
    },
    file: null,
    file_disetujui: null,
    file_spk: null,

    noktpRules: [(v) => !!v || "No KTP Belum Diisi"],
    cekNorekData: [],
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
      jml_permohonan: 0,
      jml_realisasi: 0,
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
        { text: "Kantor", value: "nama_kantor", align: "start" },
        { text: "No KTP", value: "no_ktp", align: "center", },
        { text: "No Rekening", value: "no_rekening", align: "center", },
        {
          text: "Nama Nasabah",
          value: "namafile",
          align: "center",
        },
        { text: "Tanggal Permohonan", value: "tgl_permohonan", align: "center" },
        { text: "Tanggal Disetujui/Ditolak", value: "tgl_setujutolak",align: "center"},
        { text: "Tanggal Pencairan", value: "tgl_pencairan",align: "center" },
        { text: "Jumlah Permohonan", value: "jml_permohonan", formatter: this.formatCurrency, align: "center"},
        { text: "Jumlah Realisasi", value: "jml_realisasi", formatter: this.formatCurrency, align: "center"},
        { text: "Status", value: "statuspermohonan", align: "center" },
      ];
      headers.push({
        text: "File Permohonan",
        value: "file",
        sortable: false,
        align: "center",
      });
      headers.push({
        text: "File Disetujui",
        value: "file_disetujui",
        sortable: false,
        align: "center",
      });
      headers.push({
        text: "File SPK",
        value: "file_spk",
        sortable: false,
        align: "center",
      });
      headers.push({
        text: "Update Status",
        value: "edit",
        sortable: false,
        align: "center",
      });

      if (this.$gate.isAdmin()) {
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
    sumField(key) {
        // sum data in give key (property)
        
        return this.permohonankredit.reduce((a, b) => a + (b[key] || 0), 0)
    },
    formatCurrency (value) {
      return new Intl.NumberFormat("id-ID", {
      style: "currency",
      currency: "IDR"
    }).format(value);
},
    getColor(statuspermohonan) {
      if (statuspermohonan === "Selesai") return "green";
      else if (statuspermohonan === "Ditolak") return "red";
      else return "orange";
    },
    async cekNorek() {
      if (
        this.$gate.isAdmin() ||
        this.$gate.isKredit() ||
        this.$gate.isBisnis() ||
        this.$gate.isPelayanan()
      ) {
        const formData = new FormData();
        formData.set("no_ktp", this.editedItem.no_ktp);
        //const response = await axios.get('api/kredit/ceknama')
        const response = await axios.post(
          "api/permohonankredit/ceknorek",
          formData
        );
        //this.cekNorekData = response.data.data[0].no_rekening;
        if (response.data.message == "adarek") {
          this.cekNorekData = response.data.data[0].no_ktp;
          this.pesaneror = "No KTP " + this.cekNorekData + " Sudah Ada";

          // console.log(this.cekNorekData);

          Toast.fire({
            icon: "error",
            //title: response.data.message
            title:
              "No KTP " +
              response.data.data[0].no_ktp +
              " Sudah Ada Dalam Data",
          });
          this.initialize();
        } //endif response
      } //endif gate
    },
    norekKeyboard: function (evt) {
      evt = evt ? evt : window.event;
      var charCode = evt.which ? evt.which : evt.keyCode;
      //nomer wungkul
      if (
        charCode > 31 &&
        (charCode < 48 || charCode > 57) &&
        (charCode < 95 || charCode > 105) &&
        charCode !== 46 &&
        charCode !== 75
      ) {
        //tidak boleh tombol '/' dan '\'
        //if (charCode === 191 || charCode===220) {
        evt.preventDefault();
      } else {
        this.editedItem.no_rekening = this.editedItem.no_rekening.toUpperCase();
        return true;
      }
    },
    noktpKeyboard: function (evt) {
      evt = evt ? evt : window.event;
      var charCode = evt.which ? evt.which : evt.keyCode;
      //nomer wungkul
      if (
        charCode > 31 &&
        (charCode < 48 || charCode > 57) &&
        (charCode < 95 || charCode > 105) &&
        charCode !== 46
      ) {
        //tidak boleh tombol '/' dan '\'
        //if (charCode === 191 || charCode===220) {
        evt.preventDefault();
      } else {
        //this.editedItem.no_ktp = this.no_ktp.toUpperCase();
        return true;
      }
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

      if (
        this.$gate.isAdmin() ||
        this.$gate.isKredit() ||
        this.$gate.isBisnis() ||
        this.$gate.isPelayanan()
      ) {
        axios.get("api/permohonankredit").then((response) => {
          this.permohonankredit = response.data.data;
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
      this.editedItem.no_ktp = item.no_ktp;
      this.editedItem.no_rekening = item.no_rekening;
      this.editedItem.jml_realisasi = item.jml_realisasi;
      this.editedItem.namafile = item.namafile;
    },
    newModal() {
      this.editmode = false;
      $("#addNew").modal("show");
      this.$refs.form.reset();
      this.editedItem.namafile = "";
      this.editedItem.no_ktp = "";
      this.editedItem.no_rekening = "";
      this.editedItem.jml_permohonan = "";
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
      formData.set("no_ktp", this.editedItem.no_ktp);
      formData.set("no_rekening", this.editedItem.no_rekening);
      formData.set("namafile", this.editedItem.namafile);
      formData.set("tgl_permohonan", this.tgl_permohonan);
      formData.set("jml_permohonan", this.editedItem.jml_permohonan);
      formData.set("file", this.file);
      formData.set("status_id", 1);
      // formData.append('file', this.file);
       console.log(this.editedItem.jml_permohonan);
       console.log(this.editedItem.no_ktp);
      axios
        .post("api/permohonankredit", formData, config)
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
        url: "api/permohonankredit/download/" + id,
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
        url: "api/permohonankredit/filesetuju/" + id,
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
        url: "api/permohonankredit/filespk/" + id,
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
      formData.set("no_ktp", this.editedItem.no_ktp);
      formData.set("no_rekening", this.editedItem.no_rekening);
      formData.set("namafile", this.editedItem.namafile);
      formData.set("jml_realisasi", this.editedItem.jml_realisasi);

      if (this.$gate.isAdmin() || this.$gate.isKredit() || this.$gate.isPelayanan()){
        formData.set("tgl_pencairan", this.tgl_permohonan);
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
        .post("api/permohonankredit/" + this.editedItem.id, formData, config)
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
            .delete("api/permohonankredit/" + id)
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
