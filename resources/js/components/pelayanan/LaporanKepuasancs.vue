<template>
  <v-app>
    <v-container fluid>
      <v-row no-gutters class="justify-content-md-center">
        <v-col cols="12" md="11">
          <v-card class="pa-3 mx-auto" v-if="$gate.isAdmin() || $gate.isPelayanan() || $gate.isCs() || $gate.isTeller()">
            <v-toolbar
              src="images/banner-biru-pelayanan.jpg"
              color="rgb(39,154,187)"
              dark
              shaped
              class="mb-4"
            >
              <v-toolbar-title class="font-weight-bold">
                <v-icon left large dark>mdi-file-chart</v-icon>
                Laporan & Rekapitulasi Kepuasan Nasabah (CS & Teller)
              </v-toolbar-title>
              <v-spacer></v-spacer>
              <v-btn small color="success" dark @click="initialize()">
                <v-icon left>mdi-reload</v-icon> Refresh Data
              </v-btn>
            </v-toolbar>

            <!-- STATISTIK RINGKASAN HARI INI -->
            <v-row class="mb-4">
              <v-col cols="12" sm="4">
                <v-card class="pa-3 elevation-2 text-center" style="border-left: 6px solid #4CAF50; border-radius: 8px;">
                  <div class="subtitle-2 grey--text text-uppercase font-weight-bold">Puas Hari Ini (Anda)</div>
                  <div class="display-1 font-weight-bold success--text mt-1">
                    {{ todayUserStats.puas }}
                  </div>
                  <div class="caption grey--text mt-1" v-if="todayUserStats.total > 0">
                    {{ ((todayUserStats.puas / todayUserStats.total) * 100).toFixed(1) }}% dari total respon
                  </div>
                </v-card>
              </v-col>

              <v-col cols="12" sm="4">
                <v-card class="pa-3 elevation-2 text-center" style="border-left: 6px solid #FF5252; border-radius: 8px;">
                  <div class="subtitle-2 grey--text text-uppercase font-weight-bold">Tidak Puas Hari Ini (Anda)</div>
                  <div class="display-1 font-weight-bold error--text mt-1">
                    {{ todayUserStats.tidak_puas }}
                  </div>
                  <div class="caption grey--text mt-1" v-if="todayUserStats.total > 0">
                    {{ ((todayUserStats.tidak_puas / todayUserStats.total) * 100).toFixed(1) }}% dari total respon
                  </div>
                </v-card>
              </v-col>

              <v-col cols="12" sm="4">
                <v-card class="pa-3 elevation-2 text-center" style="border-left: 6px solid #2196F3; border-radius: 8px;">
                  <div class="subtitle-2 grey--text text-uppercase font-weight-bold">Total Respon Hari Ini</div>
                  <div class="display-1 font-weight-bold primary--text mt-1">
                    {{ todayUserStats.total }}
                  </div>
                  <div class="caption grey--text mt-1">
                    Keseluruhan Staff: {{ todayAllStats.total }} Respon
                  </div>
                </v-card>
              </v-col>
            </v-row>

            <!-- TABEL DATA LAPORAN -->
            <div class="card-body table-responsive p-0">
              <v-data-table
                :headers="headers"
                :items="kepuasanList"
                :search="search"
                :items-per-page="10"
                dense
                class="elevation-3"
              >
                <template v-slot:top>
                  <v-toolbar flat class="py-2">
                    <div class="d-flex align-center">
                      <vue-excel-xlsx
                        :data="kepuasanList"
                        :columns="columnsExcel"
                        :file-name="'Laporan_Kepuasan_Pelayanan'"
                        :file-type="'xls'"
                        :sheet-name="'Kepuasan_Pelayanan'"
                        class="btn btn-success btn-sm mr-2"
                        title="Export Excel"
                      >
                        <i class="fa-solid fa-file-excel"></i>
                      </vue-excel-xlsx>

                      <v-btn color="error" small class="mr-2" @click="printPDF()" title="Export / Print PDF" min-width="0">
                        <v-icon small>mdi-file-pdf-box</v-icon>
                      </v-btn>
                    </div>

                    <v-spacer></v-spacer>

                    <v-row class="align-center justify-end" style="max-width: 850px;">
                      <!-- FILTER ROLE -->
                      <v-col cols="12" sm="3" v-if="$gate.isAdmin() || $gate.isPelayanan()">
                        <v-select
                          v-model="selectedRole"
                          :items="rolesList"
                          item-text="text"
                          item-value="value"
                          label="Filter Role"
                          single-line
                          hide-details
                          dense
                          outlined
                          @change="initialize()"
                        ></v-select>
                      </v-col>

                      <!-- FILTER KANTOR -->
                      <v-col cols="12" sm="3" v-if="$gate.isAdmin() || $gate.isPelayanan()">
                        <v-combobox
                          v-model="selectedKantor"
                          label="Filter Kantor"
                          :items="namaKantorList"
                          item-value="id"
                          item-text="nama_kantor"
                          placeholder="Pilih Kantor"
                          single-line
                          hide-details
                          clearable
                          dense
                          outlined
                          :return-object="false"
                          @change="initialize()"
                          @click="getKantor()"
                        ></v-combobox>
                      </v-col>

                      <!-- FILTER DARI TANGGAL -->
                      <v-col cols="12" sm="3">
                        <v-menu
                          v-model="menuFrom"
                          :close-on-content-click="false"
                          transition="scale-transition"
                          offset-y
                          min-width="auto"
                        >
                          <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                              v-model="fromTglText"
                              label="Dari Tanggal"
                              append-icon="mdi-calendar"
                              single-line
                              hide-details
                              dense
                              outlined
                              v-bind="attrs"
                              v-on="on"
                            ></v-text-field>
                          </template>
                          <v-date-picker
                            v-model="fromTgl"
                            @input="menuFrom = false"
                            locale="id-ID"
                          ></v-date-picker>
                        </v-menu>
                      </v-col>

                      <!-- FILTER SAMPAI TANGGAL -->
                      <v-col cols="12" sm="3">
                        <v-menu
                          v-model="menuTo"
                          :close-on-content-click="false"
                          transition="scale-transition"
                          offset-y
                          min-width="auto"
                        >
                          <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                              v-model="toTglText"
                              label="Sampai Tanggal"
                              append-icon="mdi-calendar"
                              single-line
                              hide-details
                              dense
                              outlined
                              v-bind="attrs"
                              v-on="on"
                            ></v-text-field>
                          </template>
                          <v-date-picker
                            v-model="toTgl"
                            @input="menuTo = false"
                            locale="id-ID"
                          ></v-date-picker>
                        </v-menu>
                      </v-col>

                      <v-col cols="auto">
                        <v-btn fab dark color="indigo" x-small @click="initialize()">
                          <v-icon>mdi-filter</v-icon>
                        </v-btn>
                      </v-col>
                    </v-row>

                    <v-spacer></v-spacer>

                    <v-text-field
                      v-model="search"
                      append-icon="mdi-magnify"
                      label="Cari Rekap..."
                      single-line
                      hide-details
                      loading="grey"
                      style="max-width: 180px;"
                    ></v-text-field>
                  </v-toolbar>
                </template>

                <template v-slot:item.index="{ index }">
                  {{ index + 1 }}
                </template>

                <template v-slot:item.tanggal="{ item }">
                  {{ formatDate(item.tanggal) }}
                </template>

                <template v-slot:item.role="{ item }">
                  <v-chip
                    x-small
                    :color="item.role === 'cs' ? 'success' : item.role === 'teller' ? 'info' : 'grey'"
                    text-color="white"
                    class="font-weight-bold text-uppercase"
                  >
                    {{ item.role === 'cs' ? 'CS' : (item.role === 'teller' ? 'Teller' : item.role) }}
                  </v-chip>
                </template>

                <template v-slot:item.puas="{ item }">
                  <v-chip color="success" text-color="white" small class="font-weight-bold">
                    <v-icon left small>mdi-thumb-up</v-icon> {{ item.puas }}
                  </v-chip>
                </template>

                <template v-slot:item.tidak_puas="{ item }">
                  <v-chip color="error" text-color="white" small class="font-weight-bold">
                    <v-icon left small>mdi-thumb-down</v-icon> {{ item.tidak_puas }}
                  </v-chip>
                </template>

                <template v-slot:item.actions="{ item }">
                  <v-icon small color="red" @click="deleteItem(item.id)">
                    mdi-delete
                  </v-icon>
                </template>
              </v-data-table>
            </div>
          </v-card>
        </v-col>
      </v-row>

      <div v-if="!$gate.isAdmin() && !$gate.isPelayanan() && !$gate.isCs() && !$gate.isTeller()">
        <not-found></not-found>
      </div>
    </v-container>
  </v-app>
