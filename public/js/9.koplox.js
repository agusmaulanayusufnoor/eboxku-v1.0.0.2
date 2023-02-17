(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[9],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/akunting/Stockpromosi.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/akunting/Stockpromosi.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var moment__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! moment */ "./node_modules/moment/moment.js");
/* harmony import */ var moment__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(moment__WEBPACK_IMPORTED_MODULE_0__);
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data(vm) {
    var _editedItem;

    return {
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      editmode: false,
      dialog: false,
      dialogDelete: false,
      periodeTgl: '',
      filterFormTgl: '',
      date: new Date().toISOString().substr(0, 7),
      search: '',
      stock: [],
      valid: true,
      editedIndex: -1,
      editedItem: (_editedItem = {
        id: '',
        kantor_id: '',
        keterangan: '',
        //periode: vm.formatDate((new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)),
        periode: '',
        periodeRules: [function (v) {
          return !!v || 'Bulan periode belum diisi';
        }],
        harga_satuan: '',
        hargaSatuanRules: [function (v) {
          return !!v || 'Harga Satuan belum diisi';
        }],
        stok_awal: 0,
        stokAwalRules: [function (v) {
          return !!v || 'harus diisi angka';
        }, function (v) {
          return v > -1 || 'angka tidak boleh minus';
        }],
        stok_masuk: 0,
        stokMasukRules: [function (v) {
          return !!v || 'harus diisi angka';
        }, function (v) {
          return v > -1 || 'angka tidak boleh minus';
        }],
        stok_keluar: 0,
        stokKeluarRules: [function (v) {
          return !!v || 'harus diisi angka';
        }, function (v) {
          return v > -1 || 'angka tidak boleh minus';
        }],
        stok_akhir: 0,
        nom_awal: 0,
        nomAwalRules: [function (v) {
          return v > -1 || 'angka tidak boleh minus';
        }],
        nom_masuk: 0,
        nomMasukRules: [function (v) {
          return v > -1 || 'angka tidak boleh minus';
        }],
        nom_keluar: 0,
        nomKeluarRules: [function (v) {
          return v > -1 || 'angka tidak boleh minus';
        }]
      }, _defineProperty(_editedItem, "stok_akhir", ''), _defineProperty(_editedItem, "nom_akhir", ''), _defineProperty(_editedItem, "barang_id", ''), _defineProperty(_editedItem, "namaBarang", []), _defineProperty(_editedItem, "satuan_id", ''), _defineProperty(_editedItem, "namaSatuan", []), _defineProperty(_editedItem, "id_kantor", ''), _defineProperty(_editedItem, "namaKantor", []), _editedItem),
      menu1: false,
      menu2: false,
      menu3: false,
      pesaneror: '',
      form: new Form({
        id: '',
        kantor_id: '',
        barang_id: '',
        satuan_id: '',
        periode: '',
        harga_satuan: '',
        stok_awal: '',
        stok_masuk: '',
        stok_keluar: '',
        stok_akhir: '',
        nom_awal: '',
        nom_masuk: '',
        nom_keluar: '',
        nom_akhir: '',
        keterangan: ''
      }),
      columnsExcel: [{
        label: 'Kode Kantor',
        field: 'kode_kantor',
        align: 'start'
      }, {
        label: 'Kantor',
        field: 'nama_kantor'
      }, {
        label: 'Periode',
        field: 'periode'
      }, {
        label: 'NAMA BARANG',
        field: 'namabarang'
      }, {
        label: 'SATUAN',
        field: 'namasatuan'
      }, {
        label: 'HARGA SATUAN',
        field: 'harga_satuan'
      }, {
        label: 'STOK AWAL',
        field: 'stok_awal'
      }, {
        label: 'STOK MASUK',
        field: 'stok_masuk'
      }, {
        label: 'STOK KELUAR',
        field: 'stok_keluar'
      }, {
        label: 'STOK AKHIR',
        field: 'stok_akhir'
      }, {
        label: 'NOMINAL AWAL',
        field: 'nom_awal'
      }, {
        label: 'NOMINAL MASUK',
        field: 'nom_masuk'
      }, {
        label: 'NOMINAL KELUAR',
        field: 'nom_keluar'
      }, {
        label: 'NOMINAL AKHIR',
        field: 'nom_akhir'
      }, {
        label: 'KETERANGAN',
        field: 'keterangan'
      }],
      json_meta: [[{
        " key ": " charset ",
        " value ": " utf- 8 "
      }]]
    };
  },
  computed: {
    headers: function headers() {
      var headers = [{
        text: 'No',
        value: 'index',
        align: 'center',
        sortable: false
      }, {
        text: 'Kantor',
        value: 'nama_kantor',
        align: 'start'
      }, {
        text: 'Periode',
        value: 'periode'
      }, {
        text: 'Nama Barang',
        value: 'namabarang'
      }, {
        text: 'Satuan',
        value: 'namasatuan'
      }, {
        text: 'Harga Satuan',
        value: 'harga_satuan'
      }, {
        text: 'Stok Awal',
        value: 'stok_awal',
        align: 'center'
      }, {
        text: 'Stok Masuk',
        value: 'stok_masuk',
        align: 'center'
      }, {
        text: 'Stok Keluar',
        value: 'stok_keluar',
        align: 'center'
      }, {
        text: 'Stok Akhir',
        value: 'stok_akhir',
        align: 'center'
      }, {
        text: 'Nominal Awal',
        value: 'nom_awal',
        align: 'center'
      }, {
        text: 'Nominal Masuk',
        value: 'nom_masuk',
        align: 'center'
      }, {
        text: 'Nominal Keluar',
        value: 'nom_keluar',
        align: 'center'
      }, {
        text: 'Nominal Akhir',
        value: 'nom_akhir',
        align: 'center'
      }, {
        text: 'Ket.',
        value: 'keterangan',
        align: 'center'
      }]; // headers.push({ text: 'Edit', value: 'edit', sortable: false,align: 'center' })

      headers.push({
        text: 'Hapus',
        value: 'actions',
        sortable: false,
        align: 'center'
      }); // if(this.$gate.isAdmin()){
      //     headers.push({ text: 'Edit', value: 'edit', sortable: false,align: 'center' })
      //     headers.push({ text: 'Hapus', value: 'actions', sortable: false, align: 'center' })
      // }

      return headers;
    },
    periodeTglText: function periodeTglText() {
      return this.periodeTgl ? moment__WEBPACK_IMPORTED_MODULE_0___default()(this.periodeTgl).format('MMMM YYYY') : '';
    },
    periodeMomentJS: function periodeMomentJS() {
      return this.date ? moment__WEBPACK_IMPORTED_MODULE_0___default()(this.date).format('MMMM YYYY') : '';
    },
    computedDateFormatted: function computedDateFormatted() {
      return this.formatDate(this.editedItem.date);
    },
    formTitle: function formTitle() {
      return this.editedIndex === -1 ? 'New Item' : 'Edit Item';
    }
  },
  watch: {
    date: function date(val) {
      this.editedItem.periode = moment__WEBPACK_IMPORTED_MODULE_0___default()(this.date).format('MMMM YYYY');
    },
    dialog: function dialog(val) {
      val || this.close();
    },
    dialogDelete: function dialogDelete(val) {
      val || this.closeDelete();
    }
  },
  //     beforeCreate: function() {
  //     console.log(this.$kantor_id)
  //   },
  created: function created() {
    this.$Progress.start();
    this.initialize();
    this.$Progress.finish();
  },
  methods: {
    pencetKeyboard: function pencetKeyboard(evt) {
      evt = evt ? evt : window.event;
      var charCode = evt.which ? evt.which : evt.keyCode; //nomer wungkul

      if (charCode > 31 && (charCode < 48 || charCode > 57) && (charCode < 95 || charCode > 105) && charCode !== 46) {
        //tidak boleh tombol '/' dan '\'
        //if (charCode === 191 || charCode===220) {
        evt.preventDefault();
        ;
      } else {
        return true;
      }
    },
    inputStokAwal: function inputStokAwal() {
      this.editedItem.stok_akhir = parseInt(this.editedItem.stok_awal);
    },
    inputStokMasuk: function inputStokMasuk() {
      this.editedItem.stok_akhir = parseInt(this.editedItem.stok_awal) + parseInt(this.editedItem.stok_masuk);
    },
    inputStokAkhir: function inputStokAkhir() {
      this.editedItem.stok_akhir = parseInt(this.editedItem.stok_awal) + parseInt(this.editedItem.stok_masuk) - parseInt(this.editedItem.stok_keluar);
    },
    inputNominalAwal: function inputNominalAwal() {
      this.editedItem.nom_akhir = parseInt(this.editedItem.nom_awal);
    },
    inputNominalMasuk: function inputNominalMasuk() {
      this.editedItem.nom_akhir = parseInt(this.editedItem.nom_awal) + parseInt(this.editedItem.nom_masuk);
    },
    inputNominalAkhir: function inputNominalAkhir() {
      this.editedItem.nom_akhir = parseInt(this.editedItem.nom_awal) + parseInt(this.editedItem.nom_masuk) - parseInt(this.editedItem.nom_keluar);
    },
    formatDate: function formatDate(date) {
      if (!date) return null;

      var _date$split = date.split('-'),
          _date$split2 = _slicedToArray(_date$split, 2),
          year = _date$split2[0],
          month = _date$split2[1];

      return "".concat(month, "/").concat(year);
    },
    parseDate: function parseDate(date) {
      if (!date) return null;

      var _date$split3 = date.split('/'),
          _date$split4 = _slicedToArray(_date$split3, 3),
          day = _date$split4[0],
          month = _date$split4[1],
          year = _date$split4[2];

      return "".concat(year, "-").concat(month.padStart(2, '0'), "-").concat(day.padStart(2, '0'));
    },
    formatDateFilter: function formatDateFilter(date) {
      if (!date) return null;

      var _date$split5 = date.split('-'),
          _date$split6 = _slicedToArray(_date$split5, 3),
          year = _date$split6[0],
          month = _date$split6[1],
          day = _date$split6[2];

      return "".concat(day, "/").concat(month, "/").concat(year, " ~ ").concat(day, "/").concat(month, "/").concat(year);
    },
    filterKantor: function filterKantor() {
      var _this = this;

      this.$Progress.start();
      var formData = new FormData();
      formData.set('kantor_id', this.editedItem.id_kantor);

      if (this.editedItem.id_kantor != '') {
        if (this.$gate.isAdmin() || this.$gate.isAK()) {
          axios.get("api/stockpromosi/filterkantor", {
            params: {
              kantor_id: this.editedItem.id_kantor
            }
          }).then(function (response) {
            _this.stock = response.data.data;
            _this.editedItem.kantor_id = _this.$kantor_id; // this.form.fill
            //console.log(this.stock);
            //console.log(this.kantor_id)
          })["catch"](function (error) {
            console.log(error.response.data);
          });
        }
      } else {
        //Swal.fire("Gagal Filter", "Filter Tanggal Belum Dipilih...!", "warning");
        Swal.fire({
          icon: 'error',
          title: 'Error Filter',
          text: 'Filter Kantor Belum Dipilih...! ',
          width: 600,
          padding: '3em',
          color: '#ff0000',
          background: '#ff0000 url(/images/kayu.jpg)',
          backdrop: "\n            rgba(255,0,64,0.4)\n            url(\"/images/nyan-cat.gif\")\n            left top\n            no-repeat\n          "
        });
      }

      this.$Progress.finish();
    },
    filterBarang: function filterBarang() {
      var _this2 = this;

      this.$Progress.start();
      var formData = new FormData();
      formData.set('barang_id', this.editedItem.barang_id);

      if (this.editedItem.barang_id != '') {
        if (this.$gate.isAdmin() || this.$gate.isAK()) {
          axios.get("api/stockpromosi/filterbarang", {
            params: {
              barang_id: this.editedItem.barang_id
            }
          }).then(function (response) {
            _this2.stock = response.data.data;
            _this2.editedItem.kantor_id = _this2.$kantor_id; // this.form.fill
            //console.log(this.stock);
            //console.log(this.kantor_id)
          })["catch"](function (error) {
            console.log(error.response.data);
          });
        }
      } else {
        //Swal.fire("Gagal Filter", "Filter Tanggal Belum Dipilih...!", "warning");
        Swal.fire({
          icon: 'error',
          title: 'Error Filter',
          text: 'Filter Tanggal Belum Dipilih...! ',
          width: 600,
          padding: '3em',
          color: '#ff0000',
          background: '#ff0000 url(/images/kayu.jpg)',
          backdrop: "\n            rgba(255,0,64,0.4)\n            url(\"/images/nyan-cat.gif\")\n            left top\n            no-repeat\n          "
        });
      }

      this.$Progress.finish();
    },
    filterTanggal: function filterTanggal() {
      var _this3 = this;

      this.$Progress.start();
      var formData = new FormData();
      formData.set('periodetgl', this.periodeTglText);

      if (this.periodeTglText != '') {
        if (this.$gate.isAdmin() || this.$gate.isAK()) {
          axios.get("api/stockpromosi/filtertanggal", {
            params: {
              periodetgl: this.periodeTglText
            }
          }).then(function (response) {
            _this3.stock = response.data.data;
            _this3.editedItem.kantor_id = _this3.$kantor_id; // this.form.fill
            //console.log(this.stock);
            //console.log(this.kantor_id)
          })["catch"](function (error) {
            console.log(error.response.data);
          });
        }
      } else {
        //Swal.fire("Gagal Filter", "Filter Tanggal Belum Dipilih...!", "warning");
        Swal.fire({
          icon: 'error',
          title: 'Error Filter',
          text: 'Filter Tanggal Belum Dipilih...! ',
          width: 600,
          padding: '3em',
          color: '#ff0000',
          background: '#ff0000 url(/images/kayu.jpg)',
          backdrop: "\n            rgba(255,0,64,0.4)\n            url(\"/images/nyan-cat.gif\")\n            left top\n            no-repeat\n          "
        });
      }

      this.$Progress.finish();
    },
    getBarang: function getBarang() {
      var _this4 = this;

      if (this.$gate.isAdmin() || this.$gate.isAK()) {
        //axios.get("api/user").then((response) => {(this.users = response.data.data)});
        axios.get("api/stockpromosi/getbarang").then(function (response) {
          _this4.editedItem.namaBarang = response.data.data; //console.log(this.editedItem.namaBarang);
          //console.log(this.kantor_id)
        })["catch"](function (error) {
          console.log(error.response.data);
        });
      }
    },
    getKantor: function getKantor() {
      var _this5 = this;

      if (this.$gate.isAdmin() || this.$gate.isAK()) {
        //axios.get("api/user").then((response) => {(this.users = response.data.data)});
        axios.get("api/stockpromosi/getkantor").then(function (response) {
          _this5.editedItem.namaKantor = response.data.data; //console.log(this.editedItem.namaKantor);
          //console.log(this.kantor_id)
        })["catch"](function (error) {
          console.log(error.response.data);
        });
      }
    },
    getSatuan: function getSatuan() {
      var _this6 = this;

      if (this.$gate.isAdmin() || this.$gate.isAK()) {
        //axios.get("api/user").then((response) => {(this.users = response.data.data)});
        axios.get("api/stockpromosi/getsatuan").then(function (response) {
          _this6.editedItem.namaSatuan = response.data.data; //console.log(this.editedItem.namaBarang);
          //console.log(this.kantor_id)
        })["catch"](function (error) {
          console.log(error.response.data);
        });
      }
    },
    initialize: function initialize() {
      var _this7 = this;

      this.$Progress.start();

      if (this.$gate.isAdmin() || this.$gate.isAK()) {
        //axios.get("api/user").then((response) => {(this.users = response.data.data)});
        axios.get("api/stockpromosi").then(function (response) {
          _this7.stock = response.data.data;
          _this7.editedItem.kantor_id = _this7.$kantor_id; // this.form.fill

          console.log(_this7.stock); //console.log(this.kantor_id)
        })["catch"](function (error) {
          console.log(error.response.data);
        });
      }

      this.$refs.CBKantor.reset();
      this.$refs.CBBarang.reset();
      this.$refs.tfPeriode.reset();
      this.$Progress.finish();
    },
    editModal: function editModal(item) {
      this.editmode = true; //this.$refs.form.reset()

      $('#addNew').modal('show');
      this.editedIndex = this.stock.indexOf(item); // this.editedItem = Object.assign({}, item)

      this.editedItem.kantor_id = this.$kantor_id;
      this.editedItem.tanggal = item.tanggal; //this.editedItem.dateFormatted      = this.formatDate(this.tanggal);

      this.editedItem.id = item.id;
      this.editedItem.jenis = item.jenis;
      this.editedItem.jml_stok_awal = item.jml_stok_awal;
      this.editedItem.tambahan_stok = item.tambahan_stok;
      this.editedItem.jml_digunakan = item.jml_digunakan;
      this.editedItem.jml_rusak = item.jml_rusak;
      this.editedItem.jml_hilang = item.jml_hilang;
      this.editedItem.jml_stok_akhir = item.jml_stok_akhir; //  console.log(item.id);

      console.log(this.$kantor_id);
    },
    newModal: function newModal() {
      this.editmode = false;
      $('#addNew').modal('show');
      this.$refs.form.reset(); //this.namafile = '';
    },
    createUser: function createUser() {
      var _this8 = this;

      this.$refs.form.validate();
      this.$Progress.start(); // e.preventDefault();

      var config = {
        headers: {
          'content-type': 'multipart/form-data'
        }
      };

      if (this.$gate.isAdmin() || this.$gate.isAK()) {
        var formData = new FormData();
        formData.set('kantor_id', this.editedItem.kantor_id);
        formData.set('periode', this.editedItem.periode);
        formData.set('barang_id', this.editedItem.barang_id);
        formData.set('satuan_id', this.editedItem.satuan_id);
        formData.set('harga_satuan', this.editedItem.harga_satuan);
        formData.set('stok_awal', this.editedItem.stok_awal);
        formData.set('stok_masuk', this.editedItem.stok_masuk);
        formData.set('stok_keluar', this.editedItem.stok_keluar);
        formData.set('stok_akhir', parseInt(this.editedItem.stok_awal) + parseInt(this.editedItem.stok_masuk) - parseInt(this.editedItem.stok_keluar));
        formData.set('nom_awal', this.editedItem.nom_awal);
        formData.set('nom_masuk', this.editedItem.nom_masuk);
        formData.set('nom_keluar', this.editedItem.nom_keluar);
        formData.set('nom_akhir', parseInt(this.editedItem.nom_awal) + parseInt(this.editedItem.nom_masuk) - parseInt(this.editedItem.nom_keluar));
        formData.set('keterangan', this.editedItem.keterangan); //formData.append('jml_stok_akhir', this.jml_stok_awal);
        // console.log(this.file);

        axios.post('api/stockpromosi', formData, config).then(function (response) {
          $('#addNew').modal('hide');
          Toast.fire({
            icon: 'success',
            title: response.data.message
          });

          _this8.$Progress.finish();

          _this8.initialize();
        })["catch"](function (response) {
          Swal.fire("Failed!", data.message, "warning"); // Toast.fire({
          //     icon: 'error',
          //     title: 'Gagal tambah stok, ulangi!'
          //     //title: response.message
          // });
        });
      }
    },
    updateUser: function updateUser() {
      var _this9 = this;

      var config = {
        headers: {
          'accept': 'application/json',
          'Accept-Language': 'en-US,en;q=0.8',
          'content-type': 'multipart/form-data'
        } // headers: {'X-Custom-Header': 'value'}

      };
      this.$refs.form.validate();
      this.$Progress.start(); //console.log(this.editedItem.id)

      var formData = new FormData();
      formData.set('kantor_id', this.editedItem.kantor_id);
      formData.set('jenis', this.editedItem.jenis);
      formData.set('tanggal', this.editedItem.tanggal);
      formData.set('jml_stok_awal', this.editedItem.jml_stok_awal);
      formData.set('tambahan_stok', this.editedItem.tambahan_stok);
      formData.set('jml_digunakan', this.editedItem.jml_digunakan);
      formData.set('jml_rusak', this.editedItem.jml_rusak);
      formData.set('jml_hilang', this.editedItem.jml_hilang);
      formData.set('jml_stok_akhir', parseInt(this.editedItem.jml_stok_awal) + parseInt(this.editedItem.tambahan_stok) - parseInt(this.editedItem.jml_digunakan) - parseInt(this.editedItem.jml_rusak) - parseInt(this.editedItem.jml_hilang));
      formData.append("_method", "PUT"); // console.log(formData);

      axios.post('api/stock/' + this.editedItem.id, formData, config) //axios.put('api/stock/27',formData)
      .then(function (response) {
        console.log(_this9.editedItem.id); // success

        $('#addNew').modal('hide');
        Toast.fire({
          icon: 'success',
          title: response.data.message
        });

        _this9.$Progress.finish(); //  Fire.$emit('AfterCreate');


        _this9.initialize();
      })["catch"](function (error) {
        console.log(error);

        _this9.$Progress.fail();
      });
    },
    deleteUser: function deleteUser(id) {
      var _this10 = this;

      Swal.fire({
        title: 'Yakin dihapus?',
        text: "Jika dihapus data hilang!",
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!'
      }).then(function (result) {
        // Send request to the server
        if (result.value) {
          _this10.form["delete"]('api/stockpromosi/' + id).then(function () {
            Swal.fire('Dihapus!', 'Data telah dihapus.', 'success'); // Fire.$emit('AfterCreate');

            _this10.initialize();
          })["catch"](function (data) {
            Swal.fire("Failed!", data.message, "warning");
          });
        }
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/akunting/Stockpromosi.vue?vue&type=template&id=aca4005c&":
/*!************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/akunting/Stockpromosi.vue?vue&type=template&id=aca4005c& ***!
  \************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function () {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "v-app",
    [
      _c(
        "v-container",
        { attrs: { fluid: "" } },
        [
          _c(
            "v-row",
            {
              staticClass: "justify-content-md-center",
              attrs: { "no-gutters": "" },
            },
            [
              _c(
                "v-col",
                { attrs: { cols: "12" } },
                [
                  _vm.$gate.isAdmin() || _vm.$gate.isAK()
                    ? _c(
                        "v-card",
                        { staticClass: "pa-2 mx-auto" },
                        [
                          _c(
                            "v-toolbar",
                            {
                              attrs: {
                                src: "images/banner-biru-pelayanan.jpg",
                                color: "rgb(39,154,187)",
                                dark: "",
                                shaped: "",
                              },
                            },
                            [
                              _c("v-toolbar-title", [
                                _vm._v(
                                  "\r\n                    Stok Barang Promosi\r\n                "
                                ),
                              ]),
                              _vm._v(" "),
                              _c("v-spacer"),
                              _vm._v(" "),
                              _c(
                                "v-btn",
                                {
                                  attrs: {
                                    small: "",
                                    color: "indigo",
                                    dark: "",
                                  },
                                  on: { click: _vm.newModal },
                                },
                                [
                                  _c("v-icon", [_vm._v("mdi-cart-plus")]),
                                  _vm._v(" Tambah Stok\r\n                  "),
                                ],
                                1
                              ),
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c(
                            "div",
                            { staticClass: "card-body table-responsive p-0" },
                            [
                              _c("v-data-table", {
                                staticClass: "elevation-3",
                                attrs: {
                                  headers: _vm.headers,
                                  items: _vm.stock,
                                  search: _vm.search,
                                  "items-per-page": 10,
                                  "footer-props": {
                                    "items-per-page-options": [
                                      5, 10, 14, 140, -1,
                                    ],
                                    "items-per-page-text": "baris per halaman",
                                  },
                                  justify: "center",
                                  dense: "",
                                },
                                scopedSlots: _vm._u(
                                  [
                                    {
                                      key: "footer.prepend",
                                      fn: function () {
                                        return [
                                          _c(
                                            "v-btn",
                                            {
                                              staticClass: "ma-2",
                                              attrs: {
                                                color: "success",
                                                dark: "",
                                                small: "",
                                              },
                                              on: {
                                                click: function ($event) {
                                                  return _vm.initialize()
                                                },
                                              },
                                            },
                                            [
                                              _vm._v(
                                                "\r\n                      Refresh\r\n                      "
                                              ),
                                              _c(
                                                "v-icon",
                                                {
                                                  attrs: {
                                                    right: "",
                                                    dark: "",
                                                  },
                                                },
                                                [
                                                  _vm._v(
                                                    "\r\n                        mdi-reload\r\n                      "
                                                  ),
                                                ]
                                              ),
                                            ],
                                            1
                                          ),
                                        ]
                                      },
                                      proxy: true,
                                    },
                                    {
                                      key: "item.index",
                                      fn: function (ref) {
                                        var index = ref.index
                                        return [
                                          _vm._v(
                                            "\r\n                    " +
                                              _vm._s(index + 1) +
                                              "\r\n                "
                                          ),
                                        ]
                                      },
                                    },
                                    {
                                      key: "top",
                                      fn: function () {
                                        return [
                                          _c(
                                            "v-toolbar",
                                            { attrs: { flat: "" } },
                                            [
                                              _c(
                                                "vue-excel-xlsx",
                                                {
                                                  staticClass:
                                                    "btn btn-success btn-sm",
                                                  attrs: {
                                                    data: _vm.stock,
                                                    columns: _vm.columnsExcel,
                                                    "file-name":
                                                      "stok_barang_cetak",
                                                    "file-type": "xlsx",
                                                    "sheet-name": "stok",
                                                  },
                                                },
                                                [
                                                  _c("i", {
                                                    staticClass:
                                                      "fa-solid fa-file-excel",
                                                  }),
                                                  _vm._v(
                                                    "\r\n                        Excel\r\n                    "
                                                  ),
                                                ]
                                              ),
                                              _vm._v(" "),
                                              _c("v-spacer"),
                                              _vm._v(" "),
                                              _c("v-spacer"),
                                              _vm._v(" "),
                                              _vm.$gate.isAdmin()
                                                ? _c(
                                                    "v-row",
                                                    [
                                                      _c(
                                                        "v-col",
                                                        {
                                                          attrs: {
                                                            cols: "8",
                                                            sm: "8",
                                                            md: "8",
                                                          },
                                                        },
                                                        [
                                                          _c("v-combobox", {
                                                            ref: "CBKantor",
                                                            attrs: {
                                                              label: "Kantor",
                                                              items:
                                                                _vm.editedItem
                                                                  .namaKantor,
                                                              "item-value":
                                                                "id",
                                                              "item-text":
                                                                "nama_kantor",
                                                              placeholder:
                                                                "Pilih Kantor",
                                                              "single-line": "",
                                                              "hide-details":
                                                                "",
                                                              "return-object": false,
                                                            },
                                                            on: {
                                                              change: function (
                                                                $event
                                                              ) {
                                                                return _vm.filterKantor()
                                                              },
                                                              click: function (
                                                                $event
                                                              ) {
                                                                return _vm.getKantor()
                                                              },
                                                            },
                                                            model: {
                                                              value:
                                                                _vm.editedItem
                                                                  .id_kantor,
                                                              callback:
                                                                function ($$v) {
                                                                  _vm.$set(
                                                                    _vm.editedItem,
                                                                    "id_kantor",
                                                                    $$v
                                                                  )
                                                                },
                                                              expression:
                                                                "editedItem.id_kantor",
                                                            },
                                                          }),
                                                        ],
                                                        1
                                                      ),
                                                    ],
                                                    1
                                                  )
                                                : _vm._e(),
                                              _vm._v(" "),
                                              _c("v-spacer"),
                                              _vm._v(" "),
                                              _vm.$gate.isAdmin()
                                                ? _c(
                                                    "v-row",
                                                    [
                                                      _c(
                                                        "v-col",
                                                        {
                                                          attrs: {
                                                            cols: "8",
                                                            sm: "8",
                                                            md: "8",
                                                          },
                                                        },
                                                        [
                                                          _c("v-combobox", {
                                                            ref: "CBBarang",
                                                            attrs: {
                                                              label: "Barang",
                                                              items:
                                                                _vm.editedItem
                                                                  .namaBarang,
                                                              "item-value":
                                                                "id",
                                                              "item-text":
                                                                "namabarang",
                                                              placeholder:
                                                                "Pilih Barang",
                                                              "single-line": "",
                                                              "hide-details":
                                                                "",
                                                              "return-object": false,
                                                            },
                                                            on: {
                                                              change: function (
                                                                $event
                                                              ) {
                                                                return _vm.filterBarang()
                                                              },
                                                              click: function (
                                                                $event
                                                              ) {
                                                                return _vm.getBarang()
                                                              },
                                                            },
                                                            model: {
                                                              value:
                                                                _vm.editedItem
                                                                  .barang_id,
                                                              callback:
                                                                function ($$v) {
                                                                  _vm.$set(
                                                                    _vm.editedItem,
                                                                    "barang_id",
                                                                    $$v
                                                                  )
                                                                },
                                                              expression:
                                                                "editedItem.barang_id",
                                                            },
                                                          }),
                                                        ],
                                                        1
                                                      ),
                                                    ],
                                                    1
                                                  )
                                                : _vm._e(),
                                              _vm._v(" "),
                                              _c("v-spacer"),
                                              _vm._v(" "),
                                              _c(
                                                "v-row",
                                                [
                                                  _c(
                                                    "v-col",
                                                    {
                                                      attrs: {
                                                        cols: "7",
                                                        sm: "7",
                                                        md: "7",
                                                      },
                                                    },
                                                    [
                                                      _c(
                                                        "v-menu",
                                                        {
                                                          ref: "menu2",
                                                          attrs: {
                                                            "close-on-content-click": false,
                                                            "nudge-right": 40,
                                                            transition:
                                                              "scale-transition",
                                                            "offset-y": "",
                                                            "min-width": "auto",
                                                          },
                                                          scopedSlots: _vm._u(
                                                            [
                                                              {
                                                                key: "activator",
                                                                fn: function (
                                                                  ref
                                                                ) {
                                                                  var on =
                                                                    ref.on
                                                                  var attrs =
                                                                    ref.attrs
                                                                  return [
                                                                    _c(
                                                                      "v-text-field",
                                                                      _vm._g(
                                                                        _vm._b(
                                                                          {
                                                                            ref: "tfPeriode",
                                                                            attrs:
                                                                              {
                                                                                "single-line":
                                                                                  "",
                                                                                label:
                                                                                  "Periode",
                                                                                "append-icon":
                                                                                  "mdi-calendar",
                                                                                "hide-details":
                                                                                  "",
                                                                              },
                                                                            model:
                                                                              {
                                                                                value:
                                                                                  _vm.periodeTglText,
                                                                                callback:
                                                                                  function (
                                                                                    $$v
                                                                                  ) {
                                                                                    _vm.periodeTglText =
                                                                                      $$v
                                                                                  },
                                                                                expression:
                                                                                  "periodeTglText",
                                                                              },
                                                                          },
                                                                          "v-text-field",
                                                                          attrs,
                                                                          false
                                                                        ),
                                                                        on
                                                                      )
                                                                    ),
                                                                  ]
                                                                },
                                                              },
                                                            ],
                                                            null,
                                                            false,
                                                            1244225009
                                                          ),
                                                          model: {
                                                            value: _vm.menu2,
                                                            callback: function (
                                                              $$v
                                                            ) {
                                                              _vm.menu2 = $$v
                                                            },
                                                            expression: "menu2",
                                                          },
                                                        },
                                                        [
                                                          _vm._v(" "),
                                                          _c("v-date-picker", {
                                                            attrs: {
                                                              type: "month",
                                                              elevation: "15",
                                                              "year-icon":
                                                                "calendar-blank",
                                                              locale: "id-ID",
                                                            },
                                                            on: {
                                                              input: function (
                                                                $event
                                                              ) {
                                                                _vm.menu2 = false
                                                              },
                                                            },
                                                            model: {
                                                              value:
                                                                _vm.periodeTgl,
                                                              callback:
                                                                function ($$v) {
                                                                  _vm.periodeTgl =
                                                                    $$v
                                                                },
                                                              expression:
                                                                "periodeTgl",
                                                            },
                                                          }),
                                                        ],
                                                        1
                                                      ),
                                                    ],
                                                    1
                                                  ),
                                                  _vm._v(" "),
                                                  _c(
                                                    "v-col",
                                                    [
                                                      _c(
                                                        "v-btn",
                                                        {
                                                          staticClass: "mx-3",
                                                          attrs: {
                                                            fab: "",
                                                            dark: "",
                                                            color: "indigo",
                                                            "x-small": "",
                                                            fixed: "",
                                                            bottom: "",
                                                          },
                                                          on: {
                                                            click: function (
                                                              $event
                                                            ) {
                                                              return _vm.filterTanggal()
                                                            },
                                                          },
                                                        },
                                                        [
                                                          _c("v-icon", [
                                                            _vm._v(
                                                              "\r\n                        mdi-filter\r\n                      "
                                                            ),
                                                          ]),
                                                        ],
                                                        1
                                                      ),
                                                    ],
                                                    1
                                                  ),
                                                ],
                                                1
                                              ),
                                              _vm._v(" "),
                                              _c("v-spacer"),
                                              _vm._v(" "),
                                              _c("v-text-field", {
                                                attrs: {
                                                  "append-icon": "mdi-magnify",
                                                  label: "Cari Data Stok",
                                                  "single-line": "",
                                                  "hide-details": "",
                                                  loading: "grey",
                                                },
                                                model: {
                                                  value: _vm.search,
                                                  callback: function ($$v) {
                                                    _vm.search = $$v
                                                  },
                                                  expression: "search",
                                                },
                                              }),
                                            ],
                                            1
                                          ),
                                        ]
                                      },
                                      proxy: true,
                                    },
                                    {
                                      key: "item.edit",
                                      fn: function (ref) {
                                        var item = ref.item
                                        return [
                                          _c(
                                            "v-card-actions",
                                            { staticClass: "justify-center" },
                                            [
                                              _c(
                                                "v-icon",
                                                {
                                                  attrs: {
                                                    small: "",
                                                    color: "green",
                                                  },
                                                  on: {
                                                    click: function ($event) {
                                                      return _vm.editModal(item)
                                                    },
                                                  },
                                                },
                                                [
                                                  _vm._v(
                                                    "\r\n                        mdi-pencil\r\n                    "
                                                  ),
                                                ]
                                              ),
                                            ],
                                            1
                                          ),
                                        ]
                                      },
                                    },
                                    {
                                      key: "item.actions",
                                      fn: function (ref) {
                                        var item = ref.item
                                        return [
                                          _c(
                                            "v-icon",
                                            {
                                              attrs: {
                                                small: "",
                                                color: "red",
                                              },
                                              on: {
                                                click: function ($event) {
                                                  return _vm.deleteUser(item.id)
                                                },
                                              },
                                            },
                                            [
                                              _vm._v(
                                                "\r\n                    mdi-delete\r\n                "
                                              ),
                                            ]
                                          ),
                                        ]
                                      },
                                    },
                                  ],
                                  null,
                                  false,
                                  1416576956
                                ),
                              }),
                            ],
                            1
                          ),
                        ],
                        1
                      )
                    : _vm._e(),
                ],
                1
              ),
            ],
            1
          ),
          _vm._v(" "),
          !_vm.$gate.isAdmin() && !_vm.$gate.isAK()
            ? _c("div", [_c("not-found")], 1)
            : _vm._e(),
          _vm._v(" "),
          _c(
            "div",
            {
              staticClass: "modal fade",
              attrs: {
                id: "addNew",
                tabindex: "-1",
                role: "dialog",
                "aria-labelledby": "addNew",
                "aria-hidden": "true",
              },
            },
            [
              _c(
                "div",
                {
                  staticClass: "modal-dialog modal-xl modal-dialog-scrollable",
                  attrs: { role: "document" },
                },
                [
                  _c(
                    "div",
                    { staticClass: "modal-content" },
                    [
                      _c("div", { staticClass: "modal-header primary" }, [
                        _c(
                          "h5",
                          {
                            directives: [
                              {
                                name: "show",
                                rawName: "v-show",
                                value: !_vm.editmode,
                                expression: "!editmode",
                              },
                            ],
                            staticClass: "modal-title",
                            staticStyle: { color: "white" },
                          },
                          [
                            _c("i", {
                              staticClass: "nav-icon fas fa-cart-plus",
                            }),
                            _vm._v(" Tambah Stok"),
                          ]
                        ),
                        _vm._v(" "),
                        _c(
                          "h5",
                          {
                            directives: [
                              {
                                name: "show",
                                rawName: "v-show",
                                value: _vm.editmode,
                                expression: "editmode",
                              },
                            ],
                            staticClass: "modal-title",
                          },
                          [_vm._v("Edit Stok")]
                        ),
                        _vm._v(" "),
                        _c(
                          "button",
                          {
                            staticClass: "close",
                            attrs: {
                              type: "button",
                              "data-dismiss": "modal",
                              "aria-label": "Close",
                            },
                          },
                          [
                            _c("span", { attrs: { "aria-hidden": "true" } }, [
                              _vm._v("×"),
                            ]),
                          ]
                        ),
                      ]),
                      _vm._v(" "),
                      _c(
                        "v-form",
                        {
                          ref: "form",
                          attrs: { "lazy-validation": "" },
                          on: {
                            submit: function ($event) {
                              $event.preventDefault()
                              _vm.editmode ? _vm.updateUser() : _vm.createUser()
                            },
                          },
                          model: {
                            value: _vm.valid,
                            callback: function ($$v) {
                              _vm.valid = $$v
                            },
                            expression: "valid",
                          },
                        },
                        [
                          _c(
                            "div",
                            { staticClass: "modal-body" },
                            [
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: _vm.editedItem.kantor_id,
                                    expression: "editedItem.kantor_id",
                                  },
                                ],
                                attrs: { type: "hidden", name: "kantor_id" },
                                domProps: { value: _vm.editedItem.kantor_id },
                                on: {
                                  input: function ($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.$set(
                                      _vm.editedItem,
                                      "kantor_id",
                                      $event.target.value
                                    )
                                  },
                                },
                              }),
                              _vm._v(" "),
                              _c("input", {
                                directives: [
                                  {
                                    name: "model",
                                    rawName: "v-model",
                                    value: _vm.csrf,
                                    expression: "csrf",
                                  },
                                ],
                                attrs: { type: "hidden", name: "_token" },
                                domProps: { value: _vm.csrf },
                                on: {
                                  input: function ($event) {
                                    if ($event.target.composing) {
                                      return
                                    }
                                    _vm.csrf = $event.target.value
                                  },
                                },
                              }),
                              _vm._v(" "),
                              _c(
                                "v-container",
                                [
                                  _c(
                                    "v-row",
                                    [
                                      _c(
                                        "v-col",
                                        {
                                          attrs: {
                                            cols: "12",
                                            sm: "3",
                                            md: "3",
                                          },
                                        },
                                        [
                                          _c(
                                            "v-menu",
                                            {
                                              ref: "menu1",
                                              attrs: {
                                                "close-on-content-click": false,
                                                "nudge-right": 40,
                                                transition: "scale-transition",
                                                "offset-y": "",
                                                "min-width": "auto",
                                              },
                                              scopedSlots: _vm._u([
                                                {
                                                  key: "activator",
                                                  fn: function (ref) {
                                                    var on = ref.on
                                                    var attrs = ref.attrs
                                                    return [
                                                      _c(
                                                        "v-text-field",
                                                        _vm._g(
                                                          _vm._b(
                                                            {
                                                              attrs: {
                                                                value:
                                                                  _vm.periodeMomentJS,
                                                                rules:
                                                                  _vm.editedItem
                                                                    .periodeRules,
                                                                label:
                                                                  "Periode",
                                                                placeholder:
                                                                  "periode bulan",
                                                                "prepend-icon":
                                                                  "mdi-calendar",
                                                                outlined: "",
                                                                required: "",
                                                                dense: "",
                                                                clearable: "",
                                                                readonly: "",
                                                              },
                                                              on: {
                                                                blur: function (
                                                                  $event
                                                                ) {
                                                                  _vm.editedItem.periode =
                                                                    _vm.periodeMomentJS
                                                                },
                                                                "click:clear":
                                                                  function (
                                                                    $event
                                                                  ) {
                                                                    _vm.date =
                                                                      null
                                                                  },
                                                              },
                                                              model: {
                                                                value:
                                                                  _vm.editedItem
                                                                    .periode,
                                                                callback:
                                                                  function (
                                                                    $$v
                                                                  ) {
                                                                    _vm.$set(
                                                                      _vm.editedItem,
                                                                      "periode",
                                                                      $$v
                                                                    )
                                                                  },
                                                                expression:
                                                                  "editedItem.periode",
                                                              },
                                                            },
                                                            "v-text-field",
                                                            attrs,
                                                            false
                                                          ),
                                                          on
                                                        )
                                                      ),
                                                    ]
                                                  },
                                                },
                                              ]),
                                              model: {
                                                value: _vm.menu1,
                                                callback: function ($$v) {
                                                  _vm.menu1 = $$v
                                                },
                                                expression: "menu1",
                                              },
                                            },
                                            [
                                              _vm._v(" "),
                                              _c("v-date-picker", {
                                                attrs: {
                                                  type: "month",
                                                  elevation: "15",
                                                  "year-icon":
                                                    "mdi-calendar-blank",
                                                  "prev-icon":
                                                    "mdi-skip-previous",
                                                  "next-icon": "mdi-skip-next",
                                                  locale: "id-ID",
                                                },
                                                on: {
                                                  input: function ($event) {
                                                    _vm.menu1 = false
                                                  },
                                                },
                                                model: {
                                                  value: _vm.date,
                                                  callback: function ($$v) {
                                                    _vm.date = $$v
                                                  },
                                                  expression: "date",
                                                },
                                              }),
                                            ],
                                            1
                                          ),
                                        ],
                                        1
                                      ),
                                      _vm._v(" "),
                                      _c(
                                        "v-col",
                                        { attrs: { cols: "12", sm: "3" } },
                                        [
                                          _c("v-combobox", {
                                            attrs: {
                                              label: "Nama Barang",
                                              "append-outer-icon":
                                                "mdi-cart-variant",
                                              items: _vm.editedItem.namaBarang,
                                              "item-value": "id",
                                              "item-text": "namabarang",
                                              placeholder: "Daftar Barang",
                                              dense: "",
                                              outlined: "",
                                              "return-object": false,
                                              "persistent-hint": "",
                                              "error-messages": _vm.pesaneror,
                                            },
                                            on: {
                                              click: function ($event) {
                                                return _vm.getBarang()
                                              },
                                            },
                                            model: {
                                              value: _vm.editedItem.barang_id,
                                              callback: function ($$v) {
                                                _vm.$set(
                                                  _vm.editedItem,
                                                  "barang_id",
                                                  $$v
                                                )
                                              },
                                              expression:
                                                "editedItem.barang_id",
                                            },
                                          }),
                                        ],
                                        1
                                      ),
                                      _vm._v(" "),
                                      _c(
                                        "v-col",
                                        {
                                          attrs: {
                                            cols: "12",
                                            sm: "3",
                                            md: "3",
                                          },
                                        },
                                        [
                                          _c("v-combobox", {
                                            attrs: {
                                              label: "Satuan",
                                              "prepend-icon": "mdi-scale",
                                              items: _vm.editedItem.namaSatuan,
                                              "item-value": "id",
                                              "item-text": "namasatuan",
                                              placeholder: "Pilih Satuan",
                                              dense: "",
                                              outlined: "",
                                              "return-object": false,
                                              "persistent-hint": "",
                                              "error-messages": _vm.pesaneror,
                                            },
                                            on: {
                                              click: function ($event) {
                                                return _vm.getSatuan()
                                              },
                                            },
                                            model: {
                                              value: _vm.editedItem.satuan_id,
                                              callback: function ($$v) {
                                                _vm.$set(
                                                  _vm.editedItem,
                                                  "satuan_id",
                                                  $$v
                                                )
                                              },
                                              expression:
                                                "editedItem.satuan_id",
                                            },
                                          }),
                                        ],
                                        1
                                      ),
                                      _vm._v(" "),
                                      _c(
                                        "v-col",
                                        {
                                          attrs: {
                                            cols: "12",
                                            sm: "3",
                                            md: "3",
                                          },
                                        },
                                        [
                                          _c("v-text-field", {
                                            attrs: {
                                              rules:
                                                _vm.editedItem.hargaSatuanRules,
                                              name: "harga_satuan",
                                              label: "Harga Satuan",
                                              placeholder: "Harga Satuan",
                                              "append-outer-icon": "mdi-cash",
                                              outlined: "",
                                              required: "",
                                              dense: "",
                                              counter: "",
                                              maxlength: "10",
                                            },
                                            on: {
                                              keydown: function ($event) {
                                                return _vm.pencetKeyboard(
                                                  $event
                                                )
                                              },
                                            },
                                            model: {
                                              value:
                                                _vm.editedItem.harga_satuan,
                                              callback: function ($$v) {
                                                _vm.$set(
                                                  _vm.editedItem,
                                                  "harga_satuan",
                                                  $$v
                                                )
                                              },
                                              expression:
                                                "editedItem.harga_satuan",
                                            },
                                          }),
                                        ],
                                        1
                                      ),
                                      _vm._v(" "),
                                      _c(
                                        "v-col",
                                        {
                                          attrs: {
                                            cols: "12",
                                            sm: "3",
                                            md: "3",
                                          },
                                        },
                                        [
                                          _c("v-text-field", {
                                            attrs: {
                                              rules:
                                                _vm.editedItem.stokAwalRules,
                                              name: "stok_awal",
                                              label: "Stok Awal",
                                              placeholder: "input nilai angka",
                                              "prepend-icon":
                                                "mdi-numeric-1-box-multiple",
                                              outlined: "",
                                              required: "",
                                              dense: "",
                                              counter: "",
                                              maxlength: "10",
                                            },
                                            on: {
                                              keydown: function ($event) {
                                                return _vm.pencetKeyboard(
                                                  $event
                                                )
                                              },
                                              change: _vm.inputStokAwal,
                                            },
                                            model: {
                                              value: _vm.editedItem.stok_awal,
                                              callback: function ($$v) {
                                                _vm.$set(
                                                  _vm.editedItem,
                                                  "stok_awal",
                                                  $$v
                                                )
                                              },
                                              expression:
                                                "editedItem.stok_awal",
                                            },
                                          }),
                                        ],
                                        1
                                      ),
                                      _vm._v(" "),
                                      _c(
                                        "v-col",
                                        {
                                          attrs: {
                                            cols: "12",
                                            sm: "3",
                                            md: "3",
                                          },
                                        },
                                        [
                                          _c("v-text-field", {
                                            attrs: {
                                              rules:
                                                _vm.editedItem.stokMasukRules,
                                              name: "stok_masuk",
                                              label: "Stok Masuk",
                                              placeholder: "input nilai angka",
                                              "append-outer-icon":
                                                "mdi-numeric-2-box-multiple",
                                              outlined: "",
                                              required: "",
                                              dense: "",
                                              counter: "",
                                              maxlength: "10",
                                            },
                                            on: {
                                              keydown: function ($event) {
                                                return _vm.pencetKeyboard(
                                                  $event
                                                )
                                              },
                                              change: _vm.inputStokMasuk,
                                            },
                                            model: {
                                              value: _vm.editedItem.stok_masuk,
                                              callback: function ($$v) {
                                                _vm.$set(
                                                  _vm.editedItem,
                                                  "stok_masuk",
                                                  $$v
                                                )
                                              },
                                              expression:
                                                "editedItem.stok_masuk",
                                            },
                                          }),
                                        ],
                                        1
                                      ),
                                      _vm._v(" "),
                                      _c(
                                        "v-col",
                                        {
                                          attrs: {
                                            cols: "12",
                                            sm: "3",
                                            md: "3",
                                          },
                                        },
                                        [
                                          _c("v-text-field", {
                                            attrs: {
                                              rules:
                                                _vm.editedItem.stokKeluarRules,
                                              name: "stok_keluar",
                                              label: "Stok Keluar",
                                              placeholder: "input nilai angka",
                                              "prepend-icon":
                                                "mdi-numeric-3-box-multiple",
                                              outlined: "",
                                              required: "",
                                              dense: "",
                                              counter: "",
                                              maxlength: "10",
                                            },
                                            on: {
                                              keydown: function ($event) {
                                                return _vm.pencetKeyboard(
                                                  $event
                                                )
                                              },
                                              change: _vm.inputStokAkhir,
                                            },
                                            model: {
                                              value: _vm.editedItem.stok_keluar,
                                              callback: function ($$v) {
                                                _vm.$set(
                                                  _vm.editedItem,
                                                  "stok_keluar",
                                                  $$v
                                                )
                                              },
                                              expression:
                                                "editedItem.stok_keluar",
                                            },
                                          }),
                                        ],
                                        1
                                      ),
                                      _vm._v(" "),
                                      _c(
                                        "v-col",
                                        {
                                          attrs: {
                                            cols: "12",
                                            sm: "3",
                                            md: "3",
                                          },
                                        },
                                        [
                                          _c("v-text-field", {
                                            attrs: {
                                              name: "stok_akhir",
                                              label: "Stok Akhir",
                                              placeholder: "input nilai angka",
                                              "append-outer-icon":
                                                "mdi-numeric-4-box-multiple",
                                              outlined: "",
                                              required: "",
                                              dense: "",
                                              readonly: "",
                                              disabled: "",
                                              maxlength: "10",
                                            },
                                            on: {
                                              keydown: function ($event) {
                                                return _vm.pencetKeyboard(
                                                  $event
                                                )
                                              },
                                              change: _vm.inputStokAkhir,
                                            },
                                            model: {
                                              value: _vm.editedItem.stok_akhir,
                                              callback: function ($$v) {
                                                _vm.$set(
                                                  _vm.editedItem,
                                                  "stok_akhir",
                                                  $$v
                                                )
                                              },
                                              expression:
                                                "editedItem.stok_akhir",
                                            },
                                          }),
                                        ],
                                        1
                                      ),
                                      _vm._v(" "),
                                      _c(
                                        "v-col",
                                        {
                                          attrs: {
                                            cols: "12",
                                            sm: "3",
                                            md: "3",
                                          },
                                        },
                                        [
                                          _c("v-text-field", {
                                            attrs: {
                                              rules:
                                                _vm.editedItem.nomAwalRules,
                                              name: "nominal_awal",
                                              label: "Nominal Awal",
                                              placeholder: "input nilai angka",
                                              "prepend-icon":
                                                "mdi-numeric-1-box-multiple",
                                              outlined: "",
                                              required: "",
                                              dense: "",
                                              counter: "",
                                              maxlength: "10",
                                            },
                                            on: {
                                              keydown: function ($event) {
                                                return _vm.pencetKeyboard(
                                                  $event
                                                )
                                              },
                                              change: _vm.inputNominalAwal,
                                            },
                                            model: {
                                              value: _vm.editedItem.nom_awal,
                                              callback: function ($$v) {
                                                _vm.$set(
                                                  _vm.editedItem,
                                                  "nom_awal",
                                                  $$v
                                                )
                                              },
                                              expression: "editedItem.nom_awal",
                                            },
                                          }),
                                        ],
                                        1
                                      ),
                                      _vm._v(" "),
                                      _c(
                                        "v-col",
                                        {
                                          attrs: {
                                            cols: "12",
                                            sm: "3",
                                            md: "3",
                                          },
                                        },
                                        [
                                          _c("v-text-field", {
                                            attrs: {
                                              rules:
                                                _vm.editedItem.nomMasukRules,
                                              name: "nom_masuk",
                                              label: "Nominal Masuk",
                                              placeholder: "input nilai angka",
                                              "append-outer-icon":
                                                "mdi-numeric-2-box-multiple",
                                              outlined: "",
                                              required: "",
                                              dense: "",
                                              counter: "",
                                              maxlength: "10",
                                            },
                                            on: {
                                              keydown: function ($event) {
                                                return _vm.pencetKeyboard(
                                                  $event
                                                )
                                              },
                                              change: _vm.inputNominalMasuk,
                                            },
                                            model: {
                                              value: _vm.editedItem.nom_masuk,
                                              callback: function ($$v) {
                                                _vm.$set(
                                                  _vm.editedItem,
                                                  "nom_masuk",
                                                  $$v
                                                )
                                              },
                                              expression:
                                                "editedItem.nom_masuk",
                                            },
                                          }),
                                        ],
                                        1
                                      ),
                                      _vm._v(" "),
                                      _c(
                                        "v-col",
                                        {
                                          attrs: {
                                            cols: "12",
                                            sm: "3",
                                            md: "3",
                                          },
                                        },
                                        [
                                          _c("v-text-field", {
                                            attrs: {
                                              rules:
                                                _vm.editedItem.nomKeluarRules,
                                              name: "nominal_keluar",
                                              label: "Nominal Keluar",
                                              placeholder: "input nilai angka",
                                              "prepend-icon":
                                                "mdi-numeric-3-box-multiple",
                                              outlined: "",
                                              required: "",
                                              dense: "",
                                              counter: "",
                                              maxlength: "10",
                                            },
                                            on: {
                                              keydown: function ($event) {
                                                return _vm.pencetKeyboard(
                                                  $event
                                                )
                                              },
                                              change: _vm.inputNominalAkhir,
                                            },
                                            model: {
                                              value: _vm.editedItem.nom_keluar,
                                              callback: function ($$v) {
                                                _vm.$set(
                                                  _vm.editedItem,
                                                  "nom_keluar",
                                                  $$v
                                                )
                                              },
                                              expression:
                                                "editedItem.nom_keluar",
                                            },
                                          }),
                                        ],
                                        1
                                      ),
                                      _vm._v(" "),
                                      _c(
                                        "v-col",
                                        {
                                          attrs: {
                                            cols: "12",
                                            sm: "3",
                                            md: "3",
                                          },
                                        },
                                        [
                                          _c("v-text-field", {
                                            attrs: {
                                              name: "nom_akhir",
                                              label: "Nominal Akhir",
                                              placeholder: "input nilai angka",
                                              "append-outer-icon":
                                                "mdi-numeric-4-box-multiple",
                                              outlined: "",
                                              required: "",
                                              dense: "",
                                              readonly: "",
                                              disabled: "",
                                              maxlength: "10",
                                            },
                                            on: {
                                              keydown: function ($event) {
                                                return _vm.pencetKeyboard(
                                                  $event
                                                )
                                              },
                                              change: _vm.inputNominalAkhir,
                                            },
                                            model: {
                                              value: _vm.editedItem.nom_akhir,
                                              callback: function ($$v) {
                                                _vm.$set(
                                                  _vm.editedItem,
                                                  "nom_akhir",
                                                  $$v
                                                )
                                              },
                                              expression:
                                                "editedItem.nom_akhir",
                                            },
                                          }),
                                        ],
                                        1
                                      ),
                                      _vm._v(" "),
                                      _c(
                                        "v-col",
                                        {
                                          attrs: {
                                            cols: "12",
                                            sm: "12",
                                            md: "12",
                                          },
                                        },
                                        [
                                          _c("v-text-field", {
                                            attrs: {
                                              name: "keterangan",
                                              label: "Keterangan",
                                              "prepend-icon": "mdi-note",
                                              outlined: "",
                                              dense: "",
                                              hint: "input spasi jika tidak ada keterangan",
                                              "persistent-hint": "",
                                            },
                                            model: {
                                              value: _vm.editedItem.keterangan,
                                              callback: function ($$v) {
                                                _vm.$set(
                                                  _vm.editedItem,
                                                  "keterangan",
                                                  $$v
                                                )
                                              },
                                              expression:
                                                "editedItem.keterangan",
                                            },
                                          }),
                                        ],
                                        1
                                      ),
                                    ],
                                    1
                                  ),
                                ],
                                1
                              ),
                            ],
                            1
                          ),
                          _vm._v(" "),
                          _c(
                            "div",
                            { staticClass: "modal-footer" },
                            [
                              _c(
                                "v-btn",
                                {
                                  attrs: {
                                    color: "error",
                                    elevation: "2",
                                    type: "button",
                                    "data-dismiss": "modal",
                                  },
                                },
                                [
                                  _c("v-icon", [_vm._v("mdi-file-cancel")]),
                                  _vm._v(
                                    "\r\n                            Batal\r\n                        "
                                  ),
                                ],
                                1
                              ),
                              _vm._v(" "),
                              _c(
                                "v-btn",
                                {
                                  directives: [
                                    {
                                      name: "show",
                                      rawName: "v-show",
                                      value: _vm.editmode,
                                      expression: "editmode",
                                    },
                                  ],
                                  attrs: {
                                    color: "success",
                                    elevation: "2",
                                    type: "submit",
                                  },
                                },
                                [
                                  _c("v-icon", [_vm._v("mdi-pencil")]),
                                  _vm._v(
                                    "\r\n                            Ubah\r\n                        "
                                  ),
                                ],
                                1
                              ),
                              _vm._v(" "),
                              _c(
                                "v-btn",
                                {
                                  directives: [
                                    {
                                      name: "show",
                                      rawName: "v-show",
                                      value: !_vm.editmode,
                                      expression: "!editmode",
                                    },
                                  ],
                                  attrs: {
                                    color: "primary",
                                    elevation: "2",
                                    type: "submit",
                                  },
                                },
                                [
                                  _c("v-icon", [_vm._v("mdi-archive-plus")]),
                                  _vm._v(
                                    "\r\n                            Tambah\r\n                        "
                                  ),
                                ],
                                1
                              ),
                            ],
                            1
                          ),
                        ]
                      ),
                    ],
                    1
                  ),
                ]
              ),
            ]
          ),
        ],
        1
      ),
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/akunting/Stockpromosi.vue":
/*!***********************************************************!*\
  !*** ./resources/js/components/akunting/Stockpromosi.vue ***!
  \***********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Stockpromosi_vue_vue_type_template_id_aca4005c___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Stockpromosi.vue?vue&type=template&id=aca4005c& */ "./resources/js/components/akunting/Stockpromosi.vue?vue&type=template&id=aca4005c&");
/* harmony import */ var _Stockpromosi_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Stockpromosi.vue?vue&type=script&lang=js& */ "./resources/js/components/akunting/Stockpromosi.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Stockpromosi_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Stockpromosi_vue_vue_type_template_id_aca4005c___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Stockpromosi_vue_vue_type_template_id_aca4005c___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/akunting/Stockpromosi.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/akunting/Stockpromosi.vue?vue&type=script&lang=js&":
/*!************************************************************************************!*\
  !*** ./resources/js/components/akunting/Stockpromosi.vue?vue&type=script&lang=js& ***!
  \************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Stockpromosi_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./Stockpromosi.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/akunting/Stockpromosi.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Stockpromosi_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/akunting/Stockpromosi.vue?vue&type=template&id=aca4005c&":
/*!******************************************************************************************!*\
  !*** ./resources/js/components/akunting/Stockpromosi.vue?vue&type=template&id=aca4005c& ***!
  \******************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Stockpromosi_vue_vue_type_template_id_aca4005c___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./Stockpromosi.vue?vue&type=template&id=aca4005c& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/akunting/Stockpromosi.vue?vue&type=template&id=aca4005c&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Stockpromosi_vue_vue_type_template_id_aca4005c___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Stockpromosi_vue_vue_type_template_id_aca4005c___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);