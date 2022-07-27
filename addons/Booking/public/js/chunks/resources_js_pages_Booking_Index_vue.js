"use strict";
(self["webpackChunksubscription"] = self["webpackChunksubscription"] || []).push([["resources_js_pages_Booking_Index_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/Booking/Index.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/Booking/Index.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__),
/* harmony export */   "getEntry": () => (/* binding */ getEntry)
/* harmony export */ });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  data: function data() {
    return {
      collection: {},
      entry: {},
      booking: null,
      loadingBooking: false
    };
  },
  methods: {
    loadBookingDetail: function loadBookingDetail(id) {
      var _this = this;

      this.loadingBooking = true;
      this.booking = null;
      axios.get('/api/booking/' + id).then(function (response) {
        _this.loadingBooking = false;
        _this.booking = response.data.data;
      })["catch"](function (error) {
        _this.loadingBooking = false;
        toast(error.response.data.message, 'error');
      });
    },
    destroy: function destroy(id) {
      axios["delete"]('/api/booking/' + id).then(function (response) {
        toast('Booking successfully deleted.', 'success');
        bus().$emit('refresh-datatable-bookings');
      });
    }
  },
  computed: {
    endpoint: function endpoint() {
      return '/datatable/collection/' + this.$route.params.collection + '/' + this.$route.params.id + '/bookings';
    }
  },
  beforeRouteEnter: function beforeRouteEnter(to, from, next) {
    getEntry(to.params.collection, to.params.id, function (error, entry, matrix, fields) {
      if (error) {
        next(function (vm) {
          vm.$router.push('/collection/' + vm.$router.currentRoute.params.collection);
          toast(error.toString(), 'danger');
        });
      } else {
        next(function (vm) {
          vm.collection = matrix;
          vm.entry = entry;
          vm.$emit('updateHead');
        });
      }
    });
  },
  beforeRouteUpdate: function beforeRouteUpdate(to, from, next) {
    var _this2 = this;

    getEntry(to.params.collection, to.params.id, function (error, entry, matrix, fields) {
      if (error) {
        _this2.$router.push('/bookable-collection/' + _this2.$router.currentRoute.params.collection);

        toast(error.toString(), 'danger');
      } else {
        _this2.collection = matrix;
        _this2.entry = entry;

        _this2.$emit('updateHead');
      }
    });
    next();
  }
});
function getEntry(collection, id, callback) {
  axios.get('/api/collections/' + collection + '/' + id).then(function (response) {
    var matrix = response.data.data.matrix;
    var entry = response.data.data.entry;
    var fields = {
      name: entry.name,
      slug: entry.slug,
      status: entry.status,
      publish_at: entry.publish_at,
      expire_at: entry.expire_at
    };

    _.forEach(matrix.blueprint.sections, function (section) {
      _.forEach(section.fields, function (field) {
        fields[field.handle] = entry[field.handle];
      });
    });

    callback(null, entry, matrix, fields);
  })["catch"](function (error) {
    callback(new Error('The requested entry could not be found'));
  });
}

/***/ }),

/***/ "./resources/js/pages/Booking/Index.vue":
/*!**********************************************!*\
  !*** ./resources/js/pages/Booking/Index.vue ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__),
/* harmony export */   "getEntry": () => (/* reexport safe */ _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__.getEntry)
/* harmony export */ });
/* harmony import */ var _Index_vue_vue_type_template_id_7bc72ac3___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Index.vue?vue&type=template&id=7bc72ac3& */ "./resources/js/pages/Booking/Index.vue?vue&type=template&id=7bc72ac3&");
/* harmony import */ var _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Index.vue?vue&type=script&lang=js& */ "./resources/js/pages/Booking/Index.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Index_vue_vue_type_template_id_7bc72ac3___WEBPACK_IMPORTED_MODULE_0__.render,
  _Index_vue_vue_type_template_id_7bc72ac3___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/pages/Booking/Index.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/js/pages/Booking/Index.vue?vue&type=script&lang=js&":
