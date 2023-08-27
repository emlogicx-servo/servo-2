/*!
 App Connect Scheduler
 Version: 1.1.0
 (c) 2022 Wappler.io
 @build 2022-04-14 12:03:48
 */
dmx.Component("scheduler",{initialData:{running:!1,percent:0},attributes:{delay:{type:Number,default:60},unit:{type:String,default:"seconds"},noprogress:{type:Boolean,default:!1},norepeat:{type:Boolean,default:!1},noload:{type:Boolean,default:!1}},methods:{start:function(){this.start()},stop:function(){this.stop()}},events:{tick:Event},render:function(t){this.props.noload||this.start()},beforeDestroy:function(){this.stop()},start:function(){this.set("running",!0),this._startTime=Date.now(),this.tick()},stop:function(){clearTimeout(this._timer),this.set("running",!1),this.set("percent",0)},tick:function(){if(this.data.running)if(this.props.noprogress)this.dispatchEvent("tick"),this.props.norepeat||(this._timer=setTimeout((()=>this.tick()),this.delay()));else{let t=Date.now()-this._startTime,e=this.delay();t>=e?(this.set("percent",100),this.dispatchEvent("tick"),this.props.norepeat?this.stop():this.start()):(this.set("percent",Math.ceil(100*t/e)),requestAnimationFrame((()=>this.tick())))}},delay:function(){switch(this.props.unit){case"miliseconds":return this.props.delay;case"minutes":return 6e4*this.props.delay;case"hours":return 36e5*this.props.delay;case"days":return 864e5*this.props.delay;default:return 1e3*this.props.delay}}});
//# sourceMappingURL=../maps/dmxScheduler.js.map
