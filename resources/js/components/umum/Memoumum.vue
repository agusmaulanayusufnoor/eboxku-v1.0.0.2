<template>
<v-app>
    <v-container fluid>
        <v-row no-gutters class="justify-content-md-center">
          <v-col cols="11">
            <v-card class="pa-2 mx-auto" v-if="$gate.isAdmin() || $gate.isUM() || $gate.isSekdir()">
              <v-toolbar src="images/banner-biru-akunting.jpg"
              color="rgb(39,154,187)" dark shaped>
                <v-toolbar-title>
                    File Memo Umum
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
                :items="memoumum"
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
                    <v-row>
                        <v-col
                                cols="8"
                                sm="8"
                                md="8"
                            >
                                <v-combobox
                                v-model="jenisFilter"
                                label="Jenis Memo"
                                :items="items"
                                item-value="jenis"
                                item-text="jenis"
                                placeholder="Jenis Memo"
                                single-line
                                hide-details
                                clearable
                                ref="cbjenis"
                                :return-object="false"
                                persistent-hint :error-messages="pesaneror"
                                @change="filterJenis()"
                                ></v-combobox>
                            </v-col>
                    </v-row>
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
                            <template>
                                <v-container fluid>

                                    <v-radio-group
                                    v-model="jenis" :mandatory="false"
                                    row
                                    prepend-icon="mdi-format-list-bulleted-type"
                                    >
                                    <template v-slot:label>
                                        <div><strong class="text-h6 text-bold">Jenis Memo :</strong></div>
                                    </template>
                                    <v-radio
                                        label="Umum"
                                        value="umum"
                                    ></v-radio>
                                    <v-radio
                                        label="CSR"
                                        value="csr"
                                    ></v-radio>
                                    </v-radio-group>
                                </v-container>
                            </template>
                             <v-col
                                cols="12"
                                sm="12"
                                md="12"
                             >

                             <v-text-field
                                v-model="no_memo"
                                :rules="norekRules"
                                name="no_memo"
                                label="Nomor Memo"
                                placeholder="No. Memo"
                                counter
                                maxlength="25"
                                outlined
                                required
                                dense
                                prepend-icon="mdi-file"
                            ></v-text-field>
                            <has-error :form="form" field="namafile"></has-error>
                             <v-text-field
                                v-model="namafile"
                                :rules="nameRules"
                                name="namafile"
                                label="Perihal"
                                placeholder="Perihal/Keterangan"
                                outlined
                                required
                                dense
                                prepend-icon="mdi-file"
                                @keydown="pencetKeyboard($event)"
                            ></v-text-field>
                            <has-error :form="form" field="namafile"></has-error>

                        <!-- tanggal -->
                        <template>
                        <v-row>
                            <v-col
                            cols="12"
                            sm="12"
                            md="12"
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
                                        v-model="dateFormatted"
                                        @blur="tanggal = parseDate(dateFormatted)"
                                        :rules="tanggalRules"
                                        label="Tanggal File"
                                        placeholder="Tanggal Legalitas"
                                        prepend-icon="mdi-calendar"
                                        v-bind="attrs"
                                        v-on="on"
                                        outlined
                                        required
                                        dense
                                    ></v-text-field>
                                </template>
                                <v-date-picker
                                    v-model="tanggal"
                                    elevation="15"
                                    @input="menu1 = false"
                                    year-icon="mdi-calendar-blank"
                                    locale="id-ID"
                                ></v-date-picker>

                                </v-menu>
                            </v-col>
                        </v-row>
                        </template>
                            <has-error :form="form" field="tanggal"></has-error>
                        <!-- <input type="file" @change="uploadFile"> -->
                         <template>

                            <v-file-input
                                v-model="file"
                                :rules="fileRules"
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
      dialogDelete: false,
      search:'',
     memoumum:[],
     valid:true,
        file: null,
        id : '',
        nama_kantor : '',
        namaKantor :'',
        kantor_id: '',
        jenis:'',
        jenisFilter:'',
        items : ['umum','csr',],
        cekNorekData:[],
        pesaneror:[],
        no_memo: '',
        norekRules: [
        v => !!v || 'No Rekening Belum Diisi',
      ],
        namafile: '',
        nameRules: [
        v => !!v || 'Nama File Belum Diisi',
      ],
      menu1: false,
      menu2:false,

      dateFormatted: vm.formatDate((new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)),
     //dateFormatted :'',
     tanggal:'',
         tanggalRules: [
        v => !!v || 'Periode bulan belum diisi',
      ],
       fileRules: [
        v => !!v || 'File belum dimasukan',
      ],
        //file: '',
    form: new Form({
        id : '',
        kantor_id: '',
        jenis:'',
        no_memo:'',
        tanggal:'',
        namafile: '',
        tanggal: '',
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
                { text: 'Jenis Memo', value: 'jenis' },
                { text: 'No Memo', value: 'no_memo' },
                { text: 'Tanggal', value: 'tanggal' },
                {
                text: 'Perihal',
                value: 'namafile',
                },

      ]
            headers.push({ text: 'Download File', value: 'file', sortable: false,align: 'center' })
            if(this.$gate.isAdmin()){
                headers.push({ text: 'Hapus', value: 'actions', sortable: false })
            }
            return headers
        },
        computedDateFormatted () {
            return this.formatDate(this.tanggal);
        },
        periodeMomentJS () {

        return this.tanggal ? moment(this.tanggal).format('MMMM YYYY') : '';
        },
      formTitle () {
        return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
      },

    },

    watch: {
      tanggal (val) {
        this.dateFormatted = moment(this.tanggal).format('DD/MM/YYYY')
      },
      date (val) {
        this.tanggal = moment(this.tanggal).format('DD/MM/YYYY')
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
     // this.$refs.cbkantor.reset();
      this.$refs.cbjenis.reset();
    },

    methods: {

    norekKeyboard: function(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      //nomer wungkul
      if ((charCode > 31 && (charCode < 48 || charCode > 57) && (charCode < 95 || charCode > 105 )) && charCode !== 46) {
      //tidak boleh tombol '/' dan '\'
      //if (charCode === 191 || charCode===220) {
        evt.preventDefault();;
      } else {
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
        evt.preventDefault();;
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
      async getKantor() {

        if(this.$gate.isAdmin()){

        //axios.get("api/user").then((response) => {(this.users = response.data.data)});
        axios.get("api/memoumum/getkantor")
            .then((response) => {

            this.namaKantor = response.data.data

           // console.log(this.namaKantor);
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
        axios.get("api/memoumum/filterkantor",{
            params: {
            kantor_id: this.nama_kantor
            }
        })
            .then((response) => {
                this.memoumum = response.data.data;
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
    async filterJenis(){
        this.$Progress.start();
            const formData = new FormData
                formData.set('jenis', this.jenisFilter);
        if(this.jenisFilter !=''){
        if(this.$gate.isAdmin() || this.$gate.isUM() || this.$gate.isSekdir()){
        axios.get("api/memoumum/filterjenis",{
            params: {
            jenis: this.jenisFilter
            }
        })
            .then((response) => {
                this.memoumum = response.data.data;
                //this.kantor_id = this.$kantor_id;
                // this.form.fill
            // console.log(this.memoumum);
             //console.log(this.jenis)
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
      initialize() {
         this.$Progress.start();

            if(this.$gate.isAdmin() || this.$gate.isUM() || this.$gate.isSekdir() ){

               //axios.get("api/user").then((response) => {(this.users = response.data.data)});
             axios.get("api/memoumum")
                .then((response) => {
                this.memoumum = response.data.data;
                this.kantor_id = this.$kantor_id;
                // this.form.fill
               // console.log(this.memoumum);
               // console.log(this.kantor_id)
                });
            }

           this.$Progress.finish();
          // this.$refs.cbkantor.reset();
           this.$refs.cbjenis.reset();
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
        this.no_memo = '';
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
            formData.set('jenis', this.jenis)
            formData.set('no_memo', this.no_memo)
            formData.set('namafile', this.namafile)
            formData.set('tanggal', this.dateFormatted)
            formData.set('file', this.file)
            // formData.append('file', this.file);
            //console.log(this.dateFormatted);
            axios.post('api/memoumum',formData,config)
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
          downloadFile(id,file){
              axios({
                  url:'api/memoumum/download/'+id,
                  method:'GET',
                  responseType:'blob'
              }).then((response) => {
                var fileUrl     = window.URL.createObjectURL(new Blob([response.data]))
                var fileLink    = document.createElement('a')
                fileLink.href   = fileUrl

                fileLink.setAttribute('download','aba.pdf')
                fileLink.download = file;
                document.body.appendChild(fileLink)

                fileLink.click()

              }).catch(()=> {
                                  Swal.fire("Gagal Download!", "File tidak ada...", "warning");
                              });
          },
          updateUser(){
                this.$Progress.start();
                // console.log('Editing data');
                this.form.put('api/memoumum/'+this.form.id)
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
                                this.form.delete('api/memoumum/'+id).then(()=>{
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
