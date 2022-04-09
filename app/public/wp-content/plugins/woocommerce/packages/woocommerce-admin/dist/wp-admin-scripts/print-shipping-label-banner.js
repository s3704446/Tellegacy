this.wc=this.wc||{},this.wc.printShippingLabelBanner=function(e){var t={};function n(o){if(t[o])return t[o].exports;var i=t[o]={i:o,l:!1,exports:{}};return e[o].call(i.exports,i,i.exports,n),i.l=!0,i.exports}return n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var i in e)n.d(o,i,function(t){return e[t]}.bind(null,i));return o},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=469)}({0:function(e,t){e.exports=window.wp.element},1:function(e,t,n){e.exports=n(49)()},11:function(e,t){e.exports=window.wc.data},118:function(e,t,n){"use strict";function o(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}var i=n(23);var s=n(0);function r(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(e);t&&(o=o.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,o)}return n}t.a=function(e){var t=e.icon,n=e.size,c=void 0===n?24:n,a=function(e,t){if(null==e)return{};var n,o,s=Object(i.a)(e,t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);for(o=0;o<r.length;o++)n=r[o],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(s[n]=e[n])}return s}(e,["icon","size"]);return Object(s.cloneElement)(t,function(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?r(Object(n),!0).forEach((function(t){o(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):r(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}({width:c,height:c},a))}},13:function(e,t){e.exports=window.wp.compose},14:function(e,t){e.exports=window.wc.wcSettings},16:function(e,t){e.exports=window.wc.tracks},18:function(e,t){e.exports=window.wp.apiFetch},19:function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},i=c(n(5)),s=c(n(72)),r=c(n(75));function c(e){return e&&e.__esModule?e:{default:e}}var a=void 0;function l(e,t){var n,r,c,u,p,d,m,h,b=[],f={};for(d=0;d<e.length;d++)if("string"!==(p=e[d]).type){if(!t.hasOwnProperty(p.value)||void 0===t[p.value])throw new Error("Invalid interpolation, missing component node: `"+p.value+"`");if("object"!==o(t[p.value]))throw new Error("Invalid interpolation, component node must be a ReactElement or null: `"+p.value+"`","\n> "+a);if("componentClose"===p.type)throw new Error("Missing opening component token: `"+p.value+"`");if("componentOpen"===p.type){n=t[p.value],c=d;break}b.push(t[p.value])}else b.push(p.value);return n&&(u=function(e,t){var n,o,i=t[e],s=0;for(o=e+1;o<t.length;o++)if((n=t[o]).value===i.value){if("componentOpen"===n.type){s++;continue}if("componentClose"===n.type){if(0===s)return o;s--}}throw new Error("Missing closing component token `"+i.value+"`")}(c,e),m=l(e.slice(c+1,u),t),r=i.default.cloneElement(n,{},m),b.push(r),u<e.length-1&&(h=l(e.slice(u+1),t),b=b.concat(h))),1===b.length?b[0]:(b.forEach((function(e,t){e&&(f["interpolation-child-"+t]=e)})),(0,s.default)(f))}t.default=function(e){var t=e.mixedString,n=e.components,i=e.throwErrors;if(a=t,!n)return t;if("object"!==(void 0===n?"undefined":o(n))){if(i)throw new Error("Interpolation Error: unable to process `"+t+"` because components is not an object");return t}var s=(0,r.default)(t);try{return l(s,n)}catch(e){if(i)throw new Error("Interpolation Error: unable to process `"+t+"` because of error `"+e.message+"`");return t}}},2:function(e,t){e.exports=window.wp.i18n},22:function(e,t,n){"use strict";n.d(t,"d",(function(){return a})),n.d(t,"a",(function(){return l})),n.d(t,"b",(function(){return u})),n.d(t,"c",(function(){return p})),n.d(t,"e",(function(){return d}));var o=n(2),i=n(14);const s=["wcAdminSettings","preloadSettings"],r=Object(i.getSetting)("admin",{}),c=Object.keys(r).reduce((e,t)=>(s.includes(t)||(e[t]=r[t]),e),{});function a(e,t=!1,n=(e=>e)){if(s.includes(e))throw new Error(Object(o.__)("Mutable settings should be accessed via data store."));return n(c.hasOwnProperty(e)?c[e]:t,t)}Object(i.getSetting)("adminUrl"),Object(i.getSetting)("countries");const l=Object(i.getSetting)("currency"),u=Object(i.getSetting)("locale"),p=(Object(i.getSetting)("siteTitle"),Object(i.getSetting)("wcAssetUrl"),a("orderStatuses"));function d(e,t,n=(e=>e)){if(s.includes(e))throw new Error(Object(o.__)("Mutable settings should be mutated via data store."));c[e]=n(t)}},23:function(e,t,n){"use strict";function o(e,t){if(null==e)return{};var n,o,i={},s=Object.keys(e);for(o=0;o<s.length;o++)n=s[o],t.indexOf(n)>=0||(i[n]=e[n]);return i}n.d(t,"a",(function(){return o}))},255:function(e,t,n){},3:function(e,t){e.exports=window.wp.components},4:function(e,t){e.exports=window.lodash},40:function(e,t){e.exports=function(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e},e.exports.default=e.exports,e.exports.__esModule=!0},469:function(e,t,n){"use strict";n.r(t);var o=n(0),i=n(11),s=n(40),r=n.n(s),c=n(2),a=n(3),l=n(13),u=n(19),p=n.n(u),d=n(1),m=n.n(d),h=n(4),b=n(7),f=n(16);n(255);class w extends o.Component{constructor(...e){super(...e),r()(this,"setDismissed",e=>{this.props.updateOptions({woocommerce_shipping_dismissed_timestamp:e})}),r()(this,"hideBanner",()=>{document.getElementById("woocommerce-admin-print-label").style.display="none"}),r()(this,"remindMeLaterClicked",()=>{const{onCloseAll:e,trackElementClicked:t}=this.props;this.setDismissed(Date.now()),e(),this.hideBanner(),t("shipping_banner_dismiss_modal_remind_me_later")}),r()(this,"closeForeverClicked",()=>{const{onCloseAll:e,trackElementClicked:t}=this.props;this.setDismissed(-1),e(),this.hideBanner(),t("shipping_banner_dismiss_modal_close_forever")})}render(){const{onClose:e,visible:t}=this.props;return t?Object(o.createElement)(a.Modal,{title:Object(c.__)("Are you sure?",'woocommerce'),onRequestClose:e,className:"wc-admin-shipping-banner__dismiss-modal"},Object(o.createElement)("p",{className:"wc-admin-shipping-banner__dismiss-modal-help-text"},Object(c.__)("With WooCommerce Shipping you can Print shipping labels from your WooCommerce dashboard at the lowest USPS rates.",'woocommerce')),Object(o.createElement)("div",{className:"wc-admin-shipping-banner__dismiss-modal-actions"},Object(o.createElement)(a.Button,{isSecondary:!0,onClick:this.remindMeLaterClicked},Object(c.__)("Remind me later",'woocommerce')),Object(o.createElement)(a.Button,{isPrimary:!0,onClick:this.closeForeverClicked},Object(c.__)("I don't need this",'woocommerce')))):null}}var g=Object(l.compose)(Object(b.withDispatch)(e=>{const{updateOptions:t}=e(i.OPTIONS_STORE_NAME);return{updateOptions:t}}))(w),y=n(118),v=n(8),O=Object(o.createElement)(v.SVG,{xmlns:"http://www.w3.org/2000/svg",viewBox:"-2 -2 24 24"},Object(o.createElement)(v.Path,{d:"M10 2c4.42 0 8 3.58 8 8s-3.58 8-8 8-8-3.58-8-8 3.58-8 8-8zm1.13 9.38l.35-6.46H8.52l.35 6.46h2.26zm-.09 3.36c.24-.23.37-.55.37-.96 0-.42-.12-.74-.36-.97s-.59-.35-1.06-.35-.82.12-1.07.35-.37.55-.37.97c0 .41.13.73.38.96.26.23.61.34 1.06.34s.8-.11 1.05-.34z"}));const j="install",_="activate",S="setup",E="start",k={["download"]:Object(c.__)("download",'woocommerce'),[j]:Object(c.__)("install",'woocommerce'),[_]:Object(c.__)("activate",'woocommerce'),[S]:Object(c.__)("set up",'woocommerce'),[E]:Object(c.__)("start",'woocommerce')};function P({isSetupError:e,errorReason:t}){return e?Object(o.createElement)("div",{className:"wc-admin-shipping-banner-install-error"},Object(o.createElement)(y.a,{icon:O,className:"warning-icon"}),(e=>{const t=e in k?k[e]:k[S];return Object(c.sprintf)(Object(c.__)("Unable to %s the plugin. Refresh the page and try again.",'woocommerce'),t)})(t)):null}var x=n(18),C=n.n(x);var A=n(22);const R=Object(A.d)("wcAdminAssetUrl","");class B extends o.Component{constructor(e){super(e),r()(this,"isSetupError",()=>this.state.wcsSetupError),r()(this,"closeDismissModal",()=>{this.setState({isDismissModalOpen:!1}),this.trackElementClicked("shipping_banner_dismiss_modal_close_button")}),r()(this,"openDismissModal",()=>{this.setState({isDismissModalOpen:!0}),this.trackElementClicked("shipping_banner_dimiss")}),r()(this,"hideBanner",()=>{this.setState({showShippingBanner:!1})}),r()(this,"createShippingLabelClicked",()=>{const{activePlugins:e}=this.props;this.setState({isShippingLabelButtonBusy:!0}),this.trackElementClicked("shipping_banner_create_label"),e.includes("woocommerce-services")?this.acceptTosAndGetWCSAssets():this.installAndActivatePlugins("woocommerce-services")}),r()(this,"woocommerceServiceLinkClicked",()=>{this.trackElementClicked("shipping_banner_woocommerce_service_link")}),r()(this,"trackBannerEvent",(e,t={})=>{const{activePlugins:n,isJetpackConnected:o}=this.props;Object(f.recordEvent)(e,{banner_name:"wcadmin_install_wcs_prompt",jetpack_installed:n.includes("jetpack"),jetpack_connected:o,wcs_installed:n.includes("woocommerce-services"),...t})}),r()(this,"trackImpression",()=>{this.trackBannerEvent("banner_impression")}),r()(this,"trackElementClicked",e=>{this.trackBannerEvent("banner_element_clicked",{element:e})}),r()(this,"getInstallText",()=>{const{activePlugins:e}=this.props;return e.includes("woocommerce-services")?Object(c.__)('You\'ve already installed WooCommerce Shipping. By clicking "Create shipping label", you agree to its {{tosLink}}Terms of Service{{/tosLink}}.','woocommerce'):Object(c.__)('By clicking "Create shipping label", {{wcsLink}}WooCommerce Shipping{{/wcsLink}} will be installed and you agree to its {{tosLink}}Terms of Service{{/tosLink}}.','woocommerce')});const t=new URL(window.location.href).searchParams.get("post");this.state={showShippingBanner:!0,isDismissModalOpen:!1,setupErrorReason:S,orderId:parseInt(t,10),wcsAssetsLoaded:!1,wcsAssetsLoading:!1,wcsSetupError:!1,isShippingLabelButtonBusy:!1,installText:this.getInstallText(),isWcsModalOpen:!1}}componentDidMount(){const{showShippingBanner:e}=this.state;e&&this.trackImpression()}async installAndActivatePlugins(e){const{installPlugins:t,activatePlugins:n,isRequesting:o}=this.props;if(o)return!1;if(!0!==(await t([e])).success)return void this.setState({setupErrorReason:j,wcsSetupError:!0});!0===(await n([e])).success?this.acceptTosAndGetWCSAssets():this.setState({setupErrorReason:_,wcsSetupError:!0})}acceptTosAndGetWCSAssets(){return C()({path:"/wc/v1/connect/tos",method:"POST",data:{accepted:!0}}).then(()=>C()({path:"/wc/v1/connect/assets",method:"GET"})).then(e=>this.loadWcsAssets(e)).catch(()=>this.setState({wcsSetupError:!0}))}generateMetaBoxHtml(e,t,n){const o=JSON.stringify(n).replace(/"/g,"&quot;");return`\n<div id="${e}" class="postbox">\n\t<div class="postbox-header">\n\t\t<h2 class="hndle"><span>${t}</span></h2>\n\t\t<div class="handle-actions">\n\t\t\t<button type="button" class="handlediv" aria-expanded="true">\n\t\t\t\t<span class="screen-reader-text">${Object(c.__)("Toggle panel:",'woocommerce')} ${t}</span>\n\t\t\t\t<span class="toggle-indicator" aria-hidden="true"></span>\n\t\t\t</button>\n\t\t</div>\n\t</div>\n\t<div class="inside">\n\t\t<div class="wcc-root woocommerce wc-connect-create-shipping-label" data-args="${o}">\n\t\t</div>\n\t</div>\n</div>\n`}loadWcsAssets({assets:e}){if(this.state.wcsAssetsLoaded||this.state.wcsAssetsLoading)return void this.openWcsModal();this.setState({wcsAssetsLoading:!0});const t=e.wc_connect_admin_script,n=e.wc_connect_admin_style;if(void 0===window.wcsPluginData){const e=t.substring(0,t.lastIndexOf("/")+1);window.wcsPluginData={assetPath:e}}const{orderId:o}=this.state,{itemsCount:i}=this.props,s=this.generateMetaBoxHtml("woocommerce-order-label",Object(c.__)("Shipping Label",'woocommerce'),{order:{id:o},context:"shipping_label",items:i});document.getElementById("woocommerce-order-data").insertAdjacentHTML("beforebegin",s);const r=this.generateMetaBoxHtml("woocommerce-order-shipment-tracking",Object(c.__)("Shipment Tracking",'woocommerce'),{order:{id:o},context:"shipment_tracking",items:i});document.getElementById("woocommerce-order-actions").insertAdjacentHTML("afterend",r),window.jQuery&&(window.jQuery("#normal-sortables").sortable("refresh"),window.jQuery("#side-sortables").sortable("refresh"),window.jQuery("#woocommerce-order-label").hide()),Promise.all([new Promise((e,n)=>{const o=document.createElement("script");o.src=t,o.async=!0,o.onload=e,o.onerror=n,document.body.appendChild(o)}),new Promise((e,t)=>{if(""!==n){const o=document.getElementsByTagName("head")[0],i=document.createElement("link");i.rel="stylesheet",i.type="text/css",i.href=n,i.media="all",i.onload=e,i.onerror=t,o.appendChild(i)}else e()})]).then(()=>{this.setState({wcsAssetsLoaded:!0,wcsAssetsLoading:!1,isShippingLabelButtonBusy:!1}),this.openWcsModal()})}openWcsModal(){window.wcsGetAppStoreAsync&&window.wcsGetAppStoreAsync("wc-connect-create-shipping-label").then(e=>{const t=e.getState(),{orderId:n}=this.state,o=t.ui.selectedSiteId,i=e.subscribe(()=>{const t=e.getState(),s=Object(h.get)(t,["extensions","woocommerce","woocommerceServices",o,"shippingLabel",n],null),r=Object(h.get)(t,["extensions","woocommerce","woocommerceServices",o,"labelSettings"],null),a=Object(h.get)(t,["extensions","woocommerce","woocommerceServices",o,"packages"],null),l=Object(h.get)(t,["extensions","woocommerce","sites",o,"data","locations"]);s&&r&&r.meta&&a&&l&&(s.loaded&&r.meta.isLoaded&&a.isLoaded&&Object(h.isArray)(l)&&!this.state.isWcsModalOpen?(window.jQuery&&(this.setState({isWcsModalOpen:!0}),window.jQuery(".shipping-label__new-label-button").click()),e.dispatch({type:"NOTICE_CREATE",notice:{duration:1e4,status:"is-success",text:Object(c.__)("Plugin installed and activated",'woocommerce')}})):s.showPurchaseDialog&&(i(),window.jQuery&&window.jQuery("#woocommerce-order-label").show()))});document.getElementById("woocommerce-admin-print-label").style.display="none"})}render(){const{isDismissModalOpen:e,showShippingBanner:t,isShippingLabelButtonBusy:n}=this.state;return t?Object(o.createElement)("div",null,Object(o.createElement)("div",{className:"wc-admin-shipping-banner-container"},Object(o.createElement)("img",{className:"wc-admin-shipping-banner-illustration",src:R+"shippingillustration.svg",alt:Object(c.__)("Shipping ",'woocommerce')}),Object(o.createElement)("div",{className:"wc-admin-shipping-banner-blob"},Object(o.createElement)("h3",null,Object(c.__)("Print discounted shipping labels with a click.",'woocommerce')),Object(o.createElement)("p",null,p()({mixedString:this.state.installText,components:{tosLink:Object(o.createElement)(a.ExternalLink,{href:"https://wordpress.com/tos",target:"_blank",type:"external"}),wcsLink:Object(o.createElement)(a.ExternalLink,{href:"https://woocommerce.com/products/shipping/?utm_medium=product",target:"_blank",type:"external",onClick:this.woocommerceServiceLinkClicked})}})),Object(o.createElement)(P,{isSetupError:this.isSetupError(),errorReason:this.state.setupErrorReason})),Object(o.createElement)(a.Button,{disabled:n,isPrimary:!0,isBusy:n,onClick:this.createShippingLabelClicked},Object(c.__)("Create shipping label",'woocommerce')),Object(o.createElement)("button",{onClick:this.openDismissModal,type:"button",className:"notice-dismiss",disabled:this.state.isShippingLabelButtonBusy},Object(o.createElement)("span",{className:"screen-reader-text"},Object(c.__)("Close Print Label Banner.",'woocommerce')))),Object(o.createElement)(g,{visible:e,onClose:this.closeDismissModal,onCloseAll:this.hideBanner,trackElementClicked:this.trackElementClicked})):null}}B.propTypes={itemsCount:m.a.number.isRequired,isJetpackConnected:m.a.bool.isRequired,activePlugins:m.a.array.isRequired,activatePlugins:m.a.func.isRequired,installPlugins:m.a.func.isRequired,isRequesting:m.a.bool.isRequired};var L=Object(l.compose)(Object(b.withSelect)(e=>{const{isPluginsRequesting:t,isJetpackConnected:n,getActivePlugins:o}=e(i.PLUGINS_STORE_NAME);return{isRequesting:t("activatePlugins")||t("installPlugins"),isJetpackConnected:n(),activePlugins:o()}}),Object(b.withDispatch)(e=>{const{activatePlugins:t,installPlugins:n}=e(i.PLUGINS_STORE_NAME);return{activatePlugins:t,installPlugins:n}}))(B);const T=document.getElementById("wc-admin-shipping-banner-root"),M=T.dataset.args&&JSON.parse(T.dataset.args)||{},I=Object(i.withPluginsHydration)({...Object(A.d)("plugins"),jetpackStatus:Object(A.d)("dataEndpoints",{}).jetpackStatus})(L);Object(o.render)(Object(o.createElement)(I,{itemsCount:M.items}),T)},49:function(e,t,n){"use strict";var o=n(50);function i(){}function s(){}s.resetWarningCache=i,e.exports=function(){function e(e,t,n,i,s,r){if(r!==o){var c=new Error("Calling PropTypes validators directly is not supported by the `prop-types` package. Use PropTypes.checkPropTypes() to call them. Read more at http://fb.me/use-check-prop-types");throw c.name="Invariant Violation",c}}function t(){return e}e.isRequired=e;var n={array:e,bool:e,func:e,number:e,object:e,string:e,symbol:e,any:e,arrayOf:t,element:e,elementType:e,instanceOf:t,node:e,objectOf:t,oneOf:t,oneOfType:t,shape:t,exact:t,checkPropTypes:s,resetWarningCache:i};return n.PropTypes=n,n}},5:function(e,t){e.exports=window.React},50:function(e,t,n){"use strict";e.exports="SECRET_DO_NOT_PASS_THIS_OR_YOU_WILL_BE_FIRED"},51:function(e,t,n){"use strict";function o(e){return function(){return e}}var i=function(){};i.thatReturns=o,i.thatReturnsFalse=o(!1),i.thatReturnsTrue=o(!0),i.thatReturnsNull=o(null),i.thatReturnsThis=function(){return this},i.thatReturnsArgument=function(e){return e},e.exports=i},7:function(e,t){e.exports=window.wp.data},72:function(e,t,n){"use strict";var o=n(5),i="function"==typeof Symbol&&Symbol.for&&Symbol.for("react.element")||60103,s=n(51),r=n(73),c=n(74),a="function"==typeof Symbol&&Symbol.iterator;function l(e,t){return e&&"object"==typeof e&&null!=e.key?(n=e.key,o={"=":"=0",":":"=2"},"$"+(""+n).replace(/[=:]/g,(function(e){return o[e]}))):t.toString(36);var n,o}function u(e,t,n,o){var s,c=typeof e;if("undefined"!==c&&"boolean"!==c||(e=null),null===e||"string"===c||"number"===c||"object"===c&&e.$$typeof===i)return n(o,e,""===t?"."+l(e,0):t),1;var p=0,d=""===t?".":t+":";if(Array.isArray(e))for(var m=0;m<e.length;m++)p+=u(s=e[m],d+l(s,m),n,o);else{var h=function(e){var t=e&&(a&&e[a]||e["@@iterator"]);if("function"==typeof t)return t}(e);if(h){0;for(var b,f=h.call(e),w=0;!(b=f.next()).done;)p+=u(s=b.value,d+l(s,w++),n,o)}else if("object"===c){0;var g=""+e;r(!1,"Objects are not valid as a React child (found: %s).%s","[object Object]"===g?"object with keys {"+Object.keys(e).join(", ")+"}":g,"")}}return p}var p=/\/+/g;function d(e){return(""+e).replace(p,"$&/")}var m,h,b=f,f=function(e){if(this.instancePool.length){var t=this.instancePool.pop();return this.call(t,e),t}return new this(e)},w=function(e){r(e instanceof this,"Trying to release an instance into a pool of a different type."),e.destructor(),this.instancePool.length<this.poolSize&&this.instancePool.push(e)};function g(e,t,n,o){this.result=e,this.keyPrefix=t,this.func=n,this.context=o,this.count=0}function y(e,t,n){var i,r,c=e.result,a=e.keyPrefix,l=e.func,u=e.context,p=l.call(u,t,e.count++);Array.isArray(p)?v(p,c,n,s.thatReturnsArgument):null!=p&&(o.isValidElement(p)&&(i=p,r=a+(!p.key||t&&t.key===p.key?"":d(p.key)+"/")+n,p=o.cloneElement(i,{key:r},void 0!==i.props?i.props.children:void 0)),c.push(p))}function v(e,t,n,o,i){var s="";null!=n&&(s=d(n)+"/");var r=g.getPooled(t,s,o,i);!function(e,t,n){null==e||u(e,"",t,n)}(e,y,r),g.release(r)}g.prototype.destructor=function(){this.result=null,this.keyPrefix=null,this.func=null,this.context=null,this.count=0},m=function(e,t,n,o){if(this.instancePool.length){var i=this.instancePool.pop();return this.call(i,e,t,n,o),i}return new this(e,t,n,o)},(h=g).instancePool=[],h.getPooled=m||b,h.poolSize||(h.poolSize=10),h.release=w;e.exports=function(e){if("object"!=typeof e||!e||Array.isArray(e))return c(!1,"React.addons.createFragment only accepts a single object. Got: %s",e),e;if(o.isValidElement(e))return c(!1,"React.addons.createFragment does not accept a ReactElement without a wrapper object."),e;r(1!==e.nodeType,"React.addons.createFragment(...): Encountered an invalid child; DOM elements are not valid children of React components.");var t=[];for(var n in e)v(e[n],t,n,s.thatReturnsArgument);return t}},73:function(e,t,n){"use strict";e.exports=function(e,t,n,o,i,s,r,c){if(!e){var a;if(void 0===t)a=new Error("Minified exception occurred; use the non-minified dev environment for the full error message and additional helpful warnings.");else{var l=[n,o,i,s,r,c],u=0;(a=new Error(t.replace(/%s/g,(function(){return l[u++]})))).name="Invariant Violation"}throw a.framesToPop=1,a}}},74:function(e,t,n){"use strict";var o=n(51);e.exports=o},75:function(e,t,n){"use strict";function o(e){return e.match(/^\{\{\//)?{type:"componentClose",value:e.replace(/\W/g,"")}:e.match(/\/\}\}$/)?{type:"componentSelfClosing",value:e.replace(/\W/g,"")}:e.match(/^\{\{/)?{type:"componentOpen",value:e.replace(/\W/g,"")}:{type:"string",value:e}}e.exports=function(e){return e.split(/(\{\{\/?\s*\w+\s*\/?\}\})/g).map(o)}},8:function(e,t){e.exports=window.wp.primitives}});