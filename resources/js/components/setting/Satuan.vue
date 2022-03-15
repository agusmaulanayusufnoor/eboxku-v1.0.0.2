<template>
<v-app>
    <v-container fluid>
        <v-row no-gutters class="justify-content-md-center">
          <v-col cols="6">
            <v-card class="pa-2 mx-auto" v-if="$gate.isAdmin()">
              <v-toolbar color="green lighten-1" dark shaped>
                <v-toolbar-title>
                    Master Satuan
                </v-toolbar-title>
                <v-spacer></v-spacer>
                  <v-btn small color="indigo" dark @click="newModal">
                     <v-icon>mdi-plus-box</v-icon> Tambah
                  </v-btn>
              </v-toolbar>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <v-data-table
                :headers="headers"
                :items="satuan"
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
                    label="Cari Satuan"
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
                <template v-slot:item.namasatuan="{ item }">
                     <v-edit-dialog

                        @save="save"
                        @cancel="cancel"
                        @open="open(item)"
                        @close="close"

                        >
                        {{ item.namasatuan }}
                        <template v-slot:input>
                            <div class="mt-4 text-h6">
                            Edit Satuan
                            </div>
                            <v-text-field
                            v-model="editedItem.namasatuan"
                            :rules="[max25chars]"
                            label="Edit"
                            single-line
                            counter
                            ></v-text-field>
                        </template>
                        </v-edit-dialog>
                    </template>

      <!-- end edit table -->
               </v-data-table>

               <v-snackbar
                v-model="snack"
                :timeout="4000"
                :color="snackColor"
                :multi-line="multiLine"
                position: absolute
                >
                {{ snackText }}

                <template v-slot:action="{ attrs }">
                    <v-btn
                    v-bind="attrs"
                    text
                    @click="snack = false"
                    >
                    Close
                    </v-btn>
                </template>
                </v-snackbar>
             </div>
              <!-- /.card-body -->
              <!-- <div class="card-footer">
                  <pagination :data="users" @pagination-change-page="getResults"></pagination>
              </div> -->
            </v-card>
          </v-col>
        </v-row>

        <div v-if="!$gate.isAdmin()">
            <not-found></not-found>
        </div>

  <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode">Tambah Satuan</h5>
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

                        <div class="form-group input-group">
                             <v-col
                                cols="12"
                                sm="12"
                                md="12"
                             >
                             <v-text-field
                                v-model="editedItem.namasatuan"
                                :rules="editedItem.satuanRules"
                                label="Satuan"
                                name="namasatuan"
                                placeholder="Satuan"
                                outlined
                                required
                                dense
                                prepend-icon="mdi-ruler-square-compass"
                            ></v-text-field>
                            <!-- <has-error :form="form" field="satuan"></has-error> -->

                             </v-col>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <v-btn color="error" elevation="2" type="button" data-dismiss="modal">
                        <v-icon>mdi-cancel</v-icon>
                            Batal
                        </v-btn>
                        <v-btn color="success" elevation="2" v-show="editmode" type="submit" >
                            <v-icon>mdi-pencil</v-icon>
                            Ubah
                        </v-btn>
                        <v-btn color="primary" elevation="2" v-show="!editmode" type="submit" >
                            <v-icon>mdi-plus-box</v-icon>
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

    data: () => ({
       // props: ["namasatuan"],
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      editmode: false,
      dialog: false,
      dialogDelete: false,
      search:'',
      snack: false,
      multiLine: true,
        snackColor: '',
        snackText: '',
        max25chars: v => v.length <= 25 || 'Input too long!',
     satuan:[],
    editedIndex: -1,
    editedItem : {
        id : '',
        namasatuan:'',
        namasatuanEdit:'',
        satuanRules: [
        v => !!v || 'Nama satuan belum diisi',
      ],
    },

     valid:true,

        kantor_id: '',

    form: new Form({
        id : '',
        namasatuan: '',
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
                {
                text: 'Satuan',
                value: 'namasatuan',
                },

      ]

            if(this.$gate.isAdmin()){
                headers.push({ text: 'Hapus', value: 'actions', sortable: false })
            }
            return headers
        },

      formTitle () {
        return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
      },

    },

    created () {
        this.$Progress.start();

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
        this.editedItem.namasatuan = item.namasatuan

        //console.log(this.item.namasatuan);
        //alert(this.item.id)
      },
      close () {
        console.log('Dialog closed')
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

      initialize() {
         this.$Progress.start();

            if(this.$gate.isAdmin()){

               //axios.get("api/user").then((response) => {(this.users = response.data.data)});
             axios.get("api/satuan")
                .then((response) => {
                this.satuan = response.data.data;
                // this.kantor_id = this.$kantor_id;
                // this.form.fill
                //console.log(this.satuan);
                //console.log(this.kantor_id)
                });
            }

           this.$Progress.finish();
      },
     editSatuan(item){

        this.editedIndex = this.satuan.indexOf(item)
        this.item.id = item.id
        this.item.namasatuan = item.namasatuan

        console.log(this.item.id);
        //alert(this.item.id)
            },
    newModal(){
        this.editmode = false;
        $('#addNew').modal('show');
        this.$refs.form.reset()
        this.editedItem.namasatuan = '';
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
            formData.set('namasatuan', this.editedItem.namasatuan)

            axios.post('api/satuan',formData,config)
              .then((response)=>{
                  $('#addNew').modal('hide');
                    //  console.log(this.namasatuan);
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
                      title: 'Gagal tambah satuan, ulangi!'
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

                this.$Progress.start();
                //alert(this.editedItem.namasatuan);
                 const formData = new FormData
            formData.set('namasatuan', this.editedItem.namasatuan)
            formData.append("_method", "PUT");
                axios.post('api/satuan/'+this.editedItem.id,formData)
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
                                this.form.delete('api/satuan/'+id).then(()=>{
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
