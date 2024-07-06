<template>
  <v-app>
    <v-container fluid>
      <v-row no-gutters class="justify-content-md-center">
        <v-col cols="12">
          <v-card class="pa-2 mx-auto" v-if="$gate.isAdmin() || $gate.isAK()">
            <v-toolbar
              src="images/banner-biru-pelayanan.jpg"
              color="rgb(39,154,187)"
              dark
              shaped
            >
              <v-toolbar-title>
                Stok Buku Tabungan dan Bilyet Deposito
              </v-toolbar-title>
              <v-spacer></v-spacer>
              <v-btn small color="indigo" dark @click="newModal">
                <v-icon>mdi-archive-plus</v-icon> Tambah Stok
              </v-btn>
            </v-toolbar>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <v-data-table
                :headers="headers"
                :items="stock"
                :search="search"
                :items-per-page="10"
                :footer-props="{
                  'items-per-page-options': [5, 10, 14, 140, -1],
                  'items-per-page-text': 'baris per halaman',
                }"
                justify="center"
                dense
                class="elevation-3"
              >
                <template v-slot:item.tanggal="{ item }">
                  {{ formatDate(item.tanggal) }}
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
                    <vue-excel-xlsx
                      :data="stock"
                      :columns="columnsExcel"
                      :file-name="'OP003-A'"
                      :file-type="'xls'"
                      :sheet-name="'stock'"
                      class="btn btn-success btn-sm"
                    >
                      <i class="fa-solid fa-file-excel"></i>
                      Excel
                    </vue-excel-xlsx>

                    <v-spacer></v-spacer>
                    <v-spacer></v-spacer>
                    <v-spacer></v-spacer>
                    <v-spacer></v-spacer>
                    <v-row>
                      <v-col cols="12" sm="6" md="5">
                        <v-menu
                          ref="menu2"
                          v-model="menu2"
                          :close-on-content-click="false"
                          :nudge-right="40"
                          transition="scale-transition"
                          offset-y
                          min-width="auto"
                        >
                          <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                              v-model="fromTglText"
                              single-line
                              label="Dari Tanggal"
                              append-icon="mdi-calendar"
                              hide-details
                              v-bind="attrs"
                              v-on="on"
                            ></v-text-field>
                          </template>
                          <v-date-picker
                            v-model="fromTgl"
                            @input="menu2 = false"
                            elevation="15"
                            year-icon="calendar-blank"
                            locale="id-ID"
                          >
                          </v-date-picker>
                        </v-menu>
                      </v-col>
                      <v-col cols="12" sm="6" md="5">
                        <v-menu
                          ref="menu3"
                          v-model="menu3"
                          :close-on-content-click="false"
                          :nudge-right="40"
                          transition="scale-transition"
                          offset-y
                          min-width="auto"
                        >
                          <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                              v-model="toTglText"
                              single-line
                              label="Sampai Tanggal"
                              append-icon="mdi-calendar"
                              hide-details
                              v-bind="attrs"
                              v-on="on"
                            ></v-text-field>
                          </template>
                          <v-date-picker
                            v-model="toTgl"
                            @input="menu3 = false"
                            elevation="15"
                            year-icon="calendar-blank"
                            locale="id-ID"
                          >
                          </v-date-picker>
                        </v-menu>
                      </v-col>
                      <v-col>
                        <v-btn
                          @click="filterTanggal()"
                          class="mx-3"
                          fab
                          dark
                          color="indigo"
                          x-small
                          fixed
                          bottom
                        >
                          <v-icon> mdi-filter </v-icon>
                        </v-btn>
                      </v-col>
                    </v-row>
                    <v-spacer></v-spacer>

                    <v-text-field
                      v-model="search"
                      append-icon="mdi-magnify"
                      label="Cari Data Stok"
                      single-line
                      hide-details
                      loading="grey"
                    ></v-text-field>
                  </v-toolbar>
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
                  <v-icon small color="red" @click="deleteUser(item.id)">
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

      <div v-if="!$gate.isAdmin() && !$gate.isAK()">
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
            <div class="modal-header primary">
              <h5 class="modal-title" v-show="!editmode" style="color: white">
                <v-icon color="#FFFFFF">mdi-archive-plus</v-icon> Tambah Stok
              </h5>
              <h5 class="modal-title" v-show="editmode">Edit Stok</h5>
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
                <input v-model="csrf" type="hidden" name="_token" />

                <!-- tanggal -->
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="6" md="6">
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
                            v-model="editedItem.tanggal"
                            @blur="date = parseDate(editedItem.tanggal)"
                            :rules="editedItem.tanggalRules"
                            label="Tanggal Stok"
                            placeholder="tahun-bulan-hari"
                            prepend-icon="mdi-calendar"
                            v-bind="attrs"
                            v-on="on"
                            outlined
                            required
                            dense
                            readonly
                          ></v-text-field>
                        </template>
                        <v-date-picker
                          v-model="date"
                          elevation="15"
                          @input="menu1 = false"
                          year-icon="calendar-blank"
                          locale="id-ID"
                        ></v-date-picker>
                      </v-menu>
                    </v-col>
                    <v-col cols="12" sm="6">
                      <v-combobox
                        v-model="editedItem.jenis"
                        label="Jenis"
                        append-outer-icon="mdi-map"
                        :items="editedItem.jenisStok"
                        placeholder="Jenis"
                        hint="1=Tabungan | 2=deposito"
                        dense
                        outlined
                        :return-object="false"
                        persistent-hint
                        :error-messages="pesaneror"
                      ></v-combobox>
                    </v-col>

                    <v-col cols="12" sm="6" md="6">
                      <v-text-field
                        v-model="editedItem.jml_stok_awal"
                        :rules="editedItem.jmlstokawalRules"
                        name="jml_stok_awal"
                        label="Jumlah Stok Awal"
                        placeholder="input nilai angka"
                        prepend-icon="mdi-numeric-1-box-multiple"
                        outlined
                        required
                        dense
                        counter
                        maxlength="6"
                        type="number"
                        @keydown="pencetKeyboard($event)"
                        @change="inputStokAkhir"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-text-field
                        v-model="editedItem.tambahan_stok"
                        :rules="editedItem.tambahanStokRules"
                        name="tambahan_stok"
                        label="Tambahan Stok"
                        placeholder="input nilai angka"
                        append-outer-icon="mdi-numeric-2-box-multiple"
                        outlined
                        required
                        dense
                        counter
                        maxlength="6"
                        type="number"
                        @keydown="pencetKeyboard($event)"
                        @change="inputStokAkhir"
                      ></v-text-field>
                    </v-col>

                    <v-col cols="12" sm="6" md="6">
                      <v-text-field
                        v-model="editedItem.jml_digunakan"
                        :rules="editedItem.jmlDigunakanRules"
                        name="jml_digunakan"
                        label="Jml Digunakan"
                        placeholder="input nilai angka"
                        prepend-icon="mdi-numeric-3-box-multiple"
                        outlined
                        required
                        dense
                        counter
                        maxlength="6"
                        type="number"
                        @keydown="pencetKeyboard($event)"
                        @change="inputStokAkhir"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-text-field
                        v-model="editedItem.jml_rusak"
                        :rules="editedItem.jmlRusakRules"
                        name="jml_rusak"
                        label="Jumlah Rusak"
                        placeholder="input nilai angka"
                        append-outer-icon="mdi-numeric-4-box-multiple"
                        outlined
                        required
                        dense
                        counter
                        maxlength="6"
                        type="number"
                        @keydown="pencetKeyboard($event)"
                        @change="inputStokAkhir"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-text-field
                        v-model="editedItem.jml_hilang"
                        :rules="editedItem.jmlHilangRules"
                        name="jml_hilang"
                        label="Jumlah Hilang"
                        placeholder="input nilai angka"
                        prepend-icon="mdi-numeric-5-box-multiple"
                        outlined
                        required
                        dense
                        counter
                        maxlength="6"
                        type="number"
                        @keydown="pencetKeyboard($event)"
                        @change="inputStokAkhir"
                      ></v-text-field>
                    </v-col>

                    <v-col cols="12" sm="6" md="6">
                      <v-text-field
                        v-model="editedItem.jml_stok_akhir"
                        name="jml_stok_akhir"
                        label="Jml Stok Akhir"
                        placeholder="input nilai angka"
                        append-outer-icon="mdi-numeric-6-box-multiple"
                        outlined
                        required
                        dense
                        readonly
                        disabled
                        maxlength="6"
                        type="number"
                        @keydown="pencetKeyboard($event)"
                        @change="inputStokAkhir"
                      ></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>
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
                  Ubah
                </v-btn>
                <v-btn
                  color="primary"
                  elevation="2"
                  v-show="!editmode"
                  type="submit"
                >
                  <v-icon>mdi-archive-plus</v-icon>
                  Tambah
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
import moment from "moment";
export default {
  data: (vm) => ({
    csrf: document
      .querySelector('meta[name="csrf-token"]')
      .getAttribute("content"),
    editmode: false,
    dialog: false,
    dialogDelete: false,
    fromTgl: "",
    toTgl: "",
    filterFormTgl: "",
    date: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
      .toISOString()
      .substr(0, 10),

    search: "",
    stock: [],
    valid: true,
    editedIndex: -1,
    editedItem: {
      id: "",
      kantor_id: "",

      tanggal: vm.formatDate(
        new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
          .toISOString()
          .substr(0, 10)
      ),
      tanggalRules: [(v) => !!v || "Tanggal stok belum diisi"],
      jml_stok_awal: 0,
      jmlstokawalRules: [
        (v) => !!v || "harus diisi angka",
        (v) => v > -1 || "angka tidak boleh minus",
      ],
      tambahan_stok: 0,
      tambahanStokRules: [(v) => v > -1 || "angka tidak boleh minus"],
      jml_digunakan: 0,
      jmlDigunakanRules: [(v) => v > -1 || "angka tidak boleh minus"],
      jml_rusak: 0,
      jmlRusakRules: [(v) => v > -1 || "angka tidak boleh minus"],
      jml_hilang: 0,
      jmlHilangRules: [(v) => v > -1 || "angka tidak boleh minus"],
      jml_stok_akhir: "",

      jenis: "",
      jenisStok: ["1", "2"],
    },
    menu1: false,
    menu2: false,
    menu3: false,
    pesaneror: "",

    form: new Form({
      id: "",
      kantor_id: "",
      jenis: "",
      tanggal: "",
      jml_stok_awal: "",
      tambahan_stok: "",
      jml_digunakan: "",
      jml_rusak: "",
      jml_hilang: "",
      jml_stok_akhir: "",
    }),
    columnsExcel: [
      { label: "Jenis Stok", field: "jenis" },
      { label: "Sandi Kantor", field: "kode_kantor", align: "start" },
      {
        label: "Tanggal Stok",
        field: "tanggal",
        dataFormat: (value) => {
          return moment(value).format("DD/MM/YYYY");
        },
      },
      { label: "Jumlah Stok Awal", field: "jml_stok_awal" },
      { label: "Tambahan Stok", field: "tambahan_stok" },
      { label: "Jumlah Digunakan", field: "jml_digunakan" },
      { label: "Jumlah Rusak", field: "jml_rusak" },
      { label: "Jumlah Hilang", field: "jml_hilang" },
      { label: "Jumlah Stok Akhir", field: "jml_stok_akhir" },
    ],
    json_meta: [
      [
        {
          " key ": " charset ",
          " value ": " utf- 8 ",
        },
      ],
    ],
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
        { text: "Jenis Stok", value: "jenis", align: "start" },
        { text: "Sandi Kantor", value: "kode_kantor", align: "start" },
        { text: "Tanggal Stok", value: "tanggal" },
        { text: "Jumlah StokAwal", value: "jml_stok_awal", align: "center" },
        { text: "Tambahan Stok", value: "tambahan_stok", align: "center" },
        { text: "Jumlah Digunakan", value: "jml_digunakan", align: "center" },
        { text: "JumlahRusak", value: "jml_rusak", align: "center" },
        { text: "JumlahHilang", value: "jml_hilang", align: "center" },
        { text: "Jumlah StokAkhir", value: "jml_stok_akhir", align: "center" },
      ];
      headers.push({
        text: "Edit",
        value: "edit",
        sortable: false,
        align: "center",
      });

      headers.push({
        text: "Hapus",
        value: "actions",
        sortable: false,
        align: "center",
      });

      // if(this.$gate.isAdmin()){
      //     headers.push({ text: 'Edit', value: 'edit', sortable: false,align: 'center' })

      //     headers.push({ text: 'Hapus', value: 'actions', sortable: false, align: 'center' })
      // }
      return headers;
    },
    fromTglText() {
      return this.fromTgl ? moment(this.fromTgl).format("YYYY-MM-DD") : "";
    },
    toTglText() {
      return this.toTgl ? moment(this.toTgl).format("YYYY-MM-DD") : "";
    },
    computedDateFormatted() {
      return this.formatDate(this.editedItem.date);
    },

    // jenisKode: {
    //   get: function() {
    //     // find the code if it exist, else, just return the typed input
    //     const kode = this.editedItem.jenisStok.find(
    //       kode => kode.value === this.editedItem.jenis
    //     );
    //     return kode || this.editedItem.jenis;
    //   },
    //   set: function(value) {
    //     this.editedItem.jenis = value;
    //   }
    // },
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    },
  },
  watch: {
    date(val) {
      //this.editedItem.tanggal = this.formatDate(this.date)
      this.editedItem.tanggal = this.date;
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

    this.initialize();
    this.$Progress.finish();
  },

  methods: {
    pencetKeyboard: function (evt) {
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
        return true;
      }
    },
    inputStokAkhir() {
      this.editedItem.jml_stok_akhir =
        parseInt(this.editedItem.jml_stok_awal) +
        parseInt(this.editedItem.tambahan_stok) -
        parseInt(this.editedItem.jml_digunakan) -
        parseInt(this.editedItem.jml_rusak) -
        parseInt(this.editedItem.jml_hilang);
    },
    formatDate(date) {
      if (!date) return null;

      const [year, month, day] = date.split("-");
      return `${day}/${month}/${year}`;
    },
    formatDateExcel(value) {
      if (!value) return null;

      const [year, month, day] = value.split("-");
      return `${day}/${month}/${year}`;
      //return '$ ' + value;
    },
    parseDate(date) {
      if (!date) return null;

      const [day, month, year] = date.split("/");
      return `${year}-${month.padStart(2, "0")}-${day.padStart(2, "0")}`;
    },
    formatDateFilter(date) {
      if (!date) return null;

      const [year, month, day] = date.split("-");
      return `${day}/${month}/${year} ~ ${day}/${month}/${year}`;
    },
    filterTanggal() {
      this.$Progress.start();
      const formData = new FormData();
      formData.set("fromtgl", this.fromTglText);
      formData.set("totgl", this.toTglText);
      if (this.fromTglText != "" && this.toTglText != "") {
        if (this.$gate.isAdmin() || this.$gate.isAK()) {
          axios
            .get("api/stock/filtertanggal", {
              params: {
                fromtgl: this.fromTglText,
                totgl: this.toTglText,
              },
            })
            .then((response) => {
              this.stock = response.data.data;
              this.editedItem.kantor_id = this.$kantor_id;
              // this.form.fill
              //console.log(this.stock);
              //console.log(this.kantor_id)
            })
            .catch((error) => {
              console.log(error.response.data);
            });
        }
      } else {
        //Swal.fire("Gagal Filter", "Filter Tanggal Belum Dipilih...!", "warning");
        Swal.fire({
          icon: "error",
          title: "Error Filter",
          text: "Filter Tanggal Belum Dipilih...! ",
          width: 600,
          padding: "3em",
          color: "#ff0000",
          background: "#ff0000 url(/images/kayu.jpg)",
          backdrop: `
            rgba(255,0,64,0.4)
            url("/images/nyan-cat.gif")
            left top
            no-repeat
          `,
        });
      }

      this.$Progress.finish();
    },
    initialize() {
      this.$Progress.start();

      if (this.$gate.isAdmin() || this.$gate.isAK()) {
        //axios.get("api/user").then((response) => {(this.users = response.data.data)});
        axios
          .get("api/stock")
          .then((response) => {
            this.stock = response.data.data;
            this.editedItem.kantor_id = this.$kantor_id;
            // this.form.fill
            //console.log(this.stock);
            //console.log(this.kantor_id)
          })
          .catch((error) => {
            console.log(error.response.data);
          });
      }

      this.$Progress.finish();
    },
    editModal(item) {
      this.editmode = true;
      //this.$refs.form.reset()
      $("#addNew").modal("show");
      this.editedIndex = this.stock.indexOf(item);
      // this.editedItem = Object.assign({}, item)

      this.editedItem.kantor_id = this.$kantor_id;
      this.editedItem.tanggal = item.tanggal;
      //this.editedItem.dateFormatted      = this.formatDate(this.tanggal);
      this.editedItem.id = item.id;
      this.editedItem.jenis = item.jenis;
      this.editedItem.jml_stok_awal = item.jml_stok_awal;
      this.editedItem.tambahan_stok = item.tambahan_stok;
      this.editedItem.jml_digunakan = item.jml_digunakan;
      this.editedItem.jml_rusak = item.jml_rusak;
      this.editedItem.jml_hilang = item.jml_hilang;
      this.editedItem.jml_stok_akhir = item.jml_stok_akhir;

      //  console.log(item.id);
      console.log(this.$kantor_id);
    },
    newModal() {
      this.editmode = false;
      $("#addNew").modal("show");
      this.$refs.form.reset();
      //this.namafile = '';
    },

    createUser() {
      this.$refs.form.validate();
      this.$Progress.start();
      // e.preventDefault();
      const config = {
        headers: { "content-type": "multipart/form-data" },
      };

      const formData = new FormData();
      formData.set("kantor_id", this.editedItem.kantor_id);
      formData.set("jenis", this.editedItem.jenis);
      formData.set("tanggal", this.editedItem.tanggal);
      formData.set("jml_stok_awal", this.editedItem.jml_stok_awal);
      formData.set("tambahan_stok", this.editedItem.tambahan_stok);
      formData.set("jml_digunakan", this.editedItem.jml_digunakan);
      formData.set("jml_rusak", this.editedItem.jml_rusak);
      formData.set("jml_hilang", this.editedItem.jml_hilang);
      formData.set(
        "jml_stok_akhir",
        parseInt(this.editedItem.jml_stok_awal) +
          parseInt(this.editedItem.tambahan_stok) -
          parseInt(this.editedItem.jml_digunakan) -
          parseInt(this.editedItem.jml_rusak) -
          parseInt(this.editedItem.jml_hilang)
      );

      //formData.append('jml_stok_akhir', this.jml_stok_awal);
      // console.log(this.file);
      axios
        .post("api/stock", formData, config)
        .then((response) => {
          $("#addNew").modal("hide");

          Toast.fire({
            icon: "success",
            title: response.data.message,
          });

          this.$Progress.finish();
          this.initialize();
        })
        .catch((response) => {
          //Swal.fire("Failed!", data.message, "warning");
          Toast.fire({
            icon: "error",
            title: "Gagal tambah stok, ulangi!",
            //title: response.message
          });
        });
    },
    downloadFile(id, file) {
      axios({
        url: "api/stock/download/" + id,
        method: "GET",
        responseType: "blob",
      })
        .then((response) => {
          var fileUrl = window.URL.createObjectURL(new Blob([response.data]));
          var fileLink = document.createElement("a");
          fileLink.href = fileUrl;

          fileLink.setAttribute("download", "stock.zip");
          fileLink.download = file;
          document.body.appendChild(fileLink);

          fileLink.click();
        })
        .catch(() => {
          Swal.fire("Gagal Download!", "File tidak ada...", "warning");
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
      formData.set("kantor_id", this.editedItem.kantor_id);
      formData.set("jenis", this.editedItem.jenis);
      formData.set("tanggal", this.editedItem.tanggal);
      formData.set("jml_stok_awal", this.editedItem.jml_stok_awal);
      formData.set("tambahan_stok", this.editedItem.tambahan_stok);
      formData.set("jml_digunakan", this.editedItem.jml_digunakan);
      formData.set("jml_rusak", this.editedItem.jml_rusak);
      formData.set("jml_hilang", this.editedItem.jml_hilang);
      formData.set(
        "jml_stok_akhir",
        parseInt(this.editedItem.jml_stok_awal) +
          parseInt(this.editedItem.tambahan_stok) -
          parseInt(this.editedItem.jml_digunakan) -
          parseInt(this.editedItem.jml_rusak) -
          parseInt(this.editedItem.jml_hilang)
      );
      formData.append("_method", "PUT");

      // console.log(formData);
      axios
        .post("api/stock/" + this.editedItem.id, formData, config)
        //axios.put('api/stock/27',formData)
        .then((response) => {
          console.log(this.editedItem.id);
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
            .delete("api/stock/" + id)
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
