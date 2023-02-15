// export default [
//     //{ path: '/dashboard', component: require('./components/Dashboard.vue').default },
//     { path: '/dashboard', component: () => import(/* webpackPrefetch: true */'./components/Dashboard.vue') },
//     { path: '/profile', component: require('./components/Profile.vue').default },
//     { path: '/developer', component: require('./components/Developer.vue').default },

//     { path: '/users', component: () => import(/* webpackPrefetch: true */'./components/Users.vue') },

//     { path: '/bakas', component: require('./components/pelayanan/Bakas.vue').default },
//     { path: '/feedback', component: require('./components/pelayanan/Feedback.vue').default },
//     { path: '/tabungan', component: require('./components/pelayanan/Tabungan.vue').default },
//     { path: '/deposito', component: require('./components/pelayanan/Deposito.vue').default },
//     { path: '/teller', component: require('./components/pelayanan/Teller.vue').default },


//     { path: '/kredit', component: require('./components/kredit/Kredit.vue').default },

//     { path: '/kaskecil', component: require('./components/akunting/Kaskecil.vue').default },
//     { path: '/overbooking', component: require('./components/akunting/Overbooking.vue').default },
//     { path: '/rekkoranaba', component: require('./components/akunting/Rekkoranaba.vue').default },
//     { path: '/stock', component: require('./components/akunting/Stock.vue').default },
//     { path: '/stockctk', component: require('./components/akunting/Stockctk.vue').default },
//     { path: '/stockpromosi', component: require('./components/akunting/Stockpromosi.vue').default },


//     { path: '/skdir', component: require('./components/umum/Skdir.vue').default },
//     { path: '/sedir', component: require('./components/umum/Sedir.vue').default },
//     { path: '/akta', component: require('./components/umum/Akta.vue').default },
//     { path: '/legal', component: require('./components/umum/Legal.vue').default },
//     { path: '/sertifikat', component: require('./components/umum/Sertifikat.vue').default },
//     { path: '/pk', component: require('./components/umum/Pk.vue').default },
//     { path: '/pjkbadan', component: require('./components/umum/Pjkbadan.vue').default },
//     { path: '/pjksewa', component: require('./components/umum/Pjksewa.vue').default },
//     { path: '/pjkpph21', component: require('./components/umum/Pjkpph21.vue').default },
//     { path: '/pjkbunga', component: require('./components/umum/Pjkbunga.vue').default },
//     { path: '/asuransi', component: require('./components/umum/Asuransi.vue').default },
//     { path: '/sop', component: require('./components/umum/Sop.vue').default },
//     { path: '/peraturan', component: require('./components/umum/Peraturan.vue').default },
//     { path: '/lapkap', component: require('./components/umum/Lapkap.vue').default },
//     { path: '/lapkeu', component: require('./components/umum/Lapkeu.vue').default },

//     { path: '/suratmasuk', component: require('./components/sekdir/Suratmasuk.vue').default },
//     { path: '/suratkeluar', component: require('./components/sekdir/Suratkeluar.vue').default },
//     { path: '/notulen', component: require('./components/sekdir/Notulen.vue').default },
//     { path: '/polis', component: require('./components/sekdir/Polis.vue').default },

//     { path: '/monitor', component: require('./components/skai/Monitor.vue').default },
//     { path: '/periksa', component: require('./components/skai/Periksa.vue').default },

//     { path: '/kantor', component: require('./components/setting/Kantor.vue').default },
//     { path: '/satuan', component: require('./components/setting/Satuan.vue').default },
//     { path: '/barang', component: require('./components/setting/Barang.vue').default },
//     { path: '/otorisator', component: require('./components/setting/Otorisator.vue').default },
//     { path: '*', component: require('./components/NotFound.vue').default }
// ];

