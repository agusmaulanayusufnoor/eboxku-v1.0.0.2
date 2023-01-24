(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[40],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/umum/Pjkpph4ayat2.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/umum/Pjkpph4ayat2.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
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
      pjkpph4ayat2: [],
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
    initialize: function initialize() {
      var _this = this;

      this.$Progress.start();

      if (this.$gate.isAdmin() || this.$gate.isUM()) {
        //axios.get("api/user").then((response) => {(this.users = response.data.data)});
        axios.get("api/pjkpph4ayat2").then(function (response) {
          _this.pjkpph4ayat2 = response.data.data;
          _this.kantor_id = _this.$kantor_id; // this.form.fill
          //console.log(this.pjkpph4ayat2);
          //console.log(this.kantor_id)
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
      this.namafile = '';
    },
    // uploadFile(e){
    //         // `files` is always an array because the file input may be in multiple mode
    //         console.log(e);
    //         this.file = e.target.files[0];
    // },
    createUser: function createUser() {
      var _this2 = this;

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
      formData.set('file', this.file); // formData.append('file', this.file);
      // console.log(this.file);

      axios.post('api/pjkpph4ayat2', formData, config).then(function (response) {
        $('#addNew').modal('hide');
        Toast.fire({
          icon: 'success',
          title: response.data.message
        });

        _this2.$Progress.finish();

        _this2.initialize();
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
        url: 'api/pjkpph4ayat2/download/' + id,
        method: 'GET',
        responseType: 'blob'
      }).then(function (response) {
        var fileUrl = window.URL.createObjectURL(new Blob([response.data]));
        var fileLink = document.createElement('a');
        fileLink.href = fileUrl;
        fileLink.setAttribute('download', 'pjkpph4ayat2.zip');
        fileLink.download = file;
        document.body.appendChild(fileLink);
        fileLink.click();
      })["catch"](function () {
        Swal.fire("Gagal Download!", "File tidak ada...", "warning");
      });
    },
    updateUser: function updateUser() {
      var _this3 = this;

      this.$Progress.start(); // console.log('Editing data');

      this.form.put('api/pjkpph4ayat2/' + this.form.id).then(function (response) {
        // success
        $('#addNew').modal('hide');
        Toast.fire({
          icon: 'success',
          title: response.data.message
        });

        _this3.$Progress.finish(); //  Fire.$emit('AfterCreate');


        _this3.initialize();
      })["catch"](function () {
        _this3.$Progress.fail();
      });
    },
    deleteUser: function deleteUser(id) {
      var _this4 = this;

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
          _this4.form["delete"]('api/pjkpph4ayat2/' + id).then(function () {
            Swal.fire('Dihapus!', 'Data telah dihapus.', 'success'); // Fire.$emit('AfterCreate');

            _this4.initialize();
          })["catch"](function (data) {
            Swal.fire("Failed!", data.message, "warning");
          });
        }
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/umum/Pjkpph4ayat2.vue?vue&type=template&id=61148aae&":
/*!********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/umum/Pjkpph4ayat2.vue?vue&type=template&id=61148aae& ***!
  \********************************************************************************************************************************************************************************************************************/
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
                  _vm.$gate.isAdmin() || _vm.$gate.isUM()
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
                                  "\n                    File Pajak PPH Pasal 4 Ayat 2\n                "
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
                                  items: _vm.pjkpph4ayat2,
                                  search: _vm.search,
                                  justify: "center",
                                  dense: "",
                                },
                                scopedSlots: _vm._u(
                                  [
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
                                              _c("v-spacer"),
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
                                  3538273480
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
          !_vm.$gate.isAdmin() && !_vm.$gate.isUM()
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
                                    [
                                      _c(
                                        "v-row",
                                        [
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
                                              _c(
                                                "v-menu",
                                                {
                                                  ref: "menu1",
                                                  attrs: {
                                                    "close-on-content-click": false,
                                                    "nudge-right": 40,
                                                    transition:
                                                      "scale-transition",
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
                                                                    label:
                                                                      "Tanggal File",
                                                                    placeholder:
                                                                      "dd/mm/yyyy",
                                                                    "prepend-icon":
                                                                      "mdi-calendar",
                                                                    outlined:
                                                                      "",
                                                                    required:
                                                                      "",
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
                                                                    callback:
                                                                      function (
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
                                                      "year-icon":
                                                        "calendar-blank",
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
                                            ],
                                            1
                                          ),
                                        ],
                                        1
                                      ),
                                    ],
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

/***/ "./resources/js/components/umum/Pjkpph4ayat2.vue":
/*!*******************************************************!*\
  !*** ./resources/js/components/umum/Pjkpph4ayat2.vue ***!
  \*******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Pjkpph4ayat2_vue_vue_type_template_id_61148aae___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Pjkpph4ayat2.vue?vue&type=template&id=61148aae& */ "./resources/js/components/umum/Pjkpph4ayat2.vue?vue&type=template&id=61148aae&");
/* harmony import */ var _Pjkpph4ayat2_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Pjkpph4ayat2.vue?vue&type=script&lang=js& */ "./resources/js/components/umum/Pjkpph4ayat2.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Pjkpph4ayat2_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Pjkpph4ayat2_vue_vue_type_template_id_61148aae___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Pjkpph4ayat2_vue_vue_type_template_id_61148aae___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/umum/Pjkpph4ayat2.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/umum/Pjkpph4ayat2.vue?vue&type=script&lang=js&":
/*!********************************************************************************!*\
  !*** ./resources/js/components/umum/Pjkpph4ayat2.vue?vue&type=script&lang=js& ***!
  \********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Pjkpph4ayat2_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./Pjkpph4ayat2.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/umum/Pjkpph4ayat2.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Pjkpph4ayat2_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/umum/Pjkpph4ayat2.vue?vue&type=template&id=61148aae&":
/*!**************************************************************************************!*\
  !*** ./resources/js/components/umum/Pjkpph4ayat2.vue?vue&type=template&id=61148aae& ***!
  \**************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Pjkpph4ayat2_vue_vue_type_template_id_61148aae___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./Pjkpph4ayat2.vue?vue&type=template&id=61148aae& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/umum/Pjkpph4ayat2.vue?vue&type=template&id=61148aae&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Pjkpph4ayat2_vue_vue_type_template_id_61148aae___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Pjkpph4ayat2_vue_vue_type_template_id_61148aae___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);