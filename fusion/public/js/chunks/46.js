(window.webpackJsonp=window.webpackJsonp||[]).push([[46],{UtPH:function(e,t,s){"use strict";var n={props:{resource:{required:!1},form:{type:Object,required:!0}},computed:{sections:{get:function(){return this.$parent.sections},set:function(e){this.$parent.sections=e}}}},a=s("KHd+"),o=Object(a.a)(n,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("form-container",{scopedSlots:e._u([{key:"sidebar",fn:function(){return[s("div",{staticClass:"card"},[s("div",{staticClass:"card__body"},[s("p-slug",{attrs:{name:"handle",label:"Handle",autocomplete:"off",required:"",delimiter:"_",watch:e.form.name,"has-error":e.form.errors.has("handle"),"error-message":e.form.errors.get("handle")},model:{value:e.form.handle,callback:function(t){e.$set(e.form,"handle",t)},expression:"form.handle"}})],1)]),e._v(" "),e.resource?s("p-definition-list",[s("p-definition",{attrs:{name:"Created At"}},[e._v("\n                    "+e._s(e.$moment(e.resource.created_at).format("Y-MM-DD, hh:mm a"))+"\n                ")]),e._v(" "),s("p-definition",{attrs:{name:"Updated At"}},[e._v("\n                    "+e._s(e.$moment(e.resource.updated_at).format("Y-MM-DD, hh:mm a"))+"\n                ")])],1):e._e()]},proxy:!0}])},[s("portal",{attrs:{to:"actions"}},[s("div",{staticClass:"buttons"},[s("router-link",{staticClass:"button",attrs:{to:{name:"fieldsets"}}},[e._v("Go Back")]),e._v(" "),s("button",{staticClass:"button button--primary",class:{"button--disabled":!e.form.hasChanges},attrs:{type:"submit",disabled:!e.form.hasChanges},on:{click:function(t){return t.preventDefault(),e.$parent.submit(t)}}},[e._v("Save")])],1)]),e._v(" "),s("div",{staticClass:"card"},[s("div",{staticClass:"card__body"},[s("p-title",{attrs:{name:"name",autocomplete:"off",autofocus:"",required:"","has-error":e.form.errors.has("name"),"error-message":e.form.errors.get("name")},model:{value:e.form.name,callback:function(t){e.$set(e.form,"name",t)},expression:"form.name"}}),e._v(" "),s("section-builder",{staticClass:"mt-6",on:{input:e.$parent.sectionsChanged},model:{value:e.sections,callback:function(t){e.sections=t},expression:"sections"}})],1)])],1)}),[],!1,null,null,null);t.a=o.exports},uPdR:function(e,t,s){"use strict";s.r(t),s.d(t,"getFieldset",(function(){return a}));var n=s("ke3Z");function a(e,t){axios.get("/api/fieldsets/"+e).then((function(e){t(null,e.data.data)})).catch((function(e){t(new Error("The requested fieldset could not be found"))}))}var o={head:{title:function(){return{inner:this.form.name||"Loading..."}}},data:function(){return{id:null,resource:null,sections:[],originalSections:[],loaded:!1,form:new n.a({name:"",handle:""},!0)}},components:{"shared-form":s("UtPH").a},methods:{submit:function(){var e=this;this.form.patch("/api/fieldsets/"+this.resource.id).then((function(t){var s={};s.sections=e.sections,axios.post("/api/fieldsets/".concat(e.resource.id,"/sections"),s).then((function(t){toast("Fieldset successfully updated","success"),e.$router.push("/fieldsets")}))})).catch((function(e){toast(e.response.data.message,"failed")}))},sectionsChanged:function(e){this.loaded&&!this.form.hasChanges&&(_.isEqual(this.originalSections,e)||this.form.onFirstChange())}},beforeRouteEnter:function(e,t,s){a(e.params.fieldset,(function(e,t){s(e?function(t){t.$router.push("/fieldsets"),toast(e.toString(),"danger")}:function(e){e.resource=t,e.sections=t.sections,e.originalSections=_.cloneDeep(e.sections),e.form=new n.a({name:t.name,handle:t.handle},!0),e.loaded=!0,e.$emit("updateHead"),e.form.resetChangeListener()})}))}},r=s("KHd+"),i=Object(r.a)(o,(function(){var e=this.$createElement,t=this._self._c||e;return t("div",[t("portal",{attrs:{to:"title"}},[t("app-title",{attrs:{icon:"list"}},[this._v("Edit Fieldset")])],1),this._v(" "),t("shared-form",{attrs:{form:this.form,resource:this.resource}})],1)}),[],!1,null,null,null);t.default=i.exports}}]);