export default [
    //{ path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/dashboard', component: () => import(/* webpackPrefetch: true */'./components/Dashboard.vue') },
    { path: '/profile', component: require('./components/Profile.vue').default },
    { path: '/developer', component: require('./components/Developer.vue').default },

    { path: '/users', component: () => import(/* webpackPrefetch: true */'./components/Users.vue') },

    { path: '/bakas', component: () => import(/* webpackPrefetch: true */'./components/pelayanan/Bakas.vue') },
    { path: '/feedback', component: () => import(/* webpackPrefetch: true */'./components/pelayanan/Feedback.vue') },
    { path: '/tabungan', component: () => import(/* webpackPrefetch: true */'./components/pelayanan/Tabungan.vue') },
    { path: '/deposito', component: () => import(/* webpackPrefetch: true */'./components/pelayanan/Deposito.vue') },
    { path: '/teller', component: () => import(/* webpackPrefetch: true */'./components/pelayanan/Teller.vue') },
    { path: '/cs', component: () => import(/* webpackPrefetch: true */'./components/pelayanan/Cs.vue') },


    { path: '/kredit', component: () => import(/* webpackPrefetch: true */'./components/kredit/Kredit.vue') },
    { path: '/pelunasan', component: () => import(/* webpackPrefetch: true */'./components/kredit/Pelunasan.vue') },

    { path: '/kaskecil', component: () => import(/* webpackPrefetch: true */'./components/akunting/Kaskecil.vue') },
    { path: '/overbooking', component: () => import(/* webpackPrefetch: true */'./components/akunting/Overbooking.vue') },
    { path: '/rekkoranaba', component: () => import(/* webpackPrefetch: true */'./components/akunting/Rekkoranaba.vue') },
    { path: '/stock', component: () => import(/* webpackPrefetch: true */'./components/akunting/Stock.vue') },
    { path: '/stockctk', component: () => import(/* webpackPrefetch: true */'./components/akunting/Stockctk.vue') },
    { path: '/jtakuntingpusat', component: () => import(/* webpackPrefetch: true */'./components/akunting/Jtakuntingpusat.vue') },
    { path: '/jtpelayananpusat', component: () => import(/* webpackPrefetch: true */'./components/akunting/Jtpelayananpusat.vue') },


    { path: '/skdir', component: () => import(/* webpackPrefetch: true */'./components/umum/Skdir.vue') },
    { path: '/sedir', component: () => import(/* webpackPrefetch: true */'./components/umum/Sedir.vue') },
    { path: '/akta', component: () => import(/* webpackPrefetch: true */'./components/umum/Akta.vue') },
    { path: '/legal', component: () => import(/* webpackPrefetch: true */'./components/umum/Legal.vue') },
    { path: '/sertifikat', component: () => import(/* webpackPrefetch: true */'./components/umum/Sertifikat.vue') },
    { path: '/pk', component: () => import(/* webpackPrefetch: true */'./components/umum/Pk.vue') },
    { path: '/pjkpph4ayat2', component: () => import(/* webpackPrefetch: true */'./components/umum/Pjkpph4ayat2.vue') },
    { path: '/pjkpph21', component: () => import(/* webpackPrefetch: true */'./components/umum/Pjkpph21.vue') },
    { path: '/pjkpph23', component: () => import(/* webpackPrefetch: true */'./components/umum/Pjkpph23.vue') },
    { path: '/pjkpph25', component: () => import(/* webpackPrefetch: true */'./components/umum/Pjkpph25.vue') },
    { path: '/pjkbadan', component: () => import(/* webpackPrefetch: true */'./components/umum/Pjkbadan.vue') },
    { path: '/pjksewa', component:  () => import(/* webpackPrefetch: true */'./components/umum/Pjksewa.vue') },
    { path: '/pjkbunga', component: () => import(/* webpackPrefetch: true */'./components/umum/Pjkbunga.vue') },
    { path: '/asuransi', component: () => import(/* webpackPrefetch: true */'./components/umum/Asuransi.vue') },
    { path: '/sop', component: () => import(/* webpackPrefetch: true */'./components/umum/Sop.vue') },
    { path: '/peraturan', component: () => import(/* webpackPrefetch: true */'./components/umum/Peraturan.vue') },
    { path: '/lapkap', component: () => import(/* webpackPrefetch: true */'./components/umum/Lapkap.vue') },
    { path: '/lapkeu', component: () => import(/* webpackPrefetch: true */'./components/umum/Lapkeu.vue') },

    { path: '/suratmasuk', component: () => import(/* webpackPrefetch: true */'./components/sekdir/Suratmasuk.vue') },
    { path: '/suratkeluar', component: () => import(/* webpackPrefetch: true */'./components/sekdir/Suratkeluar.vue') },
    { path: '/notulen', component: () => import(/* webpackPrefetch: true */'./components/sekdir/Notulen.vue') },
    { path: '/polis', component: () => import(/* webpackPrefetch: true */'./components/sekdir/Polis.vue') },

    { path: '/monitor', component: () => import(/* webpackPrefetch: true */'./components/skai/Monitor.vue') },
    { path: '/periksa', component: () => import(/* webpackPrefetch: true */'./components/skai/Periksa.vue') },

    { path: '/kantor', component: () => import(/* webpackPrefetch: true */'./components/setting/Kantor.vue') },
    { path: '/mastersimpanan', component: () => import(/* webpackPrefetch: true */'./components/setting/Mastersimpanan.vue') },
    { path: '/satuan', component: () => import(/* webpackPrefetch: true */'./components/setting/Satuan.vue') },
    { path: '/barang', component: () => import(/* webpackPrefetch: true */'./components/setting/Barang.vue') },
    { path: '/otorisator', component: () => import(/* webpackPrefetch: true */'./components/setting/Otorisator.vue') },
    { path: '/jabatan', component: () => import(/* webpackPrefetch: true */'./components/setting/Jabatan.vue') },
    { path: '/pendidikan', component: () => import(/* webpackPrefetch: true */'./components/setting/Pendidikan.vue') },
    { path: '/statuspegawai', component: () => import(/* webpackPrefetch: true */'./components/setting/Statuspegawai.vue') },
    { path: '/statuspajak', component: () => import(/* webpackPrefetch: true */'./components/setting/Statuspajak.vue') },
    { path: '*', component: () => import(/* webpackPrefetch: true */'./components/NotFound.vue') }
];

