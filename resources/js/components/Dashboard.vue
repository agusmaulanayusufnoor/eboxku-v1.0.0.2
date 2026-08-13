<template>
  <section class="content py-3">
    <v-container fluid>
      <!-- HEADER BANNER CENTERED -->
      <v-row class="mb-4">
        <v-col cols="12" class="text-center">
          <v-card class="pa-6 elevation-2" style="border-radius: 16px; background: #ffffff;">
            <h1 class="font-weight-black primary--text mb-1" style="font-size: 2rem; letter-spacing: 0.5px;">
              PT BPR JABAR PERSERODA
            </h1>
            <div class="subtitle-1 grey--text text--darken-2 font-weight-medium mb-3">
              Dashboard Analytic Kepuasan Nasabah (Customer Service)
            </div>
            <div>
              <v-btn
                small
                rounded
                color="primary"
                dark
                class="px-4 font-weight-bold elevation-2"
                @click="fetchDashboardData"
              >
                <v-icon left small>mdi-refresh</v-icon> Refresh Data
              </v-btn>
            </div>
          </v-card>
        </v-col>
      </v-row>

      <!-- STAT CARDS (4 WIDGETS CENTERED) -->
      <v-row class="mb-4">
        <!-- PUAS HARI INI -->
        <v-col cols="12" sm="6" md="3">
          <v-card class="pa-4 elevation-3 text-center stat-card" style="border-top: 5px solid #4CAF50; border-radius: 12px; background: #ffffff;">
            <v-avatar color="green lighten-5" size="48" class="mb-2">
              <v-icon color="green darken-1" large>mdi-thumb-up</v-icon>
            </v-avatar>
            <div class="caption text-uppercase font-weight-bold grey--text text--darken-1 mb-1">
              Puas Hari Ini
            </div>
            <div class="display-1 font-weight-black success--text my-1">
              {{ today.puas }}
            </div>
            <div class="caption grey--text text--darken-1">
              {{ today.persentase }}% dari {{ today.total }} total suara
            </div>
          </v-card>
        </v-col>

        <!-- TIDAK PUAS HARI INI -->
        <v-col cols="12" sm="6" md="3">
          <v-card class="pa-4 elevation-3 text-center stat-card" style="border-top: 5px solid #FF5252; border-radius: 12px; background: #ffffff;">
            <v-avatar color="red lighten-5" size="48" class="mb-2">
              <v-icon color="red darken-1" large>mdi-thumb-down</v-icon>
            </v-avatar>
            <div class="caption text-uppercase font-weight-bold grey--text text--darken-1 mb-1">
              Tidak Puas Hari Ini
            </div>
            <div class="display-1 font-weight-black error--text my-1">
              {{ today.tidak_puas }}
            </div>
            <div class="caption grey--text text--darken-1">
              {{ today.total > 0 ? (100 - today.persentase).toFixed(1) : 0 }}% dari {{ today.total }} total suara
            </div>
          </v-card>
        </v-col>

        <!-- TOTAL RESPON HARI INI -->
        <v-col cols="12" sm="6" md="3">
          <v-card class="pa-4 elevation-3 text-center stat-card" style="border-top: 5px solid #2196F3; border-radius: 12px; background: #ffffff;">
            <v-avatar color="blue lighten-5" size="48" class="mb-2">
              <v-icon color="blue darken-1" large>mdi-account-voice</v-icon>
            </v-avatar>
            <div class="caption text-uppercase font-weight-bold grey--text text--darken-1 mb-1">
              Total Respon Hari Ini
            </div>
            <div class="display-1 font-weight-black primary--text my-1">
              {{ today.total }}
            </div>
            <div class="caption grey--text text--darken-1">
              Penilaian masuk hari ini
            </div>
          </v-card>
        </v-col>

        <!-- TINGKAT KEPUASAN BULAN INI -->
        <v-col cols="12" sm="6" md="3">
          <v-card class="pa-4 elevation-3 text-center stat-card" style="border-top: 5px solid #9C27B0; border-radius: 12px; background: #ffffff;">
            <v-avatar color="purple lighten-5" size="48" class="mb-2">
              <v-icon color="purple darken-1" large>mdi-star-circle</v-icon>
            </v-avatar>
            <div class="caption text-uppercase font-weight-bold grey--text text--darken-1 mb-1">
              Kepuasan {{ month.month_name }}
            </div>
            <div class="display-1 font-weight-black purple--text text--darken-2 my-1">
              {{ month.persentase }}%
            </div>
            <div class="caption grey--text text--darken-1">
              {{ month.puas }} Puas / {{ month.total }} Total respon
            </div>
          </v-card>
        </v-col>
      </v-row>

      <!-- DETAIL REKAP BULANAN (PER CS & PER HARI) -->
      <v-row>
        <!-- TABLE SUMMARY PER CS -->
        <v-col cols="12" md="6">
          <v-card class="pa-4 elevation-3" style="border-radius: 12px;">
            <div class="d-flex align-center justify-space-between mb-3">
              <h3 class="subtitle-1 font-weight-bold primary--text mb-0">
                <v-icon left color="primary">mdi-account-star</v-icon> Summary Per CS ({{ month.month_name }})
              </h3>
              <v-chip small color="primary" label class="font-weight-bold">
                {{ perCsList.length }} Staff CS
              </v-chip>
            </div>

            <v-data-table
              :headers="csHeaders"
              :items="perCsList"
              :items-per-page="5"
              dense
              class="elevation-1"
            >
              <template v-slot:item.index="{ index }">
                {{ index + 1 }}
              </template>

              <template v-slot:item.total_puas="{ item }">
                <span class="font-weight-bold success--text">{{ item.total_puas }}</span>
              </template>

              <template v-slot:item.total_tidak_puas="{ item }">
                <span class="font-weight-bold error--text">{{ item.total_tidak_puas }}</span>
              </template>

              <template v-slot:item.persentase_puas="{ item }">
                <v-chip
                  x-small
                  :color="item.persentase_puas >= 80 ? 'success' : item.persentase_puas >= 50 ? 'warning' : 'error'"
                  dark
                  class="font-weight-bold"
                >
                  {{ item.persentase_puas }}%
                </v-chip>
              </template>
            </v-data-table>
          </v-card>
        </v-col>

        <!-- TABLE SUMMARY PER HARI IN THIS MONTH -->
        <v-col cols="12" md="6">
          <v-card class="pa-4 elevation-3" style="border-radius: 12px;">
            <div class="d-flex align-center justify-space-between mb-3">
              <h3 class="subtitle-1 font-weight-bold primary--text mb-0">
                <v-icon left color="primary">mdi-calendar-month</v-icon> Summary Per Hari ({{ month.month_name }})
              </h3>
              <v-chip small color="info" label class="font-weight-bold">
                {{ perDayList.length }} Hari Transaksi
              </v-chip>
            </div>

            <v-data-table
              :headers="dayHeaders"
              :items="perDayList"
              :items-per-page="5"
              dense
              class="elevation-1"
            >
              <template v-slot:item.index="{ index }">
                {{ index + 1 }}
              </template>

              <template v-slot:item.tanggal="{ item }">
                {{ formatDate(item.tanggal) }}
              </template>

              <template v-slot:item.total_puas="{ item }">
                <span class="font-weight-bold success--text">{{ item.total_puas }}</span>
              </template>

              <template v-slot:item.total_tidak_puas="{ item }">
                <span class="font-weight-bold error--text">{{ item.total_tidak_puas }}</span>
              </template>

              <template v-slot:item.persentase_puas="{ item }">
                <span class="font-weight-bold primary--text">{{ item.persentase_puas }}%</span>
              </template>
            </v-data-table>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </section>
