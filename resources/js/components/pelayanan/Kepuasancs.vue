<template>
  <v-app style="background: #f1f5f9;">
    <v-container fluid class="fill-height justify-center align-center py-6">
      <v-row justify="center" align="center" class="w-100" style="max-width: 900px;">
        <v-col cols="12">
          <v-card
            v-if="$gate.isCs() || $gate.isTeller()"
            class="pa-6 mx-auto elevation-8 text-center"
            style="border-radius: 24px; background: #ffffff;"
          >
            <!-- LOGO / HEADER BANNER -->
            <div class="mb-4">
              <v-icon color="primary" style="font-size: 50px;">mdi-emoticon-happy-outline</v-icon>
              <h2 class="font-weight-bold primary--text mt-2 mb-1" style="font-size: 1.8rem;">
                PT BPR JABAR PERSERODA
              </h2>
              <h4 class="grey--text text--darken-2 font-weight-medium">
                Survei Kepuasan Pelayanan Nasabah
              </h4>
            </div>

            <v-divider class="my-4"></v-divider>

            <div class="py-4">
              <h3 class="font-weight-bold grey--text text--darken-3 mb-2" style="font-size: 1.4rem;">
                Bagaimana Pengalaman Pelayanan Anda Hari Ini?
              </h3>
              <p class="body-1 text-muted mb-8">
                Silakan sentuh / klik salah satu ikon di bawah ini untuk memberikan masukan Anda.
              </p>

              <!-- TOMBOL LIKE & DISLIKE (PUAS & TIDAK PUAS) -->
              <v-row justify="center" class="my-6">
                <v-col cols="12" sm="6" md="5" class="pa-3">
                  <v-card
                    hover
                    ripple
                    class="pa-6 text-center kiosk-btn btn-puas elevation-6"
                    style="border-radius: 20px; cursor: pointer; background: linear-gradient(135deg, #2e7d32, #4caf50);"
                    @click="submitVote('puas')"
                  >
                    <v-icon style="font-size: 80px; color: white;" class="mb-3 bounce-icon">
                      mdi-thumb-up
                    </v-icon>
                    <div class="text-h4 font-weight-black white--text">
                      PUAS
                    </div>
                  </v-card>
                </v-col>

                <v-col cols="12" sm="6" md="5" class="pa-3">
                  <v-card
                    hover
                    ripple
                    class="pa-6 text-center kiosk-btn btn-tidak-puas elevation-6"
                    style="border-radius: 20px; cursor: pointer; background: linear-gradient(135deg, #c62828, #ef5350);"
                    @click="submitVote('tidak_puas')"
                  >
                    <v-icon style="font-size: 80px; color: white;" class="mb-3 bounce-icon">
                      mdi-thumb-down
                    </v-icon>
                    <div class="text-h4 font-weight-black white--text">
                      TIDAK PUAS
                    </div>
                  </v-card>
                </v-col>
              </v-row>

              <p class="caption text-muted mt-6 mb-0">
                Terima kasih atas partisipasi Anda dalam membantu kami meningkatkan kualitas pelayanan.
              </p>
            </div>
          </v-card>

          <div v-else>
            <not-found></not-found>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    loadingVote: false,
  }),



  methods: {
    submitVote(voteType) {
      if (this.loadingVote) return;
      this.loadingVote = true;

      axios
        .post("api/kepuasancs/vote", { vote: voteType })
        .then((response) => {
          Swal.fire({
            title: voteType === "puas" ? "Terima Kasih! 👍" : "Terima Kasih atas Masukan Anda 🙏",
            text: "Penilaian Anda telah berhasil dicatat.",
            icon: voteType === "puas" ? "success" : "info",
            timer: 2000,
            showConfirmButton: false,
          });
        })
        .catch((err) => {
          Toast.fire({
            icon: "error",
            title: "Gagal mencatat respon kepuasan",
          });
        })
        .finally(() => {
          this.loadingVote = false;
        });
    },
  },
};
</script>

<style scoped>
.kiosk-btn {
  transition: transform 0.25s ease, box-shadow 0.25s ease;
  user-select: none;
}
.kiosk-btn:active {
  transform: scale(0.95) !important;
}
.kiosk-btn:hover {
  transform: translateY(-6px);
  box-shadow: 0 12px 28px rgba(0, 0, 0, 0.25) !important;
}
.bounce-icon {
  transition: transform 0.3s ease;
}
.kiosk-btn:hover .bounce-icon {
  transform: scale(1.15);
}
</style>
