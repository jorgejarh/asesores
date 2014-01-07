// jQuery Mask Plugin v1.3.2
// github.com/igorescobar/jQuery-Mask-Plugin
(function(c){var w=function(a,d,e){var f=this;a=c(a);var l;d="function"==typeof d?d(a.val(),void 0,a,e):d;f.init=function(){e=e||{};f.byPassKeys=[8,9,16,36,37,38,39,40,46,91];f.translation={0:{pattern:/\d/},9:{pattern:/\d/,optional:!0},"#":{pattern:/\d/,recursive:!0},A:{pattern:/[a-zA-Z0-9]/},S:{pattern:/[a-zA-Z]/}};f.translation=c.extend({},f.translation,e.translation);f=c.extend(!0,{},f,e);a.each(function(){!1!==e.maxlength&&a.attr("maxlength",d.length);a.attr("autocomplete","off");g.destroyEvents();
g.events();g.val(g.getMasked())})};var g={events:function(){a.on("keydown.mask",function(){l=g.val()});a.on("keyup.mask",g.behaviour);a.on("paste.mask",function(){setTimeout(function(){a.keydown().keyup()},100)})},destroyEvents:function(){a.off("keydown.mask").off("keyup.mask").off("paste.mask")},val:function(v){var d="input"===a.get(0).tagName.toLowerCase();return 0<arguments.length?d?a.val(v):a.text(v):d?a.val():a.text()},behaviour:function(a){a=a||window.event;if(-1===c.inArray(a.keyCode||a.which,
f.byPassKeys))return g.val(g.getMasked()),g.callbacks(a)},getMasked:function(){var a=[],c=g.val(),b=0,q=d.length,h=0,l=c.length,k=1,r="push",m=-1,n,s;e.reverse?(r="unshift",k=-1,n=0,b=q-1,h=l-1,s=function(){return-1<b&&-1<h}):(n=q-1,s=function(){return b<q&&h<l});for(;s();){var t=d.charAt(b),u=c.charAt(h),p=f.translation[t];p?(u.match(p.pattern)?(a[r](u),p.recursive&&(-1==m?m=b:b==n&&(b=m-k),n==m&&(b-=k)),b+=k):p.optional&&(b+=k,h-=k),h+=k):(a[r](t),u==t&&(h+=k),b+=k)}return a.join("")},callbacks:function(f){var c=
g.val(),b=g.val()!==l;if(!0===b&&"function"==typeof e.onChange)e.onChange(c,f,a,e);if(!0===b&&"function"==typeof e.onKeyPress)e.onKeyPress(c,f,a,e);if("function"===typeof e.onComplete&&c.length===d.length)e.onComplete(c,f,a,e)}};f.remove=function(){g.destroyEvents();g.val(f.getCleanVal()).removeAttr("maxlength")};f.getCleanVal=function(){for(var a=[],c=g.val(),b=0,e=d.length;b<e;b++)f.translation[d.charAt(b)]&&a.push(c.charAt(b));return a.join("")};f.init()};c.fn.mask=function(a,d){return this.each(function(){c(this).data("mask",
new w(this,a,d))})};c.fn.unmask=function(){return this.each(function(){try{c(this).data("mask").remove()}catch(a){}})};c("input[data-mask]").each(function(){var a=c(this),d={};"true"===a.attr("data-mask-reverse")&&(d.reverse=!0);"false"===a.attr("data-mask-maxlength")&&(d.maxlength=!1);a.mask(a.attr("data-mask"),d)})})(window.jQuery||window.Zepto);

/*-----------------------------------*/

$(function(){
	
	//$('#datepicker').datepicker({inline: true});
	$('#markItUp').markItUp(myHtmlSettings);
	initMenu();
	$('.info_div').click(function() {$(this).fadeOut('slow')});
	$("#dialog").dialog({ buttons: { "Ok": function() { $(this).dialog("close"); } } });
	$('#tabs').tabs();

	//$("#tabledata").resizable({ maxWidth: 940 });
	//$.plot($("#placeholder"), [ [[0, 0], [1, 10]]], { yaxis: { max: 10 }, grid: { color: "#000", borderWidth:1} });
	});
	
	
myHtmlSettings = {
    nameSpace:       "html", // Useful to prevent multi-instances CSS conflict
    onShiftEnter:    {keepDefault:false, replaceWith:'<br />\n'},
    onCtrlEnter:     {keepDefault:false, openWith:'\n<p>', closeWith:'</p>\n'},
    onTab:           {keepDefault:false, openWith:'     '},
    markupSet:  [
        {name:'Heading 1', key:'1', openWith:'<h1(!( class="[![Class]!]")!)>', closeWith:'</h1>', placeHolder:'Your title here...' },
        {name:'Heading 2', key:'2', openWith:'<h2(!( class="[![Class]!]")!)>', closeWith:'</h2>', placeHolder:'Your title here...' },
        {name:'Heading 3', key:'3', openWith:'<h3(!( class="[![Class]!]")!)>', closeWith:'</h3>', placeHolder:'Your title here...' },
        {name:'Heading 4', key:'4', openWith:'<h4(!( class="[![Class]!]")!)>', closeWith:'</h4>', placeHolder:'Your title here...' },
        {name:'Heading 5', key:'5', openWith:'<h5(!( class="[![Class]!]")!)>', closeWith:'</h5>', placeHolder:'Your title here...' },
        {name:'Heading 6', key:'6', openWith:'<h6(!( class="[![Class]!]")!)>', closeWith:'</h6>', placeHolder:'Your title here...' },
        {name:'Preview', call:'preview', className:'preview' }
    ]
}		



 function initMenu() {
  $('#menu ul').hide();
  $('#menu ul:first').show();
  $('#menu li a').click(
  function() {
  var checkElement = $(this).next();
  if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
  return false;
  }
  if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
  $('#menu ul:visible').slideUp('normal');
  checkElement.slideDown('normal');
  return false;
  }
  }
  );
  }				


