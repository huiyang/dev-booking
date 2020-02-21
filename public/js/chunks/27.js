(window.webpackJsonp=window.webpackJsonp||[]).push([[27],{WjD0:function(t,e){t.exports="object"==typeof self?self.FormData:window.FormData},ke3Z:function(t,e,a){"use strict";a("WjD0");function s(t,e){for(var a=0;a<e.length;a++){var s=e[a];s.enumerable=s.enumerable||!1,s.configurable=!0,"value"in s&&(s.writable=!0),Object.defineProperty(t,s.key,s)}}var n=function(){function t(){!function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}(this,t),this.errors={}}var e,a,n;return e=t,(a=[{key:"has",value:function(t){return this.errors.hasOwnProperty(t)}},{key:"any",value:function(){return Object.keys(this.errors).length>0}},{key:"get",value:function(t){if(this.errors[t])return this.errors[t][0]}},{key:"record",value:function(t){this.errors=t.errors}},{key:"clear",value:function(t){t?delete this.errors[t]:this.errors={}}}])&&s(e.prototype,a),n&&s(e,n),t}(),i=a("5fFP");function r(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function o(t,e){for(var a=0;a<e.length;a++){var s=e[a];s.enumerable=s.enumerable||!1,s.configurable=!0,"value"in s&&(s.writable=!0),Object.defineProperty(t,s.key,s)}}a.d(e,"a",(function(){return l}));var l=function(){function t(e){var a=arguments.length>1&&void 0!==arguments[1]&&arguments[1];r(this,t),this.errors=new n,this.originalData=e,this.hasChanges=!1,this.preventNavigation=a;var s=this;for(var i in this.__data={},e)this[i]=e[i],s.__data[i]=s[i],function(t){Object.defineProperty(s,t,{get:function(){return s.__data[t]},set:function(e){s.__data[t]=e,s.hasChanges||s.onFirstChange()}})}(i)}var e,a,s;return e=t,(a=[{key:"set",value:function(t,e){this.data[t]=e}},{key:"get",value:function(t){return this.data[t]}},{key:"reset",value:function(){for(var t in this.originalData)this[t]=this.originalData[t];this.errors.clear()}},{key:"data",value:function(){var t={};for(var e in this.originalData)t[e]=this[e];return t}},{key:"post",value:function(t){return this.submit("post",t)}},{key:"patch",value:function(t){return this.submit("patch",t)}},{key:"put",value:function(t){return this.submit("put",t)}},{key:"delete",value:function(t){return this.submit("delete",t)}},{key:"submit",value:function(t,e){var a=this;return new Promise((function(s,n){axios[t](e,a.data()).then((function(t){a.onSuccess(t.data),i.a.commit("form/setPreventNavigation",!1),s(t.data)})).catch((function(t){a.onFailure(t.response.data),n(t.response.data)}))}))}},{key:"onSuccess",value:function(t){}},{key:"onFailure",value:function(t){this.errors.record(t)}},{key:"onFirstChange",value:function(t){this.hasChanges=!0,this.preventNavigation&&i.a.commit("form/setPreventNavigation",!0)}},{key:"resetChangeListener",value:function(t){this.hasChanges=!1,this.preventNavigation&&i.a.commit("form/setPreventNavigation",!1)}}])&&o(e.prototype,a),s&&o(e,s),t}()},ylQw:function(t,e,a){"use strict";a.r(e);var s=a("ke3Z"),n={head:{title:function(){return{inner:this.matrix.name||"Loading..."}}},data:function(){return{matrix:{},page:{},form:new s.a({})}},computed:{sections:function(){var t=[],e=[];return this.matrix.fieldset&&(t=_.filter(this.matrix.fieldset.sections,(function(t){return"body"==t.placement})),e=_.filter(this.matrix.fieldset.sections,(function(t){return"sidebar"==t.placement}))),{body:t,sidebar:e}}},methods:{submit:function(){this.form.patch("/api/pages/"+this.matrix.id).then((function(t){toast("Page saved successfully","success")})).catch((function(t){toast(t.message,"failed")}))},getPage:function(t,e,a){var n=this;axios.get("/api/pages/"+t.params.page).then((function(t){_.has(t,"data.data.page")?(n.matrix=t.data.data.matrix,n.page=t.data.data.page):(n.matrix=t.data.data,n.page={name:n.matrix.name,slug:n.matrix.slug,status:1});var e={name:n.page.name,slug:n.page.slug,status:n.page.status};n.matrix.fieldset&&_.forEach(n.matrix.fieldset.sections,(function(t){_.forEach(t.fields,(function(t){Vue.set(e,t.handle,n.page[t.handle])}))})),n.form=new s.a(e,!0),n.$emit("updateHead")}))}},beforeRouteEnter:function(t,e,a){a((function(s){s.getPage(t,e,a)}))},beforeRouteUpdate:function(t,e,a){this.getPage(t,e,a),a()}},i=a("KHd+"),r=Object(i.a)(n,(function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("portal",{key:t.matrix.handle,attrs:{to:"title"}},[a("app-title",{attrs:{icon:t.matrix.icon||"pencil-alt"}},[t._v(t._s(t.matrix.name))])],1),t._v(" "),a("portal",{attrs:{to:"subtitle"}},[t._v(t._s(t.matrix.description))]),t._v(" "),a("div",{staticClass:"row"},[a("div",{staticClass:"content-container"},[a("form",{on:{submit:function(e){return e.preventDefault(),t.submit(e)},"~input":function(e){return t.form.onFirstChange(e)}}},[a("p-card",[a("div",{staticClass:"row"},[a("div",{staticClass:"col form-sidebar"},[a("div",{staticClass:"xxl:mr-10"})]),t._v(" "),a("div",{staticClass:"col mb-6 form-content"},[a("div",{staticClass:"row"},[a("div",{staticClass:"col w-1/2"},[a("p-input",{attrs:{name:"name",label:t.matrix.name_label||"Name",autocomplete:"off",autofocus:"",required:"","has-error":t.form.errors.has("name"),"error-message":t.form.errors.get("name")},model:{value:t.form.name,callback:function(e){t.$set(t.form,"name",e)},expression:"form.name"}})],1),t._v(" "),a("div",{staticClass:"col w-1/2"},[a("p-slug",{attrs:{name:"slug",label:"Slug",monospaced:"",autocomplete:"off",required:"",watch:t.form.name,"has-error":t.form.errors.has("slug"),"error-message":t.form.errors.get("slug")},model:{value:t.form.slug,callback:function(e){t.$set(t.form,"slug",e)},expression:"form.slug"}})],1)])])]),t._v(" "),t.sections.body.length>0?a("div",t._l(t.sections.body,(function(e,s){return a("div",{key:e.handle},[a("div",{staticClass:"row"},[a("div",{staticClass:"col form-sidebar"},[a("div",{staticClass:"xxl:mr-10 xxl:mb-0 mb-6"},[a("h3",[t._v(t._s(e.name))]),t._v(" "),a("p",{staticClass:"text-sm"},[t._v(t._s(e.description))])])]),t._v(" "),a("div",{staticClass:"col form-content"},t._l(e.fields,(function(e){return a("div",{key:e.handle,staticClass:"form__group"},[a(e.type.id+"-fieldtype",{tag:"component",attrs:{field:e},model:{value:t.form[e.handle],callback:function(a){t.$set(t.form,e.handle,a)},expression:"form[field.handle]"}})],1)})),0)]),t._v(" "),s!==t.sections.body.length-1?a("hr"):t._e()])})),0):a("div",{staticClass:"text-center"},[a("p",[t._v("You should configure your Matrix Page with some sections and fields first "),a("fa-icon",{staticClass:"text-emoji",attrs:{icon:["fas","hand-peace"]}})],1),t._v(" "),a("router-link",{staticClass:"button items-center",attrs:{to:"/matrices/"+t.matrix.id+"/edit"}},[a("fa-icon",{staticClass:"mr-2 text-sm",attrs:{icon:["fas","edit"]}}),t._v(" Manage your page")],1)],1)])],1)]),t._v(" "),a("div",{staticClass:"side-container"},[a("form",{on:{submit:function(e){return e.preventDefault(),t.submit(e)}}},[a("p-card",[a("div",{staticClass:"row"},[a("div",{staticClass:"col w-full"},[a("p-select",{attrs:{name:"status",label:"Status",options:[{label:"Enabled",value:1},{label:"Disabled",value:0}]},model:{value:t.form.status,callback:function(e){t.$set(t.form,"status",e)},expression:"form.status"}})],1)]),t._v(" "),a("portal",{attrs:{to:"actions"}},[a("router-link",{staticClass:"button mr-3",attrs:{to:{name:"dashboard"}}},[t._v("Go Back")]),t._v(" "),a("button",{staticClass:"button button--primary",class:{"button--disabled":!t.form.hasChanges},attrs:{type:"submit",disabled:!t.form.hasChanges},on:{click:function(e){return e.preventDefault(),t.submit(e)}}},[t._v("Save")])],1)],1),t._v(" "),t._l(t.sections.sidebar,(function(e){return a("p-card",{key:e.handle,staticClass:"mt-6"},[a("h3",[t._v(t._s(e.name))]),t._v(" "),a("p",{staticClass:"text-sm"},[t._v(t._s(e.description))]),t._v(" "),a("div",{staticClass:"w-full"},t._l(e.fields,(function(e){return a("div",{key:e.handle,staticClass:"form__group"},[a(e.type.id+"-fieldtype",{tag:"component",attrs:{field:e},model:{value:t.form[e.handle],callback:function(a){t.$set(t.form,e.handle,a)},expression:"form[field.handle]"}})],1)})),0)])}))],2)])])],1)}),[],!1,null,null,null);e.default=r.exports}}]);