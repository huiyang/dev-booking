(window.webpackJsonp=window.webpackJsonp||[]).push([[35],{EACl:function(e,t,s){"use strict";t.a={props:{value:{type:Object,required:!0}},computed:{settings:function(){return this.value.settings||{}},errors:function(){return this.value.errors||{}}}}},gsm3:function(e,t,s){"use strict";s.r(t);var n={name:"toggle-fieldtype-settings",mixins:[s("EACl").a]},l=s("KHd+"),r=Object(l.a)(n,(function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div",[s("p-toggle",{attrs:{name:"settings.default",label:"Default",help:"What would you like the default value to be?",checked:!!e.settings.default,"has-error":e.errors.has("settings.default"),"error-message":e.errors.get("settings.default")},model:{value:e.settings.default,callback:function(t){e.$set(e.settings,"default",t)},expression:"settings.default"}})],1)}),[],!1,null,null,null);t.default=r.exports}}]);