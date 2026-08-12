<template>
  <v-app>
    <v-container fluid>
      <v-row no-gutters class="justify-content-md-center">
        <v-col cols="12">
          <v-card class="pa-2 mx-auto" v-if="$gate.isAdmin() || $gate.isPpk()">
            <v-toolbar
              src="images/banner-green.jpg"
              color="green darken-2"
              dark
              shaped
            >
              <v-toolbar-title>
                <v-icon left>mdi-file-excel</v-icon>
                Transaksi Manual
              </v-toolbar-title>
              <v-spacer></v-spacer>
              <v-btn small color="orange darken-2" class="mr-2" @click="downloadTemplate">
                <v-icon left>mdi-file-table</v-icon> Format Excel
              </v-btn>
              <v-btn small color="primary" @click="openUploadModal">
                <v-icon left>mdi-file-upload</v-icon> Upload Excel
              </v-btn>
            </v-toolbar>

            <!-- Filter Bar -->
            <v-card class="mx-2 mt-3 mb-1 pa-3" outlined>
              <v-row dense>
                <v-col cols="12" md="3">
                  <v-menu
                    v-model="menuTglMulai"
                    :close-on-content-click="false"
                    transition="scale-transition"
                    offset-y
                    min-width="auto"
                  >
                    <template v-slot:activator="{ on, attrs }">
                      <v-text-field
                        v-model="filterTglMulai"
                        label="Tanggal Mulai"
                        prepend-icon="mdi-calendar"
                        readonly
                        dense
                        outlined
                        clearable
                        v-bind="attrs"
                        v-on="on"
                        @click:clear="filterTglMulai = ''"
                      ></v-text-field>
                    </template>
                    <v-date-picker v-model="filterTglMulai" @input="menuTglMulai = false" locale="id"></v-date-picker>
                  </v-menu>
                </v-col>
                <v-col cols="12" md="3">
                  <v-menu
                    v-model="menuTglAkhir"
                    :close-on-content-click="false"
                    transition="scale-transition"
                    offset-y
                    min-width="auto"
                  >
                    <template v-slot:activator="{ on, attrs }">
                      <v-text-field
                        v-model="filterTglAkhir"
                        label="Tanggal Akhir"
                        prepend-icon="mdi-calendar"
                        readonly
                        dense
                        outlined
                        clearable
                        v-bind="attrs"
                        v-on="on"
                        @click:clear="filterTglAkhir = ''"
                      ></v-text-field>
                    </template>
                    <v-date-picker v-model="filterTglAkhir" @input="menuTglAkhir = false" locale="id"></v-date-picker>
                  </v-menu>
                </v-col>
                <v-col cols="12" md="3">
                  <v-select
                    v-model="filterKantorId"
                    :items="[{ id: '', label: 'Semua Kantor' }, ...kantorList]"
                    item-text="label"
                    item-value="id"
                    label="Filter Kantor"
                    prepend-icon="mdi-office-building"
                    dense
                    outlined
                    clearable
                    @click:clear="filterKantorId = ''"
                  ></v-select>
                </v-col>
                <v-col cols="12" md="3" class="d-flex align-center">
                  <v-btn color="green darken-2" dark icon small @click="handleFilter" class="mr-2" title="Filter">
                    <v-icon>mdi-magnify</v-icon>
                  </v-btn>
                  <v-btn color="grey" outlined icon small @click="resetFilter" class="mr-2" title="Reset">
                    <v-icon>mdi-refresh</v-icon>
                  </v-btn>
                  <v-btn
                    color="red darken-1"
                    dark
                    icon
                    small
                    :disabled="!isFiltered || !items.length"
                    @click="exportPdf"
                    title="Export Laporan PDF"
                  >
                    <v-icon>mdi-file-pdf-box</v-icon>
                  </v-btn>
                </v-col>
              </v-row>
            </v-card>

            <div class="card-body table-responsive p-0">
              <v-data-table
                :headers="headers"
                :items="items"
                :search="search"
                :loading="loading"
                loading-text="Memuat data..."
                :items-per-page="10"
                :footer-props="{
                  'items-per-page-options': [5, 10, 25, -1],
                  'items-per-page-text': 'baris per halaman',
                }"
                dense
                class="elevation-3"
                multi-sort
              >
                <template v-slot:top>
                  <v-toolbar flat>
                    <v-spacer></v-spacer>
                    <v-spacer></v-spacer>
                    <v-text-field
                      v-model="search"
                      append-icon="mdi-magnify"
                      label="Cari Data"
                      single-line
                      hide-details
                    ></v-text-field>
                  </v-toolbar>
                </template>

                <template v-slot:item.index="{ index }">
                  {{ index + 1 }}
                </template>

                <template v-slot:item.status="{ item }">
                  <v-chip
                    small
                    :color="item.status === 'selesai' ? 'success' : 'warning'"
                    dark
                  >
                    {{ item.status === 'selesai' ? 'Selesai' : 'Diproses' }}
                  </v-chip>
                </template>

                <template v-slot:item.actions="{ item }">
                  <v-btn
                    v-if="$gate.isAdmin()"
                    x-small
                    color="blue darken-1"
                    dark
                    class="mr-1"
                    @click="downloadExcel(item)"
                    title="Download Excel"
                  >
                    <v-icon x-small>mdi-file-download</v-icon> Download
                  </v-btn>
                  <v-btn
                    v-if="$gate.isAdmin()"
                    x-small
                    color="success"
                    dark
                    class="mr-1"
                    :disabled="item.status === 'selesai'"
                    @click="updateStatus(item)"
                    title="Update Status Selesai"
                  >
                    <v-icon x-small>mdi-check-circle</v-icon> Selesai
                  </v-btn>
                  <v-btn
                    x-small
                    color="red darken-1"
                    dark
                    @click="hapusData(item.id)"
                    title="Hapus"
                  >
                    <v-icon x-small>mdi-delete</v-icon>
                  </v-btn>
                </template>

              </v-data-table>
            </div>
          </v-card>
        </v-col>
      </v-row>

      <div v-if="!$gate.isAdmin() && !$gate.isPpk()">
        <not-found></not-found>
      </div>

      <!-- Area Cetak PDF (tersembunyi di layar, muncul saat print) -->
      <div class="print-only">
        <div class="text-center mb-4">
          <h2 class="print-title">LAPORAN TRANSAKSI MANUAL</h2>
          <p class="print-subtitle" v-if="filterTglMulai || filterTglAkhir">
            Periode: {{ filterTglMulai || '—' }} s/d {{ filterTglAkhir || '—' }}
          </p>
          <p class="print-subtitle" v-if="filterKantorId">
            Kantor: {{ kantorLabelById(filterKantorId) }}
          </p>
          <hr />
        </div>
        <table class="print-table">
          <thead>
            <tr>
              <th style="width:50px" class="text-center">No</th>
              <th>Nama File</th>
              <th style="width:120px" class="text-center">Tanggal</th>
              <th>Kantor</th>
              <th style="width:100px" class="text-center">Status</th>
            </tr>
          </thead>
          <tbody>
            <tr v-if="!items.length">
              <td colspan="5" class="text-center">Tidak ada data.</td>
            </tr>
            <tr v-for="(item, i) in items" :key="item.id">
              <td class="text-center">{{ i + 1 }}</td>
              <td>{{ item.nama_file }}</td>
              <td class="text-center">{{ item.tanggal }}</td>
              <td>{{ item.nama_kantor }}</td>
              <td class="text-center">{{ item.status === 'selesai' ? 'Selesai' : 'Diproses' }}</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Modal Upload -->
      <v-dialog v-model="uploadDialog" max-width="560px" persistent>
        <v-card>
          <v-card-title class="green darken-2 white--text">
            <v-icon left color="white">mdi-file-excel</v-icon>
            Upload File Excel Transaksi Manual
          </v-card-title>
          <v-card-text class="pt-4">

            <!-- Alert error validasi DALAM modal -->
            <v-alert
              v-if="uploadErrors.length"
              type="error"
              dense
              border="left"
              class="mb-3"
              dismissible
              @input="uploadErrors = []"
            >
              <div><strong>Upload gagal! Data tidak valid:</strong></div>
              <ul class="mb-0 mt-1">
                <li v-for="(err, i) in uploadErrors" :key="i">{{ err }}</li>
              </ul>
            </v-alert>

            <v-alert type="info" dense border="left" class="mb-3">
              <strong>Format kolom Excel yang wajib ada:</strong><br>
              <code>no_rekening</code>, <code>nama_nasabah</code>, <code>pokok</code>, <code>bunga</code>, <code>denda</code><br>
              <em>Kolom pokok, bunga, denda harus berisi angka tanpa koma.</em>
            </v-alert>

            <v-select
              v-model="selectedKantorId"
              :items="kantorList"
              item-text="label"
              item-value="id"
              label="Pilih Kantor *"
              prepend-icon="mdi-office-building"
              outlined
              dense
              :rules="[(v) => !!v || 'Kantor wajib dipilih.']"
              class="mb-2"
            ></v-select>

            <v-file-input
              v-model="selectedFile"
              label="Pilih File Excel (.xlsx)"
              accept=".xlsx"
              prepend-icon="mdi-file-excel"
              outlined
              dense
              show-size
              :rules="fileRules"
              ref="fileInput"
            ></v-file-input>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="grey" text @click="closeUploadModal">Batal</v-btn>
            <v-btn
              color="green darken-2"
              dark
              :loading="uploading"
              @click="uploadFile"
            >
              <v-icon left>mdi-upload</v-icon> Upload
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>

    </v-container>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    loading: false,
    uploading: false,
    search: "",
    uploadDialog: false,
    selectedFile: null,
    selectedKantorId: null,
    uploadErrors: [],
    isFiltered: false,
    // Filter
    filterTglMulai: "",
    filterTglAkhir: "",
    filterKantorId: "",
    menuTglMulai: false,
    menuTglAkhir: false,
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
    fileRules: [
      (v) => !!v || "File wajib dipilih.",
      (v) => !v || v.name.endsWith(".xlsx") || "Hanya file .xlsx yang diperbolehkan.",
    ],
    headers: [
      { text: "No",       value: "index",      sortable: false, width: "50px" },
      { text: "Nama File",value: "nama_file",  sortable: true  },
      { text: "Tanggal",  value: "tanggal",    sortable: true  },
      { text: "Kantor",   value: "nama_kantor",sortable: true  },
      { text: "Status",   value: "status",     sortable: true, align: "center" },
      { text: "Aksi",     value: "actions",    sortable: false, align: "center", width: "230px" },
    ],
    items: [],
  }),

  created() {
    this.$Progress.start();
    this.initialize();
    this.$Progress.finish();
  },

  methods: {
    initialize() {
      this.loading = true;
      const params = {};
      if (this.filterTglMulai) params.tgl_mulai  = this.filterTglMulai;
      if (this.filterTglAkhir) params.tgl_akhir  = this.filterTglAkhir;
      if (this.filterKantorId) params.kantor_id   = this.filterKantorId;

      axios
        .get("api/transaksi-manual", { params })
        .then((response) => {
          this.items = response.data.data;
        })
        .catch(() => {
          Toast.fire({ icon: "error", title: "Gagal memuat data." });
        })
        .finally(() => {
          this.loading = false;
        });
    },

    handleFilter() {
      this.isFiltered = true;
      this.initialize();
    },

    resetFilter() {
      this.filterTglMulai = "";
      this.filterTglAkhir = "";
      this.filterKantorId = "";
      this.isFiltered = false;
      this.initialize();
    },

    exportPdf() {
      if (!this.isFiltered || !this.items.length) return;
      const originalTitle = document.title;
      const now = new Date();
      const year = now.getFullYear();
      const month = String(now.getMonth() + 1).padStart(2, "0");
      const day = String(now.getDate()).padStart(2, "0");
      const tglStr = `${day}-${month}-${year}`;

      document.title = `Laporan Transaksi Manual Per Tgl ${tglStr}`;
      window.print();

      const restoreTitle = () => {
        document.title = originalTitle;
        window.removeEventListener("afterprint", restoreTitle);
      };
      window.addEventListener("afterprint", restoreTitle);
      setTimeout(restoreTitle, 2000);
    },

    // Download template format Excel dari backend
    downloadTemplate() {
      axios({
        url: "api/transaksi-manual/template",
        method: "GET",
        responseType: "blob",
      })
        .then((response) => {
          const blob = new Blob([response.data], {
            type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
          });
          const link = document.createElement("a");
          link.href = window.URL.createObjectURL(blob);
          link.download = "format_transaksi_manual.xlsx";
          link.click();
          window.URL.revokeObjectURL(link.href);
        })
        .catch(() => {
          Toast.fire({ icon: "error", title: "Gagal mendownload template." });
        });
    },

    openUploadModal() {
      this.selectedFile = null;
      this.selectedKantorId = null;
      this.uploadErrors = [];
      this.uploadDialog = true;
    },

    closeUploadModal() {
      this.selectedFile = null;
      this.selectedKantorId = null;
      this.uploadErrors = [];
      this.uploadDialog = false;
    },

    uploadFile() {
      if (!this.selectedKantorId) {
        Toast.fire({ icon: "warning", title: "Pilih kantor terlebih dahulu." });
        return;
      }
      if (!this.selectedFile) {
        Toast.fire({ icon: "warning", title: "Pilih file Excel terlebih dahulu." });
        return;
      }
      if (!this.selectedFile.name.endsWith(".xlsx")) {
        Toast.fire({ icon: "error", title: "Hanya file format .xlsx yang diperbolehkan!" });
        return;
      }

      const formData = new FormData();
      formData.append("file", this.selectedFile);
      formData.append("kantor_id", this.selectedKantorId);

      this.uploading = true;
      this.uploadErrors = [];

      axios
        .post("api/transaksi-manual", formData, {
          headers: { "Content-Type": "multipart/form-data" },
        })
        .then((response) => {
          this.closeUploadModal();
          Toast.fire({
            icon: "success",
            title: response.data.message || "File berhasil diupload dengan status [Diproses].",
          });
          this.initialize();
        })
        .catch((error) => {
          if (error.response && error.response.status === 422) {
            const data = error.response.data;
            if (data.errors && Array.isArray(data.errors)) {
              this.uploadErrors = data.errors;
            } else if (data.errors && typeof data.errors === "object") {
              this.uploadErrors = Object.values(data.errors).flat();
            } else if (data.message) {
              this.uploadErrors = [data.message];
            } else {
              this.uploadErrors = ["Format data tidak valid. Pastikan kolom pokok, bunga, dan denda hanya berisi angka tanpa koma."];
            }
          } else {
            Toast.fire({ icon: "error", title: "Terjadi kesalahan saat upload." });
          }
        })
        .finally(() => {
          this.uploading = false;
        });
    },

    updateStatus(item) {
      Swal.fire({
        title: "Ubah status menjadi Selesai?",
        text: "File: " + item.nama_file,
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#28a745",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Ya, Selesai!",
        cancelButtonText: "Batal",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .put("api/transaksi-manual/" + item.id + "/status")
            .then((response) => {
              Toast.fire({
                icon: "success",
                title: response.data.message || "Status berhasil diubah menjadi Selesai.",
              });
              this.initialize();
            })
            .catch(() => {
              Toast.fire({ icon: "error", title: "Gagal mengubah status." });
            });
        }
      });
    },

    downloadExcel(item) {
      axios({
        url: "api/transaksi-manual/" + item.id + "/export",
        method: "GET",
        responseType: "blob",
      })
        .then((response) => {
          const blob = new Blob([response.data], {
            type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
          });
          const link = document.createElement("a");
          link.href = window.URL.createObjectURL(blob);
          const now = new Date();
          const tgl = now.toISOString().slice(0, 10).replace(/-/g, "");
          const jam = now.toTimeString().slice(0, 8).replace(/:/g, "");
          link.download = tgl + "_" + jam + "_" + (item.nama_kantor || item.kantor_id) + ".xlsx";
          link.click();
          window.URL.revokeObjectURL(link.href);
        })
        .catch(() => {
          Toast.fire({ icon: "error", title: "Gagal mendownload file." });
        });
    },

    kantorLabelById(id) {
      const k = this.kantorList.find((x) => x.id === id || x.id === Number(id));
      return k ? k.label : id;
    },

    hapusData(id) {
      Swal.fire({
        title: "Yakin ingin menghapus?",
        text: "Data yang dihapus tidak bisa dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Batal",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete("api/transaksi-manual/" + id)
            .then(() => {
              Toast.fire({ icon: "success", title: "Data berhasil dihapus." });
              this.initialize();
            })
            .catch(() => {
              Toast.fire({ icon: "error", title: "Gagal menghapus data." });
            });
        }
      });
    },
  },
};
</script>

