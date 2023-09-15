<template>
  <v-app>
    <v-container fluid>
      <v-row no-gutters class="justify-content-md-center">
        <v-col cols="11">
          <v-card class="pa-2 mx-auto" v-if="$gate.isAdmin()">
            <v-toolbar
              src="images/banner-green.jpg"
              color="grey lighten-1"
              dark
              shaped
            >
              <v-toolbar-title> Data User </v-toolbar-title>
              <v-spacer></v-spacer>
              <v-btn small color="primary" dark @click="newModal">
                <v-icon>mdi-account-plus</v-icon>
              </v-btn>
            </v-toolbar>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <v-data-table
                :headers="headers"
                :items="users"
                :search="search"
                class="elevation-1"
              >
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
                      label="Cari Data"
                      single-line
                      hide-details
                      loading="grey"
                    ></v-text-field>
                  </v-toolbar>
                </template>

                <template v-slot:item.actions="{ item }">
                  <v-icon
                    small
                    class="mr-5"
                    color="green"
                    @click="editModal(item)"
                  >
                    mdi-pencil
                  </v-icon>
                  <v-icon
                    small
                    class="mr-2"
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

      <div v-if="!$gate.isAdmin()">
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
              <h5 class="modal-title" v-show="!editmode">Tambah User Baru</h5>
              <h5 class="modal-title" v-show="editmode">Edit Data User</h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <!-- <form @submit.prevent="createUser"> -->

            <form @submit.prevent="editmode ? updateUser() : createUser()">
              <div class="modal-body">
                <div class="form-group">
                  <label>Nama</label>
                  <input
                    v-model="form.name"
                    type="text"
                    name="name"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('name') }"
                  />
                  <has-error :form="form" field="name"></has-error>
                </div>
                <div class="form-group">
                  <label>Username</label>
                  <input
                    v-model="form.username"
                    type="text"
                    name="username"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('username') }"
                  />
                  <has-error :form="form" field="username"></has-error>
                </div>

                <div class="form-group">
                  <label>Password</label>
                  <input
                    v-model="form.password"
                    type="password"
                    name="password"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('password') }"
                    autocomplete="false"
                  />
                  <has-error :form="form" field="password"></has-error>
                </div>

                <div class="form-group">
                  <label>Level User</label>
                  <select
                    name="type"
                    v-model="form.type"
                    id="type"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('type') }"
                  >
                    <option value="">- Pilih Level User -</option>
                    <option value="admin">Admin</option>
                    <option value="pelayanan">Pelayanan</option>
                    <option value="kredit">Kredit</option>
                    <option value="akunting">Umum dan Akunting Cabang</option>
                    <option value="umumpst">Umum Pusat</option>
                    <option value="bisnis">Bisnis Pusat</option>
                    <option value="sekdir">Sekretaris Direktur</option>
                    <option value="skai">SKAI</option>
                    <option value="sdm">SDM</option>
                  </select>
                  <has-error :form="form" field="type"></has-error>
                </div>
                <div class="form-group">
                  <label>Kantor</label>
                  <select
                    name="kantor_id"
                    v-model="form.kantor_id"
                    id="kantor_id"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('kantor_id') }"
                  >
                    <option value="">- Pilih Kantor -</option>
                    <option value="1">001 - Pusat</option>
                    <option value="2">002 - Cab. Cisalak</option>
                    <option value="3">003 - Cab. KPO</option>
                    <option value="4">004 - Cab. Subang</option>
                    <option value="5">005 - Cab. Purwadadi</option>
                    <option value="6">006 - Cab. Pamanukan</option>
                  </select>
                  <has-error :form="form" field="kantor_id"></has-error>
                </div>
                <div class="form-group">
                    <label>Otorisator</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" v-model="form.otorisator" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1">
                        <label class="form-check-label" for="inlineRadio1">Ya</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" v-model="form.otorisator" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="0">
                        <label class="form-check-label" for="inlineRadio2">Tidak</label>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <v-btn
                  color="error"
                  elevation="2"
                  type="button"
                  data-dismiss="modal"
                >
                  <v-icon>mdi-account-cancel</v-icon>
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
                  <v-icon>mdi-account-plus</v-icon>
                  Tambah
                </v-btn>
              </div>
            </form>
          </div>
        </div>
      </div>
    </v-container>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    editmode: false,
    dialog: false,
    dialogDelete: false,
    search: "",
    headers: [
      {
        text: "No",
        value: "index",
      },
      {
        text: "Username",
        align: "start",
        value: "username",
      },
      { text: "Nama", value: "name" },
      { text: "Divisi", value: "type" },
      { text: "Kantor", value: "nama_kantor" },
      { text: "Otorisator", value: "otorisator" },
      { text: "Edit - Hapus", value: "actions", sortable: false },
    ],
    users: [],
    form: new Form({
      id: "",
      name: "",
      username: "",
      password: "",
      type: "",
      kantor_id: "",
      otorisator: "0",
    }),
  }),

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
    },
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },

  created() {
    this.$Progress.start();
    this.initialize();
    this.$Progress.finish();
  },

  methods: {
    initialize() {
      this.$Progress.start();

      if (this.$gate.isAdmin()) {
        //axios.get("api/user").then((response) => {(this.users = response.data.data)});
        axios.get("api/user").then((response) => {
          this.users = response.data.data;
          //console.log(this.users);
        });
      }

      this.$Progress.finish();
    },
    editModal(item) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(item);
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
    },
    createUser() {
      this.form
        .post("api/user")
        .then((response) => {
          $("#addNew").modal("hide");

          Toast.fire({
            icon: "success",
            title: response.data.message,
          });

          this.$Progress.finish();
          this.initialize();
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Ada kesalahan, coba lagi...",
          });
        });
    },
    updateUser() {
      this.$Progress.start();
      // console.log('Editing data');
      this.form
        .put("api/user/" + this.form.id)
        .then((response) => {
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
        .catch(() => {
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
            .delete("api/user/" + id)
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
