"use strict";(self.webpackChunksubscription=self.webpackChunksubscription||[]).push([[480],{50:(t,e,n)=>{n.d(e,{Z:()=>a});var r=n(519),i=n.n(r)()((function(t){return t[1]}));i.push([t.id,".subtable thead th{padding-left:16px}.badge-success{background-color:#28a745;color:#fff}",""]);const a=i},519:t=>{t.exports=function(t){var e=[];return e.toString=function(){return this.map((function(e){var n=t(e);return e[2]?"@media ".concat(e[2]," {").concat(n,"}"):n})).join("")},e.i=function(t,n,r){"string"==typeof t&&(t=[[null,t,""]]);var i={};if(r)for(var a=0;a<this.length;a++){var s=this[a][0];null!=s&&(i[s]=!0)}for(var o=0;o<t.length;o++){var c=[].concat(t[o]);r&&i[c[0]]||(n&&(c[2]?c[2]="".concat(n," and ").concat(c[2]):c[2]=n),e.push(c))}},e}},379:(t,e,n)=>{var r,i=function(){return void 0===r&&(r=Boolean(window&&document&&document.all&&!window.atob)),r},a=function(){var t={};return function(e){if(void 0===t[e]){var n=document.querySelector(e);if(window.HTMLIFrameElement&&n instanceof window.HTMLIFrameElement)try{n=n.contentDocument.head}catch(t){n=null}t[e]=n}return t[e]}}(),s=[];function o(t){for(var e=-1,n=0;n<s.length;n++)if(s[n].identifier===t){e=n;break}return e}function c(t,e){for(var n={},r=[],i=0;i<t.length;i++){var a=t[i],c=e.base?a[0]+e.base:a[0],u=n[c]||0,d="".concat(c," ").concat(u);n[c]=u+1;var l=o(d),f={css:a[1],media:a[2],sourceMap:a[3]};-1!==l?(s[l].references++,s[l].updater(f)):s.push({identifier:d,updater:_(f,e),references:1}),r.push(d)}return r}function u(t){var e=document.createElement("style"),r=t.attributes||{};if(void 0===r.nonce){var i=n.nc;i&&(r.nonce=i)}if(Object.keys(r).forEach((function(t){e.setAttribute(t,r[t])})),"function"==typeof t.insert)t.insert(e);else{var s=a(t.insert||"head");if(!s)throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");s.appendChild(e)}return e}var d,l=(d=[],function(t,e){return d[t]=e,d.filter(Boolean).join("\n")});function f(t,e,n,r){var i=n?"":r.media?"@media ".concat(r.media," {").concat(r.css,"}"):r.css;if(t.styleSheet)t.styleSheet.cssText=l(e,i);else{var a=document.createTextNode(i),s=t.childNodes;s[e]&&t.removeChild(s[e]),s.length?t.insertBefore(a,s[e]):t.appendChild(a)}}function p(t,e,n){var r=n.css,i=n.media,a=n.sourceMap;if(i?t.setAttribute("media",i):t.removeAttribute("media"),a&&"undefined"!=typeof btoa&&(r+="\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(a))))," */")),t.styleSheet)t.styleSheet.cssText=r;else{for(;t.firstChild;)t.removeChild(t.firstChild);t.appendChild(document.createTextNode(r))}}var v=null,h=0;function _(t,e){var n,r,i;if(e.singleton){var a=h++;n=v||(v=u(e)),r=f.bind(null,n,a,!1),i=f.bind(null,n,a,!0)}else n=u(e),r=p.bind(null,n,e),i=function(){!function(t){if(null===t.parentNode)return!1;t.parentNode.removeChild(t)}(n)};return r(t),function(e){if(e){if(e.css===t.css&&e.media===t.media&&e.sourceMap===t.sourceMap)return;r(t=e)}else i()}}t.exports=function(t,e){(e=e||{}).singleton||"boolean"==typeof e.singleton||(e.singleton=i());var n=c(t=t||[],e);return function(t){if(t=t||[],"[object Array]"===Object.prototype.toString.call(t)){for(var r=0;r<n.length;r++){var i=o(n[r]);s[i].references--}for(var a=c(t,e),u=0;u<n.length;u++){var d=o(n[u]);0===s[d].references&&(s[d].updater(),s.splice(d,1))}n=a}}}},480:(t,e,n)=>{n.r(e),n.d(e,{default:()=>c});const r={data:function(){return{uid:null,tabs:null,subs:null,user:null,response:null,rdExtend:null}},beforeRouteEnter:function(t,e,n){axios.get("/api/admin/user-list/"+t.params.id+"/sub").then((function(e){n((function(n){n.uid=t.params.id,n.subs=e.data.subs,n.tabs=e.data.tabs,n.user=e.data.user,n.response=e.data}))})).catch((function(t){n((function(t){return console.log(error)}))}))},methods:{extend:function(){var t=this,e=this.rdExtend,n=this.uid;axios.put("/api/admin/user-list/"+n,null,{params:{packageid:e,uid:n}}).then((function(e){t.$router.back()}))}}};var i=n(379),a=n.n(i),s=n(50),o={insert:"head",singleton:!1};a()(s.Z,o);s.Z.locals;const c=(0,n(900).Z)(r,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("portal",{attrs:{to:"title"}},[t.user?n("page-title",{attrs:{icon:"users"}},[t._v("User - "+t._s(t.user.name))]):t._e()],1),t._v(" "),n("portal",{attrs:{to:"actions"}},[n("router-link",{staticClass:"button",attrs:{to:{name:"user-list.index"}}},[t._v("Go back")])],1),t._v(" "),n("table",{staticClass:"table"},[n("tbody",[n("tr",[n("td",[t._v("Email")]),t._v(" "),n("td",[t._v(t._s(t.user.email))])]),t._v(" "),n("tr",[n("td",[t._v("Membership Expire At")]),t._v(" "),n("td",[t._v(t._s(t.user.memberExpiryDate))])]),t._v(" "),n("tr",[n("td",[t._v("Is Member")]),t._v(" "),t.user.isMember?n("td",[n("span",{staticClass:"badge badge-success"},[t._v("Active Member")])]):n("td",[n("span",{staticClass:"badge"},[t._v("Non Member")])])])])]),t._v(" "),n("table",{staticClass:"table subtable",staticStyle:{"margin-top":"20px"}},[t._m(0),t._v(" "),n("tbody",t._l(t.subs,(function(e,r){return n("tr",[n("td",[t._v(t._s(r+1))]),t._v(" "),n("td",[t._v(t._s(e.name))]),t._v(" "),n("td",[t._v(t._s(e.subscription_items[0].valid_period))]),t._v(" "),n("td",[t._v(t._s(e.price))]),t._v(" "),n("td",{staticStyle:{"text-align":"right"}},[n("input",{directives:[{name:"model",rawName:"v-model",value:t.rdExtend,expression:"rdExtend"}],attrs:{type:"radio",name:"rdExtend"},domProps:{value:e.subscription_items[0].package_id,checked:t._q(t.rdExtend,e.subscription_items[0].package_id)},on:{change:function(n){t.rdExtend=e.subscription_items[0].package_id}}})])])})),0)]),t._v(" "),n("button",{staticStyle:{"margin-top":"16px",width:"10%","background-color":"#343c4b",color:"white"},attrs:{id:"btnExtend"},on:{click:function(e){return t.extend()}}},[t._v("Extend")])],1)}),[function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("thead",[n("tr",{staticStyle:{height:"30px"}},[n("th",{staticStyle:{width:"5%"}},[t._v("#")]),t._v(" "),n("th",{staticStyle:{width:"25%"}},[t._v("Name")]),t._v(" "),n("th",{staticStyle:{width:"25%"}},[t._v("Subscription Days")]),t._v(" "),n("th",{staticStyle:{width:"25%"}},[t._v("Price")]),t._v(" "),n("th",{staticStyle:{width:"20%"}})])])}],!1,null,null,null).exports},900:(t,e,n)=>{function r(t,e,n,r,i,a,s,o){var c,u="function"==typeof t?t.options:t;if(e&&(u.render=e,u.staticRenderFns=n,u._compiled=!0),r&&(u.functional=!0),a&&(u._scopeId="data-v-"+a),s?(c=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),i&&i.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(s)},u._ssrRegister=c):i&&(c=o?function(){i.call(this,(u.functional?this.parent:this).$root.$options.shadowRoot)}:i),c)if(u.functional){u._injectStyles=c;var d=u.render;u.render=function(t,e){return c.call(e),d(t,e)}}else{var l=u.beforeCreate;u.beforeCreate=l?[].concat(l,c):[c]}return{exports:t,options:u}}n.d(e,{Z:()=>r})}}]);