// export default [
//     //{ path: '/dashboard', component: require('./components/Dashboard.vue').default },
//     { path: '/dashboard', component: () => import(/* webpackChunkName: "[request]" */'./components/Dashboard.vue') },
//     { path: '/profile', component: require('./components/Profile.vue').default },
//     { path: '/developer', component: require('./components/Developer.vue').default },

//     { path: '/users', component: () => import(/* webpackChunkName: "[request]" */'./components/Users.vue') },

//     { path: '/bakas', component: () => import(/* webpackChunkName: "[request]" */'./components/pelayanan/Bakas.vue') },
//     { path: '/feedback', component: () => import(/* webpackChunkName: "[request]" */'./components/pelayanan/Feedback.vue') },
//     { path: '/tabungan', component: () => import(/* webpackChunkName: "[request]" */'./components/pelayanan/Tabungan.vue') },
//     { path: '/deposito', component: () => import(/* webpackChunkName: "[request]" */'./components/pelayanan/Deposito.vue') },
//     { path: '/teller', component: () => import(/* webpackChunkName: "[request]" */'./components/pelayanan/Teller.vue') },


//     { path: '/kredit', component: () => import(/* webpackChunkName: "[request]" */'./components/kredit/Kredit.vue') },

//     { path: '/kaskecil', component: () => import(/* webpackChunkName: "[request]" */'./components/akunting/Kaskecil.vue') },
//     { path: '/overbooking', component: () => import(/* webpackChunkName: "[request]" */'./components/akunting/Overbooking.vue') },
//     { path: '/rekkoranaba', component: () => import(/* webpackChunkName: "[request]" */'./components/akunting/Rekkoranaba.vue') },
//     { path: '/stock', component: () => import(/* webpackChunkName: "[request]" */'./components/akunting/Stock.vue') },
//     { path: '/stockctk', component: () => import(/* webpackChunkName: "[request]" */'./components/akunting/Stockctk.vue') },
//     { path: '/stockpromosi', component: () => import(/* webpackChunkName: "[request]" */'./components/akunting/Stockpromosi.vue') },


