(window.webpackJsonp=window.webpackJsonp||[]).push([[29],{vRFj:function(e,t,a){"use strict";a.r(t);var n=a("wd/R"),i=a.n(n);function o(e,t){return function(e){if(Array.isArray(e))return e}(e)||function(e,t){var a=null==e?null:"undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(null==a)return;var n,i,o=[],r=!0,s=!1;try{for(a=a.call(e);!(r=(n=a.next()).done)&&(o.push(n.value),!t||o.length!==t);r=!0);}catch(e){s=!0,i=e}finally{try{r||null==a.return||a.return()}finally{if(s)throw i}}return o}(e,t)||function(e,t){if(!e)return;if("string"==typeof e)return r(e,t);var a=Object.prototype.toString.call(e).slice(8,-1);"Object"===a&&e.constructor&&(a=e.constructor.name);if("Map"===a||"Set"===a)return Array.from(e);if("Arguments"===a||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(a))return r(e,t)}(e,t)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function r(e,t){(null==t||t>e.length)&&(t=e.length);for(var a=0,n=new Array(t);a<t;a++)n[a]=e[a];return n}function s(e,t,a){return t in e?Object.defineProperty(e,t,{value:a,enumerable:!0,configurable:!0,writable:!0}):e[t]=a,e}var d={data:function(e){var t;return{csrf:document.querySelector('meta[name="csrf-token"]').getAttribute("content"),editmode:!1,dialog:!1,dialogDelete:!1,periodeTgl:"",filterFormTgl:"",date:(new Date).toISOString().substr(0,7),search:"",stock:[],valid:!0,editedIndex:-1,editedItem:(t={id:"",kantor_id:"",keterangan:"",periode:"",periodeRules:[function(e){return!!e||"Bulan periode belum diisi"}],harga_satuan:"",hargaSatuanRules:[function(e){return!!e||"Harga Satuan belum diisi"}],stok_awal:0,stokAwalRules:[function(e){return!!e||"harus diisi angka"},function(e){return e>-1||"angka tidak boleh minus"}],stok_masuk:0,stokMasukRules:[function(e){return!!e||"harus diisi angka"},function(e){return e>-1||"angka tidak boleh minus"}],stok_keluar:0,stokKeluarRules:[function(e){return!!e||"harus diisi angka"},function(e){return e>-1||"angka tidak boleh minus"}],stok_akhir:0,nom_awal:0,nomAwalRules:[function(e){return e>-1||"angka tidak boleh minus"}],nom_masuk:0,nomMasukRules:[function(e){return e>-1||"angka tidak boleh minus"}],nom_keluar:0,nomKeluarRules:[function(e){return e>-1||"angka tidak boleh minus"}]},s(t,"stok_akhir",""),s(t,"nom_akhir",""),s(t,"barang_id",""),s(t,"namaBarang",[]),s(t,"satuan_id",""),s(t,"namaSatuan",[]),s(t,"id_kantor",""),s(t,"namaKantor",[]),t),menu1:!1,menu2:!1,menu3:!1,pesaneror:"",form:new Form({id:"",kantor_id:"",barang_id:"",satuan_id:"",periode:"",harga_satuan:"",stok_awal:"",stok_masuk:"",stok_keluar:"",stok_akhir:"",nom_awal:"",nom_masuk:"",nom_keluar:"",nom_akhir:"",keterangan:""}),columnsExcel:[{label:"Kode Kantor",field:"kode_kantor",align:"start"},{label:"Kantor",field:"nama_kantor"},{label:"Periode",field:"periode"},{label:"NAMA BARANG",field:"namabarang"},{label:"SATUAN",field:"namasatuan"},{label:"HARGA SATUAN",field:"harga_satuan"},{label:"STOK AWAL",field:"stok_awal"},{label:"STOK MASUK",field:"stok_masuk"},{label:"STOK KELUAR",field:"stok_keluar"},{label:"STOK AKHIR",field:"stok_akhir"},{label:"NOMINAL AWAL",field:"nom_awal"},{label:"NOMINAL MASUK",field:"nom_masuk"},{label:"NOMINAL KELUAR",field:"nom_keluar"},{label:"NOMINAL AKHIR",field:"nom_akhir"},{label:"KETERANGAN",field:"keterangan"}],json_meta:[[{" key ":" charset "," value ":" utf- 8 "}]]}},computed:{headers:function(){var e=[{text:"No",value:"index",align:"center",sortable:!1},{text:"Kantor",value:"nama_kantor",align:"start"},{text:"Periode",value:"periode"},{text:"Nama Barang",value:"namabarang"},{text:"Satuan",value:"namasatuan"},{text:"Harga Satuan",value:"harga_satuan"},{text:"Stok Awal",value:"stok_awal",align:"center"},{text:"Stok Masuk",value:"stok_masuk",align:"center"},{text:"Stok Keluar",value:"stok_keluar",align:"center"},{text:"Stok Akhir",value:"stok_akhir",align:"center"},{text:"Nominal Awal",value:"nom_awal",align:"center"},{text:"Nominal Masuk",value:"nom_masuk",align:"center"},{text:"Nominal Keluar",value:"nom_keluar",align:"center"},{text:"Nominal Akhir",value:"nom_akhir",align:"center"},{text:"Ket.",value:"keterangan",align:"center"}];return e.push({text:"Hapus",value:"actions",sortable:!1,align:"center"}),e},periodeTglText:function(){return this.periodeTgl?i()(this.periodeTgl).format("MMMM YYYY"):""},periodeMomentJS:function(){return this.date?i()(this.date).format("MMMM YYYY"):""},computedDateFormatted:function(){return this.formatDate(this.editedItem.date)},formTitle:function(){return-1===this.editedIndex?"New Item":"Edit Item"}},watch:{date:function(e){this.editedItem.periode=i()(this.date).format("MMMM YYYY")},dialog:function(e){e||this.close()},dialogDelete:function(e){e||this.closeDelete()}},created:function(){this.$Progress.start(),this.initialize(),this.$Progress.finish()},methods:{pencetKeyboard:function(e){var t=(e=e||window.event).which?e.which:e.keyCode;if(!(t>31&&(t<48||t>57)&&(t<95||t>105)&&46!==t))return!0;e.preventDefault()},inputStokAwal:function(){this.editedItem.stok_akhir=parseInt(this.editedItem.stok_awal)},inputStokMasuk:function(){this.editedItem.stok_akhir=parseInt(this.editedItem.stok_awal)+parseInt(this.editedItem.stok_masuk)},inputStokAkhir:function(){this.editedItem.stok_akhir=parseInt(this.editedItem.stok_awal)+parseInt(this.editedItem.stok_masuk)-parseInt(this.editedItem.stok_keluar)},inputNominalAwal:function(){this.editedItem.nom_akhir=parseInt(this.editedItem.nom_awal)},inputNominalMasuk:function(){this.editedItem.nom_akhir=parseInt(this.editedItem.nom_awal)+parseInt(this.editedItem.nom_masuk)},inputNominalAkhir:function(){this.editedItem.nom_akhir=parseInt(this.editedItem.nom_awal)+parseInt(this.editedItem.nom_masuk)-parseInt(this.editedItem.nom_keluar)},formatDate:function(e){if(!e)return null;var t=o(e.split("-"),2),a=t[0],n=t[1];return"".concat(n,"/").concat(a)},parseDate:function(e){if(!e)return null;var t=o(e.split("/"),3),a=t[0],n=t[1],i=t[2];return"".concat(i,"-").concat(n.padStart(2,"0"),"-").concat(a.padStart(2,"0"))},formatDateFilter:function(e){if(!e)return null;var t=o(e.split("-"),3),a=t[0],n=t[1],i=t[2];return"".concat(i,"/").concat(n,"/").concat(a," ~ ").concat(i,"/").concat(n,"/").concat(a)},filterKantor:function(){var e=this;this.$Progress.start(),(new FormData).set("kantor_id",this.editedItem.id_kantor),""!=this.editedItem.id_kantor?(this.$gate.isAdmin()||this.$gate.isAK())&&axios.get("api/stockpromosi/filterkantor",{params:{kantor_id:this.editedItem.id_kantor}}).then((function(t){e.stock=t.data.data,e.editedItem.kantor_id=e.$kantor_id})).catch((function(e){console.log(e.response.data)})):Swal.fire({icon:"error",title:"Error Filter",text:"Filter Kantor Belum Dipilih...! ",width:600,padding:"3em",color:"#ff0000",background:"#ff0000 url(/images/kayu.jpg)",backdrop:'\n            rgba(255,0,64,0.4)\n            url("/images/nyan-cat.gif")\n            left top\n            no-repeat\n          '}),this.$Progress.finish()},filterBarang:function(){var e=this;this.$Progress.start(),(new FormData).set("barang_id",this.editedItem.barang_id),""!=this.editedItem.barang_id?(this.$gate.isAdmin()||this.$gate.isAK())&&axios.get("api/stockpromosi/filterbarang",{params:{barang_id:this.editedItem.barang_id}}).then((function(t){e.stock=t.data.data,e.editedItem.kantor_id=e.$kantor_id})).catch((function(e){console.log(e.response.data)})):Swal.fire({icon:"error",title:"Error Filter",text:"Filter Tanggal Belum Dipilih...! ",width:600,padding:"3em",color:"#ff0000",background:"#ff0000 url(/images/kayu.jpg)",backdrop:'\n            rgba(255,0,64,0.4)\n            url("/images/nyan-cat.gif")\n            left top\n            no-repeat\n          '}),this.$Progress.finish()},filterTanggal:function(){var e=this;this.$Progress.start(),(new FormData).set("periodetgl",this.periodeTglText),""!=this.periodeTglText?(this.$gate.isAdmin()||this.$gate.isAK())&&axios.get("api/stockpromosi/filtertanggal",{params:{periodetgl:this.periodeTglText}}).then((function(t){e.stock=t.data.data,e.editedItem.kantor_id=e.$kantor_id})).catch((function(e){console.log(e.response.data)})):Swal.fire({icon:"error",title:"Error Filter",text:"Filter Tanggal Belum Dipilih...! ",width:600,padding:"3em",color:"#ff0000",background:"#ff0000 url(/images/kayu.jpg)",backdrop:'\n            rgba(255,0,64,0.4)\n            url("/images/nyan-cat.gif")\n            left top\n            no-repeat\n          '}),this.$Progress.finish()},getBarang:function(){var e=this;(this.$gate.isAdmin()||this.$gate.isAK())&&axios.get("api/stockpromosi/getbarang").then((function(t){e.editedItem.namaBarang=t.data.data})).catch((function(e){console.log(e.response.data)}))},getKantor:function(){var e=this;(this.$gate.isAdmin()||this.$gate.isAK())&&axios.get("api/stockpromosi/getkantor").then((function(t){e.editedItem.namaKantor=t.data.data})).catch((function(e){console.log(e.response.data)}))},getSatuan:function(){var e=this;(this.$gate.isAdmin()||this.$gate.isAK())&&axios.get("api/stockpromosi/getsatuan").then((function(t){e.editedItem.namaSatuan=t.data.data})).catch((function(e){console.log(e.response.data)}))},initialize:function(){var e=this;this.$Progress.start(),(this.$gate.isAdmin()||this.$gate.isAK())&&axios.get("api/stockpromosi").then((function(t){e.stock=t.data.data,e.editedItem.kantor_id=e.$kantor_id,console.log(e.stock)})).catch((function(e){console.log(e.response.data)})),this.$refs.CBKantor.reset(),this.$refs.CBBarang.reset(),this.$refs.tfPeriode.reset(),this.$Progress.finish()},editModal:function(e){this.editmode=!0,$("#addNew").modal("show"),this.editedIndex=this.stock.indexOf(e),this.editedItem.kantor_id=this.$kantor_id,this.editedItem.tanggal=e.tanggal,this.editedItem.id=e.id,this.editedItem.jenis=e.jenis,this.editedItem.jml_stok_awal=e.jml_stok_awal,this.editedItem.tambahan_stok=e.tambahan_stok,this.editedItem.jml_digunakan=e.jml_digunakan,this.editedItem.jml_rusak=e.jml_rusak,this.editedItem.jml_hilang=e.jml_hilang,this.editedItem.jml_stok_akhir=e.jml_stok_akhir,console.log(this.$kantor_id)},newModal:function(){this.editmode=!1,$("#addNew").modal("show"),this.$refs.form.reset()},createUser:function(){var e=this;this.$refs.form.validate(),this.$Progress.start();if(this.$gate.isAdmin()||this.$gate.isAK()){var t=new FormData;t.set("kantor_id",this.editedItem.kantor_id),t.set("periode",this.editedItem.periode),t.set("barang_id",this.editedItem.barang_id),t.set("satuan_id",this.editedItem.satuan_id),t.set("harga_satuan",this.editedItem.harga_satuan),t.set("stok_awal",this.editedItem.stok_awal),t.set("stok_masuk",this.editedItem.stok_masuk),t.set("stok_keluar",this.editedItem.stok_keluar),t.set("stok_akhir",parseInt(this.editedItem.stok_awal)+parseInt(this.editedItem.stok_masuk)-parseInt(this.editedItem.stok_keluar)),t.set("nom_awal",this.editedItem.nom_awal),t.set("nom_masuk",this.editedItem.nom_masuk),t.set("nom_keluar",this.editedItem.nom_keluar),t.set("nom_akhir",parseInt(this.editedItem.nom_awal)+parseInt(this.editedItem.nom_masuk)-parseInt(this.editedItem.nom_keluar)),t.set("keterangan",this.editedItem.keterangan),axios.post("api/stockpromosi",t,{headers:{"content-type":"multipart/form-data"}}).then((function(t){$("#addNew").modal("hide"),Toast.fire({icon:"success",title:t.data.message}),e.$Progress.finish(),e.initialize()})).catch((function(e){Swal.fire("Failed!",data.message,"warning")}))}},updateUser:function(){var e=this;this.$refs.form.validate(),this.$Progress.start();var t=new FormData;t.set("kantor_id",this.editedItem.kantor_id),t.set("jenis",this.editedItem.jenis),t.set("tanggal",this.editedItem.tanggal),t.set("jml_stok_awal",this.editedItem.jml_stok_awal),t.set("tambahan_stok",this.editedItem.tambahan_stok),t.set("jml_digunakan",this.editedItem.jml_digunakan),t.set("jml_rusak",this.editedItem.jml_rusak),t.set("jml_hilang",this.editedItem.jml_hilang),t.set("jml_stok_akhir",parseInt(this.editedItem.jml_stok_awal)+parseInt(this.editedItem.tambahan_stok)-parseInt(this.editedItem.jml_digunakan)-parseInt(this.editedItem.jml_rusak)-parseInt(this.editedItem.jml_hilang)),t.append("_method","PUT"),axios.post("api/stock/"+this.editedItem.id,t,{headers:{accept:"application/json","Accept-Language":"en-US,en;q=0.8","content-type":"multipart/form-data"}}).then((function(t){console.log(e.editedItem.id),$("#addNew").modal("hide"),Toast.fire({icon:"success",title:t.data.message}),e.$Progress.finish(),e.initialize()})).catch((function(t){console.log(t),e.$Progress.fail()}))},deleteUser:function(e){var t=this;Swal.fire({title:"Yakin dihapus?",text:"Jika dihapus data hilang!",showCancelButton:!0,confirmButtonColor:"#d33",cancelButtonColor:"#3085d6",confirmButtonText:"Ya, Hapus!"}).then((function(a){a.value&&t.form.delete("api/stockpromosi/"+e).then((function(){Swal.fire("Dihapus!","Data telah dihapus.","success"),t.initialize()})).catch((function(e){Swal.fire("Failed!",e.message,"warning")}))}))}}},l=a("KHd+"),m=Object(l.a)(d,(function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("v-app",[a("v-container",{attrs:{fluid:""}},[a("v-row",{staticClass:"justify-content-md-center",attrs:{"no-gutters":""}},[a("v-col",{attrs:{cols:"12"}},[e.$gate.isAdmin()||e.$gate.isAK()?a("v-card",{staticClass:"pa-2 mx-auto"},[a("v-toolbar",{attrs:{src:"images/banner-biru-pelayanan.jpg",color:"rgb(39,154,187)",dark:"",shaped:""}},[a("v-toolbar-title",[e._v("\n                    Stok Barang Promosi\n                ")]),e._v(" "),a("v-spacer"),e._v(" "),a("v-btn",{attrs:{small:"",color:"indigo",dark:""},on:{click:e.newModal}},[a("v-icon",[e._v("mdi-cart-plus")]),e._v(" Tambah Stok\n                  ")],1)],1),e._v(" "),a("div",{staticClass:"card-body table-responsive p-0"},[a("v-data-table",{staticClass:"elevation-3",attrs:{headers:e.headers,items:e.stock,search:e.search,"items-per-page":10,"footer-props":{"items-per-page-options":[5,10,14,140,-1],"items-per-page-text":"baris per halaman"},justify:"center",dense:""},scopedSlots:e._u([{key:"footer.prepend",fn:function(){return[a("v-btn",{staticClass:"ma-2",attrs:{color:"success",dark:"",small:""},on:{click:function(t){return e.initialize()}}},[e._v("\n                      Refresh\n                      "),a("v-icon",{attrs:{right:"",dark:""}},[e._v("\n                        mdi-reload\n                      ")])],1)]},proxy:!0},{key:"item.index",fn:function(t){var a=t.index;return[e._v("\n                    "+e._s(a+1)+"\n                ")]}},{key:"top",fn:function(){return[a("v-toolbar",{attrs:{flat:""}},[a("vue-excel-xlsx",{staticClass:"btn btn-success btn-sm",attrs:{data:e.stock,columns:e.columnsExcel,"file-name":"stok_barang_cetak","file-type":"xlsx","sheet-name":"stok"}},[a("i",{staticClass:"fa-solid fa-file-excel"}),e._v("\n                        Excel\n                    ")]),e._v(" "),a("v-spacer"),e._v(" "),a("v-spacer"),e._v(" "),e.$gate.isAdmin()?a("v-row",[a("v-col",{attrs:{cols:"8",sm:"8",md:"8"}},[a("v-combobox",{ref:"CBKantor",attrs:{label:"Kantor",items:e.editedItem.namaKantor,"item-value":"id","item-text":"nama_kantor",placeholder:"Pilih Kantor","single-line":"","hide-details":"","return-object":!1},on:{change:function(t){return e.filterKantor()},click:function(t){return e.getKantor()}},model:{value:e.editedItem.id_kantor,callback:function(t){e.$set(e.editedItem,"id_kantor",t)},expression:"editedItem.id_kantor"}})],1)],1):e._e(),e._v(" "),a("v-spacer"),e._v(" "),e.$gate.isAdmin()?a("v-row",[a("v-col",{attrs:{cols:"8",sm:"8",md:"8"}},[a("v-combobox",{ref:"CBBarang",attrs:{label:"Barang",items:e.editedItem.namaBarang,"item-value":"id","item-text":"namabarang",placeholder:"Pilih Barang","single-line":"","hide-details":"","return-object":!1},on:{change:function(t){return e.filterBarang()},click:function(t){return e.getBarang()}},model:{value:e.editedItem.barang_id,callback:function(t){e.$set(e.editedItem,"barang_id",t)},expression:"editedItem.barang_id"}})],1)],1):e._e(),e._v(" "),a("v-spacer"),e._v(" "),a("v-row",[a("v-col",{attrs:{cols:"7",sm:"7",md:"7"}},[a("v-menu",{ref:"menu2",attrs:{"close-on-content-click":!1,"nudge-right":40,transition:"scale-transition","offset-y":"","min-width":"auto"},scopedSlots:e._u([{key:"activator",fn:function(t){var n=t.on,i=t.attrs;return[a("v-text-field",e._g(e._b({ref:"tfPeriode",attrs:{"single-line":"",label:"Periode","append-icon":"mdi-calendar","hide-details":""},model:{value:e.periodeTglText,callback:function(t){e.periodeTglText=t},expression:"periodeTglText"}},"v-text-field",i,!1),n))]}}],null,!1,1244225009),model:{value:e.menu2,callback:function(t){e.menu2=t},expression:"menu2"}},[e._v(" "),a("v-date-picker",{attrs:{type:"month",elevation:"15","year-icon":"calendar-blank",locale:"id-ID"},on:{input:function(t){e.menu2=!1}},model:{value:e.periodeTgl,callback:function(t){e.periodeTgl=t},expression:"periodeTgl"}})],1)],1),e._v(" "),a("v-col",[a("v-btn",{staticClass:"mx-3",attrs:{fab:"",dark:"",color:"indigo","x-small":"",fixed:"",bottom:""},on:{click:function(t){return e.filterTanggal()}}},[a("v-icon",[e._v("\n                        mdi-filter\n                      ")])],1)],1)],1),e._v(" "),a("v-spacer"),e._v(" "),a("v-text-field",{attrs:{"append-icon":"mdi-magnify",label:"Cari Data Stok","single-line":"","hide-details":"",loading:"grey"},model:{value:e.search,callback:function(t){e.search=t},expression:"search"}})],1)]},proxy:!0},{key:"item.edit",fn:function(t){var n=t.item;return[a("v-card-actions",{staticClass:"justify-center"},[a("v-icon",{attrs:{small:"",color:"green"},on:{click:function(t){return e.editModal(n)}}},[e._v("\n                        mdi-pencil\n                    ")])],1)]}},{key:"item.actions",fn:function(t){var n=t.item;return[a("v-icon",{attrs:{small:"",color:"red"},on:{click:function(t){return e.deleteUser(n.id)}}},[e._v("\n                    mdi-delete\n                ")])]}}],null,!1,1420096508)})],1)],1):e._e()],1)],1),e._v(" "),e.$gate.isAdmin()||e.$gate.isAK()?e._e():a("div",[a("not-found")],1),e._v(" "),a("div",{staticClass:"modal fade",attrs:{id:"addNew",tabindex:"-1",role:"dialog","aria-labelledby":"addNew","aria-hidden":"true"}},[a("div",{staticClass:"modal-dialog modal-xl modal-dialog-scrollable",attrs:{role:"document"}},[a("div",{staticClass:"modal-content"},[a("div",{staticClass:"modal-header primary"},[a("h5",{directives:[{name:"show",rawName:"v-show",value:!e.editmode,expression:"!editmode"}],staticClass:"modal-title",staticStyle:{color:"white"}},[a("i",{staticClass:"nav-icon fas fa-cart-plus"}),e._v(" Tambah Stok")]),e._v(" "),a("h5",{directives:[{name:"show",rawName:"v-show",value:e.editmode,expression:"editmode"}],staticClass:"modal-title"},[e._v("Edit Stok")]),e._v(" "),a("button",{staticClass:"close",attrs:{type:"button","data-dismiss":"modal","aria-label":"Close"}},[a("span",{attrs:{"aria-hidden":"true"}},[e._v("×")])])]),e._v(" "),a("v-form",{ref:"form",attrs:{"lazy-validation":""},on:{submit:function(t){t.preventDefault(),e.editmode?e.updateUser():e.createUser()}},model:{value:e.valid,callback:function(t){e.valid=t},expression:"valid"}},[a("div",{staticClass:"modal-body"},[a("input",{directives:[{name:"model",rawName:"v-model",value:e.editedItem.kantor_id,expression:"editedItem.kantor_id"}],attrs:{type:"hidden",name:"kantor_id"},domProps:{value:e.editedItem.kantor_id},on:{input:function(t){t.target.composing||e.$set(e.editedItem,"kantor_id",t.target.value)}}}),e._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:e.csrf,expression:"csrf"}],attrs:{type:"hidden",name:"_token"},domProps:{value:e.csrf},on:{input:function(t){t.target.composing||(e.csrf=t.target.value)}}}),e._v(" "),a("v-container",[a("v-row",[a("v-col",{attrs:{cols:"12",sm:"3",md:"3"}},[a("v-menu",{ref:"menu1",attrs:{"close-on-content-click":!1,"nudge-right":40,transition:"scale-transition","offset-y":"","min-width":"auto"},scopedSlots:e._u([{key:"activator",fn:function(t){var n=t.on,i=t.attrs;return[a("v-text-field",e._g(e._b({attrs:{value:e.periodeMomentJS,rules:e.editedItem.periodeRules,label:"Periode",placeholder:"periode bulan","prepend-icon":"mdi-calendar",outlined:"",required:"",dense:"",clearable:"",readonly:""},on:{blur:function(t){e.editedItem.periode=e.periodeMomentJS},"click:clear":function(t){e.date=null}},model:{value:e.editedItem.periode,callback:function(t){e.$set(e.editedItem,"periode",t)},expression:"editedItem.periode"}},"v-text-field",i,!1),n))]}}]),model:{value:e.menu1,callback:function(t){e.menu1=t},expression:"menu1"}},[e._v(" "),a("v-date-picker",{attrs:{type:"month",elevation:"15","year-icon":"mdi-calendar-blank","prev-icon":"mdi-skip-previous","next-icon":"mdi-skip-next",locale:"id-ID"},on:{input:function(t){e.menu1=!1}},model:{value:e.date,callback:function(t){e.date=t},expression:"date"}})],1)],1),e._v(" "),a("v-col",{attrs:{cols:"12",sm:"3"}},[a("v-combobox",{attrs:{label:"Nama Barang","append-outer-icon":"mdi-cart-variant",items:e.editedItem.namaBarang,"item-value":"id","item-text":"namabarang",placeholder:"Daftar Barang",dense:"",outlined:"","return-object":!1,"persistent-hint":"","error-messages":e.pesaneror},on:{click:function(t){return e.getBarang()}},model:{value:e.editedItem.barang_id,callback:function(t){e.$set(e.editedItem,"barang_id",t)},expression:"editedItem.barang_id"}})],1),e._v(" "),a("v-col",{attrs:{cols:"12",sm:"3",md:"3"}},[a("v-combobox",{attrs:{label:"Satuan","prepend-icon":"mdi-scale",items:e.editedItem.namaSatuan,"item-value":"id","item-text":"namasatuan",placeholder:"Pilih Satuan",dense:"",outlined:"","return-object":!1,"persistent-hint":"","error-messages":e.pesaneror},on:{click:function(t){return e.getSatuan()}},model:{value:e.editedItem.satuan_id,callback:function(t){e.$set(e.editedItem,"satuan_id",t)},expression:"editedItem.satuan_id"}})],1),e._v(" "),a("v-col",{attrs:{cols:"12",sm:"3",md:"3"}},[a("v-text-field",{attrs:{rules:e.editedItem.hargaSatuanRules,name:"harga_satuan",label:"Harga Satuan",placeholder:"Harga Satuan","append-outer-icon":"mdi-cash",outlined:"",required:"",dense:"",counter:"",maxlength:"10"},on:{keydown:function(t){return e.pencetKeyboard(t)}},model:{value:e.editedItem.harga_satuan,callback:function(t){e.$set(e.editedItem,"harga_satuan",t)},expression:"editedItem.harga_satuan"}})],1),e._v(" "),a("v-col",{attrs:{cols:"12",sm:"3",md:"3"}},[a("v-text-field",{attrs:{rules:e.editedItem.stokAwalRules,name:"stok_awal",label:"Stok Awal",placeholder:"input nilai angka","prepend-icon":"mdi-numeric-1-box-multiple",outlined:"",required:"",dense:"",counter:"",maxlength:"10"},on:{keydown:function(t){return e.pencetKeyboard(t)},change:e.inputStokAwal},model:{value:e.editedItem.stok_awal,callback:function(t){e.$set(e.editedItem,"stok_awal",t)},expression:"editedItem.stok_awal"}})],1),e._v(" "),a("v-col",{attrs:{cols:"12",sm:"3",md:"3"}},[a("v-text-field",{attrs:{rules:e.editedItem.stokMasukRules,name:"stok_masuk",label:"Stok Masuk",placeholder:"input nilai angka","append-outer-icon":"mdi-numeric-2-box-multiple",outlined:"",required:"",dense:"",counter:"",maxlength:"10"},on:{keydown:function(t){return e.pencetKeyboard(t)},change:e.inputStokMasuk},model:{value:e.editedItem.stok_masuk,callback:function(t){e.$set(e.editedItem,"stok_masuk",t)},expression:"editedItem.stok_masuk"}})],1),e._v(" "),a("v-col",{attrs:{cols:"12",sm:"3",md:"3"}},[a("v-text-field",{attrs:{rules:e.editedItem.stokKeluarRules,name:"stok_keluar",label:"Stok Keluar",placeholder:"input nilai angka","prepend-icon":"mdi-numeric-3-box-multiple",outlined:"",required:"",dense:"",counter:"",maxlength:"10"},on:{keydown:function(t){return e.pencetKeyboard(t)},change:e.inputStokAkhir},model:{value:e.editedItem.stok_keluar,callback:function(t){e.$set(e.editedItem,"stok_keluar",t)},expression:"editedItem.stok_keluar"}})],1),e._v(" "),a("v-col",{attrs:{cols:"12",sm:"3",md:"3"}},[a("v-text-field",{attrs:{name:"stok_akhir",label:"Stok Akhir",placeholder:"input nilai angka","append-outer-icon":"mdi-numeric-4-box-multiple",outlined:"",required:"",dense:"",readonly:"",disabled:"",maxlength:"10"},on:{keydown:function(t){return e.pencetKeyboard(t)},change:e.inputStokAkhir},model:{value:e.editedItem.stok_akhir,callback:function(t){e.$set(e.editedItem,"stok_akhir",t)},expression:"editedItem.stok_akhir"}})],1),e._v(" "),a("v-col",{attrs:{cols:"12",sm:"3",md:"3"}},[a("v-text-field",{attrs:{rules:e.editedItem.nomAwalRules,name:"nominal_awal",label:"Nominal Awal",placeholder:"input nilai angka","prepend-icon":"mdi-numeric-1-box-multiple",outlined:"",required:"",dense:"",counter:"",maxlength:"10"},on:{keydown:function(t){return e.pencetKeyboard(t)},change:e.inputNominalAwal},model:{value:e.editedItem.nom_awal,callback:function(t){e.$set(e.editedItem,"nom_awal",t)},expression:"editedItem.nom_awal"}})],1),e._v(" "),a("v-col",{attrs:{cols:"12",sm:"3",md:"3"}},[a("v-text-field",{attrs:{rules:e.editedItem.nomMasukRules,name:"nom_masuk",label:"Nominal Masuk",placeholder:"input nilai angka","append-outer-icon":"mdi-numeric-2-box-multiple",outlined:"",required:"",dense:"",counter:"",maxlength:"10"},on:{keydown:function(t){return e.pencetKeyboard(t)},change:e.inputNominalMasuk},model:{value:e.editedItem.nom_masuk,callback:function(t){e.$set(e.editedItem,"nom_masuk",t)},expression:"editedItem.nom_masuk"}})],1),e._v(" "),a("v-col",{attrs:{cols:"12",sm:"3",md:"3"}},[a("v-text-field",{attrs:{rules:e.editedItem.nomKeluarRules,name:"nominal_keluar",label:"Nominal Keluar",placeholder:"input nilai angka","prepend-icon":"mdi-numeric-3-box-multiple",outlined:"",required:"",dense:"",counter:"",maxlength:"10"},on:{keydown:function(t){return e.pencetKeyboard(t)},change:e.inputNominalAkhir},model:{value:e.editedItem.nom_keluar,callback:function(t){e.$set(e.editedItem,"nom_keluar",t)},expression:"editedItem.nom_keluar"}})],1),e._v(" "),a("v-col",{attrs:{cols:"12",sm:"3",md:"3"}},[a("v-text-field",{attrs:{name:"nom_akhir",label:"Nominal Akhir",placeholder:"input nilai angka","append-outer-icon":"mdi-numeric-4-box-multiple",outlined:"",required:"",dense:"",readonly:"",disabled:"",maxlength:"10"},on:{keydown:function(t){return e.pencetKeyboard(t)},change:e.inputNominalAkhir},model:{value:e.editedItem.nom_akhir,callback:function(t){e.$set(e.editedItem,"nom_akhir",t)},expression:"editedItem.nom_akhir"}})],1),e._v(" "),a("v-col",{attrs:{cols:"12",sm:"12",md:"12"}},[a("v-text-field",{attrs:{name:"keterangan",label:"Keterangan","prepend-icon":"mdi-note",outlined:"",dense:"",hint:"input spasi jika tidak ada keterangan","persistent-hint":""},model:{value:e.editedItem.keterangan,callback:function(t){e.$set(e.editedItem,"keterangan",t)},expression:"editedItem.keterangan"}})],1)],1)],1)],1),e._v(" "),a("div",{staticClass:"modal-footer"},[a("v-btn",{attrs:{color:"error",elevation:"2",type:"button","data-dismiss":"modal"}},[a("v-icon",[e._v("mdi-file-cancel")]),e._v("\n                            Batal\n                        ")],1),e._v(" "),a("v-btn",{directives:[{name:"show",rawName:"v-show",value:e.editmode,expression:"editmode"}],attrs:{color:"success",elevation:"2",type:"submit"}},[a("v-icon",[e._v("mdi-pencil")]),e._v("\n                            Ubah\n                        ")],1),e._v(" "),a("v-btn",{directives:[{name:"show",rawName:"v-show",value:!e.editmode,expression:"!editmode"}],attrs:{color:"primary",elevation:"2",type:"submit"}},[a("v-icon",[e._v("mdi-archive-plus")]),e._v("\n                            Tambah\n                        ")],1)],1)])],1)])])],1)],1)}),[],!1,null,null,null);t.default=m.exports}}]);
//# sourceMappingURL=29.ebox.js.map