(window.webpackJsonp=window.webpackJsonp||[]).push([[43],{EACl:function(e,l,t){"use strict";t.r(l),l.default={props:{value:{required:!0}},watch:{value:{deep:!0,handler:function(e){this.$emit("input",e)}}}}},"ve+l":function(e,l,t){"use strict";t.r(l);var a={name:"input-fieldtype-settings",data:function(){return{type:this.value.type||"text",placeholder:this.value.placeholder||""}},mixins:[t("EACl").default]},n=t("KHd+"),u=Object(n.a)(a,(function(){var e=this,l=e.$createElement,t=e._self._c||l;return t("div",[t("p-select",{attrs:{name:"settings.type",label:"Type",help:"What type of input should this be?",autocomplete:"off",options:[{label:"Text",value:"text"},{label:"E-mail",value:"email"},{label:"Hidden",value:"hidden"},{label:"Password",value:"password"},{label:"Search",value:"search"},{label:"Telephone Number",value:"tel"},{label:"URL",value:"url"}]},model:{value:e.value.type,callback:function(l){e.$set(e.value,"type",l)},expression:"value.type"}}),e._v(" "),t("p-input",{attrs:{name:"settings.placeholder",label:"Placeholder",help:"Text that will appear inside the input element's content area when empty.",autocomplete:"off"},model:{value:e.value.placeholder,callback:function(l){e.$set(e.value,"placeholder",l)},expression:"value.placeholder"}})],1)}),[],!1,null,null,null);l.default=u.exports}}]);