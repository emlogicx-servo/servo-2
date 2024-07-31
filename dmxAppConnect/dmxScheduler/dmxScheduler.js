/*!
 App Connect Scheduler
 Version: 2.0.0
 (c) 2024 Wappler.io
 @build 2024-04-15 17:48:46
 */
dmx.Component("scheduler",{initialData:{running:!1,percent:0},attributes:{delay:{type:Number,default:60},unit:{type:String,default:"seconds",enum:["miliseconds","seconds","minutes","hours","days"]},noprogress:{type:Boolean,default:!1},norepeat:{type:Boolean,default:!1},noload:{type:Boolean,default:!1}},methods:{start(){this._start()},stop(){this._stop()}},events:{tick:Event},render:!1,init(){this.props.noload||this._start()},destroy(){this._stop()},_start(){this.set("running",!0),this._startTime=Date.now(),this._tick()},_stop(){clearTimeout(this._timer),this.set("running",!1),this.set("percent",0)},_tick(){if(this.data.running)if(this.props.noprogress)this.dispatchEvent("tick"),this.props.norepeat||(this._timer=setTimeout((()=>this._tick()),this._delay()));else{let t=Date.now()-this._startTime,e=this._delay();t>=e?(this.set("percent",100),this.dispatchEvent("tick"),this.props.norepeat?this._stop():this._start()):(this.set("percent",Math.ceil(100*t/e)),requestAnimationFrame((()=>this._tick())))}},_delay(){switch(this.props.unit){case"miliseconds":return this.props.delay;case"minutes":return 6e4*this.props.delay;case"hours":return 36e5*this.props.delay;case"days":return 864e5*this.props.delay;default:return 1e3*this.props.delay}}});
//# sourceMappingURL=dmxScheduler.js.map
