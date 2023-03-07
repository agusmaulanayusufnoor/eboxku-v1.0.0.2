<template>
    <v-app>
        <v-container fluid>
            <v-row no-gutters class="justify-content-md-center">
              <v-col cols="11">
                <v-card class="pa-2 mx-auto" v-if="$gate.isAdmin() || $gate.isUM()">
                  <v-toolbar src="images/banner-red.jpg" dark shaped>
                    <v-toolbar-title>
                        Data Pajak Kendaraan
                    </v-toolbar-title>
                    <v-spacer></v-spacer>
                      <v-btn small color="indigo" dark @click="newModal">
                         <v-icon>mdi-database-plus</v-icon> Tambah Data
                      </v-btn>
                  </v-toolbar>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <v-data-table
                    :headers="headers"
                    :items="pjkkendaraan"
                    :search="search"
                    justify="center"
                    dense
                    class="elevation-3">
                    <template v-slot:footer.prepend>
                      <v-btn
                        color="success"
                        dark
                        class="ma-2"
                        small
                        @click="refresh()"
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
                        <v-row v-if="$gate.isAdmin()">
                            <v-col
                                    cols="8"
                                    sm="8"
                                    md="8"
                                >
                                    <v-combobox
                                    v-model="nama_kantor"
                                    label="Kantor"
                                    :items="namaKantor"
                                    item-value="nama_kantor"
                                    item-text="nama_kantor"
                                    placeholder="Pilih Kantor"
                                    single-line
                                    hide-details
                                    clearable
                                    ref="cbkantor"
                                    :return-object="false"
                                    persistent-hint :error-messages="pesaneror"
                                    @click="getKantor()"
                                    @change="filterKantor()"
                                    ></v-combobox>
                                </v-col>
                        </v-row>
                        <v-spacer></v-spacer>
                        <v-spacer></v-spacer>
                        <v-row>
                            <v-col
                                    cols="8"
                                    sm="8"
                                    md="8"
                                >
                                    <v-combobox
                                    v-model="statusFilter"
                                    label="Status Bayar"
                                    :items="items"
                                    item-value="status_bayar"
                                    item-text="status_bayar"
                                    placeholder="Status Bayar"
                                    single-line
                                    hide-details
                                    clearable
                                    ref="cbstatus"
                                    :return-object="false"
                                    persistent-hint :error-messages="pesaneror"
                                    @change="filterStatus()"
                                    ></v-combobox>
                                </v-col>
                        </v-row>
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
                <template v-slot:item.tgl_pajak_tahunan="{ item }">
                     <v-edit-dialog

                        @save="save"
                        @cancel="cancel"
                        @open="open(item)"
                        @close="close"

                        >
                        {{ item.tgl_pajak_tahunan }}
                        <template v-slot:input>
                            <div class="mt-4 text-h6">
                            Edit Tanggal Pajak
                            </div>
                            <v-text-field
                            v-model="editedItem.tgl_pajak_tahunan"
                            :rules="[max200chars]"
                            label="Edit"
                            single-line
                            counter
                            ></v-text-field>
                        </template>
                        </v-edit-dialog>

                </template>
                <template v-slot:item.nilai_pajak="{ item }">
                     <v-edit-dialog

                        @save="save"
                        @cancel="cancel"
                        @open="open(item)"
                        @close="close"

                        >
                        {{ item.nilai_pajak }}
                        <template v-slot:input>
                            <div class="mt-4 text-h6">
                            Edit Nilai Pajak
                            </div>
                            <v-text-field
                            v-model="editedItem.nilai_pajak"
                            :rules="[max200chars]"
                            label="Edit"
                            single-line
                            counter
                            ></v-text-field>
                        </template>
                        </v-edit-dialog>

                </template>
                <template v-slot:item.pemegang_kendaraan="{ item }">
                     <v-edit-dialog

                        @save="save"
                        @cancel="cancel"
                        @open="open(item)"
                        @close="close"

                        >
                        {{ item.pemegang_kendaraan }}
                        <template v-slot:input>
                            <div class="mt-4 text-h6">
                            Edit Pemegang Kendaraan
                            </div>
                            <v-text-field
                            v-model="editedItem.pemegang_kendaraan"
                            :rules="[max200chars]"
                            label="Edit"
                            single-line
                            counter
                            ></v-text-field>
                        </template>
                        </v-edit-dialog>

                </template>
                <template v-slot:item.keterangan="{ item }">
                     <v-edit-dialog

                        @save="save"
                        @cancel="cancel"
                        @open="open(item)"
                        @close="close"

                        >
                        {{ item.keterangan }}
                        <template v-slot:input>
                            <div class="mt-4 text-h6">
                            Edit Keterangan
                            </div>
                            <v-text-field
                            v-model="editedItem.keterangan"
                            :rules="[max200chars]"
                            label="Edit"
                            single-line
                            counter
                            ></v-text-field>
                        </template>
                        </v-edit-dialog>

                </template>
                <template v-slot:item.status_bayar="{ item }">
                     <v-edit-dialog

                        @save="save"
                        @cancel="cancel"
                        @open="open(item)"
                        @close="close"

                        >
                        {{ item.status_bayar }}
                        <template v-slot:input>
                            <div class="mt-4 text-h6">
                            Edit Status Bayar
                            </div>
                            <v-text-field
                            v-model="editedItem.status"
                            :rules="[max200chars]"
                            label="Edit"
                            single-line
                            counter
                            ></v-text-field>
                        </template>
                        </v-edit-dialog>

                </template>
                <!-- end edit-->
                   </v-data-table>
                 </div>
                  <!-- /.card-body -->
                  <!-- <div class="card-footer">
                      <pagination :data="users" @pagination-change-page="getResults"></pagination>
                  </div> -->
                </v-card>
              </v-col>
            </v-row>

            <div v-if="!$gate.isAdmin() && !$gate.isUM()">
                <not-found></not-found>
            </div>

      <!-- Modal -->
            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                    <div class="modal-header primary">
                        <h5 class="modal-title" v-show="!editmode" style="color:white;"><i class="nav-icon fas fa-plus-square"></i> Tambah Data</h5>
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
                                <!-- <input v-model="kantor_id" type="hidden"
                                name="kantor_id"> -->
                                <input v-model="csrf" type="hidden"
                                name="_token">

                            <v-container>
                                <v-row>
                                <v-col
                                    cols="12"
                                    sm="3"
                                    md="3"
                                >
                                    <v-combobox
                                    v-model="kantor_id"
                                    label="Kantor"
                                    :items="namaKantor"
                                    item-value="id"
                                    item-text="nama_kantor"
                                    placeholder="Pilih Kantor"
                                    outlined
                                    required
                                    dense
                                    hide-details
                                    prepend-icon="fa fa-building"
                                    :return-object="false"
                                    ref="CBKantor"

                                    @click="getKantor()"
                                    ></v-combobox>
                                </v-col>
                                <v-col
                                    cols="12"
                                    sm="3"
                                    md="3"
                                 >
                                <v-text-field
                                    v-model="nopol"
                                    :rules="nopolRules"
                                    name="nopol"
                                    label="Nomor Polisi"
                                    placeholder="No. Pol"
                                    counter
                                    maxlength="12"
                                    outlined
                                    required
                                    dense
                                    @keyup="uppercase"
                                    prepend-icon="mdi-police-badge"
                                    hint=""
                                    persistent-hint :error-messages="pesaneror"
                                    @change="cekNorek()"
                                ></v-text-field>
                                <has-error :form="form" field="nopol"></has-error>
                                </v-col>
                        <!-- </v-row> -->


                            <!-- tanggal -->

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
                                            v-model="dateFormatted1"
                                            @blur="tgl_habis_stnk = parseDate(dateFormatted1)"
                                            :rules="tgl_habis_stnkRules"
                                            label="Tanggal Habis STNK"
                                            placeholder="Tanggal Habis STNK"
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
                                        v-model="tgl_habis_stnk"
                                        elevation="15"
                                        @input="menu1 = false"
                                        year-icon="calendar-blank"
                                        locale="id-ID"
                                    ></v-date-picker>

                                    </v-menu>
                                </v-col>
                            <has-error :form="form" field="tgl_habis_stnk"></has-error>

                                <v-col
                                cols="12"
                                sm="3"
                                md="3"
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
                                            v-model="dateFormatted2"
                                            @blur="tgl_pajak = parseDate(dateFormatted2)"
                                            :rules="tgl_pajak_tahunanRules"
                                            label="Tanggal Pajak Tahunan"
                                            placeholder="Tanggal Pajak Tahunan"
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
                                        v-model="tgl_pajak"
                                        elevation="15"
                                        @input="menu2 = false"
                                        year-icon="calendar-blank"
                                        locale="id-ID"
                                    ></v-date-picker>

                                    </v-menu>
                                </v-col>

                            <has-error :form="form" field="tgl_pajak_tahunan"></has-error>
                            </v-row>
                            <v-row>
                            <v-col
                                cols="12"
                                sm="3"
                                md="3"
                                >
                            <v-text-field
                                    v-model="editedItem.nilai_pajak"
                                    :rules="nilai_pajakRules"
                                    name="nilai_pajak"
                                    label="Nilai Pajak"
                                    placeholder="Pajak yang harus dibayar"
                                    outlined
                                    required
                                    dense
                                    prepend-icon="fas fa-money-bill-alt"
                                    @keydown="pencetKeyboard($event)"
                            ></v-text-field>
                            <has-error :form="form" field="nilai_pajak"></has-error>
                            </v-col>
                            <v-col
                                cols="12"
                                sm="4"
                                md="4"
                            >
                            <v-text-field
                                    v-model="editedItem.pemegang_kendaraan"
                                    name="pemegang_kendaraan"
                                    label="Pemegang Kendaraan"
                                    placeholder="Pemegang Kendaraan"
                                    outlined
                                    dense
                                    prepend-icon="fas fa-user-ninja"
                            ></v-text-field>
                            <has-error :form="form" field="pemegang_kendaraan"></has-error>
                            </v-col>

                              <v-col
                                cols="5"
                                sm="5"
                                md="5"
                                >
                                        <v-radio-group
                                        v-model="status_bayar"
                                        mandatory
                                        row
                                        :rules="status_bayarRules"
                                        prepend-icon="fas fa-ellipsis-v"
                                        >

                                        <v-radio
                                            label="Belum Bayar"
                                            value="belum"
                                        ></v-radio>
                                        <v-radio
                                            label="Sudah Bayar"
                                            value="sudah"
                                        ></v-radio>
                                        </v-radio-group>
                                    </v-col>
                                    </v-row>
                            <v-text-field
                                    v-model="editedItem.keterangan"
                                    name="keterangan"
                                    label="Keterangan"
                                    placeholder="Keterangan"
                                    outlined
                                    dense
                                    prepend-icon="fas fa-comment-dots"
                                    value=" "
                            ></v-text-field>
                            <has-error :form="form" field="keterangan"></has-error>

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
                                <v-icon>mdi-database-plus</v-icon>
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
      export default {
        data: vm => ({
          csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          editmode: false,
          dialog: false,
          dialogDelete: false,
          search:'',
          items : ['belum','sudah',],
          //editmode
        snack: false,
        multiLine: true,
        snackColor: '',
        snackText: '',
        max200chars: v => v.length <= 200|| 'Input terlalu panjang [max. 200 karakter]',
        //endeditmode
         pjkkendaraan:[],
         valid:true,
            file: null,
            id : '',
            kantor_id: '',
            nama_kantor:'',
            namaKantor:[],
            nopol: '',
            nopolRules: [
            v => !!v || 'No Polisi Belum Diisi',
            ],
            cekNorekData:[],
            pesaneror:[],
          menu1: false,
          menu2:false,
          dateFormatted1: vm.formatDate((new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)),
          dateFormatted2: vm.formatDate((new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)),
          tgl_habis_stnk:(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
             tgl_habis_stnkRules: [
            v => !!v || 'Tanggal Habis STNK belum diisi',
          ],
          tgl_pajak:(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
             tgl_pajak_tahunanRules: [
            v => !!v || 'Tanggal Pajak Tahunan belum diisi',
          ],

          nilai_pajakRules: [
            v => !!v || 'Pajak yang harus dibayar belum diisi',
          ],
          status_bayar:'',
          status_bayarRules: [
            v => !!v || 'Status Bayar belum dipilih',
          ],
          statusFilter:'',
          editedItem : {
            id : '',
            nilai_pajak:'',
            tgl_pajak_tahunan:(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
            pemegang_kendaraan:'',
            keterangan:'',
            status:'',
        },
        form: new Form({
            id : '',
            kantor_id: '',
            nopol: '',
            tgl_habis_stnk: '',
            tgl_pajak_tahunan: '',
            nilai_pajak: '',
            pemegang_kendaraan: '',
            status_bayar: '',
            keterangan: '',
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
                    { text: 'Kantor', value: 'nama_kantor',align: 'start', },
                    { text: 'No Pol.', value: 'nopol' },
                    { text: 'Tanggal Habis STNK', value: 'tgl_habis_stnk' },
                    { text: 'Tanggal Pajak Tahunan', value: 'tgl_pajak_tahunan' },
                    { text: 'Pajak Yang Dibayar', value: 'nilai_pajak' },
                    { text: 'Pemegang Kendaraan', value: 'pemegang_kendaraan' },
                    { text: 'Status Bayar', value: 'status_bayar' },
                    {
                    text: 'Keterangan',
                    value: 'keterangan',
                    },
          ]
                if(this.$gate.isAdmin()){
                    headers.push({ text: 'Hapus', value: 'actions', sortable: false })
                }
                return headers
            },
            computedDateFormatted () {
                return this.formatDate(this.tanggal);
            },
          formTitle () {
            return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
          },
        },
        watch: {
          tgl_habis_stnk (val) {
            this.dateFormatted1 = this.formatDate(this.tgl_habis_stnk)
          },
          tgl_pajak (val) {
            this.dateFormatted2 = this.formatDate(this.tgl_pajak)
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
        this.editedItem.tgl_pajak_tahunan = item.tgl_pajak_tahunan
        this.editedItem.nilai_pajak = item.nilai_pajak
        this.editedItem.pemegang_kendaraan = item.pemegang_kendaraan
        this.editedItem.keterangan = item.keterangan
        this.editedItem.status = item.status_bayar
        //console.log(this.item.namabarang);
        //alert(this.item.id)
      },
      close () {
        console.log('Dialog closed')
      },
        uppercase() {
          this.nopol = this.nopol.toUpperCase();
        },
            async cekNorek (){
          if(this.$gate.isAdmin() || this.$gate.isUM() ){
            const formData = new FormData
            formData.set('nopol', this.nopol)
            //const response = await axios.get('api/kredit/ceknama')
              const response = await axios.post('api/pjkkendaraan/ceknorek',formData)
              //this.cekNorekData = response.data.data[0].nopol;
              if (response.data.message=='adarek'){
                this.cekNorekData = response.data.data[0].nopol;
                this.pesaneror = 'No Polisi '+this.cekNorekData+' Sudah Ada'
               // console.log(this.cekNorekData);
                Toast.fire({
                      icon: 'error',
                      //title: response.data.message
                      title: 'No Polisi'+response.data.data[0].nopol+' Sudah Ada Dalam Data'
                });
                this.initialize();
              }//endif response
          }//endif gate
        },
         getKantor() {
            if(this.$gate.isAdmin() || this.$gate.isUM()){
            //axios.get("api/user").then((response) => {(this.users = response.data.data)});
            axios.get("api/pjkkendaraan/getkantor")
                .then((response) => {
                this.namaKantor = response.data.data
                //console.log(this.editedItem.namaKantor);
                //console.log(this.kantor_id)
                }).catch((error)=>{
                console.log(error.response.data);
                });
            }
        },
        async filterKantor(){
            this.$Progress.start();
                const formData = new FormData
                    formData.set('kantor_id', this.nama_kantor);
                    //formData.set('nama_kantor', this.nama_kantor);
            if(this.nama_kantor !=''){
            if(this.$gate.isAdmin()){
            axios.get("api/pjkkendaraan/filterkantor",{
                params: {
                kantor_id: this.nama_kantor
                }
            })
                .then((response) => {
                    this.pjkkendaraan = response.data.data;
                    this.kantor_id = this.$kantor_id;
                    // this.form.fill
                 //console.log(this.nama_kantor);
                 //console.log(this.nama_kantor)
                    }).catch((error)=>{
                    console.log(error.response.data);
                    });
            }
            }else{
            //Swal.fire("Gagal Filter", "Filter Tanggal Belum Dipilih...!", "warning");
            Swal.fire({
            icon: 'error',
            title: 'Error Filter',
            text: 'Filter Kantor Belum Dipilih...! ',
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
        async filterStatus(){
            this.$Progress.start();
                const formData = new FormData
                    formData.set('status_bayar', this.statusFilter);
            if(this.statusFilter !=''){
            if(this.$gate.isAdmin() || this.$gate.isUM() || this.$gate.isSekdir()){
            axios.get("api/pjkkendaraan/filterstatus",{
                params: {
                status_bayar: this.statusFilter
                }
            })
                .then((response) => {
                    this.pjkkendaraan = response.data.data;
                    //this.kantor_id = this.$kantor_id;
                    // this.form.fill
                 //console.log(this.status_bayar)
                    }).catch((error)=>{
                    console.log(error.response.data);
                    });
            }
            }else{
            //Swal.fire("Gagal Filter", "Filter Tanggal Belum Dipilih...!", "warning");
            Swal.fire({
            icon: 'error',
            title: 'Error Filter',
            text: 'Filter Kantor Belum Dipilih...! ',
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
        pencetKeyboard: function(evt) {
          evt = (evt) ? evt : window.event;
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          //nomer wungkul
          if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
          //tidak boleh tombol '/' dan '\'
          //if (charCode === 191 || charCode===220) {
            evt.preventDefault();
          } else {
            return true;
          }
        },
        formatDate (tanggal) {
            if (!tanggal) return null
            const [year, month, day] = tanggal.split('-')
            return `${day}/${month}/${year}`
          },
           parseDate (tanggal) {
            if (!tanggal) return null
            const [day, month,  year] = tanggal.split('/')
            return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
          },
          refresh() {
             this.$Progress.start();
                if(this.$gate.isAdmin() || this.$gate.isUM() ){
                 axios.get("api/pjkkendaraan")
                    .then((response) => {
                    this.pjkkendaraan = response.data.data;
                    this.kantor_id = this.$kantor_id;
                    // this.form.fill
                   // console.log(this.pjkkendaraan);
                   // console.log(this.kantor_id)
                    });
                }
               this.$Progress.finish();
                this.$refs.cbkantor.reset();
                this.$refs.cbstatus.reset();
          },
          initialize() {
             this.$Progress.start();
                if(this.$gate.isAdmin() || this.$gate.isUM() ){
                 axios.get("api/pjkkendaraan")
                    .then((response) => {
                    this.pjkkendaraan = response.data.data;
                    this.kantor_id = this.$kantor_id;
                    // this.form.fill
                   // console.log(this.pjkkendaraan);
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
            this.namafile = '';
            this.pesaneror = '';
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
                formData.set('nopol', this.nopol)
                formData.set('tgl_habis_stnk', this.tgl_habis_stnk)
                formData.set('tgl_pajak_tahunan', this.tgl_pajak)
                formData.set('nilai_pajak', this.editedItem.nilai_pajak)
                formData.set('pemegang_kendaraan', this.editedItem.pemegang_kendaraan)
                formData.set('status_bayar', this.status_bayar)
                formData.set('keterangan', this.editedItem.keterangan)
                // formData.append('file', this.file);
               // console.log(this.file);
                axios.post('api/pjkkendaraan',formData,config)
                  .then((response)=>{
                      $('#addNew').modal('hide');
                      Toast.fire({
                            icon: 'success',
                            title: response.data.message
                      });
                      this.$Progress.finish();
                      this.initialize();
                  })
                  .catch((error)=>{
                      //Swal.fire("Failed!", data.message, "warning");
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
                formData.set('tgl_pajak_tahunan', this.editedItem.tgl_pajak_tahunan)
                formData.set('nilai_pajak', this.editedItem.nilai_pajak)
                formData.set('pemegang_kendaraan', this.editedItem.pemegang_kendaraan)
                formData.set('keterangan', this.editedItem.keterangan)
                formData.set('status_bayar', this.editedItem.status)
                formData.append("_method", "PUT");
                axios.post('api/pjkkendaraan/'+this.editedItem.id,formData)
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
            updateStatus(){
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
                formData.set('tgl_pajak_tahunan', this.editedItem.tgl_pajak_tahunan)
                formData.append("_method", "PUT");
                axios.post('api/pjkkendaraan/updatestatus/'+this.editedItem.id,formData)
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
                                    this.form.delete('api/pjkkendaraan/'+id).then(()=>{
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