<style scoped>
/* Area cetak — tersembunyi di layar */
.print-only {
  display: none;
}

.print-title {
  font-size: 18px;
  font-weight: bold;
  text-transform: uppercase;
  margin-bottom: 4px;
}

.print-subtitle {
  font-size: 13px;
  margin: 2px 0;
  color: #555;
}

.print-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 13px;
  margin-top: 10px;
}

.print-table th,
.print-table td {
  border: 1px solid #333;
  padding: 6px 10px;
}

.print-table th {
  background-color: #2e7d32;
  color: #fff;
  font-weight: bold;
}

/* Mode cetak */
@media print {
  /* Sembunyikan semua elemen UI */
  .main-sidebar,
  .main-header,
  .main-footer,
  .v-app-bar,
  .v-navigation-drawer,
  .v-footer,
  .v-toolbar,
  .v-card:not(.print-only) {
    display: none !important;
  }

  .content-wrapper {
    margin-left: 0 !important;
    padding: 0 !important;
  }

  /* Tampilkan area cetak */
  .print-only {
    display: block !important;
    padding: 20px;
  }

  .print-table th {
    background-color: #2e7d32 !important;
    color: #fff !important;
    -webkit-print-color-adjust: exact;
    print-color-adjust: exact;
  }
}
</style>
