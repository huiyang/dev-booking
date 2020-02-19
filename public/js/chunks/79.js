(window.webpackJsonp=window.webpackJsonp||[]).push([[79],{"09eI":function(e,t,r){"use strict";r.r(t);var a={head:{title:function(){return{inner:"Forms"}}},data:function(){return{endpoint:"/datatable/forms"}},methods:{destroy:function(e){axios.delete("/api/forms/"+e).then((function(e){toast("Form successfully deleted.","success"),proton().$emit("refresh-datatable-forms")}))}}},o=r("KHd+"),n=Object(o.a)(a,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("portal",{attrs:{to:"title"}},[r("app-title",{attrs:{icon:"paper-plane"}},[e._v("Forms")])],1),e._v(" "),r("portal",{attrs:{to:"actions"}},[r("router-link",{staticClass:"button mr-3",attrs:{to:{name:"inbox"}}},[e._v("View Inbox")]),e._v(" "),r("router-link",{staticClass:"button",attrs:{to:{name:"forms.create"}}},[e._v("Create Form")])],1),e._v(" "),r("div",{staticClass:"row"},[r("div",{staticClass:"content-container"},[r("p-datatable",{key:"forms_table",attrs:{endpoint:e.endpoint,name:"forms","sort-by":"name","per-page":10,"primary-key":"handle"},scopedSlots:e._u([{key:"name",fn:function(t){return[r("router-link",{attrs:{to:{name:"forms.edit",params:{form:t.record.id}}}},[e._v(e._s(t.record.name))])]}},{key:"handle",fn:function(t){return[r("code",[e._v(e._s(t.record.handle))])]}},{key:"description",fn:function(t){return[r("span",{staticClass:"text-gray-800 text-sm"},[e._v(e._s(t.record.description))])]}},{key:"status",fn:function(t){return[!0===t.record.status?r("span",{staticClass:"badge badge--success"},[e._v("Enabled")]):r("span",{staticClass:"badge badge--danger"},[e._v("Disabled")])]}},{key:"actions",fn:function(t){return[r("p-dropdown",{key:"form_"+t.record.id,attrs:{right:""}},[r("fa-icon",{attrs:{icon:["fas","bars"]}}),e._v(" "),r("template",{slot:"options"},[r("p-dropdown-item",{attrs:{to:{name:"forms.edit",params:{form:t.record.id}}},on:{click:function(e){e.preventDefault()}}},[e._v("Edit")]),e._v(" "),r("p-dropdown-item",{directives:[{name:"modal",rawName:"v-modal:delete-form",value:t.record,expression:"table.record",arg:"delete-form"}],on:{click:function(e){e.preventDefault()}}},[e._v("\n                                Delete\n                            ")])],1)],2)]}}])})],1)]),e._v(" "),r("portal",{attrs:{to:"modals"}},[r("p-modal",{key:"delete_form",attrs:{name:"delete-form",title:"Delete Form"},scopedSlots:e._u([{key:"footer",fn:function(t){return[r("p-button",{directives:[{name:"modal",rawName:"v-modal:delete-form",arg:"delete-form"}],staticClass:"ml-3",attrs:{theme:"danger"},on:{click:function(r){return e.destroy(t.data.id)}}},[e._v("Delete")]),e._v(" "),r("p-button",{directives:[{name:"modal",rawName:"v-modal:delete-form",arg:"delete-form"}]},[e._v("Cancel")])]}}])},[r("p",[e._v("Are you sure you want to permenantly delete this form?")])])],1)],1)}),[],!1,null,null,null);t.default=n.exports}}]);