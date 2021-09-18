/* -- DO NOT REMOVE --
 * jQuery MDTimePicker v1.0.2 plugin
 * https://github.com/dmuy/MDTimePicker
 * 
 * Author: Dionlee Uy
 * Email: dionleeuy@gmail.com
 *
 * @requires jQuery
 * -- DO NOT REMOVE -- 
 */
!function(e){"function"==typeof define&&define.amd?define(["jquery"],e):"object"==typeof exports?module.exports=e(require("jquery")):e(jQuery)}(function(e){if(void 0===e)throw new Error("MDTimePicker: This plugin requires jQuery");var t=[9,112,113,114,115,116,117,118,119,120,121,122,123],i=function(t,i){this.hour=t,this.minute=i,this.format=function(t,i){var s=this,r=(t.match(/h/g)||[]).length>1;return e.trim(t.replace(/(hh|h|mm|ss|tt|t)/g,function(e){switch(e.toLowerCase()){case"h":var t=s.getHour(!0);return i&&t<10?"0"+t:t;case"hh":return s.hour<10?"0"+s.hour:s.hour;case"mm":return s.minute<10?"0"+s.minute:s.minute;case"ss":return"00";case"t":return r?"":s.getPeriod().toLowerCase();case"tt":return r?"":s.getPeriod()}}))},this.setHour=function(e){this.hour=e},this.getHour=function(e){return e?[0,12].indexOf(this.hour)>=0?12:this.hour%12:this.hour},this.invert=function(){"AM"===this.getPeriod()?this.setHour(this.getHour()+12):this.setHour(this.getHour()-12)},this.setMinutes=function(e){this.minute=e},this.getMinutes=function(){return this.minute},this.getPeriod=function(){return this.hour<12?"AM":"PM"}},s=function(s,r){var n=this;this.visible=!1,this.activeView="hours",this.hTimeout=null,this.mTimeout=null,this.input=e(s),this.config=r,this.time=new i(0,0),this.selected=new i(0,0),this.timepicker={overlay:e('<div class="mdtimepicker hidden"></div>'),wrapper:e('<div class="mdtp__wrapper" tabindex="0"></div>'),timeHolder:{wrapper:e('<section class="mdtp__time_holder"></section>'),hour:e('<span class="mdtp__time_h">12</span>'),dots:e('<span class="mdtp__timedots">:</span>'),minute:e('<span class="mdtp__time_m">00</span>'),am_pm:e('<span class="mdtp__ampm">AM</span>')},clockHolder:{wrapper:e('<section class="mdtp__clock_holder"></section>'),am:e('<span class="mdtp__am">AM</span>'),pm:e('<span class="mdtp__pm">PM</span>'),clock:{wrapper:e('<div class="mdtp__clock"></div>'),dot:e('<span class="mdtp__clock_dot"></span>'),hours:e('<div class="mdtp__hour_holder"></div>'),minutes:e('<div class="mdtp__minute_holder"></div>')},buttonsHolder:{wrapper:e('<div class="mdtp__buttons">'),btnClear:e('<span class="mdtp__button clear-btn">Clear</span>'),btnOk:e('<span class="mdtp__button ok">Ok</span>'),btnCancel:e('<span class="mdtp__button cancel">Cancel</span>')}}},this.setMinTime(this.input.data("mintime")||this.config.minTime),this.setMaxTime(this.input.data("maxtime")||this.config.maxTime);var a=n.timepicker;if(n.setup().appendTo("body"),a.overlay.click(function(){n.hide()}),a.wrapper.click(function(e){e.stopPropagation()}).on("keydown",function(e){27===e.keyCode&&n.hide()}),a.clockHolder.am.click(function(){"AM"!==n.selected.getPeriod()&&n.setPeriod("am")}),a.clockHolder.pm.click(function(){"PM"!==n.selected.getPeriod()&&n.setPeriod("pm")}),a.timeHolder.hour.click(function(){"hours"!==n.activeView&&n.switchView("hours")}),a.timeHolder.minute.click(function(){"minutes"!==n.activeView&&n.switchView("minutes")}),a.clockHolder.buttonsHolder.btnOk.click(function(){var e=n.selected;if(!n.isDisabled(e.getHour(),e.getMinutes())){n.setValue(e);var t=n.getFormattedTime();n.triggerChange({time:t.time,value:t.value}),n.hide()}}),a.clockHolder.buttonsHolder.btnCancel.click(function(){n.hide()}),n.config.clearBtn&&a.clockHolder.buttonsHolder.btnClear.click(function(){n.input.val("").attr("data-time",null).attr("value",""),n.triggerChange({time:null,value:""}),n.hide()}),n.input.on("keydown",function(e){return 13===e.keyCode&&n.show(),!(t.indexOf(e.which)<0&&n.config.readOnly)}).on("click",function(){n.show()}).prop("readonly",!0),""!==n.input.val()){var o=n.parseTime(n.input.val(),n.config.format);n.setValue(o)}else{o=n.getSystemTime();n.time=new i(o.hour,o.minute)}n.resetSelected(),n.switchView(n.activeView)};s.prototype={constructor:s,setup:function(){var t=this,i=t.timepicker,s=i.overlay,r=i.wrapper,n=i.timeHolder,a=i.clockHolder;n.wrapper.append(n.hour).append(n.dots).append(n.minute).appendTo(r),t.config.is24hour||n.wrapper.append(n.am_pm);for(var o=t.config.is24hour?24:12,c=0;c<o;c++){var d=c+1,m=(120+30*c)%360-(t.config.is24hour&&d<13?15:0),u=24===d,l=e('<div class="mdtp__digit rotate-'+m+'" data-hour="'+(u?0:d)+'"><span>'+(u?"00":d)+"</span></div>");t.config.is24hour&&d<13&&l.addClass("inner--digit"),l.find("span").click(function(){var i=parseInt(e(this).parent().data("hour")),s=t.selected.getPeriod(),r=t.config.is24hour?i:(i+("PM"===s&&i<12||"AM"===s&&12===i?12:0))%24;t.isDisabled(r,0)||(t.setHour(r),t.switchView("minutes"))}),a.clock.hours.append(l)}for(c=0;c<60;c++){var h=c<10?"0"+c:c,p=e('<div class="mdtp__digit rotate-'+(m=(90+6*c)%360)+'" data-minute="'+c+'"></div>');c%5==0?p.addClass("marker").html("<span>"+h+"</span>"):p.html("<span></span>"),p.find("span").click(function(){var i=parseInt(e(this).parent().data("minute")),s=t.selected.getHour();t.isDisabled(s,i)||t.setMinute(i)}),a.clock.minutes.append(p)}return t.config.is24hour||a.clock.wrapper.append(a.am).append(a.pm),a.clock.wrapper.append(a.clock.dot).append(a.clock.hours).append(a.clock.minutes).appendTo(a.wrapper),t.config.clearBtn&&a.buttonsHolder.wrapper.append(a.buttonsHolder.btnClear),a.buttonsHolder.wrapper.append(a.buttonsHolder.btnCancel).append(a.buttonsHolder.btnOk).appendTo(a.wrapper),a.wrapper.appendTo(r),r.attr("data-theme",t.input.data("theme")||t.config.theme||e.fn.mdtimepicker.defaults.theme),r.appendTo(s),s},setHour:function(t){if(void 0===t)throw new Error("Expecting a value.");var i=!this.config.is24hour;this.selected.setHour(t);var s=this.selected.getHour(i);this.timepicker.timeHolder.hour.text(i?s:this.selected.format("hh")),this.timepicker.clockHolder.clock.hours.children("div").each(function(t,i){var r=e(i),n=r.data("hour");r[n===s?"addClass":"removeClass"]("active")})},setMinute:function(t){if(void 0===t)throw new Error("Expecting a value.");this.selected.setMinutes(t),this.timepicker.timeHolder.minute.text(t<10?"0"+t:t),this.timepicker.clockHolder.clock.minutes.children("div").each(function(i,s){var r=e(s),n=r.data("minute");r[n===t?"addClass":"removeClass"]("active")})},setPeriod:function(e){if(void 0===e)throw new Error("Expecting a value.");this.selected.getPeriod()!==e.toUpperCase()&&this.selected.invert();var t=this.selected.getPeriod();this.setDisabled(this.activeView),this.timepicker.timeHolder.am_pm.text(t),this.timepicker.clockHolder.am["AM"===t?"addClass":"removeClass"]("active"),this.timepicker.clockHolder.pm["PM"===t?"addClass":"removeClass"]("active")},setValue:function(e){if(void 0===e)throw new Error("Expecting a value.");var t="string"==typeof e?this.parseTime(e,this.config.format):e;this.time=new i(t.hour,t.minute);var s=this.getFormattedTime();this.input.val(s.value).attr("data-time",s.time).attr("value",s.value)},setMinTime:function(e){this.minTime=e},setMaxTime:function(e){this.maxTime=e},setDisabled:function(t){if("hours"===t||"minutes"===t){var s=this,r=this.timepicker.clockHolder.clock;"hours"===t&&r.hours.find(".mdtp__digit").each(function(t,r){var n=e(r),a=parseInt(n.data("hour")),o=s.selected.getPeriod(),c=new i(a,0);s.config.is24hour||o===c.getPeriod()||c.invert(),n[s.isDisabled(c.getHour(),0)?"addClass":"removeClass"]("digit--disabled")}),"minutes"===t&&r.minutes.find(".mdtp__digit").each(function(t,i){var r=e(i),n=parseInt(r.data("minute")),a=s.selected.getHour();r[s.isDisabled(a,n)?"addClass":"removeClass"]("digit--disabled")})}},isDisabled:function(e,t){var i=this,s=null,r=null,n=null,a=null,o=new Date,c=new Date(o.getFullYear(),o.getMonth(),o.getDate(),e,t,0,0),d="hours"===i.activeView;return i.minTime&&(s="now"===i.minTime?i.getSystemTime():i.parseTime(i.minTime)),i.maxTime&&(n="now"===i.maxTime?i.getSystemTime():i.parseTime(i.maxTime)),s&&(r=new Date(o.getFullYear(),o.getMonth(),o.getDate(),s.getHour(),d?0:s.getMinutes(),0,0)),n&&(a=new Date(o.getFullYear(),o.getMonth(),o.getDate(),n.getHour(),d?0:n.getMinutes(),0,0)),r&&c<r||a&&c>a},resetSelected:function(){this.setHour(this.time.hour),this.setMinute(this.time.minute),this.setPeriod(this.time.getPeriod())},getFormattedTime:function(){return{time:this.time.format(this.config.timeFormat,!1),value:this.time.format(this.config.format,this.config.hourPadding)}},getSystemTime:function(){var e=new Date;return new i(e.getHours(),e.getMinutes())},parseTime:function(e,t){var s=void 0===t?this.config.format:t,r=(s.match(/h/g)||[]).length>1,n=((s.match(/m/g)||[]).length,(s.match(/t/g)||[]).length),a=e.length,o=s.indexOf("h"),c=s.lastIndexOf("h"),d="",m="";if(this.config.hourPadding||r)d=e.substr(o,2);else{var u=s.substring(o-1,o),l=s.substring(c+1,c+2);d=c===s.length-1?e.substring(e.indexOf(u,o-1)+1,a):0===o?e.substring(0,e.indexOf(l,o)):e.substring(e.indexOf(u,o-1)+1,e.indexOf(l,o+1))}var h=(s=s.replace(/(hh|h)/g,d)).indexOf("m"),p=s.lastIndexOf("m"),f=s.indexOf("t"),g=s.substring(h-1,h);s.substring(p+1,p+2);m=p===s.length-1?e.substring(e.indexOf(g,h-1)+1,a):0===h?e.substring(0,2):e.substr(h,2);var v="pm"===(r?parseInt(d)>11?n>1?"PM":"pm":n>1?"AM":"am":e.substr(f,2)).toLowerCase(),k=new i(parseInt(d),parseInt(m));return(v&&parseInt(d)<12||!v&&12===parseInt(d))&&k.invert(),k},switchView:function(e){var t=this,i=this.timepicker;"hours"!==e&&"minutes"!==e||(t.activeView=e,t.setDisabled(e),i.timeHolder.hour["hours"===e?"addClass":"removeClass"]("active"),i.timeHolder.minute["hours"===e?"removeClass":"addClass"]("active"),i.clockHolder.clock.hours.addClass("animate"),"hours"===e&&i.clockHolder.clock.hours.removeClass("hidden"),clearTimeout(t.hTimeout),t.hTimeout=setTimeout(function(){"hours"!==e&&i.clockHolder.clock.hours.addClass("hidden"),i.clockHolder.clock.hours.removeClass("animate")},"hours"===e?20:350),i.clockHolder.clock.minutes.addClass("animate"),"minutes"===e&&i.clockHolder.clock.minutes.removeClass("hidden"),clearTimeout(t.mTimeout),t.mTimeout=setTimeout(function(){"minutes"!==e&&i.clockHolder.clock.minutes.addClass("hidden"),i.clockHolder.clock.minutes.removeClass("animate")},"minutes"===e?20:350))},show:function(){var t=this;if(""===t.input.val()){var s=t.getSystemTime();this.time=new i(s.hour,s.minute)}t.resetSelected(),e("body").attr("mdtimepicker-display","on"),t.timepicker.wrapper.addClass("animate"),t.timepicker.overlay.removeClass("hidden").addClass("animate"),setTimeout(function(){t.timepicker.overlay.removeClass("animate"),t.timepicker.wrapper.removeClass("animate").focus(),t.visible=!0,t.input.blur()},10)},hide:function(){var t=this;t.timepicker.overlay.addClass("animate"),t.timepicker.wrapper.addClass("animate"),setTimeout(function(){t.switchView("hours"),t.timepicker.overlay.addClass("hidden").removeClass("animate"),t.timepicker.wrapper.removeClass("animate"),e("body").removeAttr("mdtimepicker-display"),t.visible=!1,t.input.focus()},300)},destroy:function(){this.input.removeData("mdtimepicker").unbind("keydown").unbind("click").removeProp("readonly"),this.timepicker.overlay.remove()},triggerChange:function(t){this.input.trigger(e.Event("timechanged",t)).trigger("onchange").trigger("change")}},e.fn.mdtimepicker=function(){var t=arguments,i=t[0],r=e.extend({},e.fn.mdtimepicker.defaults);return"object"==typeof i&&i.is24hour&&(r.format="hh:mm"),e(this).each(function(n,a){var o=e(this),c=e(this).data("mdtimepicker"),d=e.extend({},r,o.data(),"object"==typeof i&&i);c||o.data("mdtimepicker",c=new s(this,d)),"string"==typeof i&&c[i].apply(c,Array.prototype.slice.call(t).slice(1))})},e.fn.mdtimepicker.defaults={timeFormat:"hh:mm:ss.000",format:"h:mm tt",theme:"blue",hourPadding:!1,clearBtn:!1,is24hour:!1}});