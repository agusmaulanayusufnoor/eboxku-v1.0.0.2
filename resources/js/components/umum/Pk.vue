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

                <template v-slot:item.index="{ index }">
                    {{ index + 1 }}
                </template>

                <template v-slot:top>
                <v-toolbar flat >
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
                             <v-col
                                cols="12"
                                sm="12"
                                md="12"
                             >
                             <v-text-field
                                v-model="no_pk"
                                :rules="norekRules"
                                name="no_pk"
                                label="Nomor PK"
                                placeholder="input no. pk"
                                counter
                                maxlength="100"
                                outlined
                                required
                                dense
                                prepend-icon="mdi-file"
                                hint=""
                                persistent-hint :error-messages="pesaneror"
                                @change="cekNorek()"
                            ></v-text-field>
                            <has-error :form="form" field="namafile"></has-error>
                             <v-text-field
                                v-model="namafile"
                                :rules="nameRules"
                                name="namafile"
                                label="Nama Mitra"
                                placeholder="input nama mitra"
                                outlined
                                required
                                dense
                                prepend-icon="mdi-file"
                                @keydown="pencetKeyboard($event)"
                            ></v-text-field>
                            <has-error :form="form" field="namafile"></has-error>

                        <!-- tglmulai -->
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
                            </v-col>
                        </v-row>
                        </template>
                            <has-error :form="form" field="tglmulai"></has-error>

                                                <!-- tglakhir -->
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
                                    @input="menu1 = false"
                                    year-icon="calendar-blank"
                                    locale="id-ID"
                                ></v-date-picker>

                                </v-menu>
                            </v-col>
                        </v-row>
                        </template>
                            <has-error :form="form" field="tglakhir"></has-error>
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

  export default {
    data: vm => ({
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      editmode: false,
      dialog: false,
      dialogDelete: false,
      search:'',
     pk:[],
     valid:true,
        file: null,
        id : '',
        kantor_id: '',
        no_pk: '',
        norekRules: [
        v => !!v || 'No Perjanjian Kerjasama Belum Diisi',
      ],
        cekNorekData:[],
        pesaneror:[],
        namafile: '',
        nameRules: [
        v => !!v || 'Nama File Belum Diisi',
      ],
      menu1: false,
      menu2:false,

      dateFormatted: vm.formatDate((new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)),
      dateFormatted2: vm.formatDate2((new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)),

      tglmulai:(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
         tglmulaiRules: [
        v => !!v || 'Tanggal mulai belum diisi',
      ],
      tglakhir:(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
         tglakhirRules: [
        v => !!v || 'Tanggal akhir belum diisi',
      ],
       fileRules: [
        v => !!v || 'File belum dimasukan',
      ],
        //file: '',
    form: new Form({
        id : '',
        kantor_id: '',
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
                { text: 'Tanggal Mulai', value: 'tglmulai',align: 'start', },
                { text: 'Tanggal Berakhir', value: 'tglakhir' },
                {
                text: 'Nama Mitra',
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
            return this.formatDate(this.tglmulai);
        },

      formTitle () {
        return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
      },

    },

    watch: {
      tglmulai (val) {
        this.dateFormatted = this.formatDate(this.tglmulai)
      },
      tglakhir (val) {
        this.dateFormatted2 = this.formatDate2(this.tglakhir)
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

    async cekNorek (){
      if(this.$gate.isAdmin() || this.$gate.isUM() || this.$gate.isSekdir()){
        const formData = new FormData
        formData.set('no_pk', this.no_pk)
        //const response = await axios.get('api/pk/ceknama')
          const response = await axios.post('api/pk/ceknorek',formData)
          //this.cekNorekData = response.data.data[0].no_pk;
          if (response.data.message=='adarek'){
            this.cekNorekData = response.data.data[0].no_pk;
            this.pesaneror = 'No PK '+this.cekNorekData+' Sudah Ada'

           // console.log(this.cekNorekData);

            Toast.fire({
                  icon: 'error',
                  //title: response.data.message
                  title: 'No PK '+response.data.data[0].no_pk+' Sudah Ada Dalam Data'
            });
            this.initialize();
          }//endif response

      }//endif gate
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
        this.namafile = '';
        this.no_pk = '';
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
            formData.set('no_pk', this.no_pk)
            formData.set('namafile', this.namafile)
            formData.set('tglmulai', this.tglmulai)
            formData.set('tglakhir', this.tglakhir)
            formData.set('file', this.file)
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
                this.$Progress.start();
                // console.log('Editing data');
                this.form.put('api/pk/'+this.form.id)
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
