(window.webpackJsonp=window.webpackJsonp||[]).push([[59],{qIk6:function(t,e,a){"use strict";a.r(e);var i=a("zwY0"),l=a.n(i),n={name:"datetime-fieldtype",data:function(){return{datetime:"",flatpickr:null}},props:{field:{type:Object,required:!0},value:{required:!1,default:null}},methods:{emitEvent:function(t,e,a){this.$emit("input",this.format(e,a))},format:function(t,e){if(""!=t){var a=e.parseDate(t);return e.formatDate(a,"Y-m-d H:i:S")}return null},adjustTimezone:function(t){var e=(new Date).getTimezoneOffset(),a=new Date(this.datetime);return a=new Date(a.getTime()+6e4*e)}},mounted:function(){if(this.datetime=this.value,this.flatpickr=l()("#flatpickr_"+this.field.handle,{altInput:!0,enableTime:this.field.settings.time,altFormat:this.field.settings.format||"Y-m-d",minuteIncrement:1,allowInput:!1,clickOpens:!0,defaultDate:this.value,onChange:this.emitEvent}),this.value){var t=this.adjustTimezone(this.datetime),e=this.format(t,this.flatpickr);this.flatpickr.setDate(e),this.emitEvent(null,this.flatpickr.latestSelectedDateObj,this.flatpickr)}}},s=a("KHd+"),r=Object(s.a)(n,(function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"datetime"},[a("label",{staticClass:"form__label",attrs:{for:t.field.handle}},[t._v(t._s(t.field.name))]),t._v(" "),a("div",{staticClass:"flex items-center relative"},[a("fa-icon",{staticClass:"ml-3 absolute z-10 pointer-events-none",attrs:{icon:"calendar-alt"}}),t._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:t.datetime,expression:"datetime"}],staticClass:"datetime__input form__control mr-2 background-inherit",attrs:{id:"flatpickr_"+t.field.handle,name:t.field.handle,help:t.field.help,placeholder:t.field.settings.placeholder},domProps:{value:t.datetime},on:{input:function(e){e.target.composing||(t.datetime=e.target.value)}}})],1),t._v(" "),t.datetime?a("a",{staticClass:"datetime__clear text-sm pl-1",attrs:{href:"#",title:"Clear date"},on:{click:function(e){return e.preventDefault(),t.flatpickr.clear()}}},[t._v("\n    Clear date\n  ")]):t._e(),t._v(" "),t.field.help?a("div",{staticClass:"form__control--meta"},[a("div",{staticClass:"form__help"},[a("span",{domProps:{innerHTML:t._s(t.field.help)}})])]):t._e()])}),[],!1,null,null,null);e.default=r.exports}}]);