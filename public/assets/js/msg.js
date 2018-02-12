/*! Copyright 2011, Ben Lin (http://dreamerslab.com/)
* Licensed under the MIT License (LICENSE.txt).
*
* Version: 1.1.1
*
* Requires: jQuery 1.2.6+
*/
;(function($,window){var get_win_size=function(){if(window.innerWidth!=undefined)return[window.innerWidth,window.innerHeight];else{var B=document.body;var D=document.documentElement;return[Math.max(D.clientWidth,B.clientWidth),Math.max(D.clientHeight,B.clientHeight)]}};$.fn.center=function(opt){var $w=$(window);var scrollTop=$w.scrollTop();return this.each(function(){var $this=$(this);var configs=$.extend({against:"window",top:false,topPercentage:0.5,resize:true},opt);var centerize=function(){var against=configs.against;var against_w_n_h;var $against;if(against==="window")against_w_n_h=get_win_size();else if(against==="parent"){$against=$this.parent();against_w_n_h=[$against.width(),$against.height()];scrollTop=0}else{$against=$this.parents(against);against_w_n_h=[$against.width(),$against.height()];scrollTop=0}var x=(against_w_n_h[0]-$this.outerWidth())*0.5;var y=(against_w_n_h[1]-$this.outerHeight())*configs.topPercentage+scrollTop;if(configs.top)y=configs.top+scrollTop;$this.css({"left":x,"top":y})};centerize();if(configs.resize===true)$w.resize(centerize)})}})(jQuery,window);

/* Copyright 2011, Ben Lin (http://dreamerslab.com/)
* Licensed under the MIT License (LICENSE.txt).
*
* Version: 1.0.7
*
* Requires: 
* jQuery 1.3.0+, 
* jQuery Center plugin 1.0.0+ https://github.com/dreamerslab/jquery.center
*/
;(function(d,e){var a={},c=0,f,b=[function(){}];d.msg=function(){var g,k,j,l,m,i,h;j=[].shift.call(arguments);l={}.toString.call(j);m=d.extend({afterBlock:function(){},autoUnblock:true,center:{topPercentage:0.4},css:{},clickUnblock:true,content:"Please wait...",fadeIn:200,fadeOut:300,bgPath:"",klass:"black-on-white",method:"appendTo",target:"body",timeOut:2400,z:1000},a);l==="[object Object]"&&d.extend(m,j);i={unblock:function(){g=d("#jquery-msg-overlay").fadeOut(m.fadeOut,function(){b[m.msgID](g);g.remove();});clearTimeout(f);}};h={unblock:function(o,n){var p=o===undefined?0:o;m.msgID=n===undefined?c:n;setTimeout(function(){i.unblock();},p);},replace:function(n){if({}.toString.call(n)!=="[object String]"){throw"$.msg('replace'); error: second argument has to be a string";}d("#jquery-msg-content").empty().html(n).center(m.center);},overwriteGlobal:function(o,n){a[o]=n;}};c--;m.msgID=m.msgID===undefined?c:m.msgID;b[m.msgID]=m.beforeUnblock===undefined?function(){}:m.beforeUnblock;if(l==="[object String]"){h[j].apply(h,arguments);}else{g=d('<div id="jquery-msg-overlay" class="'+m.klass+'" style="position:absolute; z-index:'+m.z+"; top:0px; right:0px; left:0px; height:"+d(e).height()+'px;"><img src="'+m.bgPath+'blank.gif" id="jquery-msg-bg" style="width: 100%; height: 100%; top: 0px; left: 0px;"/><div id="jquery-msg-content" class="jquery-msg-content" style="position:absolute;">'+m.content+"</div></div>");g[m.method](m.target);k=d("#jquery-msg-content").center(m.center).css(m.css).hide();g.hide().fadeIn(m.fadeIn,function(){k.fadeIn("fast").children().andSelf().bind("click",function(n){n.stopPropagation();});m.afterBlock.call(h,g);m.clickUnblock&&g.bind("click",function(n){n.stopPropagation();i.unblock();});if(m.autoUnblock){f=setTimeout(i.unblock,m.timeOut);}});}return this;};})(jQuery,document);