/*!***********************************************************************!*\
  !*** ./resources/js/pages/Booking/Index.vue?vue&type=script&lang=js& ***!
  \***********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__),
/* harmony export */   "getEntry": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__.getEntry)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Index.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/Booking/Index.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/pages/Booking/Index.vue?vue&type=template&id=7bc72ac3&":
/*!*****************************************************************************!*\
  !*** ./resources/js/pages/Booking/Index.vue?vue&type=template&id=7bc72ac3& ***!
  \*****************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_7bc72ac3___WEBPACK_IMPORTED_MODULE_0__.render),
/* harmony export */   "staticRenderFns": () => (/* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_7bc72ac3___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns)
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Index_vue_vue_type_template_id_7bc72ac3___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./Index.vue?vue&type=template&id=7bc72ac3& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/Booking/Index.vue?vue&type=template&id=7bc72ac3&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/Booking/Index.vue?vue&type=template&id=7bc72ac3&":
/*!********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/js/pages/Booking/Index.vue?vue&type=template&id=7bc72ac3& ***!
  \********************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render),
/* harmony export */   "staticRenderFns": () => (/* binding */ staticRenderFns)
/* harmony export */ });
var render = function () {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c(
        "portal",
        { attrs: { to: "title" } },
        [
          _c(
            "page-title",
            {
              attrs: {
                icon: _vm.collection.icon || "pencil-alt",
                subtitle: _vm.entry.name,
              },
            },
            [_vm._v("Manage Bookings")]
          ),
        ],
        1
      ),
      _vm._v(" "),
      _c("portal", { attrs: { to: "actions" } }, [
        _c(
          "div",
          { staticClass: "buttons" },
          [
            _vm.collection.slug && _vm.$mq != "sm"
              ? _c(
                  "ui-button",
                  {
                    attrs: {
                      to: {
                        name: "bookable_collection.index",
                        params: { collection: _vm.collection.slug },
                      },
                      variant: "secondary",
                    },
                  },
                  [_vm._v("Go Back")]
                )
              : _vm._e(),
            _vm._v(" "),
            _vm.collection.slug && _vm.$mq != "sm"
              ? _c(
                  "ui-button",
                  {
                    attrs: {
                      to: {
                        name: "bookable_collection.booking.create",
                        params: { collection: _vm.collection.slug },
                      },
                      variant: "primary",
                    },
                  },
                  [_vm._v("New Booking")]
                )
              : _vm._e(),
          ],
          1
        ),
      ]),
      _vm._v(" "),
      _c("ui-table", {
        key: "bookings_table",
        attrs: {
          id: "bookings",
          endpoint: _vm.endpoint,
          "sort-by": "created_at",
          "sort-in": "desc",
        },
        scopedSlots: _vm._u([
          {
            key: "bookable_name",
            fn: function (table) {
              return [
                _vm._v(
                  "\n            " +
                    _vm._s(table.record.bookable.name) +
                    "\n        "
                ),
              ]
            },
          },
          {
            key: "starts_at",
            fn: function (table) {
              return [
                _c("ui-datetime", {
                  attrs: { timestamp: table.record.starts_at },
                }),
              ]
            },
          },
          {
            key: "ends_at",
            fn: function (table) {
              return [
                _c("ui-datetime", {
                  attrs: { timestamp: table.record.ends_at },
                }),
              ]
            },
          },
          {
            key: "created_at",
            fn: function (table) {
              return [
                _c("ui-datetime", {
                  attrs: { timestamp: table.record.created_at },
                }),
              ]
            },
          },
          {
            key: "actions",
            fn: function (table) {
              return [
                _c(
                  "ui-actions",
                  {
                    key: "entry_" + table.record.id + "_actions",
                    attrs: { id: "entry_" + table.record.id + "_actions" },
                  },
                  [
                    _c(
                      "ui-dropdown-link",
                      {
                        directives: [
                          {
                            name: "modal",
                            rawName: "v-modal:view-booking",
                            value: table.record,
                            expression: "table.record",
                            arg: "view-booking",
                          },
                        ],
                        on: {
                          click: function ($event) {
                            $event.preventDefault()
                            return _vm.loadBookingDetail(table.record.id)
                          },
                        },
                      },
                      [
                        _vm._v(
                          "\n                    View Detail\n                "
                        ),
                      ]
                    ),
                    _vm._v(" "),
                    _c(
                      "ui-dropdown-link",
                      {
                        attrs: {
                          to: {
                            name: "bookable_collection.booking.edit",
                            params: { booking: table.record.id },
                          },
                        },
                      },
                      [_vm._v("Edit")]
                    ),
                    _vm._v(" "),
                    _c("ui-dropdown-divider"),
                    _vm._v(" "),
                    _c(
                      "ui-dropdown-link",
                      {
                        directives: [
                          {
                            name: "modal",
                            rawName: "v-modal:delete-entry",
                            value: table.record,
                            expression: "table.record",
                            arg: "delete-entry",
                          },
                        ],
                        staticClass: "danger",
                        on: {
                          click: function ($event) {
                            $event.preventDefault()
                          },
                        },
                      },
                      [_vm._v("\n                    Delete\n                ")]
                    ),
                  ],
                  1
                ),
              ]
            },
          },
        ]),
      }),
      _vm._v(" "),
      _c(
        "portal",
        { attrs: { to: "modals" } },
        [
          _c(
            "ui-modal",
            {
              key: "delete_entry",
              attrs: { name: "delete-entry", title: "Delete Entry" },
              scopedSlots: _vm._u([
                {
                  key: "footer",
                  fn: function (entry) {
                    return [
                      _c(
                        "ui-button",
                        {
                          directives: [
                            {
                              name: "modal",
                              rawName: "v-modal:delete-entry",
                              arg: "delete-entry",
                            },
                          ],
                          staticClass: "ml-3",
                          attrs: { variant: "danger" },
                          on: {
                            click: function ($event) {
                              return _vm.destroy(entry.data.id)
                            },
                          },
                        },
                        [_vm._v("Delete")]
                      ),
                      _vm._v(" "),
                      _c(
                        "ui-button",
                        {
                          directives: [
                            {
                              name: "modal",
                              rawName: "v-modal:delete-entry",
                              arg: "delete-entry",
                            },
                          ],
                          attrs: { variant: "secondary" },
                        },
                        [_vm._v("Cancel")]
                      ),
                    ]
                  },
                },
              ]),
            },
            [
              _c("p", [
                _vm._v(
                  "Are you sure you want to permenantly delete this booking?"
                ),
              ]),
            ]
          ),
          _vm._v(" "),
          _c("ui-modal", {
            key: "view_booking",
            attrs: { name: "view-booking", title: "Booking Detail" },
            scopedSlots: _vm._u([
              {
                key: "default",
                fn: function (entry) {
                  return [
                    _vm.loadingBooking
                      ? _c("div", [
                          _vm._v(
                            "\n                    Loading...\n                "
                          ),
                        ])
                      : _vm.booking &&
                        _vm.booking.detail &&
                        _vm.booking.detail.entry &&
                        _vm.booking.detail.matrix
                      ? _c(
                          "div",
                          [
                            _c("div", [
                              _c("h3", [
                                _vm._v(_vm._s(_vm.booking.bookable.name)),
                              ]),
                            ]),
                            _vm._v(" "),
                            _c("div", { staticClass: "flex flex-wrap mb-3" }, [
                              _c(
                                "div",
                                { staticClass: "md:w-1/2 w-full" },
                                [
                                  _c("ui-label", [_vm._v("From")]),
                                  _vm._v(" "),
                                  _c("ui-datetime", {
                                    attrs: { timestamp: _vm.booking.starts_at },
                                  }),
                                ],
                                1
                              ),
                              _vm._v(" "),
                              _c(
                                "div",
                                { staticClass: "md:w-1/2 w-full" },
                                [
                                  _c("ui-label", [_vm._v("To")]),
                                  _vm._v(" "),
                                  _c("ui-datetime", {
                                    attrs: { timestamp: _vm.booking.ends_at },
                                  }),
                                ],
                                1
                              ),
                            ]),
                            _vm._v(" "),
                            _vm._l(
                              _vm.booking.detail.matrix.blueprint.sections,
                              function (section) {
                                return _c(
                                  "div",
                                  { key: section.id },
                                  _vm._l(section.fields, function (field) {
                                    return _c(
                                      "div",
                                      { key: field.id },
                                      [
                                        _c("ui-label", [
                                          _vm._v(_vm._s(field.name)),
                                        ]),
                                        _vm._v(" "),
                                        _c("div", [
                                          _vm._v(
                                            _vm._s(
                                              _vm.booking.detail.entry[
                                                field.handle
                                              ]
                                            )
                                          ),
                                        ]),
                                      ],
                                      1
                                    )
                                  }),
                                  0
                                )
                              }
                            ),
                          ],
                          2
                        )
                      : _vm._e(),
                  ]
                },
              },
              {
                key: "footer",
                fn: function (entry) {
                  return [
                    _c(
                      "ui-button",
                      {
                        directives: [
                          {
                            name: "modal",
                            rawName: "v-modal:view-booking",
                            arg: "view-booking",
                          },
                        ],
                        attrs: { variant: "secondary" },
                      },
                      [_vm._v("Close")]
                    ),
                  ]
                },
              },
            ]),
          }),
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

/***/ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js":
/*!********************************************************************!*\
  !*** ./node_modules/vue-loader/lib/runtime/componentNormalizer.js ***!
  \********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ normalizeComponent)
/* harmony export */ });
/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file (except for modules).
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

function normalizeComponent (
  scriptExports,
  render,
  staticRenderFns,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier, /* server only */
  shadowMode /* vue-cli only */
) {
  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (render) {
    options.render = render
    options.staticRenderFns = staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = 'data-v-' + scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = shadowMode
      ? function () {
        injectStyles.call(
          this,
          (options.functional ? this.parent : this).$root.$options.shadowRoot
        )
      }
      : injectStyles
  }

  if (hook) {
    if (options.functional) {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functional component in vue file
      var originalRender = options.render
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return originalRender(h, context)
      }
    } else {
      // inject component registration as beforeCreate hook
      var existing = options.beforeCreate
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    }
  }

  return {
    exports: scriptExports,
    options: options
  }
}


/***/ })

}]);