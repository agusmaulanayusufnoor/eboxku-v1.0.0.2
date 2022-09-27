// export default [
//     //{ path: '/dashboard', component: require('./components/Dashboard.vue').default },
//     { path: '/dashboard', component: () => import('./components/Dashboard.vue') },
//     { path: '/profile', component: require('./components/Profile.vue').default },
//     { path: '/developer', component: require('./components/Developer.vue').default },

//     { path: '/users', component: () => import('./components/Users.vue') },

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
    { path: '/dashboard', component: () => import(/* webpackChunkName: "[request]" */'./components/Dashboard.vue') },
    { path: '/profile', component: require('./components/Profile.vue').default },
    { path: '/developer', component: require('./components/Developer.vue').default },

    { path: '/users', component: () => import('./components/Users.vue') },

    { path: '/bakas', component: () => import('./components/pelayanan/Bakas.vue') },
    { path: '/feedback', component: () => import('./components/pelayanan/Feedback.vue') },
    { path: '/tabungan', component: () => import('./components/pelayanan/Tabungan.vue') },
    { path: '/deposito', component: () => import('./components/pelayanan/Deposito.vue') },
    { path: '/teller', component: () => import('./components/pelayanan/Teller.vue') },


    { path: '/kredit', component: () => import('./components/kredit/Kredit.vue') },

    { path: '/kaskecil', component: () => import('./components/akunting/Kaskecil.vue') },
    { path: '/overbooking', component: () => import('./components/akunting/Overbooking.vue') },
    { path: '/rekkoranaba', component: () => import('./components/akunting/Rekkoranaba.vue') },
    { path: '/stock', component: () => import('./components/akunting/Stock.vue') },
    { path: '/stockctk', component: () => import('./components/akunting/Stockctk.vue') },
    { path: '/stockpromosi', component: () => import('./components/akunting/Stockpromosi.vue') },


    { path: '/skdir', component: () => import('./components/umum/Skdir.vue') },
    { path: '/sedir', component: () => import('./components/umum/Sedir.vue') },
    { path: '/akta', component: () => import('./components/umum/Akta.vue') },
    { path: '/legal', component: () => import('./components/umum/Legal.vue') },
    { path: '/sertifikat', component: () => import('./components/umum/Sertifikat.vue') },
    { path: '/pk', component: () => import('./components/umum/Pk.vue') },
    { path: '/pjkbadan', component: () => import('./components/umum/Pjkbadan.vue') },
    { path: '/pjksewa', component:  () => import('./components/umum/Pjksewa.vue') },
    { path: '/pjkpph21', component: () => import('./components/umum/Pjkpph21.vue') },
    { path: '/pjkbunga', component: () => import('./components/umum/Pjkbunga.vue') },
    { path: '/asuransi', component: () => import('./components/umum/Asuransi.vue') },
    { path: '/sop', component: () => import('./components/umum/Sop.vue') },
    { path: '/peraturan', component: () => import('./components/umum/Peraturan.vue') },
    { path: '/lapkap', component: () => import('./components/umum/Lapkap.vue') },
    { path: '/lapkeu', component: () => import('./components/umum/Lapkeu.vue') },

    { path: '/suratmasuk', component: () => import('./components/sekdir/Suratmasuk.vue') },
    { path: '/suratkeluar', component: () => import('./components/sekdir/Suratkeluar.vue') },
    { path: '/notulen', component: () => import('./components/sekdir/Notulen.vue') },
    { path: '/polis', component: () => import('./components/sekdir/Polis.vue') },

    { path: '/monitor', component: () => import('./components/skai/Monitor.vue') },
    { path: '/periksa', component: () => import('./components/skai/Periksa.vue') },

    { path: '/kantor', component: () => import('./components/setting/Kantor.vue') },
    { path: '/satuan', component: () => import('./components/setting/Satuan.vue') },
    { path: '/barang', component: () => import('./components/setting/Barang.vue') },
    { path: '/otorisator', component: () => import('./components/setting/Otorisator.vue') },
    { path: '*', component: () => import('./components/NotFound.vue') }
];
