(function () {var a={name:"Janitor",props:{label:String,progress:String,job:String,cooldown:Number,status:String,data:String,pageURI:String,clipboard:Boolean},data:function(){return{oldlabel:"",downloadRequest:"",clipboardRequest:""}},methods:{janitor:function(){if(!0===this.clipboard){this.clipboardRequest=this.data,this.oldlabel=this.label,this.label=this.progress,this.status="is-success";var t=this;return setTimeout(function(){t.label=t.oldlabel,t.status=""},this.cooldown),void this.$nextTick(function(){t.copyToClipboard(t.$refs.clipboard)})}if(""!==this.clipboardRequest)return this.copyToClipboard(this.$refs.clipboard),this.label=this.oldlabel,this.status="",void(this.clipboardRequest="");var e=this.job;if(e=e+"/"+encodeURIComponent(this.pageURI),null!=this.data){var o=this.data;e=e+"/"+encodeURIComponent(o)}this.getRequest(e)},getRequest:function(t){var e=this,o=this;this.oldlabel=this.label,this.label=null!=this.progress&&this.progress.length>0?this.progress:this.label+"...",this.status="doing-job",this.$api.get(t).then(function(t){if(void 0!==t.label&&(o.label=t.label),void 0!==t.status?o.status=200==t.status?"is-success":"has-error":o.status="has-response",void 0!==t.reload&&!0===t.reload&&location.reload(),void 0!==t.href&&(location.href=t.href),void 0!==t.download){e.downloadRequest=t.download;var i=e;e.$nextTick(function(){i.simulateClick(i.$refs.download)})}void 0!==t.clipboard?e.clipboardRequest=t.clipboard:setTimeout(function(){o.label=o.oldlabel,o.status=""},o.cooldown)})},simulateClick:function(t){var e=new MouseEvent("click",{bubbles:!0,cancelable:!0,view:window});t.dispatchEvent(e)},copyToClipboard:function(t){var e,o,i,s,a,l;s=void 0,i=void 0,(o="INPUT"===t.tagName||"TEXTAREA"===t.tagName)?(l=t,s=t.selectionStart,i=t.selectionEnd):((l=document.getElementById("_hiddenCopyText_"))||((l=document.createElement("textarea")).style.position="absolute",l.style.left="-9999px",l.style.top="0",l.id="_hiddenCopyText_",document.body.appendChild(l)),l.textContent=t.textContent),e=document.activeElement,l.focus(),l.setSelectionRange(0,l.value.length),a=void 0;try{a=document.execCommand("copy")}catch(n){n,a=!1}return e&&"function"==typeof e.focus&&e.focus(),o?t.setSelectionRange(s,i):l.textContent="",a}}};if(typeof a==="function"){a=a.options}Object.assign(a,function(){var render=function(){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;return _c("div",{staticClass:"janitor-wrapper"},[_c("k-button",{staticClass:"janitor",class:_vm.status,attrs:{"job":_vm.job},on:{"click":function($event){return _vm.janitor()}}},[_vm._v(_vm._s(_vm.label)+" ")]),_vm._v(" "),_c("a",{ref:"download",staticClass:"hidden",attrs:{"href":_vm.downloadRequest,"download":""}}),_vm._v(" "),_c("textarea",{ref:"clipboard",staticClass:"hidden"},[_vm._v(_vm._s(_vm.clipboardRequest))])],1)};var staticRenderFns=[];return{render:render,staticRenderFns:staticRenderFns,_compiled:true,_scopeId:"data-v-4d4bb0",functional:undefined}}());panel.plugin("bnomei/janitor",{fields:{janitor:a}});})();