</template>

<script>
import moment from "moment";

export default {
  data: () => ({
    today: {
      puas: 0,
      tidak_puas: 0,
      total: 0,
      persentase: 0,
    },
    month: {
      month_name: "",
      puas: 0,
      tidak_puas: 0,
      total: 0,
      persentase: 0,
    },
    perCsList: [],
    perDayList: [],

    csHeaders: [
      { text: "No", value: "index", align: "center", sortable: false },
      { text: "Nama CS", value: "nama_cs" },
      { text: "Kantor", value: "nama_kantor" },
      { text: "Puas 👍", value: "total_puas", align: "center" },
      { text: "Tidak Puas 👎", value: "total_tidak_puas", align: "center" },
      { text: "Total", value: "total_respon", align: "center" },
      { text: "Kepuasan %", value: "persentase_puas", align: "center" },
    ],

    dayHeaders: [
      { text: "No", value: "index", align: "center", sortable: false },
      { text: "Tanggal", value: "tanggal", align: "center" },
      { text: "Puas 👍", value: "total_puas", align: "center" },
      { text: "Tidak Puas 👎", value: "total_tidak_puas", align: "center" },
      { text: "Total", value: "total_respon", align: "center" },
      { text: "Tingkat Kepuasan", value: "persentase_puas", align: "center" },
    ],
  }),

  created() {
    this.fetchDashboardData();
  },

  methods: {
    formatDate(date) {
      if (!date) return "";
      return moment(date).format("DD/MM/YYYY");
    },

    fetchDashboardData() {
      this.$Progress.start();
      axios
        .get("api/kepuasancs/dashboard-summary")
        .then((response) => {
          const data = response.data.data;
          this.today = data.today;
          this.month = data.month;
          this.perCsList = data.per_cs;
          this.perDayList = data.per_day;
        })
        .catch((err) => {
          console.log(err);
        })
        .finally(() => {
          this.$Progress.finish();
        });
    },
  },
};
</script>

<style scoped>
.stat-card {
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.stat-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12) !important;
}
</style>
