<template>
<v-app>
    <v-container fluid>
        <v-row no-gutters class="justify-content-md-center">
          <v-col cols="11">
            <v-card class="pa-2 mx-auto" v-if="$gate.isAdmin() || $gate.isAK()">
              <v-toolbar src="images/banner-biru-akunting.jpg"
              color="rgb(39,154,187)" dark shaped>
                <v-toolbar-title>
                    File Overbooking
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
                :items="overbooking"
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

        <div v-if="!$gate.isAdmin() && !$gate.isAK()">
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
                                v-model="namafile"
                                :rules="nameRules"
                                name="namafile"
                                label="Nama File"
                                placeholder="Nama File"
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
                                        placeholder="dd/mm/yyyy"
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
                                    year-icon="calendar-blank"
                                    locale="id-ID"
                                ></v-date-picker>

                                </v-menu>
                            </v-col>
                            <v-col
                                cols="12"
                                sm="12"
                                md="12"
                            >
                                <v-combobox
                                v-model="otorisator_id"
                                label="Nama Otorisator"
                                prepend-icon="nav-icon fas fa-user-secret"
                                :items="namaOtorisator"
                                item-value="id"
                                item-text="namaotorisator"
                                placeholder="Daftar Otorisator"
                                outlined
                                required
                                dense
                                :return-object="false"
                                persistent-hint :error-messages="pesaneror"
                                @click="getOtorisator()"
                                ></v-combobox>
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
                                accept=".zip"
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
    //   headers: [
    //     {
    //     text: 'No',
    //     value: 'index',
    //     },
    //     { text: 'Kantor', value: 'nama_kantor',align: 'start', },
    //     {
    //       text: 'Nama File',
    //       value: 'namafile',
    //     },
    //     { text: 'Tanggal File', value: 'tanggal' },
    //     { text: 'Download File', value: 'file', sortable: false,align: 'center'  },

    //     { text: 'Hapus', value: 'actions', sortable: false },
    //   ],
    namaOtorisator:[],
    otorisator_id: '',
    pesaneror:'',
     overbooking:[],
     valid:true,
        file: null,
        id : '',
        kantor_id: '',
        namafile: '',
        nameRules: [
        v => !!v || 'Nama file belum diisi',
      ],
      menu1: false,
      menu2:false,

      dateFormatted: vm.formatDate((new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)),
      tanggal:(new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
         tanggalRules: [
        v => !!v || 'Tanggal file belum diisi',
      ],
       fileRules: [
        v => !!v || 'File belum dimasukan',
      ],
        //file: '',
    form: new Form({
        id : '',
        kantor_id: '',
        namafile: '',
        tanggal: '',
        otorisator_id: '',
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
                { text: 'Kantor', value: 'nama_kantor',align: 'start', },
                {
                text: 'Nama File',
                value: 'namafile',
                },
                { text: 'Tanggal File', value: 'tanggal' },
                { text: 'Otorisator', value: 'namaotorisator' },
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

      formTitle () {
        return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
      },

    },

    watch: {
      tanggal (val) {
        this.dateFormatted = this.formatDate(this.tanggal)
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
        console.log(this.kantor_id)
      this.initialize()
      this.$Progress.finish();
    },

    methods: {
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
      getOtorisator() {

        if(this.$gate.isAdmin() || this.$gate.isAK() ){

        //axios.get("api/user").then((response) => {(this.users = response.data.data)});
        axios.get("api/kaskecil/getotorisator")
            .then((response) => {

            this.namaOtorisator = response.data.data

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
             axios.get("api/overbooking")
                .then((response) => {
                this.overbooking = response.data.data;
                this.kantor_id = this.$kantor_id;
                // this.form.fill
                //console.log(this.overbooking);
                //console.log(this.kantor_id)
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
    },
    // uploadFile(e){
    //         // `files` is always an array because the file input may be in multiple mode
    //         console.log(e);
    //         this.file = e.target.files[0];
    // },
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
            formData.set('namafile', this.namafile)
            formData.set('tanggal', this.tanggal)
            formData.set('otorisator_id', this.otorisator_id)
            formData.set('file', this.file)
            // formData.append('file', this.file);
           // console.log(this.file);
            axios.post('api/overbooking',formData,config)
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
                  url:'api/overbooking/download/'+id,
                  method:'GET',
                  responseType:'blob'
              }).then((response) => {
                var fileUrl     = window.URL.createObjectURL(new Blob([response.data]))
                var fileLink    = document.createElement('a')
                fileLink.href   = fileUrl

                fileLink.setAttribute('download','overbooking.zip')
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
                this.form.put('api/overbooking/'+this.form.id)
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
                                this.form.delete('api/overbooking/'+id).then(()=>{
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
