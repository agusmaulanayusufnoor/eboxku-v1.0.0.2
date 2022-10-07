(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[5],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/akunting/Stock.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/akunting/Stock.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************/
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

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
    return {
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      editmode: false,
      dialog: false,
      dialogDelete: false,
      fromTgl: '',
      toTgl: '',
      filterFormTgl: '',
      date: new Date(Date.now() - new Date().getTimezoneOffset() * 60000).toISOString().substr(0, 10),
      search: '',
      stock: [],
      valid: true,
      editedIndex: -1,
      editedItem: {
        id: '',
        kantor_id: '',
        tanggal: vm.formatDate(new Date(Date.now() - new Date().getTimezoneOffset() * 60000).toISOString().substr(0, 10)),
        tanggalRules: [function (v) {
          return !!v || 'Tanggal stok belum diisi';
        }],
        jml_stok_awal: 0,
        jmlstokawalRules: [function (v) {
          return !!v || 'harus diisi angka';
        }, function (v) {
          return v > -1 || 'angka tidak boleh minus';
        }],
        tambahan_stok: 0,
        tambahanStokRules: [function (v) {
          return v > -1 || 'angka tidak boleh minus';
        }],
        jml_digunakan: 0,
        jmlDigunakanRules: [function (v) {
          return v > -1 || 'angka tidak boleh minus';
        }],
        jml_rusak: 0,
        jmlRusakRules: [function (v) {
          return v > -1 || 'angka tidak boleh minus';
        }],
        jml_hilang: 0,
        jmlHilangRules: [function (v) {
          return v > -1 || 'angka tidak boleh minus';
        }],
        jml_stok_akhir: '',
        jenis: '',
        jenisStok: ['1', '2']
      },
      menu1: false,
      menu2: false,
      menu3: false,
      pesaneror: '',
      form: new Form({
        id: '',
        kantor_id: '',
        jenis: '',
        tanggal: '',
        jml_stok_awal: '',
        tambahan_stok: '',
        jml_digunakan: '',
        jml_rusak: '',
        jml_hilang: '',
        jml_stok_akhir: ''
      }),
      columnsExcel: [{
        label: 'Jenis Stok',
        field: 'jenis'
      }, {
        label: 'Sandi Kantor',
        field: 'kode_kantor',
        align: 'start'
      }, {
        label: 'Tanggal Stok',
        field: 'tanggal',
        dataFormat: function dataFormat(value) {
          return moment__WEBPACK_IMPORTED_MODULE_0___default()(value).format('DD/MM/YYYY');
        }
      }, {
        label: 'Jumlah Stok Awal',
        field: 'jml_stok_awal'
      }, {
        label: 'Tambahan Stok',
        field: 'tambahan_stok'
      }, {
        label: 'Jumlah Digunakan',
        field: 'jml_digunakan'
      }, {
        label: 'Jumlah Rusak',
        field: 'jml_rusak'
      }, {
        label: 'Jumlah Hilang',
        field: 'jml_hilang'
      }, {
        label: 'Jumlah Stok Akhir',
        field: 'jml_stok_akhir'
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
        text: 'Jenis Stok',
        value: 'jenis',
        align: 'start'
      }, {
        text: 'Sandi Kantor',
        value: 'kode_kantor',
        align: 'start'
      }, {
        text: 'Tanggal Stok',
        value: 'tanggal'
      }, {
        text: 'Jumlah StokAwal',
        value: 'jml_stok_awal',
        align: 'center'
      }, {
        text: 'Tambahan Stok',
        value: 'tambahan_stok',
        align: 'center'
      }, {
        text: 'Jumlah Digunakan',
        value: 'jml_digunakan',
        align: 'center'
      }, {
        text: 'JumlahRusak',
        value: 'jml_rusak',
        align: 'center'
      }, {
        text: 'JumlahHilang',
        value: 'jml_hilang',
        align: 'center'
      }, {
        text: 'Jumlah StokAkhir',
        value: 'jml_stok_akhir',
        align: 'center'
      }];
      headers.push({
        text: 'Edit',
        value: 'edit',
        sortable: false,
        align: 'center'
      });
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
    fromTglText: function fromTglText() {
      return this.fromTgl ? moment__WEBPACK_IMPORTED_MODULE_0___default()(this.fromTgl).format('YYYY-MM-DD') : '';
    },
    toTglText: function toTglText() {
      return this.toTgl ? moment__WEBPACK_IMPORTED_MODULE_0___default()(this.toTgl).format('YYYY-MM-DD') : '';
    },
    computedDateFormatted: function computedDateFormatted() {
      return this.formatDate(this.editedItem.date);
    },
    // jenisKode: {
    //   get: function() {
    //     // find the code if it exist, else, just return the typed input
    //     const kode = this.editedItem.jenisStok.find(
    //       kode => kode.value === this.editedItem.jenis
    //     );
    //     return kode || this.editedItem.jenis;
    //   },
    //   set: function(value) {
    //     this.editedItem.jenis = value;
    //   }
    // },
    formTitle: function formTitle() {
      return this.editedIndex === -1 ? 'New Item' : 'Edit Item';
    }
  },
  watch: {
    date: function date(val) {
      //this.editedItem.tanggal = this.formatDate(this.date)
      this.editedItem.tanggal = this.date;
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
    inputStokAkhir: function inputStokAkhir() {
      this.editedItem.jml_stok_akhir = parseInt(this.editedItem.jml_stok_awal) + parseInt(this.editedItem.tambahan_stok) - parseInt(this.editedItem.jml_digunakan) - parseInt(this.editedItem.jml_rusak) - parseInt(this.editedItem.jml_hilang);
    },
    formatDate: function formatDate(date) {
      if (!date) return null;

      var _date$split = date.split('-'),
          _date$split2 = _slicedToArray(_date$split, 3),
          year = _date$split2[0],
          month = _date$split2[1],
          day = _date$split2[2];

      return "".concat(day, "/").concat(month, "/").concat(year);
    },
    formatDateExcel: function formatDateExcel(value) {
      if (!value) return null;

      var _value$split = value.split('-'),
          _value$split2 = _slicedToArray(_value$split, 3),
          year = _value$split2[0],
          month = _value$split2[1],
          day = _value$split2[2];

      return "".concat(day, "/").concat(month, "/").concat(year); //return '$ ' + value;
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
    filterTanggal: function filterTanggal() {
      var _this = this;

      this.$Progress.start();
      var formData = new FormData();
      formData.set('fromtgl', this.fromTglText);
      formData.set('totgl', this.toTglText);

      if (this.fromTglText != '' && this.toTglText != '') {
        if (this.$gate.isAdmin() || this.$gate.isAK()) {
          axios.get("api/stock/filtertanggal", {
            params: {
              fromtgl: this.fromTglText,
              totgl: this.toTglText
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
    initialize: function initialize() {
      var _this2 = this;

      this.$Progress.start();

      if (this.$gate.isAdmin() || this.$gate.isAK()) {
        //axios.get("api/user").then((response) => {(this.users = response.data.data)});
        axios.get("api/stock").then(function (response) {
          _this2.stock = response.data.data;
          _this2.editedItem.kantor_id = _this2.$kantor_id; // this.form.fill
          //console.log(this.stock);
          //console.log(this.kantor_id)
        })["catch"](function (error) {
          console.log(error.response.data);
        });
      }

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
      var _this3 = this;

      this.$refs.form.validate();
      this.$Progress.start(); // e.preventDefault();

      var config = {
        headers: {
          'content-type': 'multipart/form-data'
        }
      };
      var formData = new FormData();
      formData.set('kantor_id', this.editedItem.kantor_id);
      formData.set('jenis', this.editedItem.jenis);
      formData.set('tanggal', this.editedItem.tanggal);
      formData.set('jml_stok_awal', this.editedItem.jml_stok_awal);
      formData.set('tambahan_stok', this.editedItem.tambahan_stok);
      formData.set('jml_digunakan', this.editedItem.jml_digunakan);
      formData.set('jml_rusak', this.editedItem.jml_rusak);
      formData.set('jml_hilang', this.editedItem.jml_hilang);
      formData.set('jml_stok_akhir', parseInt(this.editedItem.jml_stok_awal) + parseInt(this.editedItem.tambahan_stok) - parseInt(this.editedItem.jml_digunakan) - parseInt(this.editedItem.jml_rusak) - parseInt(this.editedItem.jml_hilang)); //formData.append('jml_stok_akhir', this.jml_stok_awal);
      // console.log(this.file);

      axios.post('api/stock', formData, config).then(function (response) {
        $('#addNew').modal('hide');
        Toast.fire({
          icon: 'success',
          title: response.data.message
        });

        _this3.$Progress.finish();

        _this3.initialize();
      })["catch"](function (response) {
        //Swal.fire("Failed!", data.message, "warning");
        Toast.fire({
          icon: 'error',
          title: 'Gagal tambah stok, ulangi!' //title: response.message

        });
      });
    },
    downloadFile: function downloadFile(id, file) {
      axios({
        url: 'api/stock/download/' + id,
        method: 'GET',
        responseType: 'blob'
      }).then(function (response) {
        var fileUrl = window.URL.createObjectURL(new Blob([response.data]));
        var fileLink = document.createElement('a');
        fileLink.href = fileUrl;
        fileLink.setAttribute('download', 'stock.zip');
        fileLink.download = file;
        document.body.appendChild(fileLink);
        fileLink.click();
      })["catch"](function () {
        Swal.fire("Gagal Download!", "File tidak ada...", "warning");
      });
    },
    updateUser: function updateUser() {
      var _this4 = this;

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
        console.log(_this4.editedItem.id); // success

        $('#addNew').modal('hide');
        Toast.fire({
          icon: 'success',
          title: response.data.message
        });

        _this4.$Progress.finish(); //  Fire.$emit('AfterCreate');


        _this4.initialize();
      })["catch"](function (error) {
        console.log(error);

        _this4.$Progress.fail();
      });
    },
    deleteUser: function deleteUser(id) {
      var _this5 = this;

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
          _this5.form["delete"]('api/stock/' + id).then(function () {
            Swal.fire('Dihapus!', 'Data telah dihapus.', 'success'); // Fire.$emit('AfterCreate');

            _this5.initialize();
          })["catch"](function (data) {
            Swal.fire("Failed!", data.message, "warning");
          });
        }
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/akunting/Stock.vue?vue&type=template&id=c3a2cfba&":
/*!*****************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/akunting/Stock.vue?vue&type=template&id=c3a2cfba& ***!
  \*****************************************************************************************************************************************************************************************************************/
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
                                  "\n                    Stok Buku Tabungan dan Bilyet Deposito\n                "
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
                                  _c("v-icon", [_vm._v("mdi-archive-plus")]),
                                  _vm._v(" Tambah Stok\n                  "),
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
                                      key: "item.tanggal",
                                      fn: function (ref) {
                                        var item = ref.item
                                        return [
                                          _vm._v(
                                            "\n                " +
                                              _vm._s(
                                                _vm.formatDate(item.tanggal)
                                              ) +
                                              "\n                "
                                          ),
                                        ]
                                      },
                                    },
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
                                                "\n                      Refresh\n                      "
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
                                                    "\n                        mdi-reload\n                      "
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
                                            "\n                    " +
                                              _vm._s(index + 1) +
                                              "\n                "
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
                                                    "file-name": "OP003-A",
                                                    "file-type": "xls",
                                                    "sheet-name": "stock",
                                                  },
                                                },
                                                [
                                                  _c("i", {
                                                    staticClass:
                                                      "fa-solid fa-file-excel",
                                                  }),
                                                  _vm._v(
                                                    "\n                        Excel\n                    "
                                                  ),
                                                ]
                                              ),
                                              _vm._v(" "),
                                              _c("v-spacer"),
                                              _vm._v(" "),
                                              _c("v-spacer"),
                                              _vm._v(" "),
                                              _c("v-spacer"),
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
                                                        cols: "12",
                                                        sm: "6",
                                                        md: "5",
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
                                                                            attrs:
                                                                              {
                                                                                "single-line":
                                                                                  "",
                                                                                label:
                                                                                  "Dari Tanggal",
                                                                                "append-icon":
                                                                                  "mdi-calendar",
                                                                                "hide-details":
                                                                                  "",
                                                                              },
                                                                            model:
                                                                              {
                                                                                value:
                                                                                  _vm.fromTglText,
                                                                                callback:
                                                                                  function (
                                                                                    $$v
                                                                                  ) {
                                                                                    _vm.fromTglText =
                                                                                      $$v
                                                                                  },
                                                                                expression:
                                                                                  "fromTglText",
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
                                                            3807831418
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
                                                                _vm.fromTgl,
                                                              callback:
                                                                function ($$v) {
                                                                  _vm.fromTgl =
                                                                    $$v
                                                                },
                                                              expression:
                                                                "fromTgl",
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
                                                    {
                                                      attrs: {
                                                        cols: "12",
                                                        sm: "6",
                                                        md: "5",
                                                      },
                                                    },
                                                    [
                                                      _c(
                                                        "v-menu",
                                                        {
                                                          ref: "menu3",
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
                                                                            attrs:
                                                                              {
                                                                                "single-line":
                                                                                  "",
                                                                                label:
                                                                                  "Sampai Tanggal",
                                                                                "append-icon":
                                                                                  "mdi-calendar",
                                                                                "hide-details":
                                                                                  "",
                                                                              },
                                                                            model:
                                                                              {
                                                                                value:
                                                                                  _vm.toTglText,
                                                                                callback:
                                                                                  function (
                                                                                    $$v
                                                                                  ) {
                                                                                    _vm.toTglText =
                                                                                      $$v
                                                                                  },
                                                                                expression:
                                                                                  "toTglText",
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
                                                            1484171918
                                                          ),
                                                          model: {
                                                            value: _vm.menu3,
                                                            callback: function (
                                                              $$v
                                                            ) {
                                                              _vm.menu3 = $$v
                                                            },
                                                            expression: "menu3",
                                                          },
                                                        },
                                                        [
                                                          _vm._v(" "),
                                                          _c("v-date-picker", {
                                                            attrs: {
                                                              elevation: "15",
                                                              "year-icon":
                                                                "calendar-blank",
                                                              locale: "id-ID",
                                                            },
                                                            on: {
                                                              input: function (
                                                                $event
                                                              ) {
                                                                _vm.menu3 = false
                                                              },
                                                            },
                                                            model: {
                                                              value: _vm.toTgl,
                                                              callback:
                                                                function ($$v) {
                                                                  _vm.toTgl =
                                                                    $$v
                                                                },
                                                              expression:
                                                                "toTgl",
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
                                                              "\n                        mdi-filter\n                      "
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
                                                    "\n                        mdi-pencil\n                    "
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
                                                "\n                    mdi-delete\n                "
                                              ),
                                            ]
                                          ),
                                        ]
                                      },
                                    },
                                  ],
                                  null,
                                  false,
                                  2067198694
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
                { staticClass: "modal-dialog", attrs: { role: "document" } },
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
                            _c("v-icon", { attrs: { color: "#FFFFFF" } }, [
                              _vm._v("mdi-archive-plus"),
                            ]),
                            _vm._v(" Tambah Stok"),
                          ],
                          1
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
                                            sm: "6",
                                            md: "6",
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
                                                                rules:
                                                                  _vm.editedItem
                                                                    .tanggalRules,
                                                                label:
                                                                  "Tanggal Stok",
                                                                placeholder:
                                                                  "tahun-bulan-hari",
                                                                "prepend-icon":
                                                                  "mdi-calendar",
                                                                outlined: "",
                                                                required: "",
                                                                dense: "",
                                                                readonly: "",
                                                              },
                                                              on: {
                                                                blur: function (
                                                                  $event
                                                                ) {
                                                                  _vm.date =
                                                                    _vm.parseDate(
                                                                      _vm
                                                                        .editedItem
                                                                        .tanggal
                                                                    )
                                                                },
                                                              },
                                                              model: {
                                                                value:
                                                                  _vm.editedItem
                                                                    .tanggal,
                                                                callback:
                                                                  function (
                                                                    $$v
                                                                  ) {
                                                                    _vm.$set(
                                                                      _vm.editedItem,
                                                                      "tanggal",
                                                                      $$v
                                                                    )
                                                                  },
                                                                expression:
                                                                  "editedItem.tanggal",
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
                                                  elevation: "15",
                                                  "year-icon": "calendar-blank",
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
                                        { attrs: { cols: "12", sm: "6" } },
                                        [
                                          _c("v-combobox", {
                                            attrs: {
                                              label: "Jenis",
                                              "append-outer-icon": "mdi-map",
                                              items: _vm.editedItem.jenisStok,
                                              placeholder: "Jenis",
                                              hint: "1=Tabungan | 2=deposito",
                                              dense: "",
                                              outlined: "",
                                              "return-object": false,
                                              "persistent-hint": "",
                                              "error-messages": _vm.pesaneror,
                                            },
                                            model: {
                                              value: _vm.editedItem.jenis,
                                              callback: function ($$v) {
                                                _vm.$set(
                                                  _vm.editedItem,
                                                  "jenis",
                                                  $$v
                                                )
                                              },
                                              expression: "editedItem.jenis",
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
                                            sm: "6",
                                            md: "6",
                                          },
                                        },
                                        [
                                          _c("v-text-field", {
                                            attrs: {
                                              rules:
                                                _vm.editedItem.jmlstokawalRules,
                                              name: "jml_stok_awal",
                                              label: "Jumlah Stok Awal",
                                              placeholder: "input nilai angka",
                                              "prepend-icon":
                                                "mdi-numeric-1-box-multiple",
                                              outlined: "",
                                              required: "",
                                              dense: "",
                                              counter: "",
                                              maxlength: "6",
                                              type: "number",
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
                                              value:
                                                _vm.editedItem.jml_stok_awal,
                                              callback: function ($$v) {
                                                _vm.$set(
                                                  _vm.editedItem,
                                                  "jml_stok_awal",
                                                  $$v
                                                )
                                              },
                                              expression:
                                                "editedItem.jml_stok_awal",
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
                                            sm: "6",
                                            md: "6",
                                          },
                                        },
                                        [
                                          _c("v-text-field", {
                                            attrs: {
                                              rules:
                                                _vm.editedItem
                                                  .tambahanStokRules,
                                              name: "tambahan_stok",
                                              label: "Tambahan Stok",
                                              placeholder: "input nilai angka",
                                              "append-outer-icon":
                                                "mdi-numeric-2-box-multiple",
                                              outlined: "",
                                              required: "",
                                              dense: "",
                                              counter: "",
                                              maxlength: "6",
                                              type: "number",
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
                                              value:
                                                _vm.editedItem.tambahan_stok,
                                              callback: function ($$v) {
                                                _vm.$set(
                                                  _vm.editedItem,
                                                  "tambahan_stok",
                                                  $$v
                                                )
                                              },
                                              expression:
                                                "editedItem.tambahan_stok",
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
                                            sm: "6",
                                            md: "6",
                                          },
                                        },
                                        [
                                          _c("v-text-field", {
                                            attrs: {
                                              rules:
                                                _vm.editedItem
                                                  .jmlDigunakanRules,
                                              name: "jml_digunakan",
                                              label: "Jml Digunakan",
                                              placeholder: "input nilai angka",
                                              "prepend-icon":
                                                "mdi-numeric-3-box-multiple",
                                              outlined: "",
                                              required: "",
                                              dense: "",
                                              counter: "",
                                              maxlength: "6",
                                              type: "number",
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
                                              value:
                                                _vm.editedItem.jml_digunakan,
                                              callback: function ($$v) {
                                                _vm.$set(
                                                  _vm.editedItem,
                                                  "jml_digunakan",
                                                  $$v
                                                )
                                              },
                                              expression:
                                                "editedItem.jml_digunakan",
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
                                            sm: "6",
                                            md: "6",
                                          },
                                        },
                                        [
                                          _c("v-text-field", {
                                            attrs: {
                                              rules:
                                                _vm.editedItem.jmlRusakRules,
                                              name: "jml_rusak",
                                              label: "Jumlah Rusak",
                                              placeholder: "input nilai angka",
                                              "append-outer-icon":
                                                "mdi-numeric-4-box-multiple",
                                              outlined: "",
                                              required: "",
                                              dense: "",
                                              counter: "",
                                              maxlength: "6",
                                              type: "number",
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
                                              value: _vm.editedItem.jml_rusak,
                                              callback: function ($$v) {
                                                _vm.$set(
                                                  _vm.editedItem,
                                                  "jml_rusak",
                                                  $$v
                                                )
                                              },
                                              expression:
                                                "editedItem.jml_rusak",
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
                                            sm: "6",
                                            md: "6",
                                          },
                                        },
                                        [
                                          _c("v-text-field", {
                                            attrs: {
                                              rules:
                                                _vm.editedItem.jmlHilangRules,
                                              name: "jml_hilang",
                                              label: "Jumlah Hilang",
                                              placeholder: "input nilai angka",
                                              "prepend-icon":
                                                "mdi-numeric-5-box-multiple",
                                              outlined: "",
                                              required: "",
                                              dense: "",
                                              counter: "",
                                              maxlength: "6",
                                              type: "number",
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
                                              value: _vm.editedItem.jml_hilang,
                                              callback: function ($$v) {
                                                _vm.$set(
                                                  _vm.editedItem,
                                                  "jml_hilang",
                                                  $$v
                                                )
                                              },
                                              expression:
                                                "editedItem.jml_hilang",
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
                                            sm: "6",
                                            md: "6",
                                          },
                                        },
                                        [
                                          _c("v-text-field", {
                                            attrs: {
                                              name: "jml_stok_akhir",
                                              label: "Jml Stok Akhir",
                                              placeholder: "input nilai angka",
                                              "append-outer-icon":
                                                "mdi-numeric-6-box-multiple",
                                              outlined: "",
                                              required: "",
                                              dense: "",
                                              readonly: "",
                                              disabled: "",
                                              maxlength: "6",
                                              type: "number",
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
                                              value:
                                                _vm.editedItem.jml_stok_akhir,
                                              callback: function ($$v) {
                                                _vm.$set(
                                                  _vm.editedItem,
                                                  "jml_stok_akhir",
                                                  $$v
                                                )
                                              },
                                              expression:
                                                "editedItem.jml_stok_akhir",
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
                                    "\n                            Batal\n                        "
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
                                    "\n                            Ubah\n                        "
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
                                    "\n                            Tambah\n                        "
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

/***/ "./resources/js/components/akunting/Stock.vue":
/*!****************************************************!*\
  !*** ./resources/js/components/akunting/Stock.vue ***!
  \****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Stock_vue_vue_type_template_id_c3a2cfba___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Stock.vue?vue&type=template&id=c3a2cfba& */ "./resources/js/components/akunting/Stock.vue?vue&type=template&id=c3a2cfba&");
/* harmony import */ var _Stock_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Stock.vue?vue&type=script&lang=js& */ "./resources/js/components/akunting/Stock.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Stock_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Stock_vue_vue_type_template_id_c3a2cfba___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Stock_vue_vue_type_template_id_c3a2cfba___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/akunting/Stock.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/akunting/Stock.vue?vue&type=script&lang=js&":
/*!*****************************************************************************!*\
  !*** ./resources/js/components/akunting/Stock.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Stock_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./Stock.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/akunting/Stock.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Stock_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/akunting/Stock.vue?vue&type=template&id=c3a2cfba&":
/*!***********************************************************************************!*\
  !*** ./resources/js/components/akunting/Stock.vue?vue&type=template&id=c3a2cfba& ***!
  \***********************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Stock_vue_vue_type_template_id_c3a2cfba___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./Stock.vue?vue&type=template&id=c3a2cfba& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/akunting/Stock.vue?vue&type=template&id=c3a2cfba&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Stock_vue_vue_type_template_id_c3a2cfba___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Stock_vue_vue_type_template_id_c3a2cfba___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);