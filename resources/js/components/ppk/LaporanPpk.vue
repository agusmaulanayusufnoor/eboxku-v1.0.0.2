<template>
  <v-app>
    <v-container fluid>
      <v-row no-gutters class="justify-content-md-center">
        <v-col cols="12">
          <!-- Non-print card controls -->
          <v-card class="pa-2 mx-auto no-print" v-if="$gate.isAdmin() || $gate.isPpk()">
            <v-toolbar
              src="images/banner-green.jpg"
              color="green darken-2"
              dark
              shaped
            >
              <v-toolbar-title>
                <v-icon left>mdi-file-chart</v-icon>
                Laporan Summary Transaksi Manual
              </v-toolbar-title>
              <v-spacer></v-spacer>
              <v-btn color="primary" small @click="cetakPdf" :disabled="!items.length">
                <v-icon left>mdi-printer</v-icon> Cetak PDF
              </v-btn>
            </v-toolbar>

            <!-- Filter -->
            <v-card class="mx-2 mt-3 mb-3 pa-3" outlined>
              <v-row dense>
                <v-col cols="12" md="4">
                  <v-menu
                    v-model="menuBulan"
                    :close-on-content-click="false"
                    transition="scale-transition"
                    offset-y
                    min-width="auto"
                  >
                    <template v-slot:activator="{ on, attrs }">
                      <v-text-field
                        v-model="filterBulan"
                        label="Pilih Bulan & Tahun *"
                        prepend-icon="mdi-calendar-month"
                        readonly
                        dense
                        outlined
                        clearable
                        v-bind="attrs"
                        v-on="on"
                        @click:clear="filterBulan = ''"
                      ></v-text-field>
                    </template>
                    <v-date-picker
                      v-model="filterBulan"
                      type="month"
                      @input="menuBulan = false"
                      locale="id"
                    ></v-date-picker>
                  </v-menu>
                </v-col>

                <v-col cols="12" md="4">
                  <v-select
                    v-model="filterKantorId"
                    :items="[{ id: '', label: 'Semua Kantor' }, ...kantorList]"
                    item-text="label"
                    item-value="id"
                    label="Pilih Kantor"
                    prepend-icon="mdi-office-building"
                    dense
                    outlined
                    clearable
                    @click:clear="filterKantorId = ''"
                  ></v-select>
                </v-col>

                <v-col cols="12" md="4" class="d-flex align-center">
                  <v-btn color="green darken-2" dark @click="initialize" class="mr-2">
                    <v-icon left>mdi-magnify</v-icon> Tampilkan
                  </v-btn>
                  <v-btn color="grey" outlined @click="resetFilter">
                    <v-icon left>mdi-refresh</v-icon> Reset
                  </v-btn>
                </v-col>
              </v-row>
            </v-card>
          </v-card>

          <!-- Area yang diprint sebagai PDF -->
          <v-card class="pa-6 mx-auto mt-2 print-area" outlined>
            <!-- Header Surat / Laporan -->
            <div class="text-center mb-4">
              <h2 class="font-weight-bold text-uppercase mb-1">LAPORAN SUMMARY TRANSAKSI MANUAL</h2>
              <h4 class="font-weight-normal text-muted mb-1" v-if="bulanNama">
                Periode Bulan: {{ bulanNama }}
              </h4>
              <h4 class="font-weight-normal text-muted" v-if="kantorNama">
                Kantor: {{ kantorNama }}
              </h4>
              <hr class="mt-2 mb-4" />
            </div>

            <!-- Tabel Laporan -->
            <table class="table-laporan">
              <thead>
                <tr>
                  <th style="width: 60px;" class="text-center">No</th>
                  <th class="text-left">Nama Kantor</th>
                  <th style="width: 180px;" class="text-center">Jumlah File Upload</th>
                </tr>
              </thead>
              <tbody>
                <tr v-if="loading">
                  <td colspan="3" class="text-center py-4">Memuat data...</td>
                </tr>
                <tr v-else-if="!items.length">
                  <td colspan="3" class="text-center py-4">Tidak ada data untuk periode ini.</td>
                </tr>
                <tr v-else v-for="(item, i) in items" :key="i">
                  <td class="text-center">{{ i + 1 }}</td>
                  <td>{{ item.kode_kantor }} - {{ item.nama_kantor }}</td>
                  <td class="text-center font-weight-bold">{{ item.jumlah_file }}</td>
                </tr>
              </tbody>
              <tfoot v-if="items.length">
                <tr class="total-row">
                  <td colspan="2" class="text-right font-weight-bold">TOTAL FILE:</td>
                  <td class="text-center font-weight-bold">{{ totalFile }}</td>
                </tr>
              </tfoot>
            </table>

            <!-- Footer Tanda Tangan (Tampil saat cetak) -->
            <div class="signature-section mt-8">
              <div class="d-flex justify-space-between">
                <div class="text-center" style="min-width: 200px;">
                  <p class="mb-12">Dibuat Oleh,</p>
                  <p class="font-weight-bold mb-0">( {{ userNama }} )</p>
                  <p class="text-caption">Staf PPK</p>
                </div>
                <div class="text-center" style="min-width: 200px;">
                  <p class="mb-12">Mengetahui,</p>
                  <p class="font-weight-bold mb-0">( ACENG ROHMANA )</p>
                  <p class="text-caption">Pemimpin Divisi</p>
                </div>
              </div>
            </div>
          </v-card>
        </v-col>
      </v-row>

      <div v-if="!$gate.isAdmin() && !$gate.isPpk()">
        <not-found></not-found>
      </div>

    </v-container>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    loading: false,
    menuBulan: false,
    filterBulan: new Date().toISOString().slice(0, 7), // Default bulan ini YYYY-MM
    filterKantorId: "",
    items: [],
    totalFile: 0,
    kantorList: [
      { id: 1,  label: "001 - Pusat" },
      { id: 2,  label: "002 - Cab. Cisalak" },
      { id: 3,  label: "003 - Cab. KPO" },
      { id: 4,  label: "004 - Cab. Subang" },
      { id: 5,  label: "005 - Cab. Purwadadi" },
      { id: 6,  label: "006 - Cab. Pamanukan" },
      { id: 7,  label: "007 - Cab. Majalengka" },
      { id: 8,  label: "008 - Cab. Panyingkiran" },
      { id: 9,  label: "009 - Cab. Banjaran" },
      { id: 10, label: "010 - Cab. Cingambul" },
      { id: 11, label: "011 - Cab. Bekasi" },
      { id: 12, label: "012 - Cab. Pondokgede" },
      { id: 13, label: "013 - Cab. Cibitung" },
      { id: 14, label: "014 - Cab. Setu" },
      { id: 15, label: "015 - Cab. Cibarusah" },
      { id: 16, label: "016 - Cab. Sukatani" },
      { id: 17, label: "017 - Cab. Cimerak" },
      { id: 18, label: "018 - Cab. Ciamis" },
    ],
  }),

  computed: {
    bulanNama() {
      if (!this.filterBulan) return "Semua Periode";
      const [year, month] = this.filterBulan.split("-");
      const namaBulan = [
        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
      ];
      return (namaBulan[parseInt(month) - 1] || "") + " " + year;
    },

    kantorNama() {
      if (!this.filterKantorId) return "";
      const k = this.kantorList.find((x) => x.id === this.filterKantorId);
      return k ? k.label : "";
    },

    userNama() {
      if (this.$gate && this.$gate.user && this.$gate.user.name) {
        return this.$gate.user.name.toUpperCase();
      }
      if (window.user && window.user.name) {
        return window.user.name.toUpperCase();
      }
      return "____________________";
    },
  },

  created() {
    this.initialize();
  },

  methods: {
    initialize() {
      this.loading = true;
      const params = {};
      if (this.filterBulan)    params.bulan     = this.filterBulan;
      if (this.filterKantorId) params.kantor_id = this.filterKantorId;

      axios
        .get("api/transaksi-manual/laporan", { params })
        .then((response) => {
          this.items     = response.data.data.rows;
          this.totalFile = response.data.data.total;
        })
        .catch(() => {
          Toast.fire({ icon: "error", title: "Gagal memuat laporan." });
        })
        .finally(() => {
          this.loading = false;
        });
    },

    resetFilter() {
      this.filterBulan    = new Date().toISOString().slice(0, 7);
      this.filterKantorId = "";
      this.initialize();
    },

    cetakPdf() {
      window.print();
    },
  },
};
</script>

<style scoped>
.table-laporan {
  width: 100%;
  border-collapse: collapse;
  margin-top: 10px;
}

.table-laporan th,
.table-laporan td {
  border: 1px solid #333;
  padding: 8px 12px;
  font-size: 14px;
}

.table-laporan th {
  background-color: #2e7d32;
  color: #fff;
  font-weight: bold;
}

.table-laporan .total-row td {
  background-color: #e8f5e9;
  border-top: 2px solid #333;
}

/* CSS Khusus Cetak / Save AS PDF */
@media print {
  .no-print,
  .main-sidebar,
  .main-header,
  .main-footer {
    display: none !important;
  }

  .content-wrapper {
    margin-left: 0 !important;
    padding: 0 !important;
  }

  .print-area {
    border: none !important;
    box-shadow: none !important;
    padding: 0 !important;
  }

  .table-laporan th {
    background-color: #2e7d32 !important;
    -webkit-print-color-adjust: exact;
    print-color-adjust: exact;
  }
}
</style>