function poner_malo_texto(selector)
{
	selector.css('border','1px solid red');
}

function poner_bueno_texto(selector)
{
	selector.css('border','1px solid green');
}


function validar_form(selector_form)
{
	valido=0;
	
	$(selector_form+' .requerido').each(function(index,element){
			
			if($(this).val()=="")
			{
				poner_malo_texto($(this));
				$('#error').html('Campo Requerido');
				valido=1;
			}else{
	
				poner_bueno_texto($(this));
			}
			
		});
	
	if(valido==1)
	{
		return false;
	}else{
		return true;
		}
}


// jQuery Mask Plugin v1.5.2
// github.com/igorescobar/jQuery-Mask-Plugin
(function(g){var y=function(a,h,d){var k=this,x;a=g(a);h="function"===typeof h?h(a.val(),void 0,a,d):h;k.init=function(){d=d||{};k.byPassKeys=[9,16,17,18,36,37,38,39,40,91];k.translation={0:{pattern:/\d/},9:{pattern:/\d/,optional:!0},"#":{pattern:/\d/,recursive:!0},A:{pattern:/[a-zA-Z0-9]/},S:{pattern:/[a-zA-Z]/}};k.translation=g.extend({},k.translation,d.translation);k=g.extend(!0,{},k,d);a.each(function(){!1!==d.maxlength&&a.attr("maxlength",h.length);a.attr("autocomplete","off");c.destroyEvents();
c.events();c.val(c.getMasked())})};var c={getCaret:function(){var e;e=0;var b=a.get(0),c=document.selection,f=b.selectionStart;if(c&&-1===navigator.appVersion.indexOf("MSIE 10"))b.focus(),e=c.createRange(),e.moveStart("character",-b.value.length),e=e.text.length;else if(f||"0"===f)e=f;return e},setCaret:function(e){var b;b=a.get(0);b.setSelectionRange?(b.focus(),b.setSelectionRange(e,e)):b.createTextRange&&(b=b.createTextRange(),b.collapse(!0),b.moveEnd("character",e),b.moveStart("character",e),b.select())},
events:function(){a.on("keydown.mask",function(){x=c.val()});a.on("keyup.mask",c.behaviour);a.on("paste.mask",function(){setTimeout(function(){a.keydown().keyup()},100)})},destroyEvents:function(){a.off("keydown.mask keyup.mask paste.mask")},val:function(e){var b="input"===a.get(0).tagName.toLowerCase();return 0<arguments.length?b?a.val(e):a.text(e):b?a.val():a.text()},behaviour:function(a){a=a||window.event;if(-1===g.inArray(a.keyCode||a.which,k.byPassKeys)){var b,d=c.getCaret();d<c.val().length&&
(b=!0);c.val(c.getMasked());b&&c.setCaret(d);return c.callbacks(a)}},getMasked:function(a){var b=[],g=c.val(),f=0,p=h.length,l=0,s=g.length,m=1,t="push",q=-1,n,u;d.reverse?(t="unshift",m=-1,n=0,f=p-1,l=s-1,u=function(){return-1<f&&-1<l}):(n=p-1,u=function(){return f<p&&l<s});for(;u();){var v=h.charAt(f),w=g.charAt(l),r=k.translation[v];if(r)w.match(r.pattern)?(b[t](w),r.recursive&&(-1===q?q=f:f===n&&(f=q-m),n===q&&(f-=m)),f+=m):r.optional&&(f+=m,l-=m),l+=m;else{if(!a)b[t](v);w===v&&(l+=m);f+=m}}a=
h.charAt(n);p!==s+1||k.translation[a]||b.push(a);return b.join("")},callbacks:function(e){var b=c.val(),g=c.val()!==x;if(!0===g&&"function"===typeof d.onChange)d.onChange(b,e,a,d);if(!0===g&&"function"===typeof d.onKeyPress)d.onKeyPress(b,e,a,d);if("function"===typeof d.onComplete&&b.length===h.length)d.onComplete(b,e,a,d)}};k.remove=function(){c.destroyEvents();c.val(k.getCleanVal()).removeAttr("maxlength")};k.getCleanVal=function(){return c.getMasked(!0)};k.init()};g.fn.mask=function(a,h){return this.each(function(){g(this).data("mask",
new y(this,a,h))})};g.fn.unmask=function(){return this.each(function(){try{g(this).data("mask").remove()}catch(a){}})};g.fn.cleanVal=function(){return g(this).data("mask").getCleanVal()};g("input[data-mask]").each(function(){var a=g(this),h={};"true"===a.attr("data-mask-reverse")&&(h.reverse=!0);"false"===a.attr("data-mask-maxlength")&&(h.maxlength=!1);a.mask(a.attr("data-mask"),h)})})(window.jQuery||window.Zepto);