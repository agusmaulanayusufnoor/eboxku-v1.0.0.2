(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[5],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/akunting/Overbooking.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/akunting/Overbooking.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

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
/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data(vm) {
    return {
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      editmode: false,
      dialog: false,
      dialogDelete: false,
      search: '',
      //   headers: [
      //     {
      //     text: 'No',
      //     value: 'index',
      //     },
      //     { text: 'Kantor', value: 'nama_kantor',align: 'start', },
      //     {
      //       text: 'Nama File',
      //       value: 'namafile',
      //     },
      //     { text: 'Tanggal File', value: 'tanggal' },
      //     { text: 'Download File', value: 'file', sortable: false,align: 'center'  },
      //     { text: 'Hapus', value: 'actions', sortable: false },
      //   ],
      namaOtorisator: [],
      otorisator_id: '',
      nama_kantor: '',
      namaKantor: [],
      pesaneror: '',
      overbooking: [],
      valid: true,
      file: null,
      id: '',
      kantor_id: '',
      namafile: '',
      nameRules: [function (v) {
        return !!v || 'Nama file belum diisi';
      }],
      menu1: false,
      menu2: false,
      dateFormatted: vm.formatDate(new Date(Date.now() - new Date().getTimezoneOffset() * 60000).toISOString().substr(0, 10)),
      tanggal: new Date(Date.now() - new Date().getTimezoneOffset() * 60000).toISOString().substr(0, 10),
      tanggalRules: [function (v) {
        return !!v || 'Tanggal file belum diisi';
      }],
      fileRules: [function (v) {
        return !!v || 'File belum dimasukan';
      }],
      //file: '',
      form: new Form({
        id: '',
        kantor_id: '',
        namafile: '',
        tanggal: '',
        otorisator_id: '',
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
        text: 'Kantor',
        value: 'nama_kantor',
        align: 'start'
      }, {
        text: 'Nama File',
        value: 'namafile'
      }, {
        text: 'Tanggal File',
        value: 'tanggal'
      }, {
        text: 'Otorisator',
        value: 'namaotorisator'
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
      return this.formatDate(this.tanggal);
    },
    formTitle: function formTitle() {
      return this.editedIndex === -1 ? 'New Item' : 'Edit Item';
    }
  },
  watch: {
    tanggal: function tanggal(val) {
      this.dateFormatted = this.formatDate(this.tanggal);
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
    console.log(this.kantor_id);
    this.initialize();
    this.$Progress.finish();
    this.$refs.cboto.reset();
    this.$refs.cbkantor.reset();
  },
  methods: {
    pencetKeyboard: function pencetKeyboard(evt) {
      evt = evt ? evt : window.event;
      var charCode = evt.which ? evt.which : evt.keyCode; //nomer wungkul
      //if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
      //tidak boleh tombol '/' dan '\'

      if (charCode === 191 || charCode === 220) {
        evt.preventDefault();
        ;
      } else {
        return true;
      }
    },
    formatDate: function formatDate(tanggal) {
      if (!tanggal) return null;

      var _tanggal$split = tanggal.split('-'),
          _tanggal$split2 = _slicedToArray(_tanggal$split, 3),
          year = _tanggal$split2[0],
          month = _tanggal$split2[1],
          day = _tanggal$split2[2];

      return "".concat(day, "/").concat(month, "/").concat(year);
    },
    parseDate: function parseDate(tanggal) {
      if (!tanggal) return null;

      var _tanggal$split3 = tanggal.split('/'),
          _tanggal$split4 = _slicedToArray(_tanggal$split3, 3),
          day = _tanggal$split4[0],
          month = _tanggal$split4[1],
          year = _tanggal$split4[2];

      return "".concat(year, "-").concat(month.padStart(2, '0'), "-").concat(day.padStart(2, '0'));
    },
    getOtorisator: function getOtorisator() {
      var _this = this;

      if (this.$gate.isAdmin() || this.$gate.isAK()) {
        //axios.get("api/user").then((response) => {(this.users = response.data.data)});
        axios.get("api/overbooking/getotorisator").then(function (response) {
          _this.namaOtorisator = response.data.data; //console.log(this.editedItem.namaBarang);
          //console.log(this.kantor_id)
        })["catch"](function (error) {
          console.log(error.response.data);
        });
      }
    },
    getKantor: function getKantor() {
      var _this2 = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                if (_this2.$gate.isAdmin()) {
                  //axios.get("api/user").then((response) => {(this.users = response.data.data)});
                  axios.get("api/overbooking/getkantor").then(function (response) {
                    _this2.namaKantor = response.data.data;
                    console.log(_this2.namaKantor);
                    console.log(_this2.kantor_id);
                  })["catch"](function (error) {
                    console.log(error.response.data);
                  });
                }

              case 1:
              case "end":
                return _context.stop();
            }
          }
        }, _callee);
      }))();
    },
    filterKantor: function filterKantor() {
      var _this3 = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2() {
        var formData;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
                _this3.$Progress.start();

                formData = new FormData();
                formData.set('kantor_id', _this3.nama_kantor);

                if (_this3.nama_kantor != '') {
                  if (_this3.$gate.isAdmin()) {
                    axios.get("api/overbooking/filterkantor", {
                      params: {
                        kantor_id: _this3.nama_kantor
                      }
                    }).then(function (response) {
                      _this3.overbooking = response.data.data;
                      _this3.kantor_id = _this3.$kantor_id; // this.form.fill
                      // console.log(this.overbooking);
                      // console.log(this.kantor_id)
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

                _this3.$Progress.finish();

              case 5:
              case "end":
                return _context2.stop();
            }
          }
        }, _callee2);
      }))();
    },
    filterOtorisator: function filterOtorisator() {
      var _this4 = this;

      return _asyncToGenerator( /*#__PURE__*/_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee3() {
        var formData;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee3$(_context3) {
          while (1) {
            switch (_context3.prev = _context3.next) {
              case 0:
                _this4.$Progress.start();

                formData = new FormData();
                formData.set('otorisator_id', _this4.otorisator_id);

                if (_this4.otorisator_id != '') {
                  if (_this4.$gate.isAdmin() || _this4.$gate.isAK()) {
                    axios.get("api/overbooking/filterotorisator", {
                      params: {
                        otorisator_id: _this4.otorisator_id
                      }
                    }).then(function (response) {
                      _this4.overbooking = response.data.data;
                      _this4.otorisator_id = _this4.$otorisator_id; // this.form.fill
                      // console.log(this.overbooking);
                      // console.log(this.kantor_id)
                    })["catch"](function (error) {
                      console.log(error.response.data);
                    });
                  }
                } else {
                  //Swal.fire("Gagal Filter", "Filter Tanggal Belum Dipilih...!", "warning");
                  Swal.fire({
                    icon: 'error',
                    title: 'Error Filter',
                    text: 'Filter Otorisator Belum Dipilih...! ',
                    width: 600,
                    padding: '3em',
                    color: '#ff0000',
                    background: '#ff0000 url(/images/kayu.jpg)',
                    backdrop: "\n            rgba(255,0,64,0.4)\n            url(\"/images/nyan-cat.gif\")\n            left top\n            no-repeat\n          "
                  });
                }

                _this4.$Progress.finish();

              case 5:
              case "end":
                return _context3.stop();
            }
          }
        }, _callee3);
      }))();
    },
    initialize: function initialize() {
      var _this5 = this;

      this.$Progress.start();

      if (this.$gate.isAdmin() || this.$gate.isAK()) {
        //axios.get("api/user").then((response) => {(this.users = response.data.data)});
        axios.get("api/overbooking").then(function (response) {
          _this5.overbooking = response.data.data;
          _this5.kantor_id = _this5.$kantor_id; // this.form.fill
          //console.log(this.overbooking);
          //console.log(this.kantor_id)
        });
      } //this.$refs.CBKantor.reset();


      this.$Progress.finish();
      this.$refs.cboto.reset();
      this.$refs.cbkantor.reset();
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
      this.namafile = '';
    },
    // uploadFile(e){
    //         // `files` is always an array because the file input may be in multiple mode
    //         console.log(e);
    //         this.file = e.target.files[0];
    // },
    createUser: function createUser() {
      var _this6 = this;

      this.$refs.form.validate();
      this.$Progress.start(); // e.preventDefault();

      var config = {
        headers: {
          'content-type': 'multipart/form-data'
        }
      }; // //this.append('file', this.file);

      var formData = new FormData();
      formData.set('kantor_id', this.kantor_id);
      formData.set('namafile', this.namafile);
      formData.set('tanggal', this.tanggal);
      formData.set('otorisator_id', this.otorisator_id);
      formData.set('file', this.file); // formData.append('file', this.file);

      console.log(this.kantor_id);
      axios.post('api/overbooking', formData, config).then(function (response) {
        $('#addNew').modal('hide');
        Toast.fire({
          icon: 'success',
          title: response.data.message
        });

        _this6.$Progress.finish();

        _this6.initialize();
      })["catch"](function (error) {
        //Swal.fire("Failed!", data.message, "warning");
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
        url: 'api/overbooking/download/' + id,
        method: 'GET',
        responseType: 'blob'
      }).then(function (response) {
        var fileUrl = window.URL.createObjectURL(new Blob([response.data]));
        var fileLink = document.createElement('a');
        fileLink.href = fileUrl;
        fileLink.setAttribute('download', 'overbooking.zip');
        fileLink.download = file;
        document.body.appendChild(fileLink);
        fileLink.click();
      })["catch"](function () {
        Swal.fire("Gagal Download!", "File tidak ada...", "warning");
      });
    },
    updateUser: function updateUser() {
      var _this7 = this;

      this.$Progress.start(); // console.log('Editing data');

      this.form.put('api/overbooking/' + this.form.id).then(function (response) {
        // success
        $('#addNew').modal('hide');
        Toast.fire({
          icon: 'success',
          title: response.data.message
        });

        _this7.$Progress.finish(); //  Fire.$emit('AfterCreate');


        _this7.initialize();
      })["catch"](function () {
        _this7.$Progress.fail();
      });
    },
    deleteUser: function deleteUser(id) {
      var _this8 = this;

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
          _this8.form["delete"]('api/overbooking/' + id).then(function () {
            Swal.fire('Dihapus!', 'Data telah dihapus.', 'success'); // Fire.$emit('AfterCreate');

            _this8.initialize();
          })["catch"](function (data) {
            Swal.fire("Failed!", data.message, "warning");
          });
        }
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/akunting/Overbooking.vue?vue&type=template&id=73efdad2&":
/*!***********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/akunting/Overbooking.vue?vue&type=template&id=73efdad2& ***!
  \***********************************************************************************************************************************************************************************************************************/
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
                  _vm.$gate.isAdmin() || _vm.$gate.isAK()
                    ? _c(
                        "v-card",
                        { staticClass: "pa-2 mx-auto" },
                        [
                          _c(
                            "v-toolbar",
                            {
                              attrs: {
                                src: "images/banner-biru-akunting.jpg",
                                color: "rgb(39,154,187)",
                                dark: "",
                                shaped: "",
                              },
                            },
                            [
                              _c("v-toolbar-title", [
                                _vm._v(
                                  "\n                    File Overbooking\n                "
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
                                  _vm._v(" Upload File\n                  "),
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
                                  items: _vm.overbooking,
                                  search: _vm.search,
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
                                                            ref: "cbkantor",
                                                            attrs: {
                                                              label: "Kantor",
                                                              items:
                                                                _vm.namaKantor,
                                                              "item-value":
                                                                "nama_kantor",
                                                              "item-text":
                                                                "nama_kantor",
                                                              placeholder:
                                                                "Pilih Kantor",
                                                              "single-line": "",
                                                              "hide-details":
                                                                "",
                                                              clearable: "",
                                                              "return-object": false,
                                                              "persistent-hint":
                                                                "",
                                                              "error-messages":
                                                                _vm.pesaneror,
                                                            },
                                                            on: {
                                                              click: function (
                                                                $event
                                                              ) {
                                                                return _vm.getKantor()
                                                              },
                                                              change: function (
                                                                $event
                                                              ) {
                                                                return _vm.filterKantor()
                                                              },
                                                            },
                                                            model: {
                                                              value:
                                                                _vm.nama_kantor,
                                                              callback:
                                                                function ($$v) {
                                                                  _vm.nama_kantor =
                                                                    $$v
                                                                },
                                                              expression:
                                                                "nama_kantor",
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
                                                        cols: "10",
                                                        sm: "10",
                                                        md: "10",
                                                      },
                                                    },
                                                    [
                                                      _c("v-combobox", {
                                                        ref: "cboto",
                                                        attrs: {
                                                          label: "Otorisator",
                                                          items:
                                                            _vm.namaOtorisator,
                                                          "item-value": "id",
                                                          "item-text":
                                                            "namaotorisator",
                                                          placeholder:
                                                            "Daftar Otorisator",
                                                          "single-line": "",
                                                          "hide-details": "",
                                                          clearable: "",
                                                          "return-object": false,
                                                          "persistent-hint": "",
                                                          "error-messages":
                                                            _vm.pesaneror,
                                                        },
                                                        on: {
                                                          click: function (
                                                            $event
                                                          ) {
                                                            return _vm.getOtorisator()
                                                          },
                                                          change: function (
                                                            $event
                                                          ) {
                                                            return _vm.filterOtorisator()
                                                          },
                                                        },
                                                        model: {
                                                          value:
                                                            _vm.otorisator_id,
                                                          callback: function (
                                                            $$v
                                                          ) {
                                                            _vm.otorisator_id =
                                                              $$v
                                                          },
                                                          expression:
                                                            "otorisator_id",
                                                        },
                                                      }),
                                                    ],
                                                    1
                                                  ),
                                                ],
                                                1
                                              ),
                                              _vm._v(" "),
                                              _c("v-spacer"),
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
                                                    "\n                            mdi-download\n                        "
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
                                  3968794873
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
                                        rules: _vm.nameRules,
                                        name: "namafile",
                                        label: "Nama File",
                                        placeholder: "Nama File",
                                        outlined: "",
                                        required: "",
                                        dense: "",
                                        "prepend-icon": "mdi-file",
                                      },
                                      on: {
                                        keydown: function ($event) {
                                          return _vm.pencetKeyboard($event)
                                        },
                                      },
                                      model: {
                                        value: _vm.namafile,
                                        callback: function ($$v) {
                                          _vm.namafile = $$v
                                        },
                                        expression: "namafile",
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
                                                            _vm.tanggalRules,
                                                          label: "Tanggal File",
                                                          placeholder:
                                                            "dd/mm/yyyy",
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
                                                            _vm.tanggal =
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
                                            value: _vm.tanggal,
                                            callback: function ($$v) {
                                              _vm.tanggal = $$v
                                            },
                                            expression: "tanggal",
                                          },
                                        }),
                                      ],
                                      1
                                    ),
                                    _vm._v(" "),
                                    _c("v-combobox", {
                                      attrs: {
                                        label: "Nama Otorisator",
                                        "prepend-icon":
                                          "nav-icon fas fa-user-secret",
                                        items: _vm.namaOtorisator,
                                        "item-value": "id",
                                        "item-text": "namaotorisator",
                                        placeholder: "Daftar Otorisator",
                                        outlined: "",
                                        required: "",
                                        dense: "",
                                        "return-object": false,
                                        "persistent-hint": "",
                                        "error-messages": _vm.pesaneror,
                                      },
                                      on: {
                                        click: function ($event) {
                                          return _vm.getOtorisator()
                                        },
                                      },
                                      model: {
                                        value: _vm.otorisator_id,
                                        callback: function ($$v) {
                                          _vm.otorisator_id = $$v
                                        },
                                        expression: "otorisator_id",
                                      },
                                    }),
                                    _vm._v(" "),
                                    _c("has-error", {
                                      attrs: {
                                        form: _vm.form,
                                        field: "tanggal",
                                      },
                                    }),
                                    _vm._v(" "),
                                    [
                                      _c("v-file-input", {
                                        attrs: {
                                          rules: _vm.fileRules,
                                          color: "deep-purple accent-4",
                                          counter: "",
                                          label: "File input",
                                          required: "",
                                          placeholder: "Ambil File",
                                          "prepend-icon": "mdi-paperclip",
                                          outlined: "",
                                          dense: "",
                                          "show-size": "",
                                          accept: ".zip",
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
                                                          "\n                                    " +
                                                            _vm._s(text) +
                                                            "\n                                "
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
                                                          "\n                                    +" +
                                                            _vm._s(
                                                              _vm.files.length -
                                                                2
                                                            ) +
                                                            " File(s)\n                                "
                                                        ),
                                                      ]
                                                    )
                                                  : _vm._e(),
                                              ]
                                            },
                                          },
                                        ]),
                                        model: {
                                          value: _vm.file,
                                          callback: function ($$v) {
                                            _vm.file = $$v
                                          },
                                          expression: "file",
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
                                  _c("v-icon", [_vm._v("mdi-file-upload")]),
                                  _vm._v(
                                    "\n                            Upload\n                        "
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

/***/ "./resources/js/components/akunting/Overbooking.vue":
/*!**********************************************************!*\
  !*** ./resources/js/components/akunting/Overbooking.vue ***!
  \**********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Overbooking_vue_vue_type_template_id_73efdad2___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Overbooking.vue?vue&type=template&id=73efdad2& */ "./resources/js/components/akunting/Overbooking.vue?vue&type=template&id=73efdad2&");
/* harmony import */ var _Overbooking_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Overbooking.vue?vue&type=script&lang=js& */ "./resources/js/components/akunting/Overbooking.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Overbooking_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Overbooking_vue_vue_type_template_id_73efdad2___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Overbooking_vue_vue_type_template_id_73efdad2___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/akunting/Overbooking.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/akunting/Overbooking.vue?vue&type=script&lang=js&":
/*!***********************************************************************************!*\
  !*** ./resources/js/components/akunting/Overbooking.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Overbooking_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./Overbooking.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/akunting/Overbooking.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Overbooking_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/akunting/Overbooking.vue?vue&type=template&id=73efdad2&":
/*!*****************************************************************************************!*\
  !*** ./resources/js/components/akunting/Overbooking.vue?vue&type=template&id=73efdad2& ***!
  \*****************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Overbooking_vue_vue_type_template_id_73efdad2___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./Overbooking.vue?vue&type=template&id=73efdad2& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/akunting/Overbooking.vue?vue&type=template&id=73efdad2&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Overbooking_vue_vue_type_template_id_73efdad2___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Overbooking_vue_vue_type_template_id_73efdad2___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);