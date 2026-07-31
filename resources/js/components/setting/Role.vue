<template>
<v-app>
    <v-container fluid>
        <v-row no-gutters class="justify-content-md-center">
          <v-col cols="9">
            <v-card class="pa-2 mx-auto" v-if="$gate.isAdmin()">
              <v-toolbar color="green lighten-1" dark shaped>
                <v-toolbar-title>
                    Master Role User (Level User)
                </v-toolbar-title>
                <v-spacer></v-spacer>
                  <v-btn small color="indigo" dark @click="newModal">
                     <v-icon>mdi-plus-box</v-icon> Tambah Role
                  </v-btn>
              </v-toolbar>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <v-data-table
                :headers="headers"
                :items="roles"
                :search="search"
                justify="center"
                dense
                class="elevation-3">

                <template v-slot:item.index="{ index }">
                    {{ index + 1 }}
                </template>

                <template v-slot:top>
                <v-toolbar flat>
                    <v-spacer></v-spacer>
                    <v-spacer></v-spacer>
                    <v-spacer></v-spacer>
                    <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Cari Role User"
                    single-line
                    hide-details
                    loading="grey"
                ></v-text-field>
                </v-toolbar>
                </template>

                <!-- edit table for description -->
                <template v-slot:item.description="{ item }">
                     <v-edit-dialog
                        @save="save"
                        @cancel="cancel"
                        @open="open(item)"
                        @close="close"
                        >
                        {{ item.description }}
                        <template v-slot:input>
                            <div class="mt-4 text-h6">
                            Edit Keterangan Role
                            </div>
                            <v-text-field
                            v-model="editedItem.description"
                            :rules="[max100chars]"
                            label="Keterangan Role"
                            single-line
                            counter
                            ></v-text-field>
                        </template>
                        </v-edit-dialog>
                </template>

                <!-- tombol edit dan hapus -->
                <template v-slot:item.actions="{ item }">
                <v-icon
                    small
                    class="mr-2"
                    color="blue"
                    @click="editModal(item)"
                >
                    mdi-pencil
                </v-icon>
                <v-icon
                    small
                    color="red"
                    @click="deleteRole(item.id)"
                >
                    mdi-delete
                </v-icon>
                </template>

               </v-data-table>
             </div>
            </v-card>
          </v-col>
          <v-col cols="3">
             <v-snackbar
                v-model="snack"
                :timeout="4000"
                :color="snackColor"
                :multi-line="multiLine"
                position: absolute right
                style="margin-bottom=230px"
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
          </v-col>
        </v-row>

        <div v-if="!$gate.isAdmin()">
            <not-found></not-found>
        </div>

        <!-- Modal Form -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode">Tambah Role User</h5>
                    <h5 class="modal-title" v-show="editmode">Edit Role User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <v-form
                @submit.prevent="editmode ? updateRole() : createRole()"
                ref="form"
                v-model="valid"
                lazy-validation
                >
                    <div class="modal-body">
                        <input v-model="csrf" type="hidden" name="_token">

                        <div class="form-group">
                            <v-text-field
                                v-model="editedItem.name"
                                :rules="nameRules"
                                label="Kode / Name Role (e.g. admin, pelayanan, kredit)"
                                name="name"
                                placeholder="Contoh: pelayanan"
                                outlined
                                required
                                dense
                                prepend-icon="mdi-shield-account"
                            ></v-text-field>
                        </div>

                        <div class="form-group">
                            <v-text-field
                                v-model="editedItem.description"
                                :rules="descriptionRules"
                                label="Keterangan Role (Tampilan di Combo Box)"
                                name="description"
                                placeholder="Contoh: Pelayanan"
                                outlined
                                required
                                dense
                                prepend-icon="mdi-card-text"
                            ></v-text-field>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <v-btn color="error" elevation="2" type="button" data-dismiss="modal">
                            <v-icon>mdi-cancel</v-icon> Batal
                        </v-btn>
                        <v-btn color="success" elevation="2" v-show="editmode" type="submit">
                            <v-icon>mdi-pencil</v-icon> Ubah
                        </v-btn>
                        <v-btn color="primary" elevation="2" v-show="!editmode" type="submit">
                            <v-icon>mdi-plus-box</v-icon> Tambah
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
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      editmode: false,
      search: '',
      snack: false,
      multiLine: true,
      snackColor: '',
      snackText: '',
      max100chars: v => (v || '').length <= 100 || 'Input terlalu panjang!',
      roles: [],
      editedItem: {
        id: '',
        name: '',
        description: '',
      },
      nameRules: [
        v => !!v || 'Kode Role harus diisi',
      ],
      descriptionRules: [
        v => !!v || 'Keterangan Role harus diisi',
      ],
      valid: true,
      form: new Form({
        id: '',
        name: '',
        description: '',
      }),
    }),
    computed: {
      headers() {
        let headers = [
          {
            text: 'No',
            value: 'index',
            align: 'center',
            sortable: false
          },
          {
            text: 'Kode Role (Value)',
            value: 'name',
          },
          {
            text: 'Keterangan Role (Label)',
            value: 'description',
          },
        ];

        if (this.$gate.isAdmin()) {
          headers.push({ text: 'Aksi', value: 'actions', sortable: false });
        }
        return headers;
      },
    },

    created() {
      this.$Progress.start();
      this.initialize();
      this.$Progress.finish();
    },

    methods: {
      save() {
        this.snack = true;
        this.snackColor = 'success';
        this.snackText = 'Data disimpan';
        this.updateRole();
      },
      cancel() {
        this.snack = true;
        this.snackColor = 'error';
        this.snackText = 'Dibatalkan';
      },
      open(item) {
        this.snack = true;
        this.snackColor = 'info';
        this.snackText = 'Enter = Simpan';
        this.editedItem.id = item.id;
        this.editedItem.name = item.name;
        this.editedItem.description = item.description;
      },
      close() {
        console.log('Dialog closed');
      },

      initialize() {
        this.$Progress.start();

        if (this.$gate.isAdmin()) {
          axios.get('api/role')
            .then((response) => {
              this.roles = response.data.data;
            })
            .catch(() => {
              Toast.fire({
                icon: 'error',
                title: 'Gagal mengambil data role',
              });
            });
        }

        this.$Progress.finish();
      },

      newModal() {
        this.editmode = false;
        this.editedItem.id = '';
        this.editedItem.name = '';
        this.editedItem.description = '';
        if (this.$refs.form) {
          this.$refs.form.resetValidation();
        }
        $('#addNew').modal('show');
      },

      editModal(item) {
        this.editmode = true;
        this.editedItem.id = item.id;
        this.editedItem.name = item.name;
        this.editedItem.description = item.description;
        if (this.$refs.form) {
          this.$refs.form.resetValidation();
        }
        $('#addNew').modal('show');
      },

      createRole() {
        if (!this.$refs.form.validate()) return;

        this.$Progress.start();

        axios.post('api/role', {
          name: this.editedItem.name,
          description: this.editedItem.description,
        })
          .then((response) => {
            $('#addNew').modal('hide');
            Toast.fire({
              icon: 'success',
              title: response.data.message
            });
            this.$Progress.finish();
            this.initialize();
          })
          .catch((error) => {
            this.$Progress.fail();
            let msg = 'Gagal menambah role, ulangi!';
            if (error.response && error.response.data && error.response.data.message) {
              msg = error.response.data.message;
            }
            Toast.fire({
              icon: 'error',
              title: msg
            });
          });
      },

      updateRole() {
        this.$Progress.start();

        axios.put('api/role/' + this.editedItem.id, {
          name: this.editedItem.name,
          description: this.editedItem.description,
        })
          .then((response) => {
            $('#addNew').modal('hide');
            Toast.fire({
              icon: 'success',
              title: response.data.message
            });
            this.$Progress.finish();
            this.initialize();
          })
          .catch((error) => {
            this.$Progress.fail();
            let msg = 'Gagal memperbarui role!';
            if (error.response && error.response.data && error.response.data.message) {
              msg = error.response.data.message;
            }
            Toast.fire({
              icon: 'error',
              title: msg
            });
          });
      },

      deleteRole(id) {
        Swal.fire({
          title: 'Yakin dihapus?',
          text: 'Jika dihapus data hilang!',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#3085d6',
          confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
          if (result.value) {
            axios.delete('api/role/' + id)
              .then(() => {
                Swal.fire('Dihapus!', 'Data role telah dihapus.', 'success');
                this.initialize();
              })
              .catch((data) => {
                Swal.fire('Gagal!', 'Gagal menghapus data role.', 'warning');
              });
          }
        });
      },
    },
  }
</script>
