(function(e){function m(){this.regional=[];this.regional[""]={currentText:"Now",closeText:"Done",ampm:!1,amNames:["AM","A"],pmNames:["PM","P"],timeFormat:"hh:mm tt",timeSuffix:"",timeOnlyTitle:"Choose Time",timeText:"Time",hourText:"Hour",minuteText:"Minute",secondText:"Second",millisecText:"Millisecond",timezoneText:"Time Zone"};this._defaults={showButtonPanel:!0,timeOnly:!1,showHour:!0,showMinute:!0,showSecond:!1,showMillisec:!1,showTimezone:!1,showTime:!0,stepHour:1,stepMinute:1,stepSecond:1,stepMillisec:1, hour:0,minute:0,second:0,millisec:0,timezone:"+0000",hourMin:0,minuteMin:0,secondMin:0,millisecMin:0,hourMax:23,minuteMax:59,secondMax:59,millisecMax:999,minDateTime:null,maxDateTime:null,onSelect:null,hourGrid:0,minuteGrid:0,secondGrid:0,millisecGrid:0,alwaysSetTime:!0,separator:" ",altFieldTimeOnly:!0,showTimepicker:!0,timezoneIso8609:!1,timezoneList:null,addSliderAccess:!1,sliderAccessArgs:null};e.extend(this._defaults,this.regional[""])}e.extend(e.ui,{timepicker:{version:"0.9.9"}});e.extend(m.prototype, {$input:null,$altInput:null,$timeObj:null,inst:null,hour_slider:null,minute_slider:null,second_slider:null,millisec_slider:null,timezone_select:null,hour:0,minute:0,second:0,millisec:0,timezone:"+0000",hourMinOriginal:null,minuteMinOriginal:null,secondMinOriginal:null,millisecMinOriginal:null,hourMaxOriginal:null,minuteMaxOriginal:null,secondMaxOriginal:null,millisecMaxOriginal:null,ampm:"",formattedDate:"",formattedTime:"",formattedDateTime:"",timezoneList:null,setDefaults:function(c){var a=this._defaults, c=c||{};e.extend(a,c);for(var b in c)if(null===c[b]||void 0===c[b])a[b]=c[b];return this},_newInst:function(c,a){var b=new m,d={},f;for(f in this._defaults){var g=c.attr("time:"+f);if(g)try{d[f]=eval(g)}catch(k){d[f]=g}}b._defaults=e.extend({},this._defaults,d,a,{beforeShow:function(c,d){if(e.isFunction(a.beforeShow))return a.beforeShow(c,d,b)},onChangeMonthYear:function(d,f,g){b._updateDateTime(g);e.isFunction(a.onChangeMonthYear)&&a.onChangeMonthYear.call(c[0],d,f,g,b)},onClose:function(d,f){!0=== b.timeDefined&&""!=c.val()&&b._updateDateTime(f);e.isFunction(a.onClose)&&a.onClose.call(c[0],d,f,b)},timepicker:b});b.amNames=e.map(b._defaults.amNames,function(a){return a.toUpperCase()});b.pmNames=e.map(b._defaults.pmNames,function(a){return a.toUpperCase()});if(null===b._defaults.timezoneList){d=[];for(f=-11;12>=f;f++)d.push((0<=f?"+":"-")+("0"+Math.abs(f).toString()).slice(-2)+"00");b._defaults.timezoneIso8609&&(d=e.map(d,function(a){return"+0000"==a?"Z":a.substring(0,3)+":"+a.substring(3)})); b._defaults.timezoneList=d}b.hour=b._defaults.hour;b.minute=b._defaults.minute;b.second=b._defaults.second;b.millisec=b._defaults.millisec;b.ampm="";b.$input=c;a.altField&&(b.$altInput=e(a.altField).css({cursor:"pointer"}).focus(function(){c.trigger("focus")}));if(0==b._defaults.minDate||0==b._defaults.minDateTime)b._defaults.minDate=new Date;if(0==b._defaults.maxDate||0==b._defaults.maxDateTime)b._defaults.maxDate=new Date;void 0!==b._defaults.minDate&&b._defaults.minDate instanceof Date&&(b._defaults.minDateTime= new Date(b._defaults.minDate.getTime()));void 0!==b._defaults.minDateTime&&b._defaults.minDateTime instanceof Date&&(b._defaults.minDate=new Date(b._defaults.minDateTime.getTime()));void 0!==b._defaults.maxDate&&b._defaults.maxDate instanceof Date&&(b._defaults.maxDateTime=new Date(b._defaults.maxDate.getTime()));void 0!==b._defaults.maxDateTime&&b._defaults.maxDateTime instanceof Date&&(b._defaults.maxDate=new Date(b._defaults.maxDateTime.getTime()));return b},_addTimePicker:function(c){this.timeDefined= this._parseTime(this.$altInput&&this._defaults.altFieldTimeOnly?this.$input.val()+" "+this.$altInput.val():this.$input.val());this._limitMinMaxDateTime(c,!1);this._injectTimePicker()},_parseTime:function(c,a){var b=this._defaults.timeFormat.toString().replace(/h{1,2}/ig,"(\\d?\\d)").replace(/m{1,2}/ig,"(\\d?\\d)").replace(/s{1,2}/ig,"(\\d?\\d)").replace(/l{1}/ig,"(\\d?\\d?\\d)").replace(/t{1,2}/ig,this._getPatternAmpm()).replace(/z{1}/ig,"(z|[-+]\\d\\d:?\\d\\d)?").replace(/\s/g,"\\s?")+this._defaults.timeSuffix+ "$",d=this._getFormatPositions(),f="";this.inst||(this.inst=e.datepicker._getInst(this.$input[0]));if(a||!this._defaults.timeOnly)b="^.{"+e.datepicker._get(this.inst,"dateFormat").length+",}?"+this._defaults.separator.replace(RegExp("[.*+?|()\\[\\]{}\\\\]","g"),"\\$&")+b;if(b=c.match(RegExp(b,"i"))){-1!==d.t&&(void 0===b[d.t]||0===b[d.t].length?this.ampm=f="":(f=-1!==e.inArray(b[d.t].toUpperCase(),this.amNames)?"AM":"PM",this.ampm=this._defaults["AM"==f?"amNames":"pmNames"][0]));-1!==d.h&&(this.hour= "AM"==f&&"12"==b[d.h]?0:"PM"==f&&"12"!=b[d.h]?(parseFloat(b[d.h])+12).toFixed(0):Number(b[d.h]));-1!==d.m&&(this.minute=Number(b[d.m]));-1!==d.s&&(this.second=Number(b[d.s]));-1!==d.l&&(this.millisec=Number(b[d.l]));if(-1!==d.z&&void 0!==b[d.z]){d=b[d.z].toUpperCase();switch(d.length){case 1:d=this._defaults.timezoneIso8609?"Z":"+0000";break;case 5:this._defaults.timezoneIso8609&&(d="0000"==d.substring(1)?"Z":d.substring(0,3)+":"+d.substring(3));break;case 6:this._defaults.timezoneIso8609?"00:00"== d.substring(1)&&(d="Z"):d="Z"==d||"00:00"==d.substring(1)?"+0000":d.replace(/:/,"")}this.timezone=d}return!0}return!1},_getPatternAmpm:function(){var c=[];o=this._defaults;o.amNames&&e.merge(c,o.amNames);o.pmNames&&e.merge(c,o.pmNames);c=e.map(c,function(a){return a.replace(/[.*+?|()\[\]{}\\]/g,"\\$&")});return"("+c.join("|")+")?"},_getFormatPositions:function(){var c=this._defaults.timeFormat.toLowerCase().match(/(h{1,2}|m{1,2}|s{1,2}|l{1}|t{1,2}|z)/g),a={h:-1,m:-1,s:-1,l:-1,t:-1,z:-1};if(c)for(var b= 0;b<c.length;b++)-1==a[c[b].toString().charAt(0)]&&(a[c[b].toString().charAt(0)]=b+1);return a},_injectTimePicker:function(){var c=this.inst.dpDiv,a=this._defaults,b=this,d=parseInt(a.hourMax-(a.hourMax-a.hourMin)%a.stepHour,10),f=parseInt(a.minuteMax-(a.minuteMax-a.minuteMin)%a.stepMinute,10),g=parseInt(a.secondMax-(a.secondMax-a.secondMin)%a.stepSecond,10),k=parseInt(a.millisecMax-(a.millisecMax-a.millisecMin)%a.stepMillisec,10),i=this.inst.id.toString().replace(/([^A-Za-z0-9_])/g,"");if(0===c.find("div#ui-timepicker-div-"+ i).length&&a.showTimepicker){var h='<div class="ui-timepicker-div" id="ui-timepicker-div-'+i+'"><dl><dt class="ui_tpicker_time_label" id="ui_tpicker_time_label_'+i+'"'+(a.showTime?"":' style="display:none;"')+">"+a.timeText+'</dt><dd class="ui_tpicker_time" id="ui_tpicker_time_'+i+'"'+(a.showTime?"":' style="display:none;"')+'></dd><dt class="ui_tpicker_hour_label" id="ui_tpicker_hour_label_'+i+'"'+(a.showHour?"":' style="display:none;"')+">"+a.hourText+"</dt>",p=0,q=0,m=0,r=0,l,h=h+('<dd class="ui_tpicker_hour"><div id="ui_tpicker_hour_'+ i+'"'+(a.showHour?"":' style="display:none;"')+"></div>");if(a.showHour&&0<a.hourGrid){for(var h=h+'<div style="padding-left: 1px"><table class="ui-tpicker-grid-label"><tr>',j=a.hourMin;j<=d;j+=parseInt(a.hourGrid,10)){p++;var n=a.ampm&&12<j?j-12:j;10>n&&(n="0"+n);a.ampm&&(n=0==j?"12a":12>j?n+"a":n+"p");h+="<td>"+n+"</td>"}h+="</tr></table></div>"}h=h+"</dd>"+('<dt class="ui_tpicker_minute_label" id="ui_tpicker_minute_label_'+i+'"'+(a.showMinute?"":' style="display:none;"')+">"+a.minuteText+'</dt><dd class="ui_tpicker_minute"><div id="ui_tpicker_minute_'+ i+'"'+(a.showMinute?"":' style="display:none;"')+"></div>");if(a.showMinute&&0<a.minuteGrid){h+='<div style="padding-left: 1px"><table class="ui-tpicker-grid-label"><tr>';for(j=a.minuteMin;j<=f;j+=parseInt(a.minuteGrid,10))q++,h+="<td>"+(10>j?"0":"")+j+"</td>";h+="</tr></table></div>"}h=h+"</dd>"+('<dt class="ui_tpicker_second_label" id="ui_tpicker_second_label_'+i+'"'+(a.showSecond?"":' style="display:none;"')+">"+a.secondText+'</dt><dd class="ui_tpicker_second"><div id="ui_tpicker_second_'+i+'"'+ (a.showSecond?"":' style="display:none;"')+"></div>");if(a.showSecond&&0<a.secondGrid){h+='<div style="padding-left: 1px"><table><tr>';for(j=a.secondMin;j<=g;j+=parseInt(a.secondGrid,10))m++,h+="<td>"+(10>j?"0":"")+j+"</td>";h+="</tr></table></div>"}h=h+"</dd>"+('<dt class="ui_tpicker_millisec_label" id="ui_tpicker_millisec_label_'+i+'"'+(a.showMillisec?"":' style="display:none;"')+">"+a.millisecText+'</dt><dd class="ui_tpicker_millisec"><div id="ui_tpicker_millisec_'+i+'"'+(a.showMillisec?"":' style="display:none;"')+ "></div>");if(a.showMillisec&&0<a.millisecGrid){h+='<div style="padding-left: 1px"><table><tr>';for(j=a.millisecMin;j<=k;j+=parseInt(a.millisecGrid,10))r++,h+="<td>"+(10>j?"0":"")+j+"</td>";h+="</tr></table></div>"}h=h+"</dd>"+('<dt class="ui_tpicker_timezone_label" id="ui_tpicker_timezone_label_'+i+'"'+(a.showTimezone?"":' style="display:none;"')+">"+a.timezoneText+"</dt>");h+='<dd class="ui_tpicker_timezone" id="ui_tpicker_timezone_'+i+'"'+(a.showTimezone?"":' style="display:none;"')+"></dd>";$tp= e(h+"</dl></div>");!0===a.timeOnly&&($tp.prepend('<div class="ui-widget-header ui-helper-clearfix ui-corner-all"><div class="ui-datepicker-title">'+a.timeOnlyTitle+"</div></div>"),c.find(".ui-datepicker-header, .ui-datepicker-calendar").hide());this.hour_slider=$tp.find("#ui_tpicker_hour_"+i).slider({orientation:"horizontal",value:this.hour,min:a.hourMin,max:d,step:a.stepHour,slide:function(a,c){b.hour_slider.slider("option","value",c.value);b._onTimeChange()}});this.minute_slider=$tp.find("#ui_tpicker_minute_"+ i).slider({orientation:"horizontal",value:this.minute,min:a.minuteMin,max:f,step:a.stepMinute,slide:function(a,c){b.minute_slider.slider("option","value",c.value);b._onTimeChange()}});this.second_slider=$tp.find("#ui_tpicker_second_"+i).slider({orientation:"horizontal",value:this.second,min:a.secondMin,max:g,step:a.stepSecond,slide:function(a,c){b.second_slider.slider("option","value",c.value);b._onTimeChange()}});this.millisec_slider=$tp.find("#ui_tpicker_millisec_"+i).slider({orientation:"horizontal", value:this.millisec,min:a.millisecMin,max:k,step:a.stepMillisec,slide:function(a,c){b.millisec_slider.slider("option","value",c.value);b._onTimeChange()}});this.timezone_select=$tp.find("#ui_tpicker_timezone_"+i).append("<select></select>").find("select");e.fn.append.apply(this.timezone_select,e.map(a.timezoneList,function(a){return e("<option />").val(typeof a=="object"?a.value:a).text(typeof a=="object"?a.label:a)}));this.timezone_select.val("undefined"!=typeof this.timezone&&null!=this.timezone&& ""!=this.timezone?this.timezone:a.timezone);this.timezone_select.change(function(){b._onTimeChange()});a.showHour&&0<a.hourGrid&&(l=100*p*a.hourGrid/(d-a.hourMin),$tp.find(".ui_tpicker_hour table").css({width:l+"%",marginLeft:l/(-2*p)+"%",borderCollapse:"collapse"}).find("td").each(function(){e(this).click(function(){var c=e(this).html();if(a.ampm)var d=c.substring(2).toLowerCase(),c=parseInt(c.substring(0,2),10),c=d=="a"?c==12?0:c:c==12?12:c+12;b.hour_slider.slider("option","value",c);b._onTimeChange(); b._onSelectHandler()}).css({cursor:"pointer",width:100/p+"%",textAlign:"center",overflow:"hidden"})}));a.showMinute&&0<a.minuteGrid&&(l=100*q*a.minuteGrid/(f-a.minuteMin),$tp.find(".ui_tpicker_minute table").css({width:l+"%",marginLeft:l/(-2*q)+"%",borderCollapse:"collapse"}).find("td").each(function(){e(this).click(function(){b.minute_slider.slider("option","value",e(this).html());b._onTimeChange();b._onSelectHandler()}).css({cursor:"pointer",width:100/q+"%",textAlign:"center",overflow:"hidden"})})); a.showSecond&&0<a.secondGrid&&$tp.find(".ui_tpicker_second table").css({width:l+"%",marginLeft:l/(-2*m)+"%",borderCollapse:"collapse"}).find("td").each(function(){e(this).click(function(){b.second_slider.slider("option","value",e(this).html());b._onTimeChange();b._onSelectHandler()}).css({cursor:"pointer",width:100/m+"%",textAlign:"center",overflow:"hidden"})});a.showMillisec&&0<a.millisecGrid&&$tp.find(".ui_tpicker_millisec table").css({width:l+"%",marginLeft:l/(-2*r)+"%",borderCollapse:"collapse"}).find("td").each(function(){e(this).click(function(){b.millisec_slider.slider("option", "value",e(this).html());b._onTimeChange();b._onSelectHandler()}).css({cursor:"pointer",width:100/r+"%",textAlign:"center",overflow:"hidden"})});d=c.find(".ui-datepicker-buttonpane");d.length?d.before($tp):c.append($tp);this.$timeObj=$tp.find("#ui_tpicker_time_"+i);null!==this.inst&&(c=this.timeDefined,this._onTimeChange(),this.timeDefined=c);c=function(){b._onSelectHandler()};this.hour_slider.bind("slidestop",c);this.minute_slider.bind("slidestop",c);this.second_slider.bind("slidestop",c);this.millisec_slider.bind("slidestop", c);if(this._defaults.addSliderAccess){var s=this._defaults.sliderAccessArgs;setTimeout(function(){if($tp.find(".ui-slider-access").length==0){$tp.find(".ui-slider:visible").sliderAccess(s);var a=$tp.find(".ui-slider-access:eq(0)").outerWidth(true);a&&$tp.find("table:visible").each(function(){var b=e(this),c=b.outerWidth(),d=b.css("marginLeft").toString().replace("%",""),f=c-a;b.css({width:f,marginLeft:d*f/c+"%"})})}},0)}}},_limitMinMaxDateTime:function(c,a){var b=this._defaults,d=new Date(c.selectedYear, c.selectedMonth,c.selectedDay);if(this._defaults.showTimepicker){if(null!==e.datepicker._get(c,"minDateTime")&&void 0!==e.datepicker._get(c,"minDateTime")&&d){var f=e.datepicker._get(c,"minDateTime"),g=new Date(f.getFullYear(),f.getMonth(),f.getDate(),0,0,0,0);if(null===this.hourMinOriginal||null===this.minuteMinOriginal||null===this.secondMinOriginal||null===this.millisecMinOriginal)this.hourMinOriginal=b.hourMin,this.minuteMinOriginal=b.minuteMin,this.secondMinOriginal=b.secondMin,this.millisecMinOriginal= b.millisecMin;c.settings.timeOnly||g.getTime()==d.getTime()?(this._defaults.hourMin=f.getHours(),this.hour<=this._defaults.hourMin?(this.hour=this._defaults.hourMin,this._defaults.minuteMin=f.getMinutes(),this.minute<=this._defaults.minuteMin?(this.minute=this._defaults.minuteMin,this._defaults.secondMin=f.getSeconds()):this.second<=this._defaults.secondMin?(this.second=this._defaults.secondMin,this._defaults.millisecMin=f.getMilliseconds()):(this.millisec<this._defaults.millisecMin&&(this.millisec= this._defaults.millisecMin),this._defaults.millisecMin=this.millisecMinOriginal)):(this._defaults.minuteMin=this.minuteMinOriginal,this._defaults.secondMin=this.secondMinOriginal,this._defaults.millisecMin=this.millisecMinOriginal)):(this._defaults.hourMin=this.hourMinOriginal,this._defaults.minuteMin=this.minuteMinOriginal,this._defaults.secondMin=this.secondMinOriginal,this._defaults.millisecMin=this.millisecMinOriginal)}if(null!==e.datepicker._get(c,"maxDateTime")&&void 0!==e.datepicker._get(c, "maxDateTime")&&d){f=e.datepicker._get(c,"maxDateTime");g=new Date(f.getFullYear(),f.getMonth(),f.getDate(),0,0,0,0);if(null===this.hourMaxOriginal||null===this.minuteMaxOriginal||null===this.secondMaxOriginal)this.hourMaxOriginal=b.hourMax,this.minuteMaxOriginal=b.minuteMax,this.secondMaxOriginal=b.secondMax,this.millisecMaxOriginal=b.millisecMax;c.settings.timeOnly||g.getTime()==d.getTime()?(this._defaults.hourMax=f.getHours(),this.hour>=this._defaults.hourMax?(this.hour=this._defaults.hourMax, this._defaults.minuteMax=f.getMinutes(),this.minute>=this._defaults.minuteMax?(this.minute=this._defaults.minuteMax,this._defaults.secondMax=f.getSeconds()):this.second>=this._defaults.secondMax?(this.second=this._defaults.secondMax,this._defaults.millisecMax=f.getMilliseconds()):(this.millisec>this._defaults.millisecMax&&(this.millisec=this._defaults.millisecMax),this._defaults.millisecMax=this.millisecMaxOriginal)):(this._defaults.minuteMax=this.minuteMaxOriginal,this._defaults.secondMax=this.secondMaxOriginal, this._defaults.millisecMax=this.millisecMaxOriginal)):(this._defaults.hourMax=this.hourMaxOriginal,this._defaults.minuteMax=this.minuteMaxOriginal,this._defaults.secondMax=this.secondMaxOriginal,this._defaults.millisecMax=this.millisecMaxOriginal)}void 0!==a&&!0===a&&(b=parseInt(this._defaults.hourMax-(this._defaults.hourMax-this._defaults.hourMin)%this._defaults.stepHour,10),d=parseInt(this._defaults.minuteMax-(this._defaults.minuteMax-this._defaults.minuteMin)%this._defaults.stepMinute,10),f=parseInt(this._defaults.secondMax- (this._defaults.secondMax-this._defaults.secondMin)%this._defaults.stepSecond,10),g=parseInt(this._defaults.millisecMax-(this._defaults.millisecMax-this._defaults.millisecMin)%this._defaults.stepMillisec,10),this.hour_slider&&this.hour_slider.slider("option",{min:this._defaults.hourMin,max:b}).slider("value",this.hour),this.minute_slider&&this.minute_slider.slider("option",{min:this._defaults.minuteMin,max:d}).slider("value",this.minute),this.second_slider&&this.second_slider.slider("option",{min:this._defaults.secondMin, max:f}).slider("value",this.second),this.millisec_slider&&this.millisec_slider.slider("option",{min:this._defaults.millisecMin,max:g}).slider("value",this.millisec))}},_onTimeChange:function(){var c=this.hour_slider?this.hour_slider.slider("value"):!1,a=this.minute_slider?this.minute_slider.slider("value"):!1,b=this.second_slider?this.second_slider.slider("value"):!1,d=this.millisec_slider?this.millisec_slider.slider("value"):!1,f=this.timezone_select?this.timezone_select.val():!1,g=this._defaults; "object"==typeof c&&(c=!1);"object"==typeof a&&(a=!1);"object"==typeof b&&(b=!1);"object"==typeof d&&(d=!1);"object"==typeof f&&(f=!1);!1!==c&&(c=parseInt(c,10));!1!==a&&(a=parseInt(a,10));!1!==b&&(b=parseInt(b,10));!1!==d&&(d=parseInt(d,10));var k=g[12>c?"amNames":"pmNames"][0],i=c!=this.hour||a!=this.minute||b!=this.second||d!=this.millisec||0<this.ampm.length&&12>c!=(-1!==e.inArray(this.ampm.toUpperCase(),this.amNames))||f!=this.timezone;i&&(!1!==c&&(this.hour=c),!1!==a&&(this.minute=a),!1!==b&& (this.second=b),!1!==d&&(this.millisec=d),!1!==f&&(this.timezone=f),this.inst||(this.inst=e.datepicker._getInst(this.$input[0])),this._limitMinMaxDateTime(this.inst,!0));g.ampm&&(this.ampm=k);this.formattedTime=e.datepicker.formatTime(this._defaults.timeFormat,this,this._defaults);this.$timeObj&&this.$timeObj.text(this.formattedTime+g.timeSuffix);this.timeDefined=!0;i&&this._updateDateTime()},_onSelectHandler:function(){var c=this._defaults.onSelect,a=this.$input?this.$input[0]:null;c&&a&&c.apply(a, [this.formattedDateTime,this])},_formatTime:function(c,a){var c=c||{hour:this.hour,minute:this.minute,second:this.second,millisec:this.millisec,ampm:this.ampm,timezone:this.timezone},b=(a||this._defaults.timeFormat).toString(),b=e.datepicker.formatTime(b,c,this._defaults);if(arguments.length)return b;this.formattedTime=b},_updateDateTime:function(c){var c=this.inst||c,a=e.datepicker._daylightSavingAdjust(new Date(c.selectedYear,c.selectedMonth,c.selectedDay)),b=e.datepicker._get(c,"dateFormat"),d= e.datepicker._getFormatConfig(c),f=null!==a&&this.timeDefined,a=this.formattedDate=e.datepicker.formatDate(b,null===a?new Date:a,d);if(!(void 0!==c.lastVal&&0<c.lastVal.length&&0===this.$input.val().length)){if(!0===this._defaults.timeOnly)a=this.formattedTime;else if(!0!==this._defaults.timeOnly&&(this._defaults.alwaysSetTime||f))a+=this._defaults.separator+this.formattedTime+this._defaults.timeSuffix;this.formattedDateTime=a;this._defaults.showTimepicker?this.$altInput&&!0===this._defaults.altFieldTimeOnly? (this.$altInput.val(this.formattedTime),this.$input.val(this.formattedDate)):(this.$altInput&&this.$altInput.val(a),this.$input.val(a)):this.$input.val(this.formattedDate);this.$input.trigger("change")}}});e.fn.extend({timepicker:function(c){var c=c||{},a=arguments;"object"==typeof c&&(a[0]=e.extend(c,{timeOnly:!0}));return e(this).each(function(){e.fn.datetimepicker.apply(e(this),a)})},datetimepicker:function(c){var c=c||{},a=arguments;return"string"==typeof c?"getDate"==c?e.fn.datepicker.apply(e(this[0]), a):this.each(function(){var b=e(this);b.datepicker.apply(b,a)}):this.each(function(){var a=e(this);a.datepicker(e.timepicker._newInst(a,c)._defaults)})}});e.datepicker.formatTime=function(c,a,b){var b=b||{},b=e.extend(e.timepicker._defaults,b),a=e.extend({hour:0,minute:0,second:0,millisec:0,timezone:"+0000"},a),d=b.amNames[0],f=parseInt(a.hour,10);b.ampm&&(11<f&&(d=b.pmNames[0],12<f&&(f%=12)),0===f&&(f=12));c=c.replace(/(?:hh?|mm?|ss?|[tT]{1,2}|[lz])/g,function(c){switch(c.toLowerCase()){case "hh":return("0"+ f).slice(-2);case "h":return f;case "mm":return("0"+a.minute).slice(-2);case "m":return a.minute;case "ss":return("0"+a.second).slice(-2);case "s":return a.second;case "l":return("00"+a.millisec).slice(-3);case "z":return a.timezone;case "t":case "tt":if(b.ampm){c.length==1&&(d=d.charAt(0));return c.charAt(0)=="T"?d.toUpperCase():d.toLowerCase()}return""}});return c=e.trim(c)};e.datepicker._base_selectDate=e.datepicker._selectDate;e.datepicker._selectDate=function(c,a){var b=this._getInst(e(c)[0]), d=this._get(b,"timepicker");d?(d._limitMinMaxDateTime(b,!0),b.inline=b.stay_open=!0,this._base_selectDate(c,a),b.inline=b.stay_open=!1,this._notifyChange(b),this._updateDatepicker(b)):this._base_selectDate(c,a)};e.datepicker._base_updateDatepicker=e.datepicker._updateDatepicker;e.datepicker._updateDatepicker=function(c){var a=c.input[0];if(!e.datepicker._curInst||!(e.datepicker._curInst!=c&&e.datepicker._datepickerShowing&&e.datepicker._lastInput!=a))if("boolean"!==typeof c.stay_open||!1===c.stay_open)this._base_updateDatepicker(c), (a=this._get(c,"timepicker"))&&a._addTimePicker(c)};e.datepicker._base_doKeyPress=e.datepicker._doKeyPress;e.datepicker._doKeyPress=function(c){var a=e.datepicker._getInst(c.target),b=e.datepicker._get(a,"timepicker");if(b&&e.datepicker._get(a,"constrainInput")){var d=b._defaults.ampm,a=e.datepicker._possibleChars(e.datepicker._get(a,"dateFormat")),b=b._defaults.timeFormat.toString().replace(/[hms]/g,"").replace(/TT/g,d?"APM":"").replace(/Tt/g,d?"AaPpMm":"").replace(/tT/g,d?"AaPpMm":"").replace(/T/g, d?"AP":"").replace(/tt/g,d?"apm":"").replace(/t/g,d?"ap":"")+" "+b._defaults.separator+b._defaults.timeSuffix+(b._defaults.showTimezone?b._defaults.timezoneList.join(""):"")+b._defaults.amNames.join("")+b._defaults.pmNames.join("")+a,d=String.fromCharCode(void 0===c.charCode?c.keyCode:c.charCode);return c.ctrlKey||" ">d||!a||-1<b.indexOf(d)}return e.datepicker._base_doKeyPress(c)};e.datepicker._base_doKeyUp=e.datepicker._doKeyUp;e.datepicker._doKeyUp=function(c){var a=e.datepicker._getInst(c.target), b=e.datepicker._get(a,"timepicker");if(b&&b._defaults.timeOnly&&a.input.val()!=a.lastVal)try{e.datepicker._updateDatepicker(a)}catch(d){e.datepicker.log(d)}return e.datepicker._base_doKeyUp(c)};e.datepicker._base_gotoToday=e.datepicker._gotoToday;e.datepicker._gotoToday=function(c){var a=this._getInst(e(c)[0]),b=a.dpDiv;this._base_gotoToday(c);var c=new Date,d=this._get(a,"timepicker");if(d&&d._defaults.showTimezone&&d.timezone_select){var f=c.getTimezoneOffset(),g=0<f?"-":"+",f=Math.abs(f),k=f%60, f=g+("0"+(f-k)/60).slice(-2)+("0"+k).slice(-2);d._defaults.timezoneIso8609&&(f=f.substring(0,3)+":"+f.substring(3));d.timezone_select.val(f)}this._setTime(a,c);e(".ui-datepicker-today",b).click()};e.datepicker._disableTimepickerDatepicker=function(c){var a=this._getInst(c),b=this._get(a,"timepicker");e(c).datepicker("getDate");b&&(b._defaults.showTimepicker=!1,b._updateDateTime(a))};e.datepicker._enableTimepickerDatepicker=function(c){var a=this._getInst(c),b=this._get(a,"timepicker");e(c).datepicker("getDate"); b&&(b._defaults.showTimepicker=!0,b._addTimePicker(a),b._updateDateTime(a))};e.datepicker._setTime=function(c,a){var b=this._get(c,"timepicker");if(b){var d=b._defaults,e=a?a.getHours():d.hour,g=a?a.getMinutes():d.minute,k=a?a.getSeconds():d.second,i=a?a.getMilliseconds():d.millisec;if(e<d.hourMin||e>d.hourMax||g<d.minuteMin||g>d.minuteMax||k<d.secondMin||k>d.secondMax||i<d.millisecMin||i>d.millisecMax)e=d.hourMin,g=d.minuteMin,k=d.secondMin,i=d.millisecMin;b.hour=e;b.minute=g;b.second=k;b.millisec= i;b.hour_slider&&b.hour_slider.slider("value",e);b.minute_slider&&b.minute_slider.slider("value",g);b.second_slider&&b.second_slider.slider("value",k);b.millisec_slider&&b.millisec_slider.slider("value",i);b._onTimeChange();b._updateDateTime(c)}};e.datepicker._setTimeDatepicker=function(c,a,b){var c=this._getInst(c),d=this._get(c,"timepicker");d&&(this._setDateFromField(c),a&&("string"==typeof a?(d._parseTime(a,b),a=new Date,a.setHours(d.hour,d.minute,d.second,d.millisec)):a=new Date(a.getTime()), "Invalid Date"==a.toString()&&(a=void 0),this._setTime(c,a)))};e.datepicker._base_setDateDatepicker=e.datepicker._setDateDatepicker;e.datepicker._setDateDatepicker=function(c,a){var b=this._getInst(c),d=a instanceof Date?new Date(a.getTime()):a;this._updateDatepicker(b);this._base_setDateDatepicker.apply(this,arguments);this._setTimeDatepicker(c,d,!0)};e.datepicker._base_getDateDatepicker=e.datepicker._getDateDatepicker;e.datepicker._getDateDatepicker=function(c,a){var b=this._getInst(c),d=this._get(b, "timepicker");return d?(this._setDateFromField(b,a),(b=this._getDate(b))&&d._parseTime(e(c).val(),d.timeOnly)&&b.setHours(d.hour,d.minute,d.second,d.millisec),b):this._base_getDateDatepicker(c,a)};e.datepicker._base_parseDate=e.datepicker.parseDate;e.datepicker.parseDate=function(c,a,b){var d;try{d=this._base_parseDate(c,a,b)}catch(e){if(0<=e.indexOf(":"))d=this._base_parseDate(c,a.substring(0,a.length-(e.length-e.indexOf(":")-2)),b);else throw e;}return d};e.datepicker._base_formatDate=e.datepicker._formatDate; e.datepicker._formatDate=function(c,a,b,d){var e=this._get(c,"timepicker");return e?(a&&this._base_formatDate(c,a,b,d),e._updateDateTime(c),e.$input.val()):this._base_formatDate(c)};e.datepicker._base_optionDatepicker=e.datepicker._optionDatepicker;e.datepicker._optionDatepicker=function(c,a,b){var d=this._get(this._getInst(c),"timepicker");if(d){var e,g,k;"string"==typeof a?"minDate"===a||"minDateTime"===a?e=b:"maxDate"===a||"maxDateTime"===a?g=b:"onSelect"===a&&(k=b):"object"==typeof a&&(a.minDate? e=a.minDate:a.minDateTime?e=a.minDateTime:a.maxDate?g=a.maxDate:a.maxDateTime&&(g=a.maxDateTime));e?(e=0==e?new Date:new Date(e),d._defaults.minDate=e,d._defaults.minDateTime=e):g?(g=0==g?new Date:new Date(g),d._defaults.maxDate=g,d._defaults.maxDateTime=g):k&&(d._defaults.onSelect=k)}return void 0===b?this._base_optionDatepicker(c,a):this._base_optionDatepicker(c,a,b)};e.timepicker=new m;e.timepicker.version="0.9.9"})(jQuery);