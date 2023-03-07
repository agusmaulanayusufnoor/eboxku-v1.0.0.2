<template>
<v-app>
    <v-container fluid>
        <v-row no-gutters class="justify-content-md-center">
          <v-col cols="11">
            <v-card class="pa-2 mx-auto" v-if="$gate.isAdmin() || $gate.isUM() || $gate.isSekdir()">
              <v-toolbar src="images/banner-yellow.jpg" color="yellow" dark shaped>
                <v-toolbar-title>
                    File Perjanjian Kerjasama
                </v-toolbar-title>
                <v-spacer></v-spacer>
                  <v-btn small color="indigo" dark @click="newModal">
                     <v-icon>mdi-file-upload</v-icon> Upload File
                  </v-btn>
              </v-toolbar>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <v-data-table
                :headers="headers"
                :items="pk"
                :search="search"
                justify="center"
                dense
                class="elevation-3">
                <template v-slot:item.tglmulai="{ item }">
                {{ formatDate(item.tglmulai) }}
                </template>
                <template v-slot:item.tglakhir="{ item }">
                {{ formatDate2(item.tglakhir) }}
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
                     <!-- tglmulai -->

                     <v-dialog
                        ref="dialog"
                        v-model="modal1"
                        :return-value.sync="filterDatemulai"
                        persistent
                        width="290px"
                    >
                                <template v-slot:activator="{ on, attrs }">
                                    <v-text-field
                                        v-model="filterTglmulai"
                                        label="Filter Tanggal Mulai"
                                        placeholder="Filter Tanggal Mulai"
                                        prepend-icon="mdi-calendar"
                                        v-bind="attrs"
                                        v-on="on"
                                        single-line
                                        hide-details
                                        readonly
                                        clearable
                                        :return-object="false"
                                        persistent-hint :error-messages="pesaneror"

                                    ></v-text-field>
                                </template>
                                <v-date-picker
                                    v-model="filterDatemulai"
                                    range
                                    scrollable
                                    year-icon="calendar-blank"
                                    locale="id-ID"
                                    elevation="15"
                                >
                                <v-spacer></v-spacer>
                                    <v-btn
                                        text
                                        color="primary"
                                        @click="modal1 = false"
                                    >
                                        Batal
                                    </v-btn>
                                    <v-btn
                                        text
                                        color="primary"
                                        @click="$refs.dialog.save(filterDatemulai),getFiltertglmulai()"

                                    >
                                        OK
                                    </v-btn>
                                </v-date-picker>
                     </v-dialog>
                            <has-error :form="form" field="filterTglmulai"></has-error>
                    <v-spacer></v-spacer>
                    <v-spacer></v-spacer>
                     <!-- filter tanggal akhir -->
                     <v-dialog
                        ref="dialog2"
                        v-model="modal2"
                        :return-value.sync="filterDateakhir"
                        persistent
                        width="290px"
                    >
                                <template v-slot:activator="{ on, attrs }">
                                    <v-text-field
                                        v-model="filterTglakhir"
                                        label="Filter Tanggal Akhir"
                                        placeholder="Filter Tanggal Akhir"
                                        prepend-icon="mdi-calendar"
                                        v-bind="attrs"
                                        v-on="on"
                                        single-line
                                        hide-details
                                        readonly
                                        clearable
                                        :return-object="false"
                                        persistent-hint :error-messages="pesaneror"

                                    ></v-text-field>
                                </template>
                                <v-date-picker
                                    v-model="filterDateakhir"
                                    range
                                    scrollable
                                    year-icon="calendar-blank"
                                    locale="id-ID"
                                    elevation="15"
                                >
                                <v-spacer></v-spacer>
                                    <v-btn
                                        text
                                        color="primary"
                                        @click="modal2 = false"
                                    >
                                        Batal
                                    </v-btn>
                                    <v-btn
                                        text
                                        color="primary"
                                        @click="$refs.dialog2.save(filterDateakhir),getFiltertglakhir()"

                                    >
                                        OK
                                    </v-btn>
                                </v-date-picker>
                     </v-dialog>
                            <has-error :form="form" field="filterTglakhir"></has-error>
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

                <!-- tombol download -->
                <template v-slot:item.file="{ item }">
                    <v-card-actions class="justify-center">
                        <v-icon
                            small
                            color="blue"
                            class="mr-4"
                            @click="downloadFile(item.id,item.file)"
                        >
                            mdi-download
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
                <!-- edit table -->
                <template v-slot:item.no_pk="{ item }">
                     <v-edit-dialog

                        @save="save"
                        @cancel="cancel"
                        @open="open(item)"
                        @close="close"

                        >
                        {{ item.no_pk }}
                        <template v-slot:input>
                            <div class="mt-4 text-h6">
                            Edit Jenis PKS
                            </div>
                            <v-text-field
                            v-model="editedItem.no_pk"
                            :rules="[max200chars]"
                            label="Edit"
                            single-line
                            counter
                            ></v-text-field>
                        </template>
                        </v-edit-dialog>

                </template>
                <template v-slot:item.namafile="{ item }">
                     <v-edit-dialog

                        @save="save"
                        @cancel="cancel"
                        @open="open(item)"
                        @close="close"

                        >
                        {{ item.namafile }}
                        <template v-slot:input>
                            <div class="mt-4 text-h6">
                            Edit Jenis PKS
                            </div>
                            <v-text-field
                            v-model="editedItem.namafile"
                            :rules="[max200chars]"
                            label="Edit"
                            single-line
                            counter
                            ></v-text-field>
                        </template>
                        </v-edit-dialog>

                </template>


                    <template v-slot:item.namamitra="{ item }">
                     <v-edit-dialog

                        @save="save"
                        @cancel="cancel"
                        @open="open(item)"
                        @close="close"

                        >
                        {{ item.namamitra }}
                        <template v-slot:input>
                            <div class="mt-4 text-h6">
                            Edit Nama Mitra
                            </div>
                            <v-text-field
                            v-model="editedItem.namamitra"
                            :rules="[max200chars]"
                            label="Edit"
                            single-line
                            counter
                            ></v-text-field>
                        </template>
                        </v-edit-dialog>

                    </template>
                <!-- end edit table -->
               </v-data-table>
             </div>
              <!-- /.card-body -->
              <!-- <div class="card-footer">
                  <pagination :data="users" @pagination-change-page="getResults"></pagination>
              </div> -->
            </v-card>
          </v-col>
        </v-row>

        <div v-if="!$gate.isAdmin() && !$gate.isUM() && !$gate.isSekdir()">
            <not-found></not-found>
        </div>

  <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode">Upload File</h5>
                    <h5 class="modal-title" v-show="editmode">Edit Data User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <v-form
                @submit.prevent="createUser"
                ref="form"
                v-model="valid"
                lazy-validation
                >

                <!-- <form @submit.prevent="editmode ? updateUser() : createUser()"> -->
                    <div class="modal-body">
                            <input v-model="kantor_id" type="hidden"
                            name="kantor_id">
                            <input v-model="csrf" type="hidden"
                            name="_token">

                        <div class="form-group input-group">
                             <v-col
                                cols="12"
                                sm="12"
                                md="12"
                             >
                             <v-text-field
                                v-model="editedItem.no_pk"
                                :rules="editedItem.nopkRules"
                                name="no_pk"
                                label="Nomor PKS"
                                placeholder="input no. pks"
                                counter
                                maxlength="100"
                                outlined
                                required
                                dense
                                prepend-icon="mdi-file"
                                hint=""
                                persistent-hint :error-messages="pesaneror"
                            ></v-text-field>
                            <has-error :form="form" field="no_pk"></has-error>
                             <v-text-field
                                v-model="editedItem.namamitra"
                                :rules="editedItem.namemitraRules"
                                name="namamitra"
                                label="Nama Mitra"
                                placeholder="input nama mitra"
                                outlined
                                required
                                dense
                                prepend-icon="mdi-file"
                            ></v-text-field>
                            <has-error :form="form" field="namafile"></has-error>
                            <v-text-field
                                v-model="editedItem.namafile"
                                :rules="editedItem.nameRules"
                                name="namafile"
                                label="Jenis Kerjasama"
                                placeholder="input PKS"
                                outlined
                                required
                                dense
                                prepend-icon="mdi-file"
                            ></v-text-field>
                            <has-error :form="form" field="namafile"></has-error>
                        <!-- tglmulai -->

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
                                        @blur="tglmulai = parseDate(dateFormatted)"
                                        :rules="tglmulaiRules"
                                        label="Tanggal Mulai"
                                        placeholder="Tanggal Mulai PKS"
                                        prepend-icon="mdi-calendar"
                                        v-bind="attrs"
                                        v-on="on"
                                        outlined
                                        required
                                        dense
                                    ></v-text-field>
                                </template>
                                <v-date-picker
                                    v-model="tglmulai"
                                    elevation="15"
                                    @input="menu1 = false"
                                    year-icon="calendar-blank"
                                    locale="id-ID"
                                ></v-date-picker>
                                </v-menu>
                            <has-error :form="form" field="tglmulai"></has-error>

                            <!-- tglakhir-->

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
                                        v-model="dateFormatted2"
                                        @blur="tglakhir = parseDate2(dateFormatted2)"
                                        :rules="tglakhirRules"
                                        label="Tanggal Akhir"
                                        placeholder="Tanggal Akhir PKS"
                                        prepend-icon="mdi-calendar"
                                        v-bind="attrs"
                                        v-on="on"
                                        outlined
                                        required
                                        dense
                                    ></v-text-field>
                                </template>
                                <v-date-picker
                                    v-model="tglakhir"
                                    elevation="15"
                                    @input="menu2 = false"
                                    year-icon="calendar-blank"
                                    locale="id-ID"
                                ></v-date-picker>
                                </v-menu>
                            <has-error :form="form" field="tglakhir"></has-error>
                        <!-- <input type="file" @change="uploadFile"> -->
                         <template>

                            <v-file-input
                                v-model="editedItem.file"
                                :rules="editedItem.fileRules"
                                color="deep-purple accent-4"
                                counter
                                label="File input"
                                required
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

                             </v-col>
                        </div>

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
import moment from 'moment';
  export default {
    data: vm => ({
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      editmode: false,
      dialog: false,
      dialog2: false,
      dialogDelete: false,
      search:'',
      //editmode
      snack: false,
      multiLine: true,
        snackColor: '',
        snackText: '',
        max200chars: v => v.length <= 200|| 'Input terlalu panjang [max. 200 karakter]',
        //endeditmode
     pk:[],
     valid:true,
     kantor_id: '',
     editedItem : {
        id : '',

        no_pk: '',
        nopkRules: [
            v => !!v || 'No Perjanjian Kerjasama Belum Diisi',
        ],

        namamitra: '',
        namemitraRules: [
        v => !!v || 'Nama Mitra Belum Diisi',
        ],
        namafile: '',
        nameRules: [
        v => !!v || 'Jenis PKS Belum Diisi',
        ],
        file: null,
        fileRules: [
        v => !!v || 'File belum dimasukan',
        ],

     },
     tglmulai:(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
         tglmulaiRules: [
        v => !!v || 'Tanggal mulai belum diisi',
        ],
        tglakhir:(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
         tglakhirRules: [
        v => !!v || 'Tanggal akhir belum diisi',
        ],
     dateFormatted: vm.formatDate((new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)),
        dateFormatted2: vm.formatDate2((new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)),
        pesaneror:[],

      menu1: false,
      menu2:false,
      menu3:false,
      modal1:false,
      modal2:false,
     // filterTglmulai:[vm.formatDate((new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)),vm.formatDate((new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10))],
      filterDatemulai:[],
      filterDateakhir:[],


        //file: '',
    form: new Form({
        id : '',
        kantor_id: '',
        namamitra: '',
        namafile: '',
        tglmulai: '',
        tglakhir: '',
        file: '',
    }),

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
                { text: 'No PK', value: 'no_pk' },
                {
                text: 'Nama Mitra',
                value: 'namamitra',
                },
                {
                text: 'Jenis Kerjasama',
                value: 'namafile',
                },
                { text: 'Tanggal Mulai', value: 'tglmulai'},
                { text: 'Tanggal Berakhir', value: 'tglakhir', },


      ]
            headers.push({ text: 'Download File', value: 'file', sortable: false,align: 'center' })
            if(this.$gate.isAdmin()){
                headers.push({ text: 'Hapus', value: 'actions', sortable: false })
            }
            return headers
        },
        computedDateFormatted () {
            return this.formatDate(this.editedItem.tglmulai);
        },

      filterTglmulai(){
        if (Date.parse(this.filterDatemulai[1]) < Date.parse(this.filterDatemulai[0])) {
                let temp = this.filterDatemulai[1]
                this.filterDatemulai[1] = this.filterDatemulai[0]
                this.filterDatemulai[0] = temp
        }


        return this.filterDatemulai.join(' s/d ')
        },
        filterTglakhir(){
        if (Date.parse(this.filterDateakhir[1]) < Date.parse(this.filterDateakhir[0])) {
                let temp = this.filterDateakhir[1]
                this.filterDateakhir[1] = this.filterDateakhir[0]
                this.filterDateakhir[0] = temp
        }


        return this.filterDateakhir.join(' s/d ')
        },
      formTitle () {
        return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
      },

    },

    watch: {
    //   filterTglmulai (val) {
    //     this.filterTglmulai = this.filterDatemulai
    //   },

      tglmulai (val) {
        this.dateFormatted = this.formatDate(this.tglmulai)
      },
      tglakhir (val) {
        this.dateFormatted2 = this.formatDate2(this.tglakhir)
      },
      dialog (val) {
        val || this.close()
      },
      dialog2 (val) {
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
        //console.log(this.kantor_id)
      this.initialize()
      this.$Progress.finish();
    },

    methods: {
      save () {
        this.snack = true
        this.snackColor = 'success'
        this.snackText = 'Data disimpan'
        this.updateUser()
      },
      cancel () {
        this.snack = true
        this.snackColor = 'error'
        this.snackText = 'Dibatalkan'
      },
      open (item) {
        this.snack = true
        this.snackColor = 'info'
        this.snackText = 'Enter = Simpan'
        this.editedItem.id = item.id
        this.editedItem.no_pk = item.no_pk
        this.editedItem.namafile = item.namafile
        this.editedItem.namamitra = item.namamitra
        //console.log(this.item.namabarang);
        //alert(this.item.id)
      },
      close () {
        console.log('Dialog closed')
      },
    async getFiltertglmulai(){

        this.$Progress.start();
            const formData = new FormData
                formData.set('tglmulai', this.filterTglmulai);
        if(this.filterTglmulai !=''){
    if(this.$gate.isAdmin() || this.$gate.isUM() || this.$gate.isSekdir()){
        axios.get("api/pk/filtertglmulai",{
            params: {
            tglmulai: this.filterTglmulai
            }
        })
            .then((response) => {
                this.pk = response.data.data;
                //this.kantor_id = this.$kantor_id;
                // this.form.fill
             //console.log(this.pk);
           //  console.log(this.filterTglmulai)
                }).catch((error)=>{
                console.log(error.response.data);
                });
        }
        }else{
        //Swal.fire("Gagal Filter", "Filter Tanggal Belum Dipilih...!", "warning");
        Swal.fire({
        icon: 'error',
        title: 'Error Filter',
        text: 'Filter Tanggal Mulai Belum Dipilih...! ',
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


    async getFiltertglakhir(){

        this.$Progress.start();
            const formData = new FormData
                formData.set('tglakhir', this.filterTglakhir);
        if(this.filterTglakhir !=''){
        if(this.$gate.isAdmin() || this.$gate.isUM() || this.$gate.isSekdir()){
        axios.get("api/pk/filtertglakhir",{
            params: {
            tglakhir: this.filterTglakhir
            }
        })
            .then((response) => {
                this.pk = response.data.data;
                //this.kantor_id = this.$kantor_id;
                // this.form.fill
            //console.log(this.pk);
           // console.log(this.filterTglakhir)
                }).catch((error)=>{
                console.log(error.response.data);
                });
        }
        }else{
        //Swal.fire("Gagal Filter", "Filter Tanggal Belum Dipilih...!", "warning");
        Swal.fire({
        icon: 'error',
        title: 'Error Filter',
        text: 'Filter Tanggal Akhir Belum Dipilih...! ',
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
    norekKeyboard: function(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      //nomer wungkul
      if ((charCode > 31 && (charCode < 48 || charCode > 57 ) && (charCode < 95 || charCode > 105 )) && charCode !== 46 && charCode !== 75 ) {
      //tidak boleh tombol '/' dan '\'
      //if (charCode === 191 || charCode===220) {
        evt.preventDefault();
      } else {
        this.no_pk = this.no_pk.toUpperCase();
        return true;
      }
    },
    pencetKeyboard: function(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      //nomer wungkul
      //if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
      //tidak boleh tombol '/' dan '\'
      if (charCode === 191 || charCode===220) {
        evt.preventDefault();
      } else {
        return true;
      }
    },
    formatDate (tglmulai) {
        if (!tglmulai) return null

        const [year, month, day] = tglmulai.split('-')
        return `${day}/${month}/${year}`
      },

       parseDate (tglmulai) {
        if (!tglmulai) return null

        const [day, month,  year] = tglmulai.split('/')
        return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
      },

      formatDate2 (tglakhir) {
        if (!tglakhir) return null

        const [year, month, day] = tglakhir.split('-')
        return `${day}/${month}/${year}`
      },

       parseDate2 (tglakhir) {
        if (!tglakhir) return null

        const [day, month,  year] = tglakhir.split('/')
        return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
      },
      initialize() {
         this.$Progress.start();

            if(this.$gate.isAdmin() || this.$gate.isUM() || this.$gate.isSekdir()){

             axios.get("api/pk")
                .then((response) => {
                this.pk = response.data.data;
                this.kantor_id = this.$kantor_id;
                // this.form.fill
               // console.log(this.pk);
               // console.log(this.kantor_id)
                });
            }

           this.$Progress.finish();
      },
     editModal(item){
                this.editmode = true;
                this.$refs.form.reset()
                $('#addNew').modal('show');
                this.form.fill(item);
            },
    newModal(){
        this.editmode = false;
        $('#addNew').modal('show');
        this.$refs.form.reset()
        this.editedItem.namafile = '';
        this.editedItem.no_pk = '';
        this.editedItem.pesaneror = '';
    },
     createUser(){
         this.$refs.form.validate();
         this.$Progress.start();
            // e.preventDefault();
            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }
            // //this.append('file', this.file);
            const formData = new FormData
            formData.set('kantor_id', this.kantor_id)
            formData.set('no_pk', this.editedItem.no_pk)
            formData.set('namamitra', this.editedItem.namamitra)
            formData.set('namafile', this.editedItem.namafile)
            formData.set('tglmulai', this.tglmulai)
            formData.set('tglakhir', this.tglakhir)
            formData.set('file', this.editedItem.file)
            // formData.append('file', this.file);
           // console.log(this.file);
            axios.post('api/pk',formData,config)
              .then((response)=>{
                  $('#addNew').modal('hide');

                  Toast.fire({
                        icon: 'success',
                        title: response.data.message
                  });

                  this.$Progress.finish();
                  this.initialize();

              })
              .catch(error =>{
                  //Swal.fire("Gagal Upload", "Cek data inputan!", "warning");
                  var errors = error.response.data.errors;
                  // Loop this object and pring Key or value or both
                  for (const [key, value] of Object.entries(errors)) {
                     // console.log(`${key}: ${value}`);
                      Toast.fire({
                      icon: 'error',
                      title: value
                      //title : "Gagal upload, ulangi..."
                      });
                  }
              })
          },
          downloadFile(id,file){
              axios({
                  url:'api/pk/download/'+id,
                  method:'GET',
                  responseType:'blob'
              }).then((response) => {
                var fileUrl     = window.URL.createObjectURL(new Blob([response.data]))
                var fileLink    = document.createElement('a')
                fileLink.href   = fileUrl

                fileLink.setAttribute('download','tabfile.zip')
                fileLink.download = file;
                document.body.appendChild(fileLink)

                fileLink.click()

              }).catch(()=> {
                                  Swal.fire("Gagal Download!", "File tidak ada...", "warning");
                              });
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
                this.$Progress.start();
                // console.log('Editing data');
                const formData = new FormData
                formData.set('no_pk', this.editedItem.no_pk)
                formData.set('namafile', this.editedItem.namafile)
                formData.set('namamitra', this.editedItem.namamitra)
                formData.append("_method", "PUT");
                axios.post('api/pk/'+this.editedItem.id,formData)
                .then((response) => {
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
                .catch(() => {
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
                                this.form.delete('api/pk/'+id).then(()=>{
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