</template>

<script>
import moment from "moment";

export default {
  data: () => ({
    search: "",
    kepuasanList: [],
    fromTgl: "",
    toTgl: "",
    menuFrom: false,
    menuTo: false,
    selectedKantor: null,
    selectedRole: "",
    namaKantorList: [],

    pincabList: [],
    namaPimpinanCabang: "",

    rolesList: [
      { text: "Semua Role", value: "" },
      { text: "Customer Service (CS)", value: "cs" },
      { text: "Teller", value: "teller" },
    ],

    todayUserStats: {
      puas: 0,
      tidak_puas: 0,
      total: 0,
    },
    todayAllStats: {
      total_puas: 0,
      total_tidak_puas: 0,
      total: 0,
    },

    columnsExcel: [
      { label: "Tanggal", field: "tanggal", dataFormat: (v) => moment(v).format("DD/MM/YYYY") },
      { label: "Kode Kantor", field: "kode_kantor" },
      { label: "Nama Kantor", field: "nama_kantor" },
      { label: "Role", field: "role", dataFormat: (v) => (v === "cs" ? "CS" : v === "teller" ? "Teller" : v) },
      { label: "Nama Staff", field: "nama_cs" },
      { label: "Jumlah Puas", field: "puas" },
      { label: "Jumlah Tidak Puas", field: "tidak_puas" },
      { label: "Total Respon", field: "total_respon" },
    ],
  }),

  computed: {
    headers() {
      let headers = [
        { text: "No", value: "index", align: "center", sortable: false },
        { text: "Tanggal", value: "tanggal", align: "center" },
        { text: "Kode Kantor", value: "kode_kantor", align: "center" },
        { text: "Nama Kantor", value: "nama_kantor" },
        { text: "Role", value: "role", align: "center" },
        { text: "Nama Staff", value: "nama_cs" },
        { text: "Puas (Thumbs Up)", value: "puas", align: "center" },
        { text: "Tidak Puas (Thumbs Down)", value: "tidak_puas", align: "center" },
        { text: "Total Respon", value: "total_respon", align: "center" },
      ];

      if (this.$gate.isAdmin()) {
        headers.push({ text: "Hapus", value: "actions", sortable: false, align: "center" });
      }
      return headers;
    },

    fromTglText() {
      return this.fromTgl ? moment(this.fromTgl).format("YYYY-MM-DD") : "";
    },
    toTglText() {
      return this.toTgl ? moment(this.toTgl).format("YYYY-MM-DD") : "";
    },
  },

  created() {
    this.$Progress.start();
    this.getTodayStats();
    this.initialize();
    this.getKantor();
    this.getPincabData();
    this.$Progress.finish();
  },

  methods: {
    formatDate(date) {
      if (!date) return null;
      return moment(date).format("DD/MM/YYYY");
    },

    getPincabData() {
      axios.get("api/pincab/user-kantor")
        .then((res) => {
          if (res.data && res.data.data && res.data.data.nama_pimpinan) {
            this.namaPimpinanCabang = res.data.data.nama_pimpinan;
          }
        })
        .catch((err) => console.log(err));

      axios.get("api/pincab")
        .then((res) => {
          this.pincabList = res.data.data || [];
        })
        .catch((err) => console.log(err));
    },

    getKantor() {
      if (this.$gate.isAdmin() || this.$gate.isPelayanan()) {
        axios
          .get("api/stock/getkantor")
          .then((response) => {
            this.namaKantorList = response.data.data.map((item) => ({
              id: item.id,
              nama_kantor: `${item.kode_kantor} - ${item.nama_kantor}`,
            }));
          })
          .catch((err) => console.log(err));
      }
    },

    getTodayStats() {
      axios
        .get("api/kepuasancs/today")
        .then((response) => {
          this.todayUserStats = response.data.data.user_today;
          this.todayAllStats = response.data.data.all_today;
        })
        .catch((err) => console.log(err));
    },

    initialize() {
      this.$Progress.start();
      const params = {};
      if (this.fromTglText) params.fromtgl = this.fromTglText;
      if (this.toTglText) params.totgl = this.toTglText;
      if (this.selectedKantor) params.kantor_id = this.selectedKantor;
      if (this.selectedRole) params.role = this.selectedRole;

      axios
        .get("api/kepuasancs", { params })
        .then((response) => {
          this.kepuasanList = response.data.data;
        })
        .catch((err) => console.log(err))
        .finally(() => {
          this.$Progress.finish();
        });
    },

    deleteItem(id) {
      Swal.fire({
        title: "Yakin dihapus?",
        text: "Data penilaian kepuasan ini akan dihapus permanen!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, Hapus!",
      }).then((result) => {
        if (result.value) {
          axios
            .delete(`api/kepuasancs/${id}`)
            .then(() => {
              Swal.fire("Dihapus!", "Data telah dihapus.", "success");
              this.initialize();
              this.getTodayStats();
            })
            .catch(() => {
              Swal.fire("Gagal!", "Gagal menghapus data", "error");
            });
        }
      });
    },

    printPDF() {
      const printableWindow = window.open("", "_blank");
      let tableRows = "";
      let totalPuas = 0;
      let totalTidakPuas = 0;
      let totalResponAll = 0;

      const loggedInUser = window.user || {};
      const userNama = loggedInUser.name || "Staff";
      const userType = (loggedInUser.type || "").toLowerCase();

      let userRoleLabel = "Staf Pelayanan";
      if (userType === "cs") {
        userRoleLabel = "Staf CS";
      } else if (userType === "teller") {
        userRoleLabel = "Staf Teller";
      } else if (userType === "admin") {
        userRoleLabel = "Administrator";
      } else if (userType === "pelayanan") {
        userRoleLabel = "Staf Pelayanan";
      } else if (userType) {
        userRoleLabel = "Staf " + userType.toUpperCase();
      }

      let pincabNameText = "";
      if (this.selectedKantor) {
        const foundKantor = this.namaKantorList.find((k) => k.id === this.selectedKantor);
        if (foundKantor) {
          const kodeSLIK = foundKantor.nama_kantor.split("-")[0].trim();
          const matchedPincab = this.pincabList.find(
            (p) => p.kode_kantor === kodeSLIK || p.kode_kantor === String(kodeSLIK).padStart(3, "0")
          );
          if (matchedPincab) {
            pincabNameText = matchedPincab.nama_pimpinan;
          }
        }
      }

      if (!pincabNameText && this.kepuasanList && this.kepuasanList.length > 0) {
        const firstRowKode = this.kepuasanList[0].kode_kantor || this.kepuasanList[0].kode_kantor_slik;
        if (firstRowKode) {
          const padded = String(firstRowKode).padStart(3, "0");
          const matchedPincab = this.pincabList.find(
            (p) => p.kode_kantor === String(firstRowKode) || p.kode_kantor === padded
          );
          if (matchedPincab) {
            pincabNameText = matchedPincab.nama_pimpinan;
          }
        }
      }

      if (!pincabNameText && this.namaPimpinanCabang) {
        pincabNameText = this.namaPimpinanCabang;
      }

      const isBlankPincab = !pincabNameText;
      if (!pincabNameText) {
        pincabNameText = "( &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; )";
      }

      this.kepuasanList.forEach((item, index) => {
        totalPuas += parseInt(item.puas || 0);
        totalTidakPuas += parseInt(item.tidak_puas || 0);
        totalResponAll += parseInt(item.total_respon || 0);

        const roleName = item.role === "cs" ? "CS" : item.role === "teller" ? "Teller" : item.role;

        tableRows +=
          "<tr>" +
          "<td style='text-align: center; border: 1px solid #ddd; padding: 8px;'>" + (index + 1) + "</td>" +
          "<td style='text-align: center; border: 1px solid #ddd; padding: 8px;'>" + this.formatDate(item.tanggal) + "</td>" +
          "<td style='text-align: center; border: 1px solid #ddd; padding: 8px;'>" + (item.kode_kantor || "-") + "</td>" +
          "<td style='border: 1px solid #ddd; padding: 8px;'>" + (item.nama_kantor || "-") + "</td>" +
          "<td style='text-align: center; border: 1px solid #ddd; padding: 8px; font-weight: bold;'>" + roleName + "</td>" +
          "<td style='border: 1px solid #ddd; padding: 8px;'>" + (item.nama_cs || "-") + "</td>" +
          "<td style='text-align: center; border: 1px solid #ddd; padding: 8px; font-weight: bold; color: green;'>" + item.puas + "</td>" +
          "<td style='text-align: center; border: 1px solid #ddd; padding: 8px; font-weight: bold; color: red;'>" + item.tidak_puas + "</td>" +
          "<td style='text-align: center; border: 1px solid #ddd; padding: 8px; font-weight: bold;'>" + item.total_respon + "</td>" +
          "</tr>";
      });

      const todayStr = moment().format("DD/MM/YYYY HH:mm");
      let periodeStr = "";
      if (this.fromTglText) {
        periodeStr = "<strong>Periode:</strong> " + this.formatDate(this.fromTglText) + " s/d " + this.formatDate(this.toTglText) + "<br/>";
      }

      let roleFilterStr = "";
      if (this.selectedRole) {
        roleFilterStr = "<strong>Filter Role:</strong> " + (this.selectedRole === "cs" ? "Customer Service" : "Teller") + "<br/>";
      }

      const pincabStyleAttr = isBlankPincab
        ? "font-weight: bold; font-size: 13px; margin: 0;"
        : "font-weight: bold; text-decoration: underline; font-size: 13px; margin: 0; text-transform: uppercase;";

      const htmlContent =
        "<!DOCTYPE html>" +
        "<html>" +
        "<head>" +
        "<title>Laporan Kepuasan Pelayanan - PT BPR JABAR PERSERODA</title>" +
        "<style>" +
        "body { font-family: Arial, sans-serif; margin: 20px; color: #333; }" +
        ".header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #1976D2; padding-bottom: 10px; }" +
        ".header h2 { margin: 0; color: #1976D2; }" +
        ".header h4 { margin: 5px 0 0 0; color: #555; }" +
        ".meta-info { margin-bottom: 15px; font-size: 13px; }" +
        "table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 13px; }" +
        "th { background-color: #f2f2f2; border: 1px solid #ddd; padding: 10px; text-align: center; }" +
        "td { border: 1px solid #ddd; padding: 8px; }" +
        "tfoot tr { background-color: #eaeff5; font-weight: bold; }" +
        ".signature-container { margin-top: 50px; display: flex; justify-content: space-between; page-break-inside: avoid; }" +
        ".signature-box { text-align: center; width: 250px; }" +
        ".signature-title { margin-bottom: 60px; font-size: 13px; }" +
        ".signature-name-user { font-weight: bold; text-decoration: underline; font-size: 13px; margin: 0; text-transform: uppercase; }" +
        ".signature-role { font-size: 12px; margin-top: 4px; color: #333; }" +
        "@media print { @page { size: A4 landscape; margin: 15mm; } }" +
        "</style>" +
        "</head>" +
        "<body>" +
        "<div class='header'>" +
        "<h2>PT BPR JABAR PERSERODA</h2>" +
        "<h4>LAPORAN REKAPITULASI KEPUASAN NASABAH (PELAYANAN)</h4>" +
        "</div>" +
        "<div class='meta-info'>" +
        "<strong>Dicetak Tanggal:</strong> " + todayStr + "<br/>" +
        periodeStr +
        roleFilterStr +
        "<strong>Total Rekap Data:</strong> " + this.kepuasanList.length + " Baris" +
        "</div>" +
        "<table>" +
        "<thead>" +
        "<tr>" +
        "<th>No</th>" +
        "<th>Tanggal</th>" +
        "<th>Kode Kantor</th>" +
        "<th>Nama Kantor</th>" +
        "<th>Role</th>" +
        "<th>Nama Staff</th>" +
        "<th>Puas 👍</th>" +
        "<th>Tidak Puas 👎</th>" +
        "<th>Total Respon</th>" +
        "</tr>" +
        "</thead>" +
        "<tbody>" +
        tableRows +
        "</tbody>" +
        "<tfoot>" +
        "<tr>" +
        "<td colspan='6' style='text-align: right; border: 1px solid #ddd; padding: 8px;'>TOTAL KESELURUHUN</td>" +
        "<td style='text-align: center; border: 1px solid #ddd; padding: 8px; color: green;'>" + totalPuas + "</td>" +
        "<td style='text-align: center; border: 1px solid #ddd; padding: 8px; color: red;'>" + totalTidakPuas + "</td>" +
        "<td style='text-align: center; border: 1px solid #ddd; padding: 8px;'>" + totalResponAll + "</td>" +
        "</tr>" +
        "</tfoot>" +
        "</table>" +
        "<div class='signature-container'>" +
        "<div class='signature-box'>" +
        "<p class='signature-title'>Dibuat oleh,</p>" +
        "<p class='signature-name-user'>" + userNama + "</p>" +
        "<p class='signature-role'>" + userRoleLabel + "</p>" +
        "</div>" +
        "<div class='signature-box'>" +
        "<p class='signature-title'>Mengetahui,</p>" +
        "<p style='" + pincabStyleAttr + "'>" + pincabNameText + "</p>" +
        "<p class='signature-role'>Pemimpin Cabang</p>" +
        "</div>" +
        "</div>" +
        "<script>" +
        "window.onload = function() { window.print(); };" +
        "<\/script>" +
        "</body>" +
        "</html>";

      printableWindow.document.write(htmlContent);
      printableWindow.document.close();
    },
  },
};
</script>

<style scoped>
</style>
