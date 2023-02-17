(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[46],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/umum/Pk.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/umum/Pk.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var moment__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! moment */ "./node_modules/moment/moment.js");
/* harmony import */ var moment__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(moment__WEBPACK_IMPORTED_MODULE_1__);
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }



function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
      dialog2: false,
      dialogDelete: false,
      search: '',
      //editmode
      snack: false,
      multiLine: true,
      snackColor: '',
      snackText: '',
      max200chars: function max200chars(v) {
        return v.length <= 200 || 'Input terlalu panjang [max. 200 karakter]';
      },
      //endeditmode
      pk: [],
      valid: true,
      kantor_id: '',
      editedItem: {
        id: '',
        no_pk: '',
        nopkRules: [function (v) {
          return !!v || 'No Perjanjian Kerjasama Belum Diisi';
        }],
        namamitra: '',
        namemitraRules: [function (v) {
          return !!v || 'Nama Mitra Belum Diisi';
        }],
        namafile: '',
        nameRules: [function (v) {
          return !!v || 'Jenis PKS Belum Diisi';
        }],
        file: null,
        fileRules: [function (v) {
          return !!v || 'File belum dimasukan';
        }]
      },
      tglmulai: new Date(Date.now() - new Date().getTimezoneOffset() * 60000).toISOString().substr(0, 10),
      tglmulaiRules: [function (v) {
        return !!v || 'Tanggal mulai belum diisi';
      }],
      tglakhir: new Date(Date.now() - new Date().getTimezoneOffset() * 60000).toISOString().substr(0, 10),
      tglakhirRules: [function (v) {
        return !!v || 'Tanggal akhir belum diisi';
      }],
      dateFormatted: vm.formatDate(new Date(Date.now() - new Date().getTimezoneOffset() * 60000).toISOString().substr(0, 10)),
      dateFormatted2: vm.formatDate2(new Date(Date.now() - new Date().getTimezoneOffset() * 60000).toISOString().substr(0, 10)),
      pesaneror: [],
      menu1: false,
      menu2: false,
      menu3: false,
      modal1: false,
      modal2: false,
      // filterTglmulai:[vm.formatDate((new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10)),vm.formatDate((new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10))],
      filterDatemulai: [],
      filterDateakhir: [],
      //file: '',
      form: new Form({
        id: '',
        kantor_id: '',
        namamitra: '',
        namafile: '',
        tglmulai: '',
        tglakhir: '',
        file: ''
      })
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
        text: 'No PK',
        value: 'no_pk'
      }, {
        text: 'Nama Mitra',
        value: 'namamitra'
      }, {
        text: 'Jenis Kerjasama',
        value: 'namafile'
      }, {
        text: 'Tanggal Mulai',
        value: 'tglmulai'
      }, {
        text: 'Tanggal Berakhir',
        value: 'tglakhir'
      }];
      headers.push({
        text: 'Download File',
        value: 'file',
        sortable: false,
        align: 'center'
      });

      if (this.$gate.isAdmin()) {
        headers.push({
          text: 'Hapus',
          value: 'actions',
          sortable: false
        });
      }

      return headers;
    },
    computedDateFormatted: function computedDateFormatted() {
      return this.formatDate(this.editedItem.tglmulai);
    },
    filterTglmulai: function filterTglmulai() {
      if (Date.parse(this.filterDatemulai[1]) < Date.parse(this.filterDatemulai[0])) {
        var temp = this.filterDatemulai[1];
        this.filterDatemulai[1] = this.filterDatemulai[0];
        this.filterDatemulai[0] = temp;
      }

      return this.filterDatemulai.join(' s/d ');
    },
    filterTglakhir: function filterTglakhir() {
      if (Date.parse(this.filterDateakhir[1]) < Date.parse(this.filterDateakhir[0])) {
        var temp = this.filterDateakhir[1];
        this.filterDateakhir[1] = this.filterDateakhir[0];
        this.filterDateakhir[0] = temp;
      }

      return this.filterDateakhir.join(' s/d ');
    },
    formTitle: function formTitle() {
      return this.editedIndex === -1 ? 'New Item' : 'Edit Item';
    }
  },
  watch: {
    //   filterTglmulai (val) {
    //     this.filterTglmulai = this.filterDatemulai
    //   },
    tglmulai: function tglmulai(val) {
      this.dateFormatted = this.formatDate(this.tglmulai);
    },
    tglakhir: function tglakhir(val) {
      this.dateFormatted2 = this.formatDate2(this.tglakhir);
    },
    dialog: function dialog(val) {
      val || this.close();
    },
    dialog2: function dialog2(val) {
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
    this.$Progress.start(); //console.log(this.kantor_id)

    this.initialize();
    this.$Progress.finish();
  },
  methods: {
    save: function save() {
      this.snack = true;
      this.snackColor = 'success';
      this.snackText = 'Data disimpan';
      this.updateUser();
    },
    cancel: function cancel() {
      this.snack = true;
      this.snackColor = 'error';
      this.snackText = 'Dibatalkan';
    },
    open: function open(item) {
      this.snack = true;
      this.snackColor = 'info';
      this.snackText = 'Enter = Simpan';
      this.editedItem.id = item.id;
      this.editedItem.no_pk = item.no_pk;
      this.editedItem.namafile = item.namafile;
      this.editedItem.namamitra = item.namamitra; //console.log(this.item.namabarang);
      //alert(this.item.id)
    },
    close: function close() {
      console.log('Dialog closed');
    },
    getFiltertglmulai: function getFiltertglmulai() {
      var _this = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
        var formData;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                _this.$Progress.start();

                formData = new FormData();
                formData.set('tglmulai', _this.filterTglmulai);

                if (_this.filterTglmulai != '') {
                  if (_this.$gate.isAdmin() || _this.$gate.isUM() || _this.$gate.isSekdir()) {
                    axios.get("api/pk/filtertglmulai", {
                      params: {
                        tglmulai: _this.filterTglmulai
                      }
                    }).then(function (response) {
                      _this.pk = response.data.data; //this.kantor_id = this.$kantor_id;
                      // this.form.fill
                      //console.log(this.pk);
                      //  console.log(this.filterTglmulai)
                    })["catch"](function (error) {
                      console.log(error.response.data);
                    });
                  }
                } else {
                  //Swal.fire("Gagal Filter", "Filter Tanggal Belum Dipilih...!", "warning");
                  Swal.fire({
                    icon: 'error',
                    title: 'Error Filter',
                    text: 'Filter Tanggal Mulai Belum Dipilih...! ',
                    width: 600,
                    padding: '3em',
                    color: '#ff0000',
                    background: '#ff0000 url(/images/kayu.jpg)',
                    backdrop: "\n            rgba(255,0,64,0.4)\n            url(\"/images/nyan-cat.gif\")\n            left top\n            no-repeat\n        "
                  });
                }

                _this.$Progress.finish();

              case 5:
              case "end":
                return _context.stop();
            }
          }
        }, _callee);
      }))();
    },
    getFiltertglakhir: function getFiltertglakhir() {
      var _this2 = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2() {
        var formData;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
                _this2.$Progress.start();

                formData = new FormData();
                formData.set('tglakhir', _this2.filterTglakhir);

                if (_this2.filterTglakhir != '') {
                  if (_this2.$gate.isAdmin() || _this2.$gate.isUM() || _this2.$gate.isSekdir()) {
                    axios.get("api/pk/filtertglakhir", {
                      params: {
                        tglakhir: _this2.filterTglakhir
                      }
                    }).then(function (response) {
                      _this2.pk = response.data.data; //this.kantor_id = this.$kantor_id;
                      // this.form.fill
                      //console.log(this.pk);
                      // console.log(this.filterTglakhir)
                    })["catch"](function (error) {
                      console.log(error.response.data);
                    });
                  }
                } else {
                  //Swal.fire("Gagal Filter", "Filter Tanggal Belum Dipilih...!", "warning");
                  Swal.fire({
                    icon: 'error',
                    title: 'Error Filter',
                    text: 'Filter Tanggal Akhir Belum Dipilih...! ',
                    width: 600,
                    padding: '3em',
                    color: '#ff0000',
                    background: '#ff0000 url(/images/kayu.jpg)',
                    backdrop: "\n            rgba(255,0,64,0.4)\n            url(\"/images/nyan-cat.gif\")\n            left top\n            no-repeat\n        "
                  });
                }

                _this2.$Progress.finish();

              case 5:
              case "end":
                return _context2.stop();
            }
          }
        }, _callee2);
      }))();
    },
    norekKeyboard: function norekKeyboard(evt) {
      evt = evt ? evt : window.event;
      var charCode = evt.which ? evt.which : evt.keyCode; //nomer wungkul

      if (charCode > 31 && (charCode < 48 || charCode > 57) && (charCode < 95 || charCode > 105) && charCode !== 46 && charCode !== 75) {
        //tidak boleh tombol '/' dan '\'
        //if (charCode === 191 || charCode===220) {
        evt.preventDefault();
      } else {
        this.no_pk = this.no_pk.toUpperCase();
        return true;
      }
    },
    pencetKeyboard: function pencetKeyboard(evt) {
      evt = evt ? evt : window.event;
      var charCode = evt.which ? evt.which : evt.keyCode; //nomer wungkul
      //if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
      //tidak boleh tombol '/' dan '\'

      if (charCode === 191 || charCode === 220) {
        evt.preventDefault();
      } else {
        return true;
      }
    },
    formatDate: function formatDate(tglmulai) {
      if (!tglmulai) return null;

      var _tglmulai$split = tglmulai.split('-'),
          _tglmulai$split2 = _slicedToArray(_tglmulai$split, 3),
          year = _tglmulai$split2[0],
          month = _tglmulai$split2[1],
          day = _tglmulai$split2[2];

      return "".concat(day, "/").concat(month, "/").concat(year);
    },
    parseDate: function parseDate(tglmulai) {
      if (!tglmulai) return null;

      var _tglmulai$split3 = tglmulai.split('/'),
          _tglmulai$split4 = _slicedToArray(_tglmulai$split3, 3),
          day = _tglmulai$split4[0],
          month = _tglmulai$split4[1],
          year = _tglmulai$split4[2];

      return "".concat(year, "-").concat(month.padStart(2, '0'), "-").concat(day.padStart(2, '0'));
    },
    formatDate2: function formatDate2(tglakhir) {
      if (!tglakhir) return null;

      var _tglakhir$split = tglakhir.split('-'),
          _tglakhir$split2 = _slicedToArray(_tglakhir$split, 3),
          year = _tglakhir$split2[0],
          month = _tglakhir$split2[1],
          day = _tglakhir$split2[2];

      return "".concat(day, "/").concat(month, "/").concat(year);
    },
    parseDate2: function parseDate2(tglakhir) {
      if (!tglakhir) return null;

      var _tglakhir$split3 = tglakhir.split('/'),
          _tglakhir$split4 = _slicedToArray(_tglakhir$split3, 3),
          day = _tglakhir$split4[0],
          month = _tglakhir$split4[1],
          year = _tglakhir$split4[2];

      return "".concat(year, "-").concat(month.padStart(2, '0'), "-").concat(day.padStart(2, '0'));
    },
    initialize: function initialize() {
      var _this3 = this;

      this.$Progress.start();

      if (this.$gate.isAdmin() || this.$gate.isUM() || this.$gate.isSekdir()) {
        axios.get("api/pk").then(function (response) {
          _this3.pk = response.data.data;
          _this3.kantor_id = _this3.$kantor_id; // this.form.fill
          // console.log(this.pk);
          // console.log(this.kantor_id)
        });
      }

      this.$Progress.finish();
    },
    editModal: function editModal(item) {
      this.editmode = true;
      this.$refs.form.reset();
      $('#addNew').modal('show');
      this.form.fill(item);
    },
    newModal: function newModal() {
      this.editmode = false;
      $('#addNew').modal('show');
      this.$refs.form.reset();
      this.editedItem.namafile = '';
      this.editedItem.no_pk = '';
      this.editedItem.pesaneror = '';
    },
    createUser: function createUser() {
      var _this4 = this;

      this.$refs.form.validate();
      this.$Progress.start(); // e.preventDefault();

      var config = {
        headers: {
          'content-type': 'multipart/form-data'
        }
      }; // //this.append('file', this.file);

      var formData = new FormData();
      formData.set('kantor_id', this.kantor_id);
      formData.set('no_pk', this.editedItem.no_pk);
      formData.set('namamitra', this.editedItem.namamitra);
      formData.set('namafile', this.editedItem.namafile);
      formData.set('tglmulai', this.tglmulai);
      formData.set('tglakhir', this.tglakhir);
      formData.set('file', this.editedItem.file); // formData.append('file', this.file);
      // console.log(this.file);

      axios.post('api/pk', formData, config).then(function (response) {
        $('#addNew').modal('hide');
        Toast.fire({
          icon: 'success',
          title: response.data.message
        });

        _this4.$Progress.finish();

        _this4.initialize();
      })["catch"](function (error) {
        //Swal.fire("Gagal Upload", "Cek data inputan!", "warning");
        var errors = error.response.data.errors; // Loop this object and pring Key or value or both

        for (var _i2 = 0, _Object$entries = Object.entries(errors); _i2 < _Object$entries.length; _i2++) {
          var _Object$entries$_i = _slicedToArray(_Object$entries[_i2], 2),
              key = _Object$entries$_i[0],
              value = _Object$entries$_i[1];

          // console.log(`${key}: ${value}`);
          Toast.fire({
            icon: 'error',
            title: value //title : "Gagal upload, ulangi..."

          });
        }
      });
    },
    downloadFile: function downloadFile(id, file) {
      axios({
        url: 'api/pk/download/' + id,
        method: 'GET',
        responseType: 'blob'
      }).then(function (response) {
        var fileUrl = window.URL.createObjectURL(new Blob([response.data]));
        var fileLink = document.createElement('a');
        fileLink.href = fileUrl;
        fileLink.setAttribute('download', 'tabfile.zip');
        fileLink.download = file;
        document.body.appendChild(fileLink);
        fileLink.click();
      })["catch"](function () {
        Swal.fire("Gagal Download!", "File tidak ada...", "warning");
      });
    },
    updateUser: function updateUser() {
      var _this5 = this;

      var config = {
        headers: {
          'accept': 'application/json',
          'Accept-Language': 'en-US,en;q=0.8',
          'content-type': 'multipart/form-data'
        } // headers: {'X-Custom-Header': 'value'}

      };
      this.$Progress.start(); // console.log('Editing data');

      var formData = new FormData();
      formData.set('no_pk', this.editedItem.no_pk);
      formData.set('namafile', this.editedItem.namafile);
      formData.set('namamitra', this.editedItem.namamitra);
      formData.append("_method", "PUT");
      axios.post('api/pk/' + this.editedItem.id, formData).then(function (response) {
        // success
        $('#addNew').modal('hide');
        Toast.fire({
          icon: 'success',
          title: response.data.message
        });

        _this5.$Progress.finish(); //  Fire.$emit('AfterCreate');


        _this5.initialize();
      })["catch"](function () {
        _this5.$Progress.fail();
      });
    },
    deleteUser: function deleteUser(id) {
      var _this6 = this;

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
          _this6.form["delete"]('api/pk/' + id).then(function () {
            Swal.fire('Dihapus!', 'Data telah dihapus.', 'success'); // Fire.$emit('AfterCreate');

            _this6.initialize();
          })["catch"](function (data) {
            Swal.fire("Failed!", data.message, "warning");
          });
        }
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/umum/Pk.vue?vue&type=template&id=724ccc42&":
/*!**********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/umum/Pk.vue?vue&type=template&id=724ccc42& ***!
  \**********************************************************************************************************************************************************************************************************/
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
                { attrs: { cols: "11" } },
                [
                  _vm.$gate.isAdmin() ||
                  _vm.$gate.isUM() ||
                  _vm.$gate.isSekdir()
                    ? _c(
                        "v-card",
                        { staticClass: "pa-2 mx-auto" },
                        [
                          _c(
                            "v-toolbar",
                            {
                              attrs: {
                                src: "images/banner-yellow.jpg",
                                color: "yellow",
                                dark: "",
                                shaped: "",
                              },
                            },
                            [
                              _c("v-toolbar-title", [
                                _vm._v(
                                  "\r\n                    File Perjanjian Kerjasama\r\n                "
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
                                  _c("v-icon", [_vm._v("mdi-file-upload")]),
                                  _vm._v(" Upload File\r\n                  "),
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
                                  items: _vm.pk,
                                  search: _vm.search,
                                  justify: "center",
                                  dense: "",
                                },
                                scopedSlots: _vm._u(
                                  [
                                    {
                                      key: "item.tglmulai",
                                      fn: function (ref) {
                                        var item = ref.item
                                        return [
                                          _vm._v(
                                            "\r\n                " +
                                              _vm._s(
                                                _vm.formatDate(item.tglmulai)
                                              ) +
                                              "\r\n                "
                                          ),
                                        ]
                                      },
                                    },
                                    {
                                      key: "item.tglakhir",
                                      fn: function (ref) {
                                        var item = ref.item
                                        return [
                                          _vm._v(
                                            "\r\n                " +
                                              _vm._s(
                                                _vm.formatDate2(item.tglakhir)
                                              ) +
                                              "\r\n                "
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
                                                "v-dialog",
                                                {
                                                  ref: "dialog",
                                                  attrs: {
                                                    "return-value":
                                                      _vm.filterDatemulai,
                                                    persistent: "",
                                                    width: "290px",
                                                  },
                                                  on: {
                                                    "update:returnValue":
                                                      function ($event) {
                                                        _vm.filterDatemulai =
                                                          $event
                                                      },
                                                    "update:return-value":
                                                      function ($event) {
                                                        _vm.filterDatemulai =
                                                          $event
                                                      },
                                                  },
                                                  scopedSlots: _vm._u(
                                                    [
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
                                                                      label:
                                                                        "Filter Tanggal Mulai",
                                                                      placeholder:
                                                                        "Filter Tanggal Mulai",
                                                                      "prepend-icon":
                                                                        "mdi-calendar",
                                                                      "single-line":
                                                                        "",
                                                                      "hide-details":
                                                                        "",
                                                                      readonly:
                                                                        "",
                                                                      clearable:
                                                                        "",
                                                                      "return-object": false,
                                                                      "persistent-hint":
                                                                        "",
                                                                      "error-messages":
                                                                        _vm.pesaneror,
                                                                    },
                                                                    model: {
                                                                      value:
                                                                        _vm.filterTglmulai,
                                                                      callback:
                                                                        function (
                                                                          $$v
                                                                        ) {
                                                                          _vm.filterTglmulai =
                                                                            $$v
                                                                        },
                                                                      expression:
                                                                        "filterTglmulai",
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
                                                    3336465079
                                                  ),
                                                  model: {
                                                    value: _vm.modal1,
                                                    callback: function ($$v) {
                                                      _vm.modal1 = $$v
                                                    },
                                                    expression: "modal1",
                                                  },
                                                },
                                                [
                                                  _vm._v(" "),
                                                  _c(
                                                    "v-date-picker",
                                                    {
                                                      attrs: {
                                                        range: "",
                                                        scrollable: "",
                                                        "year-icon":
                                                          "calendar-blank",
                                                        locale: "id-ID",
                                                        elevation: "15",
                                                      },
                                                      model: {
                                                        value:
                                                          _vm.filterDatemulai,
                                                        callback: function (
                                                          $$v
                                                        ) {
                                                          _vm.filterDatemulai =
                                                            $$v
                                                        },
                                                        expression:
                                                          "filterDatemulai",
                                                      },
                                                    },
                                                    [
                                                      _c("v-spacer"),
                                                      _vm._v(" "),
                                                      _c(
                                                        "v-btn",
                                                        {
                                                          attrs: {
                                                            text: "",
                                                            color: "primary",
                                                          },
                                                          on: {
                                                            click: function (
                                                              $event
                                                            ) {
                                                              _vm.modal1 = false
                                                            },
                                                          },
                                                        },
                                                        [
                                                          _vm._v(
                                                            "\r\n                                        Batal\r\n                                    "
                                                          ),
                                                        ]
                                                      ),
                                                      _vm._v(" "),
                                                      _c(
                                                        "v-btn",
                                                        {
                                                          attrs: {
                                                            text: "",
                                                            color: "primary",
                                                          },
                                                          on: {
                                                            click: function (
                                                              $event
                                                            ) {
                                                              _vm.$refs.dialog.save(
                                                                _vm.filterDatemulai
                                                              ),
                                                                _vm.getFiltertglmulai()
                                                            },
                                                          },
                                                        },
                                                        [
                                                          _vm._v(
                                                            "\r\n                                        OK\r\n                                    "
                                                          ),
                                                        ]
                                                      ),
                                                    ],
                                                    1
                                                  ),
                                                ],
                                                1
                                              ),
                                              _vm._v(" "),
                                              _c("has-error", {
                                                attrs: {
                                                  form: _vm.form,
                                                  field: "filterTglmulai",
                                                },
                                              }),
                                              _vm._v(" "),
                                              _c("v-spacer"),
                                              _vm._v(" "),
                                              _c("v-spacer"),
                                              _vm._v(" "),
                                              _c(
                                                "v-dialog",
                                                {
                                                  ref: "dialog2",
                                                  attrs: {
                                                    "return-value":
                                                      _vm.filterDateakhir,
                                                    persistent: "",
                                                    width: "290px",
                                                  },
                                                  on: {
                                                    "update:returnValue":
                                                      function ($event) {
                                                        _vm.filterDateakhir =
                                                          $event
                                                      },
                                                    "update:return-value":
                                                      function ($event) {
                                                        _vm.filterDateakhir =
                                                          $event
                                                      },
                                                  },
                                                  scopedSlots: _vm._u(
                                                    [
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
                                                                      label:
                                                                        "Filter Tanggal Akhir",
                                                                      placeholder:
                                                                        "Filter Tanggal Akhir",
                                                                      "prepend-icon":
                                                                        "mdi-calendar",
                                                                      "single-line":
                                                                        "",
                                                                      "hide-details":
                                                                        "",
                                                                      readonly:
                                                                        "",
                                                                      clearable:
                                                                        "",
                                                                      "return-object": false,
                                                                      "persistent-hint":
                                                                        "",
                                                                      "error-messages":
                                                                        _vm.pesaneror,
                                                                    },
                                                                    model: {
                                                                      value:
                                                                        _vm.filterTglakhir,
                                                                      callback:
                                                                        function (
                                                                          $$v
                                                                        ) {
                                                                          _vm.filterTglakhir =
                                                                            $$v
                                                                        },
                                                                      expression:
                                                                        "filterTglakhir",
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
                                                    2865023058
                                                  ),
                                                  model: {
                                                    value: _vm.modal2,
                                                    callback: function ($$v) {
                                                      _vm.modal2 = $$v
                                                    },
                                                    expression: "modal2",
                                                  },
                                                },
                                                [
                                                  _vm._v(" "),
                                                  _c(
                                                    "v-date-picker",
                                                    {
                                                      attrs: {
                                                        range: "",
                                                        scrollable: "",
                                                        "year-icon":
                                                          "calendar-blank",
                                                        locale: "id-ID",
                                                        elevation: "15",
                                                      },
                                                      model: {
                                                        value:
                                                          _vm.filterDateakhir,
                                                        callback: function (
                                                          $$v
                                                        ) {
                                                          _vm.filterDateakhir =
                                                            $$v
                                                        },
                                                        expression:
                                                          "filterDateakhir",
                                                      },
                                                    },
                                                    [
                                                      _c("v-spacer"),
                                                      _vm._v(" "),
                                                      _c(
                                                        "v-btn",
                                                        {
                                                          attrs: {
                                                            text: "",
                                                            color: "primary",
                                                          },
                                                          on: {
                                                            click: function (
                                                              $event
                                                            ) {
                                                              _vm.modal2 = false
                                                            },
                                                          },
                                                        },
                                                        [
                                                          _vm._v(
                                                            "\r\n                                        Batal\r\n                                    "
                                                          ),
                                                        ]
                                                      ),
                                                      _vm._v(" "),
                                                      _c(
                                                        "v-btn",
                                                        {
                                                          attrs: {
                                                            text: "",
                                                            color: "primary",
                                                          },
                                                          on: {
                                                            click: function (
                                                              $event
                                                            ) {
                                                              _vm.$refs.dialog2.save(
                                                                _vm.filterDateakhir
                                                              ),
                                                                _vm.getFiltertglakhir()
                                                            },
                                                          },
                                                        },
                                                        [
                                                          _vm._v(
                                                            "\r\n                                        OK\r\n                                    "
                                                          ),
                                                        ]
                                                      ),
                                                    ],
                                                    1
                                                  ),
                                                ],
                                                1
                                              ),
                                              _vm._v(" "),
                                              _c("has-error", {
                                                attrs: {
                                                  form: _vm.form,
                                                  field: "filterTglakhir",
                                                },
                                              }),
                                              _vm._v(" "),
                                              _c("v-spacer"),
                                              _vm._v(" "),
                                              _c("v-spacer"),
                                              _vm._v(" "),
                                              _c("v-text-field", {
                                                attrs: {
                                                  "append-icon": "mdi-magnify",
                                                  label: "Cari File",
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
                                      key: "item.file",
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
                                                  staticClass: "mr-4",
                                                  attrs: {
                                                    small: "",
                                                    color: "blue",
                                                  },
                                                  on: {
                                                    click: function ($event) {
                                                      return _vm.downloadFile(
                                                        item.id,
                                                        item.file
                                                      )
                                                    },
                                                  },
                                                },
                                                [
                                                  _vm._v(
                                                    "\r\n                            mdi-download\r\n                        "
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
                                              staticClass: "mr-4",
                                              attrs: {
                                                small: "",
                                                color: "red",
                                                right: "",
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
                                    {
                                      key: "item.no_pk",
                                      fn: function (ref) {
                                        var item = ref.item
                                        return [
                                          _c(
                                            "v-edit-dialog",
                                            {
                                              on: {
                                                save: _vm.save,
                                                cancel: _vm.cancel,
                                                open: function ($event) {
                                                  return _vm.open(item)
                                                },
                                                close: _vm.close,
                                              },
                                              scopedSlots: _vm._u(
                                                [
                                                  {
                                                    key: "input",
                                                    fn: function () {
                                                      return [
                                                        _c(
                                                          "div",
                                                          {
                                                            staticClass:
                                                              "mt-4 text-h6",
                                                          },
                                                          [
                                                            _vm._v(
                                                              "\r\n                            Edit Jenis PKS\r\n                            "
                                                            ),
                                                          ]
                                                        ),
                                                        _vm._v(" "),
                                                        _c("v-text-field", {
                                                          attrs: {
                                                            rules: [
                                                              _vm.max200chars,
                                                            ],
                                                            label: "Edit",
                                                            "single-line": "",
                                                            counter: "",
                                                          },
                                                          model: {
                                                            value:
                                                              _vm.editedItem
                                                                .no_pk,
                                                            callback: function (
                                                              $$v
                                                            ) {
                                                              _vm.$set(
                                                                _vm.editedItem,
                                                                "no_pk",
                                                                $$v
                                                              )
                                                            },
                                                            expression:
                                                              "editedItem.no_pk",
                                                          },
                                                        }),
                                                      ]
                                                    },
                                                    proxy: true,
                                                  },
                                                ],
                                                null,
                                                true
                                              ),
                                            },
                                            [
                                              _vm._v(
                                                "\r\n                        " +
                                                  _vm._s(item.no_pk) +
                                                  "\r\n                        "
                                              ),
                                            ]
                                          ),
                                        ]
                                      },
                                    },
                                    {
                                      key: "item.namafile",
                                      fn: function (ref) {
                                        var item = ref.item
                                        return [
                                          _c(
                                            "v-edit-dialog",
                                            {
                                              on: {
                                                save: _vm.save,
                                                cancel: _vm.cancel,
                                                open: function ($event) {
                                                  return _vm.open(item)
                                                },
                                                close: _vm.close,
                                              },
                                              scopedSlots: _vm._u(
                                                [
                                                  {
                                                    key: "input",
                                                    fn: function () {
                                                      return [
                                                        _c(
                                                          "div",
                                                          {
                                                            staticClass:
                                                              "mt-4 text-h6",
                                                          },
                                                          [
                                                            _vm._v(
                                                              "\r\n                            Edit Jenis PKS\r\n                            "
                                                            ),
                                                          ]
                                                        ),
                                                        _vm._v(" "),
                                                        _c("v-text-field", {
                                                          attrs: {
                                                            rules: [
                                                              _vm.max200chars,
                                                            ],
                                                            label: "Edit",
                                                            "single-line": "",
                                                            counter: "",
                                                          },
                                                          model: {
                                                            value:
                                                              _vm.editedItem
                                                                .namafile,
                                                            callback: function (
                                                              $$v
                                                            ) {
                                                              _vm.$set(
                                                                _vm.editedItem,
                                                                "namafile",
                                                                $$v
                                                              )
                                                            },
                                                            expression:
                                                              "editedItem.namafile",
                                                          },
                                                        }),
                                                      ]
                                                    },
                                                    proxy: true,
                                                  },
                                                ],
                                                null,
                                                true
                                              ),
                                            },
                                            [
                                              _vm._v(
                                                "\r\n                        " +
                                                  _vm._s(item.namafile) +
                                                  "\r\n                        "
                                              ),
                                            ]
                                          ),
                                        ]
                                      },
                                    },
                                    {
                                      key: "item.namamitra",
                                      fn: function (ref) {
                                        var item = ref.item
                                        return [
                                          _c(
                                            "v-edit-dialog",
                                            {
                                              on: {
                                                save: _vm.save,
                                                cancel: _vm.cancel,
                                                open: function ($event) {
                                                  return _vm.open(item)
                                                },
                                                close: _vm.close,
                                              },
                                              scopedSlots: _vm._u(
                                                [
                                                  {
                                                    key: "input",
                                                    fn: function () {
                                                      return [
                                                        _c(
                                                          "div",
                                                          {
                                                            staticClass:
                                                              "mt-4 text-h6",
                                                          },
                                                          [
                                                            _vm._v(
                                                              "\r\n                            Edit Nama Mitra\r\n                            "
                                                            ),
                                                          ]
                                                        ),
                                                        _vm._v(" "),
                                                        _c("v-text-field", {
                                                          attrs: {
                                                            rules: [
                                                              _vm.max200chars,
                                                            ],
                                                            label: "Edit",
                                                            "single-line": "",
                                                            counter: "",
                                                          },
                                                          model: {
                                                            value:
                                                              _vm.editedItem
                                                                .namamitra,
                                                            callback: function (
                                                              $$v
                                                            ) {
                                                              _vm.$set(
                                                                _vm.editedItem,
                                                                "namamitra",
                                                                $$v
                                                              )
                                                            },
                                                            expression:
                                                              "editedItem.namamitra",
                                                          },
                                                        }),
                                                      ]
                                                    },
                                                    proxy: true,
                                                  },
                                                ],
                                                null,
                                                true
                                              ),
                                            },
                                            [
                                              _vm._v(
                                                "\r\n                        " +
                                                  _vm._s(item.namamitra) +
                                                  "\r\n                        "
                                              ),
                                            ]
                                          ),
                                        ]
                                      },
                                    },
                                  ],
                                  null,
                                  false,
                                  1225602059
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
          !_vm.$gate.isAdmin() && !_vm.$gate.isUM() && !_vm.$gate.isSekdir()
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
                      _c("div", { staticClass: "modal-header" }, [
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
                          },
                          [_vm._v("Upload File")]
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
                          [_vm._v("Edit Data User")]
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
                              return _vm.createUser.apply(null, arguments)
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
                          _c("div", { staticClass: "modal-body" }, [
                            _c("input", {
                              directives: [
                                {
                                  name: "model",
                                  rawName: "v-model",
                                  value: _vm.kantor_id,
                                  expression: "kantor_id",
                                },
                              ],
                              attrs: { type: "hidden", name: "kantor_id" },
                              domProps: { value: _vm.kantor_id },
                              on: {
                                input: function ($event) {
                                  if ($event.target.composing) {
                                    return
                                  }
                                  _vm.kantor_id = $event.target.value
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
                              "div",
                              { staticClass: "form-group input-group" },
                              [
                                _c(
                                  "v-col",
                                  { attrs: { cols: "12", sm: "12", md: "12" } },
                                  [
                                    _c("v-text-field", {
                                      attrs: {
                                        rules: _vm.editedItem.nopkRules,
                                        name: "no_pk",
                                        label: "Nomor PKS",
                                        placeholder: "input no. pks",
                                        counter: "",
                                        maxlength: "100",
                                        outlined: "",
                                        required: "",
                                        dense: "",
                                        "prepend-icon": "mdi-file",
                                        hint: "",
                                        "persistent-hint": "",
                                        "error-messages": _vm.pesaneror,
                                      },
                                      model: {
                                        value: _vm.editedItem.no_pk,
                                        callback: function ($$v) {
                                          _vm.$set(_vm.editedItem, "no_pk", $$v)
                                        },
                                        expression: "editedItem.no_pk",
                                      },
                                    }),
                                    _vm._v(" "),
                                    _c("has-error", {
                                      attrs: { form: _vm.form, field: "no_pk" },
                                    }),
                                    _vm._v(" "),
                                    _c("v-text-field", {
                                      attrs: {
                                        rules: _vm.editedItem.namemitraRules,
                                        name: "namamitra",
                                        label: "Nama Mitra",
                                        placeholder: "input nama mitra",
                                        outlined: "",
                                        required: "",
                                        dense: "",
                                        "prepend-icon": "mdi-file",
                                      },
                                      model: {
                                        value: _vm.editedItem.namamitra,
                                        callback: function ($$v) {
                                          _vm.$set(
                                            _vm.editedItem,
                                            "namamitra",
                                            $$v
                                          )
                                        },
                                        expression: "editedItem.namamitra",
                                      },
                                    }),
                                    _vm._v(" "),
                                    _c("has-error", {
                                      attrs: {
                                        form: _vm.form,
                                        field: "namafile",
                                      },
                                    }),
                                    _vm._v(" "),
                                    _c("v-text-field", {
                                      attrs: {
                                        rules: _vm.editedItem.nameRules,
                                        name: "namafile",
                                        label: "Jenis Kerjasama",
                                        placeholder: "input PKS",
                                        outlined: "",
                                        required: "",
                                        dense: "",
                                        "prepend-icon": "mdi-file",
                                      },
                                      model: {
                                        value: _vm.editedItem.namafile,
                                        callback: function ($$v) {
                                          _vm.$set(
                                            _vm.editedItem,
                                            "namafile",
                                            $$v
                                          )
                                        },
                                        expression: "editedItem.namafile",
                                      },
                                    }),
                                    _vm._v(" "),
                                    _c("has-error", {
                                      attrs: {
                                        form: _vm.form,
                                        field: "namafile",
                                      },
                                    }),
                                    _vm._v(" "),
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
                                                            _vm.tglmulaiRules,
                                                          label:
                                                            "Tanggal Mulai",
                                                          placeholder:
                                                            "Tanggal Mulai PKS",
                                                          "prepend-icon":
                                                            "mdi-calendar",
                                                          outlined: "",
                                                          required: "",
                                                          dense: "",
                                                        },
                                                        on: {
                                                          blur: function (
                                                            $event
                                                          ) {
                                                            _vm.tglmulai =
                                                              _vm.parseDate(
                                                                _vm.dateFormatted
                                                              )
                                                          },
                                                        },
                                                        model: {
                                                          value:
                                                            _vm.dateFormatted,
                                                          callback: function (
                                                            $$v
                                                          ) {
                                                            _vm.dateFormatted =
                                                              $$v
                                                          },
                                                          expression:
                                                            "dateFormatted",
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
                                            value: _vm.tglmulai,
                                            callback: function ($$v) {
                                              _vm.tglmulai = $$v
                                            },
                                            expression: "tglmulai",
                                          },
                                        }),
                                      ],
                                      1
                                    ),
                                    _vm._v(" "),
                                    _c("has-error", {
                                      attrs: {
                                        form: _vm.form,
                                        field: "tglmulai",
                                      },
                                    }),
                                    _vm._v(" "),
                                    _c(
                                      "v-menu",
                                      {
                                        ref: "menu2",
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
                                                            _vm.tglakhirRules,
                                                          label:
                                                            "Tanggal Akhir",
                                                          placeholder:
                                                            "Tanggal Akhir PKS",
                                                          "prepend-icon":
                                                            "mdi-calendar",
                                                          outlined: "",
                                                          required: "",
                                                          dense: "",
                                                        },
                                                        on: {
                                                          blur: function (
                                                            $event
                                                          ) {
                                                            _vm.tglakhir =
                                                              _vm.parseDate2(
                                                                _vm.dateFormatted2
                                                              )
                                                          },
                                                        },
                                                        model: {
                                                          value:
                                                            _vm.dateFormatted2,
                                                          callback: function (
                                                            $$v
                                                          ) {
                                                            _vm.dateFormatted2 =
                                                              $$v
                                                          },
                                                          expression:
                                                            "dateFormatted2",
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
                                          value: _vm.menu2,
                                          callback: function ($$v) {
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
                                            "year-icon": "calendar-blank",
                                            locale: "id-ID",
                                          },
                                          on: {
                                            input: function ($event) {
                                              _vm.menu2 = false
                                            },
                                          },
                                          model: {
                                            value: _vm.tglakhir,
                                            callback: function ($$v) {
                                              _vm.tglakhir = $$v
                                            },
                                            expression: "tglakhir",
                                          },
                                        }),
                                      ],
                                      1
                                    ),
                                    _vm._v(" "),
                                    _c("has-error", {
                                      attrs: {
                                        form: _vm.form,
                                        field: "tglakhir",
                                      },
                                    }),
                                    _vm._v(" "),
                                    [
                                      _c("v-file-input", {
                                        attrs: {
                                          rules: _vm.editedItem.fileRules,
                                          color: "deep-purple accent-4",
                                          counter: "",
                                          label: "File input",
                                          required: "",
                                          placeholder: "Ambil File",
                                          "prepend-icon": "mdi-paperclip",
                                          outlined: "",
                                          dense: "",
                                          "show-size": "",
                                          accept: ".pdf",
                                        },
                                        scopedSlots: _vm._u([
                                          {
                                            key: "selection",
                                            fn: function (ref) {
                                              var index = ref.index
                                              var text = ref.text
                                              return [
                                                index < 2
                                                  ? _c(
                                                      "v-chip",
                                                      {
                                                        attrs: {
                                                          color:
                                                            "deep-purple accent-4",
                                                          dark: "",
                                                          label: "",
                                                          small: "",
                                                        },
                                                      },
                                                      [
                                                        _vm._v(
                                                          "\r\n                                    " +
                                                            _vm._s(text) +
                                                            "\r\n                                "
                                                        ),
                                                      ]
                                                    )
                                                  : index === 2
                                                  ? _c(
                                                      "span",
                                                      {
                                                        staticClass:
                                                          "text-overline grey--text text--darken-3 mx-2",
                                                      },
                                                      [
                                                        _vm._v(
                                                          "\r\n                                    +" +
                                                            _vm._s(
                                                              _vm.files.length -
                                                                2
                                                            ) +
                                                            " File(s)\r\n                                "
                                                        ),
                                                      ]
                                                    )
                                                  : _vm._e(),
                                              ]
                                            },
                                          },
                                        ]),
                                        model: {
                                          value: _vm.editedItem.file,
                                          callback: function ($$v) {
                                            _vm.$set(
                                              _vm.editedItem,
                                              "file",
                                              $$v
                                            )
                                          },
                                          expression: "editedItem.file",
                                        },
                                      }),
                                    ],
                                    _vm._v(" "),
                                    _c("has-error", {
                                      attrs: { form: _vm.form, field: "file" },
                                    }),
                                  ],
                                  2
                                ),
                              ],
                              1
                            ),
                          ]),
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
                                  _c("v-icon", [_vm._v("mdi-file-upload")]),
                                  _vm._v(
                                    "\r\n                            Upload\r\n                        "
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

/***/ "./resources/js/components/umum/Pk.vue":
/*!*********************************************!*\
  !*** ./resources/js/components/umum/Pk.vue ***!
  \*********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Pk_vue_vue_type_template_id_724ccc42___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Pk.vue?vue&type=template&id=724ccc42& */ "./resources/js/components/umum/Pk.vue?vue&type=template&id=724ccc42&");
/* harmony import */ var _Pk_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Pk.vue?vue&type=script&lang=js& */ "./resources/js/components/umum/Pk.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Pk_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Pk_vue_vue_type_template_id_724ccc42___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Pk_vue_vue_type_template_id_724ccc42___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/umum/Pk.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/umum/Pk.vue?vue&type=script&lang=js&":
/*!**********************************************************************!*\
  !*** ./resources/js/components/umum/Pk.vue?vue&type=script&lang=js& ***!
  \**********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Pk_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./Pk.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/umum/Pk.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Pk_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/umum/Pk.vue?vue&type=template&id=724ccc42&":
/*!****************************************************************************!*\
  !*** ./resources/js/components/umum/Pk.vue?vue&type=template&id=724ccc42& ***!
  \****************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Pk_vue_vue_type_template_id_724ccc42___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./Pk.vue?vue&type=template&id=724ccc42& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/umum/Pk.vue?vue&type=template&id=724ccc42&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Pk_vue_vue_type_template_id_724ccc42___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Pk_vue_vue_type_template_id_724ccc42___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);