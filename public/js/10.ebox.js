(window.webpackJsonp=window.webpackJsonp||[]).push([[10],{ls82:function(e,t,n){var i=function(e){"use strict";var t=Object.prototype,n=t.hasOwnProperty,i="function"==typeof Symbol?Symbol:{},r=i.iterator||"@@iterator",a=i.asyncIterator||"@@asyncIterator",o=i.toStringTag||"@@toStringTag";function s(e,t,n){return Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}),e[t]}try{s({},"")}catch(e){s=function(e,t,n){return e[t]=n}}function l(e,t,n,i){var r=t&&t.prototype instanceof u?t:u,a=Object.create(r.prototype),o=new x(i||[]);return a._invoke=function(e,t,n){var i="suspendedStart";return function(r,a){if("executing"===i)throw new Error("Generator is already running");if("completed"===i){if("throw"===r)throw a;return $()}for(n.method=r,n.arg=a;;){var o=n.delegate;if(o){var s=k(o,n);if(s){if(s===c)continue;return s}}if("next"===n.method)n.sent=n._sent=n.arg;else if("throw"===n.method){if("suspendedStart"===i)throw i="completed",n.arg;n.dispatchException(n.arg)}else"return"===n.method&&n.abrupt("return",n.arg);i="executing";var l=d(e,t,n);if("normal"===l.type){if(i=n.done?"completed":"suspendedYield",l.arg===c)continue;return{value:l.arg,done:n.done}}"throw"===l.type&&(i="completed",n.method="throw",n.arg=l.arg)}}}(e,n,o),a}function d(e,t,n){try{return{type:"normal",arg:e.call(t,n)}}catch(e){return{type:"throw",arg:e}}}e.wrap=l;var c={};function u(){}function f(){}function m(){}var h={};s(h,r,(function(){return this}));var p=Object.getPrototypeOf,v=p&&p(p(I([])));v&&v!==t&&n.call(v,r)&&(h=v);var g=m.prototype=u.prototype=Object.create(h);function _(e){["next","throw","return"].forEach((function(t){s(e,t,(function(e){return this._invoke(t,e)}))}))}function y(e,t){var i;this._invoke=function(r,a){function o(){return new t((function(i,o){!function i(r,a,o,s){var l=d(e[r],e,a);if("throw"!==l.type){var c=l.arg,u=c.value;return u&&"object"==typeof u&&n.call(u,"__await")?t.resolve(u.__await).then((function(e){i("next",e,o,s)}),(function(e){i("throw",e,o,s)})):t.resolve(u).then((function(e){c.value=e,o(c)}),(function(e){return i("throw",e,o,s)}))}s(l.arg)}(r,a,i,o)}))}return i=i?i.then(o,o):o()}}function k(e,t){var n=e.iterator[t.method];if(void 0===n){if(t.delegate=null,"throw"===t.method){if(e.iterator.return&&(t.method="return",t.arg=void 0,k(e,t),"throw"===t.method))return c;t.method="throw",t.arg=new TypeError("The iterator does not provide a 'throw' method")}return c}var i=d(n,e.iterator,t.arg);if("throw"===i.type)return t.method="throw",t.arg=i.arg,t.delegate=null,c;var r=i.arg;return r?r.done?(t[e.resultName]=r.value,t.next=e.nextLoc,"return"!==t.method&&(t.method="next",t.arg=void 0),t.delegate=null,c):r:(t.method="throw",t.arg=new TypeError("iterator result is not an object"),t.delegate=null,c)}function w(e){var t={tryLoc:e[0]};1 in e&&(t.catchLoc=e[1]),2 in e&&(t.finallyLoc=e[2],t.afterLoc=e[3]),this.tryEntries.push(t)}function b(e){var t=e.completion||{};t.type="normal",delete t.arg,e.completion=t}function x(e){this.tryEntries=[{tryLoc:"root"}],e.forEach(w,this),this.reset(!0)}function I(e){if(e){var t=e[r];if(t)return t.call(e);if("function"==typeof e.next)return e;if(!isNaN(e.length)){var i=-1,a=function t(){for(;++i<e.length;)if(n.call(e,i))return t.value=e[i],t.done=!1,t;return t.value=void 0,t.done=!0,t};return a.next=a}}return{next:$}}function $(){return{value:void 0,done:!0}}return f.prototype=m,s(g,"constructor",m),s(m,"constructor",f),f.displayName=s(m,o,"GeneratorFunction"),e.isGeneratorFunction=function(e){var t="function"==typeof e&&e.constructor;return!!t&&(t===f||"GeneratorFunction"===(t.displayName||t.name))},e.mark=function(e){return Object.setPrototypeOf?Object.setPrototypeOf(e,m):(e.__proto__=m,s(e,o,"GeneratorFunction")),e.prototype=Object.create(g),e},e.awrap=function(e){return{__await:e}},_(y.prototype),s(y.prototype,a,(function(){return this})),e.AsyncIterator=y,e.async=function(t,n,i,r,a){void 0===a&&(a=Promise);var o=new y(l(t,n,i,r),a);return e.isGeneratorFunction(n)?o:o.next().then((function(e){return e.done?e.value:o.next()}))},_(g),s(g,o,"Generator"),s(g,r,(function(){return this})),s(g,"toString",(function(){return"[object Generator]"})),e.keys=function(e){var t=[];for(var n in e)t.push(n);return t.reverse(),function n(){for(;t.length;){var i=t.pop();if(i in e)return n.value=i,n.done=!1,n}return n.done=!0,n}},e.values=I,x.prototype={constructor:x,reset:function(e){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(b),!e)for(var t in this)"t"===t.charAt(0)&&n.call(this,t)&&!isNaN(+t.slice(1))&&(this[t]=void 0)},stop:function(){this.done=!0;var e=this.tryEntries[0].completion;if("throw"===e.type)throw e.arg;return this.rval},dispatchException:function(e){if(this.done)throw e;var t=this;function i(n,i){return o.type="throw",o.arg=e,t.next=n,i&&(t.method="next",t.arg=void 0),!!i}for(var r=this.tryEntries.length-1;r>=0;--r){var a=this.tryEntries[r],o=a.completion;if("root"===a.tryLoc)return i("end");if(a.tryLoc<=this.prev){var s=n.call(a,"catchLoc"),l=n.call(a,"finallyLoc");if(s&&l){if(this.prev<a.catchLoc)return i(a.catchLoc,!0);if(this.prev<a.finallyLoc)return i(a.finallyLoc)}else if(s){if(this.prev<a.catchLoc)return i(a.catchLoc,!0)}else{if(!l)throw new Error("try statement without catch or finally");if(this.prev<a.finallyLoc)return i(a.finallyLoc)}}}},abrupt:function(e,t){for(var i=this.tryEntries.length-1;i>=0;--i){var r=this.tryEntries[i];if(r.tryLoc<=this.prev&&n.call(r,"finallyLoc")&&this.prev<r.finallyLoc){var a=r;break}}a&&("break"===e||"continue"===e)&&a.tryLoc<=t&&t<=a.finallyLoc&&(a=null);var o=a?a.completion:{};return o.type=e,o.arg=t,a?(this.method="next",this.next=a.finallyLoc,c):this.complete(o)},complete:function(e,t){if("throw"===e.type)throw e.arg;return"break"===e.type||"continue"===e.type?this.next=e.arg:"return"===e.type?(this.rval=this.arg=e.arg,this.method="return",this.next="end"):"normal"===e.type&&t&&(this.next=t),c},finish:function(e){for(var t=this.tryEntries.length-1;t>=0;--t){var n=this.tryEntries[t];if(n.finallyLoc===e)return this.complete(n.completion,n.afterLoc),b(n),c}},catch:function(e){for(var t=this.tryEntries.length-1;t>=0;--t){var n=this.tryEntries[t];if(n.tryLoc===e){var i=n.completion;if("throw"===i.type){var r=i.arg;b(n)}return r}}throw new Error("illegal catch attempt")},delegateYield:function(e,t,n){return this.delegate={iterator:I(e),resultName:t,nextLoc:n},"next"===this.method&&(this.arg=void 0),c}},e}(e.exports);try{regeneratorRuntime=i}catch(e){"object"==typeof globalThis?globalThis.regeneratorRuntime=i:Function("r","regeneratorRuntime = r")(i)}},o0o1:function(e,t,n){e.exports=n("ls82")},z4GA:function(e,t,n){"use strict";n.r(t);var i=n("o0o1"),r=n.n(i);function a(e,t){return function(e){if(Array.isArray(e))return e}(e)||function(e,t){var n=null==e?null:"undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(null==n)return;var i,r,a=[],o=!0,s=!1;try{for(n=n.call(e);!(o=(i=n.next()).done)&&(a.push(i.value),!t||a.length!==t);o=!0);}catch(e){s=!0,r=e}finally{try{o||null==n.return||n.return()}finally{if(s)throw r}}return a}(e,t)||function(e,t){if(!e)return;if("string"==typeof e)return o(e,t);var n=Object.prototype.toString.call(e).slice(8,-1);"Object"===n&&e.constructor&&(n=e.constructor.name);if("Map"===n||"Set"===n)return Array.from(e);if("Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n))return o(e,t)}(e,t)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function o(e,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,i=new Array(t);n<t;n++)i[n]=e[n];return i}function s(e,t,n,i,r,a,o){try{var s=e[a](o),l=s.value}catch(e){return void n(e)}s.done?t(l):Promise.resolve(l).then(i,r)}var l={data:function(e){return{csrf:document.querySelector('meta[name="csrf-token"]').getAttribute("content"),editmode:!1,dialog:!1,dialogDelete:!1,search:"",permohonankredit:[],valid:!0,editedItem:{id:"",kantor_id:"",no_ktp:"",no_rekening:"",namafile:"",status_id:""},file:null,file_disetujui:null,file_spk:null,noktpRules:[function(e){return!!e||"No KTP Belum Diisi"}],cekNorekData:[],pesaneror:[],nameRules:[function(e){return!!e||"Nama File Belum Diisi"}],menu1:!1,menu2:!1,dateFormatted:e.formatDate(new Date(Date.now()-6e4*(new Date).getTimezoneOffset()).toISOString().substr(0,10)),tgl_permohonan:new Date(Date.now()-6e4*(new Date).getTimezoneOffset()).toISOString().substr(0,10),tgl_permohonanRules:[function(e){return!!e||"Tanggal realisasi belum diisi"}],form:new Form({id:"",kantor_id:"",namafile:"",tgl_permohonan:"",file:""})}},computed:{headers:function(){var e=[{text:"No",value:"index",align:"center",sortable:!1},{text:"Kantor",value:"nama_kantor",align:"start"},{text:"No KTP",value:"no_ktp"},{text:"No Rekening",value:"no_rekening"},{text:"Nama Nasabah",value:"namafile"},{text:"Tanggal Permohonan",value:"tgl_permohonan"},{text:"Tanggal Disetujui/Ditolak",value:"tgl_setujutolak"},{text:"Tanggal Pencairan",value:"tgl_pencairan"},{text:"Status",value:"statuspermohonan"}];return e.push({text:"File Permohonan",value:"file",sortable:!1,align:"center"}),e.push({text:"File Disetujui",value:"file_disetujui",sortable:!1,align:"center"}),e.push({text:"File SPK",value:"file_spk",sortable:!1,align:"center"}),e.push({text:"Update Status",value:"edit",sortable:!1,align:"center"}),this.$gate.isAdmin()&&e.push({text:"Hapus",value:"actions",sortable:!1}),e},computedDateFormatted:function(){return this.formatDate(this.tgl_permohonan)},formTitle:function(){return-1===this.editedIndex?"New Item":"Edit Item"}},watch:{tgl_permohonan:function(e){this.dateFormatted=this.formatDate(this.tgl_permohonan)},dialog:function(e){e||this.close()},dialogDelete:function(e){e||this.closeDelete()}},created:function(){this.$Progress.start(),this.initialize(),this.$Progress.finish()},methods:{getColor:function(e){return"Selesai"===e?"green":"Ditolak"===e?"red":"orange"},cekNorek:function(){var e,t=this;return(e=r.a.mark((function e(){var n,i;return r.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:if(!(t.$gate.isAdmin()||t.$gate.isKredit()||t.$gate.isBisnis())){e.next=7;break}return(n=new FormData).set("no_ktp",t.editedItem.no_ktp),e.next=5,axios.post("api/permohonankredit/ceknorek",n);case 5:"adarek"==(i=e.sent).data.message&&(t.cekNorekData=i.data.data[0].no_ktp,t.pesaneror="No KTP "+t.cekNorekData+" Sudah Ada",Toast.fire({icon:"error",title:"No KTP "+i.data.data[0].no_ktp+" Sudah Ada Dalam Data"}),t.initialize());case 7:case"end":return e.stop()}}),e)})),function(){var t=this,n=arguments;return new Promise((function(i,r){var a=e.apply(t,n);function o(e){s(a,i,r,o,l,"next",e)}function l(e){s(a,i,r,o,l,"throw",e)}o(void 0)}))})()},norekKeyboard:function(e){var t=(e=e||window.event).which?e.which:e.keyCode;if(!(t>31&&(t<48||t>57)&&(t<95||t>105)&&46!==t&&75!==t))return this.editedItem.no_rekening=this.editedItem.no_rekening.toUpperCase(),!0;e.preventDefault()},noktpKeyboard:function(e){var t=(e=e||window.event).which?e.which:e.keyCode;if(!(t>31&&(t<48||t>57)&&(t<95||t>105)&&46!==t))return!0;e.preventDefault()},pencetKeyboard:function(e){var t=(e=e||window.event).which?e.which:e.keyCode;if(191!==t&&220!==t)return!0;e.preventDefault()},formatDate:function(e){if(!e)return null;var t=a(e.split("-"),3),n=t[0],i=t[1],r=t[2];return"".concat(r,"/").concat(i,"/").concat(n)},parseDate:function(e){if(!e)return null;var t=a(e.split("/"),3),n=t[0],i=t[1],r=t[2];return"".concat(r,"-").concat(i.padStart(2,"0"),"-").concat(n.padStart(2,"0"))},initialize:function(){var e=this;this.$Progress.start(),(this.$gate.isAdmin()||this.$gate.isKredit()||this.$gate.isBisnis())&&axios.get("api/permohonankredit").then((function(t){e.permohonankredit=t.data.data,e.editedItem.kantor_id=e.$kantor_id})),this.$Progress.finish()},editModal:function(e){this.editmode=!0,$("#addNew").modal("show"),this.editedItem.id=e.id,this.editedItem.kantor_id=this.$kantor_id,this.editedItem.status_id=e.status_id,this.editedItem.no_ktp=e.no_ktp,this.editedItem.no_rekening=e.no_rekening,this.editedItem.namafile=e.namafile},newModal:function(){this.editmode=!1,$("#addNew").modal("show"),this.$refs.form.reset(),this.editedItem.namafile="",this.editedItem.no_ktp="",this.editedItem.no_rekening="",this.pesaneror=""},createUser:function(){var e=this;this.$refs.form.validate(),this.$Progress.start();var t=new FormData;t.set("kantor_id",this.editedItem.kantor_id),t.set("no_ktp",this.editedItem.no_ktp),t.set("no_rekening",this.editedItem.no_rekening),t.set("namafile",this.editedItem.namafile),t.set("tgl_permohonan",this.tgl_permohonan),t.set("file",this.file),t.set("status_id",1),axios.post("api/permohonankredit",t,{headers:{"content-type":"multipart/form-data"}}).then((function(t){$("#addNew").modal("hide"),Toast.fire({icon:"success",title:t.data.message}),e.$Progress.finish(),e.initialize()})).catch((function(e){for(var t=e.response.data.errors,n=0,i=Object.entries(t);n<i.length;n++){var r=a(i[n],2),o=(r[0],r[1]);Toast.fire({icon:"error",title:o})}}))},downloadFile:function(e,t){axios({url:"api/permohonankredit/download/"+e,method:"GET",responseType:"blob"}).then((function(e){var n=window.URL.createObjectURL(new Blob([e.data])),i=document.createElement("a");i.href=n,i.setAttribute("download","tabfile.zip"),i.download=t,document.body.appendChild(i),i.click()})).catch((function(){Swal.fire("Gagal Download!","File tidak ada...","warning")}))},downloadFileDisetujui:function(e,t){axios({url:"api/permohonankredit/filesetuju/"+e,method:"GET",responseType:"blob"}).then((function(e){var n=window.URL.createObjectURL(new Blob([e.data])),i=document.createElement("a");i.href=n,i.setAttribute("download","tabfile.zip"),i.download=t,document.body.appendChild(i),i.click()})).catch((function(){Swal.fire("Gagal Download!","File disetujui belum diupload.","warning")}))},downloadFileSpk:function(e,t){axios({url:"api/permohonankredit/filespk/"+e,method:"GET",responseType:"blob"}).then((function(e){var n=window.URL.createObjectURL(new Blob([e.data])),i=document.createElement("a");i.href=n,i.setAttribute("download","tabfile.zip"),i.download=t,document.body.appendChild(i),i.click()})).catch((function(){Swal.fire("Gagal Download!","File SPK belum diupload.","warning")}))},updateUser:function(){var e=this;this.$refs.form.validate(),this.$Progress.start();var t=new FormData;t.set("no_ktp",this.editedItem.no_ktp),t.set("no_rekening",this.editedItem.no_rekening),t.set("namafile",this.editedItem.namafile),(this.$gate.isAdmin()||this.$gate.isKredit())&&(t.set("tgl_pencairan",this.tgl_permohonan),t.set("file_spk",this.file)),(this.$gate.isAdmin()||this.$gate.isBisnis())&&(t.set("tgl_setujutolak",this.tgl_permohonan),t.set("file_disetujui",this.file)),t.set("status_id",this.editedItem.status_id),t.append("_method","PUT"),axios.post("api/permohonankredit/"+this.editedItem.id,t,{headers:{accept:"application/json","Accept-Language":"en-US,en;q=0.8","content-type":"multipart/form-data"}}).then((function(t){$("#addNew").modal("hide"),Toast.fire({icon:"success",title:t.data.message}),e.$Progress.finish(),e.initialize()})).catch((function(t){console.log(t),e.$Progress.fail()}))},deleteUser:function(e){var t=this;Swal.fire({title:"Yakin dihapus?",text:"Jika dihapus data hilang!",showCancelButton:!0,confirmButtonColor:"#d33",cancelButtonColor:"#3085d6",confirmButtonText:"Ya, Hapus!"}).then((function(n){n.value&&t.form.delete("api/permohonankredit/"+e).then((function(){Swal.fire("Dihapus!","Data telah dihapus.","success"),t.initialize()})).catch((function(e){Swal.fire("Failed!",e.message,"warning")}))}))}}},d=n("KHd+"),c=Object(d.a)(l,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("v-app",[n("v-container",{attrs:{fluid:""}},[n("v-row",{staticClass:"justify-content-md-center",attrs:{"no-gutters":""}},[n("v-col",{attrs:{cols:"11"}},[e.$gate.isAdmin()||e.$gate.isKredit()||e.$gate.isBisnis()?n("v-card",{staticClass:"pa-2 mx-auto"},[n("v-toolbar",{attrs:{src:"images/banner-red.jpg",dark:"",shaped:""}},[n("v-toolbar-title",[e._v(" Permohonan Kredit ")]),e._v(" "),n("v-spacer"),e._v(" "),e.$gate.isAdmin()||e.$gate.isKredit()?n("v-btn",{attrs:{small:"",color:"indigo",dark:""},on:{click:e.newModal}},[n("v-icon",[e._v("mdi-file-upload")]),e._v(" Upload File\n            ")],1):e._e()],1),e._v(" "),n("div",{staticClass:"card-body table-responsive p-0"},[n("v-data-table",{staticClass:"elevation-3",attrs:{headers:e.headers,items:e.permohonankredit,search:e.search,justify:"center",dense:""},scopedSlots:e._u([{key:"footer.prepend",fn:function(){return[n("v-btn",{staticClass:"ma-2",attrs:{color:"success",dark:"",small:""},on:{click:function(t){return e.initialize()}}},[e._v("\n                  Refresh\n                  "),n("v-icon",{attrs:{right:"",dark:""}},[e._v(" mdi-reload ")])],1)]},proxy:!0},{key:"item.index",fn:function(t){var n=t.index;return[e._v("\n                "+e._s(n+1)+"\n              ")]}},{key:"top",fn:function(){return[n("v-toolbar",{attrs:{flat:""}},[n("v-spacer"),e._v(" "),n("v-spacer"),e._v(" "),n("v-spacer"),e._v(" "),n("v-spacer"),e._v(" "),n("v-text-field",{attrs:{"append-icon":"mdi-magnify",label:"Cari File","single-line":"","hide-details":"",loading:"grey"},model:{value:e.search,callback:function(t){e.search=t},expression:"search"}})],1)]},proxy:!0},{key:"item.statuspermohonan",fn:function(t){var i=t.item;return[n("v-chip",{attrs:{color:e.getColor(i.statuspermohonan)}},[e._v("\n                  "+e._s(i.statuspermohonan)+"\n              ")])]}},{key:"item.file",fn:function(t){var i=t.item;return[n("v-card-actions",{staticClass:"justify-center"},[n("v-icon",{staticClass:"mr-4",attrs:{small:"",color:"blue"},on:{click:function(t){return e.downloadFile(i.id,i.file)}}},[e._v("\n                    mdi-download\n                  ")])],1)]}},{key:"item.file_disetujui",fn:function(t){var i=t.item;return[n("v-card-actions",{staticClass:"justify-center"},[n("v-icon",{staticClass:"mr-4",attrs:{small:"",color:"blue"},on:{click:function(t){return e.downloadFileDisetujui(i.id,i.file_disetujui)}}},[e._v("\n                    mdi-download\n                  ")])],1)]}},{key:"item.file_spk",fn:function(t){var i=t.item;return[n("v-card-actions",{staticClass:"justify-center"},[n("v-icon",{staticClass:"mr-4",attrs:{small:"",color:"blue"},on:{click:function(t){return e.downloadFileSpk(i.id,i.file_spk)}}},[e._v("\n                    mdi-download\n                  ")])],1)]}},{key:"item.edit",fn:function(t){var i=t.item;return[n("v-card-actions",{staticClass:"justify-center"},[n("v-icon",{attrs:{small:"",color:"green"},on:{click:function(t){return e.editModal(i)}}},[e._v("\n                    mdi-pencil\n                  ")])],1)]}},{key:"item.actions",fn:function(t){var i=t.item;return[n("v-icon",{staticClass:"mr-4",attrs:{small:"",color:"red",right:""},on:{click:function(t){return e.deleteUser(i.id)}}},[e._v("\n                  mdi-delete\n                ")])]}}],null,!1,2601884050)})],1)],1):e._e()],1)],1),e._v(" "),e.$gate.isAdmin()||e.$gate.isKredit()||e.$gate.isBisnis()?e._e():n("div",[n("not-found")],1),e._v(" "),n("div",{staticClass:"modal fade",attrs:{id:"addNew",tabindex:"-1",role:"dialog","aria-labelledby":"addNew","aria-hidden":"true"}},[n("div",{staticClass:"modal-dialog",attrs:{role:"document"}},[n("div",{staticClass:"modal-content"},[n("div",{staticClass:"modal-header"},[n("h5",{directives:[{name:"show",rawName:"v-show",value:!e.editmode,expression:"!editmode"}],staticClass:"modal-title"},[e._v("Upload File")]),e._v(" "),n("h5",{directives:[{name:"show",rawName:"v-show",value:e.editmode,expression:"editmode"}],staticClass:"modal-title"},[e._v("Update Status")]),e._v(" "),n("button",{staticClass:"close",attrs:{type:"button","data-dismiss":"modal","aria-label":"Close"}},[n("span",{attrs:{"aria-hidden":"true"}},[e._v("×")])])]),e._v(" "),n("v-form",{ref:"form",attrs:{"lazy-validation":""},on:{submit:function(t){t.preventDefault(),e.editmode?e.updateUser():e.createUser()}},model:{value:e.valid,callback:function(t){e.valid=t},expression:"valid"}},[n("div",{staticClass:"modal-body"},[n("input",{directives:[{name:"model",rawName:"v-model",value:e.editedItem.kantor_id,expression:"editedItem.kantor_id"}],attrs:{type:"hidden",name:"kantor_id"},domProps:{value:e.editedItem.kantor_id},on:{input:function(t){t.target.composing||e.$set(e.editedItem,"kantor_id",t.target.value)}}}),e._v(" "),n("input",{directives:[{name:"model",rawName:"v-model",value:e.editedItem.status_id,expression:"editedItem.status_id"}],attrs:{type:"hidden",name:"status_id"},domProps:{value:e.editedItem.status_id},on:{input:function(t){t.target.composing||e.$set(e.editedItem,"status_id",t.target.value)}}}),e._v(" "),n("input",{directives:[{name:"model",rawName:"v-model",value:e.csrf,expression:"csrf"}],attrs:{type:"hidden",name:"_token"},domProps:{value:e.csrf},on:{input:function(t){t.target.composing||(e.csrf=t.target.value)}}}),e._v(" "),n("div",{staticClass:"form-group input-group"},[n("v-col",{attrs:{cols:"12",sm:"12",md:"12"}},[n("v-text-field",{attrs:{rules:e.noktpRules,name:"no_ktp",label:"Nomor KTP",placeholder:"No. KTP harus diisi",counter:"",maxlength:"16",outlined:"",required:"",dense:"","prepend-icon":"mdi-file",hint:"","persistent-hint":"","error-messages":e.pesaneror},on:{keydown:function(t){return e.noktpKeyboard(t)},change:function(t){return e.cekNorek()}},model:{value:e.editedItem.no_ktp,callback:function(t){e.$set(e.editedItem,"no_ktp",t)},expression:"editedItem.no_ktp"}}),e._v(" "),n("has-error",{attrs:{form:e.form,field:"no_ktp"}}),e._v(" "),n("v-text-field",{attrs:{name:"no_rekening",label:"Nomor Rekening kredit",placeholder:"No. Rekening Tanpa Titik",counter:"",maxlength:"12",outlined:"",required:"",dense:"","prepend-icon":"mdi-file",hint:"","persistent-hint":""},on:{keydown:function(t){return e.norekKeyboard(t)}},model:{value:e.editedItem.no_rekening,callback:function(t){e.$set(e.editedItem,"no_rekening",t)},expression:"editedItem.no_rekening"}}),e._v(" "),n("has-error",{attrs:{form:e.form,field:"no_rekening"}}),e._v(" "),n("v-text-field",{attrs:{rules:e.nameRules,name:"namafile",label:"Nama Nasabah",placeholder:"Nama File: 'nama_nasabah'",outlined:"",required:"",dense:"","prepend-icon":"mdi-file"},on:{keydown:function(t){return e.pencetKeyboard(t)}},model:{value:e.editedItem.namafile,callback:function(t){e.$set(e.editedItem,"namafile",t)},expression:"editedItem.namafile"}}),e._v(" "),n("has-error",{attrs:{form:e.form,field:"namafile"}}),e._v(" "),[n("v-row",[n("v-col",{attrs:{cols:"12",sm:"12",md:"12"}},[n("v-menu",{ref:"menu1",attrs:{"close-on-content-click":!1,"nudge-right":40,transition:"scale-transition","offset-y":"","min-width":"auto"},scopedSlots:e._u([{key:"activator",fn:function(t){var i=t.on,r=t.attrs;return[n("v-text-field",e._g(e._b({attrs:{rules:e.tgl_permohonanRules,label:"Tanggal",placeholder:"Tanggal","prepend-icon":"mdi-calendar",outlined:"",required:"",readonly:"",dense:""},on:{blur:function(t){e.tgl_permohonan=e.parseDate(e.dateFormatted)}},model:{value:e.dateFormatted,callback:function(t){e.dateFormatted=t},expression:"dateFormatted"}},"v-text-field",r,!1),i))]}}]),model:{value:e.menu1,callback:function(t){e.menu1=t},expression:"menu1"}},[e._v(" "),n("v-date-picker",{attrs:{elevation:"15","year-icon":"calendar-blank",locale:"id-ID"},on:{input:function(t){e.menu1=!1}},model:{value:e.tgl_permohonan,callback:function(t){e.tgl_permohonan=t},expression:"tgl_permohonan"}})],1)],1)],1)],e._v(" "),n("has-error",{attrs:{form:e.form,field:"tgl_permohonan"}}),e._v(" "),[n("v-file-input",{attrs:{color:"deep-purple accent-4",counter:"",label:"Upload File",placeholder:"Ambil File","prepend-icon":"mdi-paperclip",outlined:"",dense:"","show-size":"",accept:".pdf"},scopedSlots:e._u([{key:"selection",fn:function(t){var i=t.index,r=t.text;return[i<2?n("v-chip",{attrs:{color:"deep-purple accent-4",dark:"",label:"",small:""}},[e._v("\n                          "+e._s(r)+"\n                        ")]):2===i?n("span",{staticClass:"text-overline grey--text text--darken-3 mx-2"},[e._v("\n                          +"+e._s(e.files.length-2)+" File(s)\n                        ")]):e._e()]}}]),model:{value:e.file,callback:function(t){e.file=t},expression:"file"}})],e._v(" "),n("has-error",{attrs:{form:e.form,field:"file"}}),e._v(" "),[n("v-radio-group",{attrs:{mandatory:!1,row:"","prepend-icon":"mdi-format-list-bulleted-type"},scopedSlots:e._u([{key:"label",fn:function(){return[n("div",[n("strong",{staticClass:"text-h6 text-bold"},[e._v("Status :")])])]},proxy:!0}]),model:{value:e.editedItem.status_id,callback:function(t){e.$set(e.editedItem,"status_id",t)},expression:"editedItem.status_id"}},[e._v(" "),e.$gate.isAdmin()||e.$gate.isKredit()?n("v-radio",{attrs:{label:"Analisa",value:"1"}}):e._e(),e._v(" "),e.$gate.isAdmin()||e.$gate.isBisnis()?n("v-radio",{attrs:{label:"Disetujui",value:"2"}}):e._e(),e._v(" "),e.$gate.isAdmin()||e.$gate.isBisnis()?n("v-radio",{attrs:{label:"Ditolak",value:"3"}}):e._e(),e._v(" "),e.$gate.isAdmin()||e.$gate.isKredit()?n("v-radio",{attrs:{label:"Selesai",value:"4"}}):e._e()],1)]],2)],1)]),e._v(" "),n("div",{staticClass:"modal-footer"},[n("v-btn",{attrs:{color:"error",elevation:"2",type:"button","data-dismiss":"modal"}},[n("v-icon",[e._v("mdi-file-cancel")]),e._v("\n                Batal\n              ")],1),e._v(" "),n("v-btn",{directives:[{name:"show",rawName:"v-show",value:e.editmode,expression:"editmode"}],attrs:{color:"success",elevation:"2",type:"submit"}},[n("v-icon",[e._v("mdi-pencil")]),e._v("\n                Update\n              ")],1),e._v(" "),n("v-btn",{directives:[{name:"show",rawName:"v-show",value:!e.editmode,expression:"!editmode"}],attrs:{color:"primary",elevation:"2",type:"submit"}},[n("v-icon",[e._v("mdi-file-upload")]),e._v("\n                Upload\n              ")],1)],1)])],1)])])],1)],1)}),[],!1,null,null,null);t.default=c.exports}}]);
//# sourceMappingURL=10.ebox.js.map