//     { path: '/skdir', component: () => import(/* webpackChunkName: "[request]" */'./components/umum/Skdir.vue') },
//     { path: '/sedir', component: () => import(/* webpackChunkName: "[request]" */'./components/umum/Sedir.vue') },
//     { path: '/akta', component: () => import(/* webpackChunkName: "[request]" */'./components/umum/Akta.vue') },
//     { path: '/legal', component: () => import(/* webpackChunkName: "[request]" */'./components/umum/Legal.vue') },
//     { path: '/sertifikat', component: () => import(/* webpackChunkName: "[request]" */'./components/umum/Sertifikat.vue') },
//     { path: '/pk', component: () => import(/* webpackChunkName: "[request]" */'./components/umum/Pk.vue') },
//     { path: '/pjkbadan', component: () => import(/* webpackChunkName: "[request]" */'./components/umum/Pjkbadan.vue') },
//     { path: '/pjksewa', component:  () => import(/* webpackChunkName: "[request]" */'./components/umum/Pjksewa.vue') },
//     { path: '/pjkpph21', component: () => import(/* webpackChunkName: "[request]" */'./components/umum/Pjkpph21.vue') },
//     { path: '/pjkbunga', component: () => import(/* webpackChunkName: "[request]" */'./components/umum/Pjkbunga.vue') },
//     { path: '/asuransi', component: () => import(/* webpackChunkName: "[request]" */'./components/umum/Asuransi.vue') },
//     { path: '/sop', component: () => import(/* webpackChunkName: "[request]" */'./components/umum/Sop.vue') },
//     { path: '/peraturan', component: () => import(/* webpackChunkName: "[request]" */'./components/umum/Peraturan.vue') },
//     { path: '/lapkap', component: () => import(/* webpackChunkName: "[request]" */'./components/umum/Lapkap.vue') },
//     { path: '/lapkeu', component: () => import(/* webpackChunkName: "[request]" */'./components/umum/Lapkeu.vue') },

//     { path: '/suratmasuk', component: () => import(/* webpackChunkName: "[request]" */'./components/sekdir/Suratmasuk.vue') },
//     { path: '/suratkeluar', component: () => import(/* webpackChunkName: "[request]" */'./components/sekdir/Suratkeluar.vue') },
//     { path: '/notulen', component: () => import(/* webpackChunkName: "[request]" */'./components/sekdir/Notulen.vue') },
//     { path: '/polis', component: () => import(/* webpackChunkName: "[request]" */'./components/sekdir/Polis.vue') },

//     { path: '/monitor', component: () => import(/* webpackChunkName: "[request]" */'./components/skai/Monitor.vue') },
//     { path: '/periksa', component: () => import(/* webpackChunkName: "[request]" */'./components/skai/Periksa.vue') },

//     { path: '/kantor', component: () => import(/* webpackChunkName: "[request]" */'./components/setting/Kantor.vue') },
//     { path: '/satuan', component: () => import(/* webpackChunkName: "[request]" */'./components/setting/Satuan.vue') },
//     { path: '/barang', component: () => import(/* webpackChunkName: "[request]" */'./components/setting/Barang.vue') },
//     { path: '/otorisator', component: () => import(/* webpackChunkName: "[request]" */'./components/setting/Otorisator.vue') },
//     { path: '/jabatan', component: () => import(/* webpackChunkName: "[request]" */'./components/setting/Jabatan.vue') },
//     { path: '/pendidikan', component: () => import(/* webpackChunkName: "[request]" */'./components/setting/Pendidikan.vue') },
//     { path: '/statuspegawai', component: () => import(/* webpackChunkName: "[request]" */'./components/setting/Statuspegawai.vue') },
//     { path: '/statuspajak', component: () => import(/* webpackChunkName: "[request]" */'./components/setting/Statuspajak.vue') },
//     { path: '*', component: () => import(/* webpackChunkName: "[request]" */'./components/NotFound.vue') }
// ];

