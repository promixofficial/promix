!function(t){function e(s){if(o[s])return o[s].exports;var n=o[s]={exports:{},id:s,loaded:!1};return t[s].call(n.exports,n,n.exports,e),n.loaded=!0,n.exports}var o={};return e.m=t,e.c=o,e.p="",e(0)}([function(t,e){"use strict";!function(t){t.fn.goTo=function(){return t("html, body").animate({scrollTop:t(this).offset().top+"px"},"fast"),this};var e=250,o=300;t(window).scroll(function(){t(this).scrollTop()>e?t(".back-to-top").stop().fadeIn(o):t(".back-to-top").stop().fadeOut(o)})}(jQuery),function(){var t={start:function(){e.Lists.startViewMode(),this.Location.isJogos()&&e.Games.startTriggers(),this.Location.isManga()&&e.Manga.startTriggers(),(this.Location.isIlustracoes()||this.Location.isQuadrinhos())&&e.Illustrations.startTriggers(),this.Location.isContato()&&(e.Contact.startForm(),e.Inputs.startLabels()),$(".pmx-list-view-toggle").on("click",function(){e.Lists.toggleListViewMode()})},Email:{send:function(){var t=this.getData(),e=this;$.ajax({type:"POST",url:"http://promixoficial.com/api/v1/email",data:t,dataType:"json",success:function(t){"sucesso"==t.resultado?($("#msg-result").html('<span class="pmx-success" >'+t.mensagem+"</span>"),e.clearData()):$("#msg-result").html('<span class="pmx-error">'+t.mensagem+"</span>")},error:function(t){$("#msg-result").html('<span class="pmx-error">Erro ao enviar email!</span>')}})},getData:function(){var t=$("#nome").val(),e=$("#email").val(),o=$("#assunto").val(),s=$("#mensagem").val();return{nome:t,email:e,assunto:o,mensagem:s}},clearData:function(){$("#nome").val(""),$("#email").val(""),$("#assunto").val(""),$("#mensagem").val("")}},Iframe:{create:function(t,e,o){var s='<iframe style="width: '+e+"px;height: "+o+'px;border: 0px;overflow: hidden;" src="'+t+'" class="pmx-modal-container" seamless="seamless" scrolling="no" ></iframe>';$(".pmx-modal-background").append(s)}},Location:{atual:function(){var t=location.pathname.replace(/.*\/(.*)\/$/,"$1");return t},isHome:function(){var t=this.atual();return"index"===t||""===pages},isJogos:function(){return"jogos"===this.atual()},isManga:function(){return"manga"===this.atual()},isQuadrinhos:function(){return"quadrinhos"===this.atual()},isIlustracoes:function(){return"ilustracoes"===this.atual()},isJapones:function(){return"japones"===this.atual()},isContato:function(){return"contato"===this.atual()}},Modal:{contentScale:1,clickPosition:[0,0],setClickPosition:function(t){},openAnimation:function(){},closeAnimation:function(){},open:function(t,e){var o=this;this.create(e),this.contentScale=1,$(".pmx-modal").fadeIn(500,function(){$("body").addClass("pmx-modal-open"),$(".pmx-modal .icon-cancel").on("click",o.close),e&&($(".pmx-modal .icon-zoom-in").on("click",o.zoomIn.bind(o)),$(".pmx-modal .icon-zoom-out").on("click",o.zoomOut.bind(o))),t&&t()})},zoomIn:function(){this.contentScale<2&&(this.contentScale+=.1,this.setZoom())},zoomOut:function(){this.contentScale>.5&&(this.contentScale-=.1,this.setZoom())},setZoom:function(){var t="translate(-50%, -50%) scale("+this.contentScale+")";$(".pmx-modal-container").css({transform:t})},close:function(){$(".pmx-modal").fadeOut(500,function(){$("body").removeClass("pmx-modal-open"),$(".pmx-modal").remove()})},code:function(t){var e='<i class="icon icon-zoom-in"></i><i class="icon icon-zoom-out"></i>',o='<div class="pmx-modal" ><div class="pmx-modal-background" ><i class="icon icon-cancel" ></i>'+(t?e:"")+'<img class="loading" src="../wp-content/themes/promix/images/loading.gif" /></div></div>';return o},create:function(t){$("body").append(this.code(t))}}},e={Contact:{startForm:function(){$("#contact-form").submit(function(e){e.preventDefault(),t.Email.send()})}},FullScreen:{startTrigger:function(t,e){var o=this,e=document.getElementsByClassName(e)[0];$(t).on("click",function(){o.goFullScreen(e)})},goFullScreen:function(t){t.requestFullscreen?t.requestFullscreen():t.webkitRequestFullscreen?t.webkitRequestFullscreen():t.mozRequestFullScreen?t.mozRequestFullScreen():t.msRequestFullscreen&&t.msRequestFullscreen()},leaveFullScreen:function(){document.exitFullscreen?document.exitFullscreen():document.webkitExitFullscreen?document.webkitExitFullscreen():document.mozCancelFullScreen?document.mozCancelFullScreen():document.msExitFullscreen&&document.msExitFullscreen()}},Games:{startTriggers:function(){var t=this;$(".pmx-media-figure").on("click",function(){var e=$(this),o=e.attr("data-url"),s=e.attr("data-size")?e.attr("data-size"):"640,480",n=s.split(",");t.open(o,n[0],n[1])})},open:function(e,o,s){t.Modal.open(null,!0),t.Iframe.create(e,o,s)}},Manga:{startTriggers:function(){var t=this;$(".pmx-media-figure").on("click",function(e){var o=$(this),s=o.attr("data-url"),n=o.attr("data-size")?o.attr("data-size"):"690,485",i=n.split(",");t.open(s,i[0],i[1])})},open:function(e,o,s){t.Modal.open(null,!0),t.Iframe.create(e,o,s)}},Illustrations:{startTriggers:function(){var t=$(".pmx-media-face"),e=t.length;if(e>0)for(var o=0;o<e;o++)$(".pmx-media-trigger")[o].href=t[o].src}},Inputs:{startLabels:function(){$(".pmx-input").on("blur",function(){""==!$(this).val()?$(this).next().addClass("stay"):$(this).next().removeClass("stay")})}},Lists:{startViewMode:function(){"list"===localStorage["pmx-list-view-mode"]?this.setListViewMode():this.setGridViewMode()},toggleListViewMode:function(){"grid"===localStorage["pmx-list-view-mode"]?this.setListViewMode():this.setGridViewMode()},setListViewMode:function(){localStorage["pmx-list-view-mode"]="list",$(".pmx-post-list").addClass("list-view-mode").removeClass("grid-view-mode"),$(".pmx-list-view-toggle").addClass("grid-view-mode").removeClass("list-view-mode").attr("title","Posts em Grade")},setGridViewMode:function(){localStorage["pmx-list-view-mode"]="grid",$(".pmx-post-list").addClass("grid-view-mode").removeClass("list-view-mode"),$(".pmx-list-view-toggle").addClass("list-view-mode").removeClass("grid-view-mode").attr("title","Posts em Lista")}}};$(document).ready(function(){t.start()}),window.APP=t,window.VIEW=e}()}]);