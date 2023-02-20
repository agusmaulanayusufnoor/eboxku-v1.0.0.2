(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[38],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/umum/Memoumum.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/umum/Memoumum.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

throw new Error("Module build failed (from ./node_modules/babel-loader/lib/index.js):\nSyntaxError: D:\\laragon\\www\\eboxku\\resources\\js\\components\\umum\\Memoumum.vue: Unterminated string constant. (613:81)\n\n\u001b[0m \u001b[90m 611 |\u001b[39m          \u001b[36mthis\u001b[39m\u001b[33m.\u001b[39m$Progress\u001b[33m.\u001b[39mstart()\u001b[33m;\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 612 |\u001b[39m\u001b[0m\n\u001b[0m\u001b[31m\u001b[1m>\u001b[22m\u001b[39m\u001b[90m 613 |\u001b[39m             \u001b[36mif\u001b[39m(\u001b[36mthis\u001b[39m\u001b[33m.\u001b[39m$gate\u001b[33m.\u001b[39misAdmin() \u001b[33m||\u001b[39m \u001b[36mthis\u001b[39m\u001b[33m.\u001b[39m$gate\u001b[33m.\u001b[39misUM() \u001b[33m||\u001b[39m \u001b[36mthis\u001b[39m\u001b[33m.\u001b[39m$gate\u001b[33m.\u001b[39misSekdir()\u001b[32m\" ){\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m     |\u001b[39m                                                                                  \u001b[31m\u001b[1m^\u001b[22m\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 614 |\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 615 |\u001b[39m                \u001b[90m//axios.get(\"api/user\").then((response) => {(this.users = response.data.data)});\u001b[39m\u001b[0m\n\u001b[0m \u001b[90m 616 |\u001b[39m              axios\u001b[33m.\u001b[39m\u001b[36mget\u001b[39m(\u001b[32m\"api/memoumum\"\u001b[39m)\u001b[0m\n    at Parser._raise (D:\\laragon\\www\\eboxku\\node_modules\\@babel\\parser\\lib\\index.js:476:17)\n    at Parser.raiseWithData (D:\\laragon\\www\\eboxku\\node_modules\\@babel\\parser\\lib\\index.js:469:17)\n    at Parser.raise (D:\\laragon\\www\\eboxku\\node_modules\\@babel\\parser\\lib\\index.js:430:17)\n    at Parser.readString (D:\\laragon\\www\\eboxku\\node_modules\\@babel\\parser\\lib\\index.js:3124:20)\n    at Parser.getTokenFromCode (D:\\laragon\\www\\eboxku\\node_modules\\@babel\\parser\\lib\\index.js:2698:14)\n    at Parser.nextToken (D:\\laragon\\www\\eboxku\\node_modules\\@babel\\parser\\lib\\index.js:2100:10)\n    at Parser.next (D:\\laragon\\www\\eboxku\\node_modules\\@babel\\parser\\lib\\index.js:2001:10)\n    at Parser.eat (D:\\laragon\\www\\eboxku\\node_modules\\@babel\\parser\\lib\\index.js:2006:12)\n    at Parser.parseCallExpressionArguments (D:\\laragon\\www\\eboxku\\node_modules\\@babel\\parser\\lib\\index.js:12352:18)\n    at Parser.parseCoverCallAndAsyncArrowHead (D:\\laragon\\www\\eboxku\\node_modules\\@babel\\parser\\lib\\index.js:12272:29)\n    at Parser.parseSubscript (D:\\laragon\\www\\eboxku\\node_modules\\@babel\\parser\\lib\\index.js:12197:19)\n    at Parser.parseSubscripts (D:\\laragon\\www\\eboxku\\node_modules\\@babel\\parser\\lib\\index.js:12166:19)\n    at Parser.parseExprSubscripts (D:\\laragon\\www\\eboxku\\node_modules\\@babel\\parser\\lib\\index.js:12155:17)\n    at Parser.parseUpdate (D:\\laragon\\www\\eboxku\\node_modules\\@babel\\parser\\lib\\index.js:12129:21)\n    at Parser.parseMaybeUnary (D:\\laragon\\www\\eboxku\\node_modules\\@babel\\parser\\lib\\index.js:12104:23)\n    at Parser.parseMaybeUnaryOrPrivate (D:\\laragon\\www\\eboxku\\node_modules\\@babel\\parser\\lib\\index.js:11901:61)");

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/umum/Memoumum.vue?vue&type=template&id=1ec2b2ce&":
/*!****************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/umum/Memoumum.vue?vue&type=template&id=1ec2b2ce& ***!
  \****************************************************************************************************************************************************************************************************************/
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
                                src: "images/banner-biru-akunting.jpg",
                                color: "rgb(39,154,187)",
                                dark: "",
                                shaped: "",
                              },
                            },
                            [
                              _c("v-toolbar-title", [
                                _vm._v(
                                  "\n                    File Memo Umum\n                "
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
                                  items: _vm.memoumum,
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
                                              _c("v-spacer"),
                                              _vm._v(" "),
                                              _c(
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
                                                        ref: "cbjenis",
                                                        attrs: {
                                                          label: "Jenis Memo",
                                                          items: _vm.items,
                                                          "item-value": "jenis",
                                                          "item-text": "jenis",
                                                          placeholder:
                                                            "Jenis Memo",
                                                          "single-line": "",
                                                          "hide-details": "",
                                                          clearable: "",
                                                          "return-object": false,
                                                          "persistent-hint": "",
                                                          "error-messages":
                                                            _vm.pesaneror,
                                                        },
                                                        on: {
                                                          change: function (
                                                            $event
                                                          ) {
                                                            return _vm.filterJenis()
                                                          },
                                                        },
                                                        model: {
                                                          value: _vm.jenis,
                                                          callback: function (
                                                            $$v
                                                          ) {
                                                            _vm.jenis = $$v
                                                          },
                                                          expression: "jenis",
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
                                  1057431054
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
          (!_vm.$gate.isAdmin() && !_vm.$gate.isUM()) || !_vm.$gate.isSekdir()
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
                                [
                                  _c(
                                    "v-container",
                                    { attrs: { fluid: "" } },
                                    [
                                      _c(
                                        "v-radio-group",
                                        {
                                          attrs: {
                                            mandatory: false,
                                            row: "",
                                            "prepend-icon":
                                              "mdi-format-list-bulleted-type",
                                          },
                                          scopedSlots: _vm._u([
                                            {
                                              key: "label",
                                              fn: function () {
                                                return [
                                                  _c("div", [
                                                    _c(
                                                      "strong",
                                                      {
                                                        staticClass:
                                                          "text-h6 text-bold",
                                                      },
                                                      [_vm._v("Jenis Memo :")]
                                                    ),
                                                  ]),
                                                ]
                                              },
                                              proxy: true,
                                            },
                                          ]),
                                          model: {
                                            value: _vm.jenis,
                                            callback: function ($$v) {
                                              _vm.jenis = $$v
                                            },
                                            expression: "jenis",
                                          },
                                        },
                                        [
                                          _vm._v(" "),
                                          _c("v-radio", {
                                            attrs: {
                                              label: "Umum",
                                              value: "umum",
                                            },
                                          }),
                                          _vm._v(" "),
                                          _c("v-radio", {
                                            attrs: {
                                              label: "CSR",
                                              value: "csr",
                                            },
                                          }),
                                          _vm._v(
                                            "\n                                    >"
                                          ),
                                        ],
                                        1
                                      ),
                                    ],
                                    1
                                  ),
                                ],
                                _vm._v(" "),
                                _c(
                                  "v-col",
                                  { attrs: { cols: "12", sm: "12", md: "12" } },
                                  [
                                    _c("v-text-field", {
                                      attrs: {
                                        rules: _vm.norekRules,
                                        name: "no_memo",
                                        label: "Nomor Memo",
                                        placeholder: "No. Memo",
                                        counter: "",
                                        maxlength: "25",
                                        outlined: "",
                                        required: "",
                                        dense: "",
                                        "prepend-icon": "mdi-file",
                                      },
                                      model: {
                                        value: _vm.no_memo,
                                        callback: function ($$v) {
                                          _vm.no_memo = $$v
                                        },
                                        expression: "no_memo",
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
                                        rules: _vm.nameRules,
                                        name: "namafile",
                                        label: "Nama File",
                                        placeholder:
                                          "Nama File: 'nama_nasabah'",
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
                                                                    value:
                                                                      _vm.periodeMomentJS,
                                                                    rules:
                                                                      _vm.tanggalRules,
                                                                    label:
                                                                      "Tanggal Memo",
                                                                    placeholder:
                                                                      "Pilih Tanggal",
                                                                    "prepend-icon":
                                                                      "mdi-calendar",
                                                                    outlined:
                                                                      "",
                                                                    required:
                                                                      "",
                                                                    dense: "",
                                                                    clearable:
                                                                      "",
                                                                    readonly:
                                                                      "",
                                                                  },
                                                                  on: {
                                                                    blur: function (
                                                                      $event
                                                                    ) {
                                                                      _vm.tanggal =
                                                                        _vm.periodeMomentJS
                                                                    },
                                                                    "click:clear":
                                                                      function (
                                                                        $event
                                                                      ) {
                                                                        _vm.tanggal =
                                                                          null
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
                                                        "mdi-calendar-blank",
                                                      "prev-icon":
                                                        "mdi-skip-previous",
                                                      "next-icon":
                                                        "mdi-skip-next",
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
                              2
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

/***/ "./resources/js/components/umum/Memoumum.vue":
/*!***************************************************!*\
  !*** ./resources/js/components/umum/Memoumum.vue ***!
  \***************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Memoumum_vue_vue_type_template_id_1ec2b2ce___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Memoumum.vue?vue&type=template&id=1ec2b2ce& */ "./resources/js/components/umum/Memoumum.vue?vue&type=template&id=1ec2b2ce&");
/* harmony import */ var _Memoumum_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Memoumum.vue?vue&type=script&lang=js& */ "./resources/js/components/umum/Memoumum.vue?vue&type=script&lang=js&");
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _Memoumum_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _Memoumum_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__[key]; }) }(__WEBPACK_IMPORT_KEY__));
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Memoumum_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Memoumum_vue_vue_type_template_id_1ec2b2ce___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Memoumum_vue_vue_type_template_id_1ec2b2ce___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/umum/Memoumum.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/umum/Memoumum.vue?vue&type=script&lang=js&":
/*!****************************************************************************!*\
  !*** ./resources/js/components/umum/Memoumum.vue?vue&type=script&lang=js& ***!
  \****************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Memoumum_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./Memoumum.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/umum/Memoumum.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Memoumum_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Memoumum_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Memoumum_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Memoumum_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Memoumum_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/components/umum/Memoumum.vue?vue&type=template&id=1ec2b2ce&":
/*!**********************************************************************************!*\
  !*** ./resources/js/components/umum/Memoumum.vue?vue&type=template&id=1ec2b2ce& ***!
  \**********************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Memoumum_vue_vue_type_template_id_1ec2b2ce___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./Memoumum.vue?vue&type=template&id=1ec2b2ce& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/umum/Memoumum.vue?vue&type=template&id=1ec2b2ce&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Memoumum_vue_vue_type_template_id_1ec2b2ce___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Memoumum_vue_vue_type_template_id_1ec2b2ce___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);