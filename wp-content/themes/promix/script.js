!function(t){function e(a){if(n[a])return n[a].exports;var o=n[a]={exports:{},id:a,loaded:!1};return t[a].call(o.exports,o,o.exports,e),o.loaded=!0,o.exports}var n={};return e.m=t,e.c=n,e.p="",e(0)}([function(t,e){"use strict";!function(t){t.fn.goTo=function(){return t("html, body").animate({scrollTop:t(this).offset().top+"px"},"fast"),this}}(jQuery),function(){var t={start:function(){this.Location.isJogos()&&e.Games.startTriggers(),this.Location.isManga()&&e.Manga.startTriggers(),(this.Location.isIlustracoes()||this.Location.isQuadrinhos())&&e.Illustrations.startTriggers(),this.Location.isContato()&&(e.Contact.startForm(),e.Inputs.startLabels()),e.Button.effectStart(),e.MainMenu.startTrigger(),e.Window.onResize(),e.Window.startFeaturedElement()},Email:{send:function(){var t=this.getData(),e=this;$.ajax({type:"POST",url:"http://promixoficial.com/api/v1/email",data:t,dataType:"json",success:function(t){"sucesso"==t.resultado?($("#msg-result").html('<span class="pmx-success" >'+t.mensagem+"</span>"),e.clearData()):$("#msg-result").html('<span class="pmx-error">'+t.mensagem+"</span>")},error:function(t){$("#msg-result").html('<span class="pmx-error">Erro ao enviar email!</span>')}})},getData:function(){var t=$("#nome").val(),e=$("#email").val(),n=$("#assunto").val(),a=$("#mensagem").val();return{nome:t,email:e,assunto:n,mensagem:a}},clearData:function(){$("#nome").val(""),$("#email").val(""),$("#assunto").val(""),$("#mensagem").val("")}},Iframe:{create:function(t,e,n){var a='<iframe style="width: '+e+"px;height: "+n+'px;border: 0px;overflow: hidden;" src="'+t+'" class="pmx-modal-container" seamless="seamless" scrolling="no" ></iframe>';$(".pmx-modal-background").append(a)}},Location:{atual:function(){var t=location.pathname.replace(/.*\/(.*)\/$/,"$1");return t},isHome:function(){var t=this.atual();return"index"===t||""===pages},isJogos:function(){return"jogos"===this.atual()},isManga:function(){return"manga"===this.atual()},isQuadrinhos:function(){return"quadrinhos"===this.atual()},isIlustracoes:function(){return"ilustracoes"===this.atual()},isJapones:function(){return"japones"===this.atual()},isContato:function(){return"contato"===this.atual()}},Modal:{contentScale:1,clickPosition:[0,0],setClickPosition:function(t){},openAnimation:function(){},closeAnimation:function(){},open:function(t,e){var n=this;this.create(e),this.contentScale=1,$(".pmx-modal").fadeIn(500,function(){$("body").addClass("pmx-modal-open"),$(".pmx-modal .icon-cancel").on("click",n.close),e&&($(".pmx-modal .icon-zoom-in").on("click",n.zoomIn.bind(n)),$(".pmx-modal .icon-zoom-out").on("click",n.zoomOut.bind(n))),t&&t()})},zoomIn:function(){this.contentScale<2&&(this.contentScale+=.1,this.setZoom())},zoomOut:function(){this.contentScale>.5&&(this.contentScale-=.1,this.setZoom())},setZoom:function(){var t="translate(-50%, -50%) scale("+this.contentScale+")";$(".pmx-modal-container").css({transform:t})},close:function(){$(".pmx-modal").fadeOut(500,function(){$("body").removeClass("pmx-modal-open"),$(".pmx-modal").remove()})},code:function(t){var e='<i class="icon icon-zoom-in"></i><i class="icon icon-zoom-out"></i>',n='<div class="pmx-modal" ><div class="pmx-modal-background" ><i class="icon icon-cancel" ></i>'+(t?e:"")+'<img class="loading" src="../wp-content/themes/promix/images/loading.gif" /></div></div>';return n},create:function(t){$("body").append(this.code(t))}}},e={Button:{effectStart:function(){$(".pmx-material-button .pmx-material-label").click(function(t){var e,n,a,o,s;e=$(this),0==e.find(".circle").length&&e.prepend("<span class='circle'></span>"),n=e.find(".circle"),n.removeClass("animate"),n.height()||n.width()||(a=Math.max(e.outerWidth(),e.outerHeight()),n.css({height:a,width:a})),o=t.pageX-e.offset().left-n.width()/2,s=t.pageY-e.offset().top-n.height()/2,n.css({top:s+"px",left:o+"px"}).addClass("animate")})}},Contact:{startForm:function(){$("#contact-form").submit(function(e){e.preventDefault(),t.Email.send()})}},FullScreen:{startTrigger:function(t,e){var n=this,e=document.getElementsByClassName(e)[0];$(t).on("click",function(){n.goFullScreen(e)})},goFullScreen:function(t){t.requestFullscreen?t.requestFullscreen():t.webkitRequestFullscreen?t.webkitRequestFullscreen():t.mozRequestFullScreen?t.mozRequestFullScreen():t.msRequestFullscreen&&t.msRequestFullscreen()},leaveFullScreen:function(){document.exitFullscreen?document.exitFullscreen():document.webkitExitFullscreen?document.webkitExitFullscreen():document.mozCancelFullScreen?document.mozCancelFullScreen():document.msExitFullscreen&&document.msExitFullscreen()}},Games:{startTriggers:function(){var t=this;$(".pmx-media-figure").on("click",function(){var e=$(this),n=e.attr("data-url"),a=e.attr("data-size")?e.attr("data-size"):"640,480",o=a.split(",");t.open(n,o[0],o[1])})},open:function(e,n,a){t.Modal.open(null,!0),t.Iframe.create(e,n,a)}},Manga:{startTriggers:function(){var t=this;$(".pmx-media-figure").on("click",function(e){var n=$(this),a=n.attr("data-url"),o=n.attr("data-size")?n.attr("data-size"):"690,485",s=o.split(",");t.open(a,s[0],s[1])})},open:function(e,n,a){t.Modal.open(null,!0),t.Iframe.create(e,n,a)}},Illustrations:{startTriggers:function(){var t=$(".pmx-media-face"),e=t.length;if(e>0)for(var n=0;n<e;n++)$(".pmx-media-trigger")[n].href=t[n].src}},Inputs:{startLabels:function(){$(".pmx-input").on("blur",function(){""==!$(this).val()?$(this).next().addClass("stay"):$(this).next().removeClass("stay")})}},MainMenu:{selector:".main-menu-trigger",startTrigger:function(){$(this.selector).on("click",function(){$(this).toggleClass("pmx-active")})},open:function(){$(this.selector).addClass("pmx-active")},close:function(){$(this.selector).removeClass("pmx-active")}},Window:{onResize:function(){$(window).on("resize",function(){e.MainMenu.close()})},featuredElement:function(t){var e=$(t);e.length&&(e.goTo().css({"background-color":"rgba(252, 96, 0, 0.30)"}),setTimeout(function(){e.css({"background-color":""})},1e3))},getParameterByName:function(t){t=t.replace(/[\[]/,"\\[").replace(/[\]]/,"\\]");var e=new RegExp("[\\?&]"+t+"=([^&#]*)"),n=e.exec(location.search);return null===n?"":decodeURIComponent(n[1].replace(/\+/g," "))},startFeaturedElement:function(){var t=this.getParameterByName("pmx");t&&this.featuredElement("#"+t)}}};$(document).ready(function(){t.start()}),window.APP=t,window.VIEW=e}()}]);
//# sourceMappingURL=script.js.map