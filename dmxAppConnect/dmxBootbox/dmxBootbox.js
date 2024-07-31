/*!
 DMXzone Bootbox
 Version: 2.0.0
 (c) 2024 Wappler.io
 @build 2024-04-15 17:48:46
 */
dmx.Actions({"bootbox.alert":function(e){return new Promise((t=>{bootbox.alert({...this.parse(e),callback:t})}))},"bootbox.prompt":function(e){return new Promise((t=>{bootbox.prompt({...this.parse(e),callback:t})}))},"bootbox.confirm":function(e){const t={then:(e=Object.assign({},e)).then,else:e.else};return delete e.then,delete e.else,new Promise((o=>{bootbox.confirm({...this.parse(e),callback:e=>{if(e){if(t.then)return o(this._exec(t.then).then((()=>e)))}else if(t.else)return o(this._exec(t.else).then((()=>e)));o(e)}})}))}}),dmx.Component("bootbox",{methods:{alert:e=>new Promise((t=>{bootbox.alert({...e,callback:t})}))}});
//# sourceMappingURL=dmxBootbox.js.map
