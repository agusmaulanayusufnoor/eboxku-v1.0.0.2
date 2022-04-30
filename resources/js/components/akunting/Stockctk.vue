<template>
<v-app>
    <v-container fluid>
        <v-row no-gutters class="justify-content-md-center">
          <v-col cols="12">
            <v-card class="pa-2 mx-auto" v-if="$gate.isAdmin() || $gate.isAK()">
              <v-toolbar src="images/banner-biru-pelayanan.jpg"
              color="rgb(39,154,187)" dark shaped>
                <v-toolbar-title>
                    Stok Barang Cetakan
                </v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn small color="indigo" dark @click="newModal">
                     <v-icon>mdi-cart-plus</v-icon> Tambah Stok
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
                  'items-per-page-options': [5,10,14, 140, -1],
                  'items-per-page-text':'baris per halaman'
                }"
                justify="center"
                dense
                class="elevation-3">
                <template v-slot:footer.prepend>
                  <v-btn
                    color="success"
                    dark
                    class="ma-2"
                    small
                    @click="initialize()"
                    >
                      Refresh
                      <v-icon
                        right
                        dark
                      >
                        mdi-reload
                      </v-icon>
                    </v-btn>
                </template>
                <template v-slot:item.index="{ index }">
                    {{ index + 1 }}
                </template>

                <template v-slot:top>
                <v-toolbar flat >
                 <vue-excel-xlsx
                        :data="stock"
                        :columns="columnsExcel"
                        :file-name="'stockbarang'"
                        :file-type="'xlsx'"
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
                      <v-col
                      cols="12"
                      sm="6"
                      md="5"
                      >
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
                      <v-col
                      cols="12"
                      sm="6"
                      md="5"
                      >
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
                      <v-icon>
                        mdi-filter
                      </v-icon>
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
                     <v-icon
                        small
                        color="green"
                        @click="editModal(item)"
                        >
                        mdi-pencil
                    </v-icon>
                    </v-card-actions>
                </template>

                <!-- tombol hapus -->
                <template v-slot:item.actions="{ item }">

                <v-icon
                    small
                    color="red"

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

        <div v-if="!$gate.isAdmin() && !$gate.isAK()">
            <not-found></not-found>
        </div>

  <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
                <div class="modal-content">
                <div class="modal-header primary">
                    <h5 class="modal-title" v-show="!editmode" style="color:white;">Tambah Stok</h5>
                    <h5 class="modal-title" v-show="editmode">Edit Stok</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                            <input v-model="editedItem.kantor_id" type="hidden"
                            name="kantor_id">
                            <input v-model="csrf" type="hidden"
                            name="_token">


                             <!-- tanggal -->
                        <v-container>
                            <v-row>
                            <v-col
                            cols="12"
                            sm="3"
                            md="3"
                            >
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
                                        v-model="editedItem.periode"
                                        :value="periodeMomentJS"
                                        @blur="editedItem.periode = periodeMomentJS"
                                        :rules="editedItem.periodeRules"
                                        label="Periode"
                                        placeholder="periode bulan"
                                        prepend-icon="mdi-calendar"
                                        v-bind="attrs"
                                        v-on="on"
                                        outlined
                                        required
                                        dense
                                        clearable
                                        readonly
                                        @click:clear="date = null"
                                    ></v-text-field>
                                </template>
                                <v-date-picker
                                    v-model="date"
                                    type="month"
                                    elevation="15"
                                    @input="menu1 = false"
                                    year-icon="mdi-calendar-blank"
                                    prev-icon="mdi-skip-previous"
                                    next-icon="mdi-skip-next"
                                    locale="id-ID"
                                ></v-date-picker>

                                </v-menu>
                            </v-col>
                            <v-col
                                cols="12"
                                sm="3"
                            >
                                <v-combobox
                                v-model="editedItem.barang_id"
                                label="Nama Barang"
                                append-outer-icon="mdi-cart-variant"
                                :items="editedItem.namaBarang"
                                item-value="id"
                                item-text="namabarang"
                                placeholder="Daftar Barang"
                                dense
                                outlined
                                :return-object="false"
                                persistent-hint :error-messages="pesaneror"
                                @click="getBarang()"
                                ></v-combobox>
                            </v-col>
                            <v-col
                                cols="12"
                                sm="3"
                                md="3"
                            >
                                <v-combobox
                                v-model="editedItem.satuan_id"
                                label="Satuan"
                                prepend-icon="mdi-scale"
                                :items="editedItem.namaSatuan"
                                item-value="id"
                                item-text="namasatuan"
                                placeholder="Pilih Satuan"
                                dense
                                outlined
                                :return-object="false"
                                persistent-hint :error-messages="pesaneror"
                                @click="getSatuan()"
                                ></v-combobox>
                            </v-col>
                            <v-col cols="12" sm="3" md="3">
                               <v-text-field
                                v-model="editedItem.harga_satuan"
                                :rules="editedItem.hargaSatuanRules"
                                name="harga_satuan"
                                label="Harga Satuan"
                                placeholder="Harga Satuan"
                                append-outer-icon="mdi-cash"
                                outlined
                                required
                                dense
                                counter
                                maxlength="7"
                                @keydown="pencetKeyboard($event)"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="3" md="3">
                               <v-text-field
                                v-model="editedItem.stok_awal"
                                :rules="editedItem.stokAwalRules"
                                name="stok_awal"
                                label="Stok Awal"
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
                            <v-col cols="12" sm="3" md="3">
                               <v-text-field
                                v-model="editedItem.stok_masuk"
                                :rules="editedItem.stokMasukRules"
                                name="stok_masuk"
                                label="Stok Masuk"
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

                            <v-col cols="12" sm="3" md="3">
                               <v-text-field
                                v-model="editedItem.stok_keluar"
                                :rules="editedItem.stokKeluarRules"
                                name="stok_keluar"
                                label="Stok Keluar"
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
                            <v-col cols="12" sm="3" md="3">
                               <v-text-field
                                v-model="editedItem.stok_akhir"
                                name="stok_akhir"
                                label="Stok Akhir"
                                placeholder="input nilai angka"
                                append-outer-icon="mdi-numeric-4-box-multiple"
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

                            <v-col cols="12" sm="3" md="3">
                               <v-text-field
                                v-model="editedItem.nom_awal"
                                :rules="editedItem.nomAwalRules"
                                name="nominal_awal"
                                label="Nominal Awal"
                                placeholder="input nilai angka"
                                prepend-icon="mdi-numeric-1-box-multiple"
                                outlined
                                required
                                dense
                                counter
                                maxlength="6"
                                @keydown="pencetKeyboard($event)"
                                @change="inputNominalAkhir"
                                ></v-text-field>
                            </v-col>

                            <v-col cols="12" sm="3" md="3">
                               <v-text-field
                                v-model="editedItem.nom_masuk"
                                :rules="editedItem.nomMasukRules"
                                name="nom_masuk"
                                label="Nominal Masuk"
                                placeholder="input nilai angka"
                                append-outer-icon="mdi-numeric-2-box-multiple"
                                outlined
                                required
                                dense
                                counter
                                maxlength="6"
                                @keydown="pencetKeyboard($event)"
                                @change="inputNominalAkhir"
                                ></v-text-field>
                            </v-col>

                            <v-col cols="12" sm="3" md="3">
                               <v-text-field
                                v-model="editedItem.nom_keluar"
                                :rules="editedItem.nomKeluarRules"
                                name="nominal_keluar"
                                label="Nominal Keluar"
                                placeholder="input nilai angka"
                                prepend-icon="mdi-numeric-3-box-multiple"
                                outlined
                                required
                                dense
                                counter
                                maxlength="6"
                                @keydown="pencetKeyboard($event)"
                                @change="inputNominalAkhir"
                                ></v-text-field>
                            </v-col>

                             <v-col cols="12" sm="3" md="3">
                               <v-text-field
                                v-model="editedItem.nom_akhir"
                                name="nom_akhir"
                                label="Nominal Akhir"
                                placeholder="input nilai angka"
                                append-outer-icon="mdi-numeric-4-box-multiple"
                                outlined
                                required
                                dense
                                readonly
                                disabled
                                maxlength="6"
                                @keydown="pencetKeyboard($event)"
                                @change="inputNominalAkhir"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" sm="12" md="12">
                               <v-text-field
                                v-model="editedItem.keterangan"
                                name="keterangan"
                                label="Keterangan"
                                placeholder="Keterangan"
                                prepend-icon="mdi-note"
                                outlined
                                required
                                dense
                                ></v-text-field>
                            </v-col>

                            </v-row>
                        </v-container>

                    </div>
                    <div class="modal-footer">
                        <v-btn color="error" elevation="2" type="button" data-dismiss="modal">
                        <v-icon>mdi-file-cancel</v-icon>
                            Batal
                        </v-btn>
                        <v-btn color="success" elevation="2" v-show="editmode" type="submit" >
                            <v-icon>mdi-pencil</v-icon>
                            Ubah
                        </v-btn>
                        <v-btn color="primary" elevation="2" v-show="!editmode" type="submit" >
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
import moment from 'moment';
  export default {
    data: vm => ({
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      editmode: false,
      dialog: false,
      dialogDelete: false,
      fromTgl: '',
      toTgl: '',
      filterFormTgl:'',
      date: new Date().toISOString().substr(0, 7),

      search:'',
     stock:[],
     valid:true,
     editedIndex: -1,
     editedItem: {
        id : '',
        kantor_id: '',
        keterangan: '',
        //periode: vm.formatDate((new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)),
        periode: '',
        periodeRules: [
          v => !!v || 'Bulan periode belum diisi',
        ],
        harga_satuan: '',
        hargaSatuanRules: [
          v => !!v || 'Harga Satuan belum diisi',
        ],
        stok_awal: 0,
        stokAwalRules: [
        v => !!v || 'harus diisi angka',
        v => v>-1 || 'angka tidak boleh minus'
      ],
      stok_masuk: 0,
        stokMasukRules: [
          v => !!v || 'harus diisi angka',
        v => v>-1 || 'angka tidak boleh minus'
      ],
       stok_keluar: 0,
        stokKeluarRules: [
          v => !!v || 'harus diisi angka',
        v => v>-1 || 'angka tidak boleh minus'
      ],
      stok_akhir: 0,
      nom_awal: 0,
      nomAwalRules: [

        v => v>-1 || 'angka tidak boleh minus'
      ],
      nom_masuk: 0,
      nomMasukRules: [

        v => v>-1 || 'angka tidak boleh minus'
      ],
      nom_keluar: 0,
      nomKeluarRules: [

        v => v>-1 || 'angka tidak boleh minus'
      ],
      stok_akhir: '',
      nom_akhir: '',
      barang_id: '',
      namaBarang:[],
      satuan_id: '',
      namaSatuan:[],
     },
      menu1: false,
      menu2: false,
      menu3: false,
      pesaneror:'',


    form: new Form({
        id : '',
        kantor_id: '',
        barang_id: '',
        satuan_id: '',
        periode: '',
        harga_satuan: '',
        stok_awal:'',
        stok_masuk: '',
        stok_keluar: '',
        stok_akhir: '',
        nom_awal: '',
        nom_masuk: '',
        nom_keluar: '',
        nom_akhir: '',
        keterangan: '',
    }),
    columnsExcel : [

                { label: 'Jenis Stok', field: 'jenis'},
                { label: 'Sandi Kantor', field: 'kode_kantor',align: 'start', },
                { label: 'Tanggal Stok', field: 'tanggal' },
                { label: 'Stok Awal',field: 'stok_awal' },
                { label: 'Stok Masuk', field: 'stok_masuk' },
                { label: 'Stok Keluar', field: 'stok_keluar' },
                { label: 'Stok Akhir', field: 'stok_akhir' },
      ],
    json_meta: [
          [{
            " key ": " charset ",
            " value ": " utf- 8 "
          }]
        ],

    }),

    computed: {
        headers(){
            let headers = [
                {
                text: 'No',
                value: 'index',
                align: 'center',
                sortable: false
                },

                { text: 'Sandi Kantor', value: 'kode_kantor',align: 'start', },
                { text: 'Periode', value: 'periode' },
                { text: 'Nama Barang', value: 'barang_id' },
                { text: 'Satuan', value: 'satuan_id' },
                { text: 'Harga Satuan', value: 'harga_satuan' },

                { text: 'Stok Awal', value: 'stok_awal',align: 'center' },
                { text: 'Stok Masuk', value: 'stok_masuk',align: 'center' },
                { text: 'Stok Keluar', value: 'stok_keluar',align: 'center' },
                { text: 'Stok Akhir', value: 'stok_akhir',align: 'center' },
                { text: 'Nominal Awal', value: 'nom_awal',align: 'center' },
                { text: 'Nominal Masuk', value: 'nom_masuk',align: 'center' },
                { text: 'Nominal Keluar', value: 'nom_keluar',align: 'center' },
                { text: 'Nominal Akhir', value: 'nom_akhir',align: 'center' },
                { text: 'Ket.', value: 'keterangan',align: 'center' },
      ]
            // headers.push({ text: 'Edit', value: 'edit', sortable: false,align: 'center' })

                headers.push({ text: 'Hapus', value: 'actions', sortable: false, align: 'center' })

            // if(this.$gate.isAdmin()){
            //     headers.push({ text: 'Edit', value: 'edit', sortable: false,align: 'center' })

            //     headers.push({ text: 'Hapus', value: 'actions', sortable: false, align: 'center' })
            // }
            return headers
        },
        fromTglText () {

        return this.fromTgl ? moment(this.fromTgl).format('DD/MM/YYYY') : '';
        },
        toTglText () {

        return this.toTgl ? moment(this.toTgl).format('DD/MM/YYYY') : '';
        },
        periodeMomentJS () {

        return this.date ? moment(this.date).format('MMMM YYYY') : '';
        },
        computedDateFormatted () {
            return this.formatDate(this.editedItem.date);
        },

      formTitle () {
        return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
      },

    },
    watch: {
      date (val) {
        this.editedItem.periode = moment(this.date).format('MMMM YYYY')
      },
      dialog (val) {
        val || this.close()
      },
      dialogDelete (val) {
        val || this.closeDelete()
      },
    },
//     beforeCreate: function() {

//     console.log(this.$kantor_id)
//   },
    created () {
        this.$Progress.start();

      this.initialize()
      this.$Progress.finish();
    },

    methods: {
        pencetKeyboard: function(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      //nomer wungkul
      if ((charCode > 31 && (charCode < 48 || charCode > 57) && (charCode < 95 || charCode > 105 )) && charCode !== 46)  {
      //tidak boleh tombol '/' dan '\'
      //if (charCode === 191 || charCode===220) {
        evt.preventDefault();;
      } else {
        return true;
      }

    },
    inputStokAkhir() {
      this.editedItem.stok_akhir = parseInt(this.editedItem.stok_awal)+parseInt(this.editedItem.stok_masuk)-parseInt(this.editedItem.stok_keluar);
    },
    inputNominalAkhir() {
      this.editedItem.nom_akhir = parseInt(this.editedItem.nom_awal)+parseInt(this.editedItem.nom_masuk)-parseInt(this.editedItem.nom_keluar);
    },
    formatDate (date) {
        if (!date) return null

        const [year, month] = date.split('-')
        return `${month}/${year}`
      },
       parseDate (date) {
        if (!date) return null

        const [day, month,  year] = date.split('/')
        return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
      },
      formatDateFilter (date) {
        if (!date) return null

        const [year, month, day] = date.split('-')
        return `${day}/${month}/${year} ~ ${day}/${month}/${year}`
      },
      filterTanggal(){
        this.$Progress.start();
            const formData = new FormData
                formData.set('fromtgl', this.fromTglText);
                formData.set('totgl', this.toTglText);
      if(this.fromTglText !='' && this.toTglText != ''){
        if(this.$gate.isAdmin() || this.$gate.isAK() ){
         axios.get("api/stock/filtertanggal",{
            params: {
              fromtgl: this.fromTglText,
              totgl: this.toTglText
            }
          })
            .then((response) => {
                this.stock = response.data.data;
                this.editedItem.kantor_id = this.$kantor_id;
                // this.form.fill
                //console.log(this.stock);
                //console.log(this.kantor_id)
                }).catch((error)=>{
                console.log(error.response.data);
                  });
        }
      }else{
        //Swal.fire("Gagal Filter", "Filter Tanggal Belum Dipilih...!", "warning");
        Swal.fire({
          icon: 'error',
          title: 'Error Filter',
          text: 'Filter Tanggal Belum Dipilih...! ',
          width: 600,
          padding: '3em',
          color: '#ff0000',
          background: '#ff0000 url(/images/kayu.jpg)',
          backdrop: `
            rgba(255,0,64,0.4)
            url("/images/nyan-cat.gif")
            left top
            no-repeat
          `
        })
      }

        this.$Progress.finish();
      },
      getBarang() {

            if(this.$gate.isAdmin() || this.$gate.isAK() ){

               //axios.get("api/user").then((response) => {(this.users = response.data.data)});
             axios.get("api/stockctk/getbarang")
                .then((response) => {

                this.editedItem.namaBarang = response.data.data

                //console.log(this.editedItem.namaBarang);
                //console.log(this.kantor_id)
                }).catch((error)=>{
                console.log(error.response.data);
                  });
            }
      },
      getSatuan() {

            if(this.$gate.isAdmin() || this.$gate.isAK() ){

               //axios.get("api/user").then((response) => {(this.users = response.data.data)});
             axios.get("api/stockctk/getsatuan")
                .then((response) => {

                this.editedItem.namaSatuan = response.data.data

                //console.log(this.editedItem.namaBarang);
                //console.log(this.kantor_id)
                }).catch((error)=>{
                console.log(error.response.data);
                  });
            }
      },
      initialize() {
         this.$Progress.start();

            if(this.$gate.isAdmin() || this.$gate.isAK() ){

               //axios.get("api/user").then((response) => {(this.users = response.data.data)});
             axios.get("api/stockctk")
                .then((response) => {
                this.stock = response.data.data;
                this.editedItem.kantor_id = this.$kantor_id;
                // this.form.fill
                //console.log(this.stock);
                //console.log(this.kantor_id)
                }).catch((error)=>{
                console.log(error.response.data);
                  });
            }

           this.$Progress.finish();
      },
      editModal(item){


         this.editmode = true;
         //this.$refs.form.reset()
         $('#addNew').modal('show');
         this.editedIndex = this.stock.indexOf(item)
       // this.editedItem = Object.assign({}, item)

        this.editedItem.kantor_id = this.$kantor_id;
        this.editedItem.tanggal                  = item.tanggal;
        //this.editedItem.dateFormatted      = this.formatDate(this.tanggal);
        this.editedItem.id                 = item.id;
        this.editedItem.jenis              = item.jenis;
        this.editedItem.jml_stok_awal      = item.jml_stok_awal;
        this.editedItem.tambahan_stok      = item.tambahan_stok;
        this.editedItem.jml_digunakan      = item.jml_digunakan;
        this.editedItem.jml_rusak          = item.jml_rusak;
        this.editedItem.jml_hilang         = item.jml_hilang;
        this.editedItem.jml_stok_akhir     = item.jml_stok_akhir;

        //  console.log(item.id);
          console.log(this.$kantor_id);
      },
      newModal(){
        this.editmode = false;
        $('#addNew').modal('show');
        this.$refs.form.reset()
        //this.namafile = '';
      },

     createUser(){
         this.$refs.form.validate();
         this.$Progress.start();
            // e.preventDefault();
            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }


            const formData = new FormData
            formData.set('kantor_id', this.editedItem.kantor_id)
            formData.set('periode', this.editedItem.periode)
            formData.set('barang_id', this.editedItem.barang_id)
            formData.set('satuan_id', this.editedItem.satuan_id)
            formData.set('harga_satuan', this.editedItem.harga_satuan)
            formData.set('stok_awal', this.editedItem.stok_awal)
            formData.set('stok_masuk', this.editedItem.stok_masuk)
            formData.set('stok_keluar', this.editedItem.stok_keluar)
            formData.set('stok_akhir', parseInt(this.editedItem.stok_awal)+parseInt(this.editedItem.stok_masuk)-parseInt(this.editedItem.stok_keluar))
            formData.set('nom_awal', this.editedItem.nom_awal)
            formData.set('nom_masuk', this.editedItem.nom_masuk)
            formData.set('nom_keluar', this.editedItem.nom_keluar)
            formData.set('nom_akhir', parseInt(this.editedItem.nom_awal)+parseInt(this.editedItem.nom_masuk)-parseInt(this.editedItem.nom_keluar))
            formData.set('keterangan', this.editedItem.keterangan)
             //formData.append('jml_stok_akhir', this.jml_stok_awal);
           // console.log(this.file);
            axios.post('api/stockctk',formData,config)
              .then((response)=>{
                  $('#addNew').modal('hide');

                  Toast.fire({
                        icon: 'success',
                        title: response.data.message
                  });

                  this.$Progress.finish();
                  this.initialize();

              })
              .catch((response)=>{
                  //Swal.fire("Failed!", data.message, "warning");
                  Toast.fire({
                      icon: 'error',
                      title: 'Gagal tambah stok, ulangi!'
                      //title: response.message
                  });
              })
          },

          updateUser(){
            const config = {
                headers: {
                  'accept': 'application/json',
                  'Accept-Language': 'en-US,en;q=0.8',
                  'content-type': 'multipart/form-data'
                  }
               // headers: {'X-Custom-Header': 'value'}
            }
                this.$refs.form.validate();
                this.$Progress.start();
             //console.log(this.editedItem.id)
           const formData = new FormData
            formData.set('kantor_id', this.editedItem.kantor_id)
            formData.set('jenis', this.editedItem.jenis)
            formData.set('tanggal', this.editedItem.tanggal)
            formData.set('jml_stok_awal', this.editedItem.jml_stok_awal)
            formData.set('tambahan_stok', this.editedItem.tambahan_stok)
            formData.set('jml_digunakan', this.editedItem.jml_digunakan)
            formData.set('jml_rusak', this.editedItem.jml_rusak)
            formData.set('jml_hilang', this.editedItem.jml_hilang)
            formData.set('jml_stok_akhir', parseInt(this.editedItem.jml_stok_awal)+parseInt(this.editedItem.tambahan_stok)-parseInt(this.editedItem.jml_digunakan)-parseInt(this.editedItem.jml_rusak)-parseInt(this.editedItem.jml_hilang))
            formData.append("_method", "PUT");

            // console.log(formData);
              axios.post('api/stock/'+this.editedItem.id, formData, config)
                 //axios.put('api/stock/27',formData)
                .then((response) => {
                 console.log(this.editedItem.id)
                    // success
                    $('#addNew').modal('hide');
                    Toast.fire({
                      icon: 'success',
                      title: response.data.message
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
          deleteUser(id){
                Swal.fire({
                    title: 'Yakin dihapus?',
                    text: "Jika dihapus data hilang!",
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!'
                    }).then((result) => {

                        // Send request to the server
                         if (result.value) {
                                this.form.delete('api/stock/'+id).then(()=>{
                                        Swal.fire(
                                        'Dihapus!',
                                        'Data telah dihapus.',
                                        'success'
                                        );
                                    // Fire.$emit('AfterCreate');
                                    this.initialize();
                                }).catch((data)=> {
                                  Swal.fire("Failed!", data.message, "warning");
                              });
                         }
                    })
            },

    },
  }
</script>
