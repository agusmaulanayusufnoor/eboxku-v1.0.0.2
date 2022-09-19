export default [
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/profile', component: require('./components/Profile.vue').default },
    { path: '/developer', component: require('./components/Developer.vue').default },

    { path: '/users', component: require('./components/Users.vue').default },

    { path: '/bakas', component: require('./components/pelayanan/Bakas.vue').default },
    { path: '/tabungan', component: require('./components/pelayanan/Tabungan.vue').default },
    { path: '/deposito', component: require('./components/pelayanan/Deposito.vue').default },
    { path: '/teller', component: require('./components/pelayanan/Teller.vue').default },


    { path: '/kredit', component: require('./components/kredit/Kredit.vue').default },

    { path: '/kaskecil', component: require('./components/akunting/Kaskecil.vue').default },
    { path: '/overbooking', component: require('./components/akunting/Overbooking.vue').default },
    { path: '/rekkoranaba', component: require('./components/akunting/Rekkoranaba.vue').default },
    { path: '/stock', component: require('./components/akunting/Stock.vue').default },
    { path: '/stockctk', component: require('./components/akunting/Stockctk.vue').default },
    { path: '/stockpromosi', component: require('./components/akunting/Stockpromosi.vue').default },


    { path: '/skdir', component: require('./components/umum/Skdir.vue').default },
    { path: '/sedir', component: require('./components/umum/Sedir.vue').default },
    { path: '/akta', component: require('./components/umum/Akta.vue').default },
    { path: '/legal', component: require('./components/umum/Legal.vue').default },
    { path: '/sertifikat', component: require('./components/umum/Sertifikat.vue').default },
    { path: '/pk', component: require('./components/umum/Pk.vue').default },
    { path: '/pjkbadan', component: require('./components/umum/Pjkbadan.vue').default },
    { path: '/pjksewa', component: require('./components/umum/Pjksewa.vue').default },
    { path: '/pjkpph21', component: require('./components/umum/Pjkpph21.vue').default },
    { path: '/pjkbunga', component: require('./components/umum/Pjkbunga.vue').default },
    { path: '/asuransi', component: require('./components/umum/Asuransi.vue').default },
    { path: '/sop', component: require('./components/umum/Sop.vue').default },
    { path: '/peraturan', component: require('./components/umum/Peraturan.vue').default },
    { path: '/lapkap', component: require('./components/umum/Lapkap.vue').default },
    { path: '/lapkeu', component: require('./components/umum/Lapkeu.vue').default },

    { path: '/suratmasuk', component: require('./components/sekdir/Suratmasuk.vue').default },
    { path: '/suratkeluar', component: require('./components/sekdir/Suratkeluar.vue').default },
    { path: '/notulen', component: require('./components/sekdir/Notulen.vue').default },
    { path: '/polis', component: require('./components/sekdir/Polis.vue').default },

    { path: '/monitor', component: require('./components/skai/Monitor.vue').default },
    { path: '/periksa', component: require('./components/skai/Periksa.vue').default },

    { path: '/kantor', component: require('./components/setting/Kantor.vue').default },
    { path: '/satuan', component: require('./components/setting/Satuan.vue').default },
    { path: '/barang', component: require('./components/setting/Barang.vue').default },
    { path: '/otorisator', component: require('./components/setting/Otorisator.vue').default },
    { path: '*', component: require('./components/NotFound.vue').default }
];
