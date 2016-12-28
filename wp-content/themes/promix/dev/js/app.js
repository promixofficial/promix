(function($) {
    $.fn.goTo = function() {
        $('html, body').animate({
            scrollTop: $(this).offset().top + 'px'
        }, 'fast');
        return this;
    }


    var offset = 250;
    var duration = 300;
    $(window).scroll(function() {
        if ($(this).scrollTop() > offset) {
            $('.back-to-top').stop().fadeIn(duration);
        } else {
            $('.back-to-top').stop().fadeOut(duration);
        }
    });

})(jQuery);








(function(){

    var Device = {
        isMobile : (function (a) {return (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4)))})(navigator.userAgent || navigator.vendor || window.opera)
    }

    var App = {
        start: function(){
            View.Lists.startViewMode();
            if(this.Location.isJogos()){
                View.Games.startTriggers();
            }
            if(this.Location.isManga()){
                View.Manga.startTriggers();
            }
            if(this.Location.isIlustracoes() || this.Location.isQuadrinhos()){
                View.Illustrations.startTriggers();
            }
            if(this.Location.isContato()){
                View.Contact.startForm();
                View.Inputs.startLabels();
            }
            $('.pmx-list-view-toggle').on('click', function(){
                View.Lists.toggleListViewMode();
            })
            if(location.href.indexOf('localhost') !== -1){
                this.addScript('//localhost:35729/livereload.js?snipver=1');
            }
        },
        addScript: function(src,callback) {
            var s = document.createElement( 'script' );
            s.setAttribute( 'src', src );
            s.onload=callback;
            document.body.appendChild( s );
        },
        Email: {
            send: function(){
                var data = this.getData(),
                    self = this;

                $.ajax({
                    type: "POST",
                    url: "http://promixoficial.com/api/v1/email",
                    data: data,
                    dataType: "json",
                    success: function(resp){
                        if(resp.resultado=="sucesso"){
                            $('#msg-result').html('<span class="pmx-success" >'+resp.mensagem+'</span>');
                            self.clearData();
                        }else{
                            $('#msg-result').html('<span class="pmx-error">'+resp.mensagem+'</span>');
                        }
                    },
                    error: function(err){
                        $('#msg-result').html('<span class="pmx-error">Erro ao enviar email!</span>');
                    }
                });
            },
            getData: function(){
                var nome = $('#nome').val(),
                    email = $('#email').val(),
                    assunto = $('#assunto').val(),
                    mensagem = $('#mensagem').val();
                return {nome: nome, email: email, assunto: assunto, mensagem: mensagem};
            },
            clearData: function(){
                $('#nome').val("");
                $('#email').val("");
                $('#assunto').val("");
                $('#mensagem').val("");
            }
        },
        Iframe: {
            create: function(url, width, height){
                var html = '<iframe style="width: '+width+'px;height: '+height+
                    'px;border: 0px;overflow: hidden;" src="'+url+
                    '" class="pmx-modal-container" seamless="seamless" scrolling="no" ></iframe>';

                $('.pmx-modal-background').append(html);
            }
        },
        Location: {
            atual: function(){
                var path = location.pathname.replace(/.*\/(.*)\/$/, '$1');
                return path;
            },
            isHome: function(){
                var page = this.atual();
                return (page === "index" || pages === "");
            },
            isJogos: function(){
                return (this.atual().indexOf("jogos") !== -1);
            },
            isManga: function(){
                return (this.atual().indexOf("manga") !== -1);
            },
            isQuadrinhos: function(){
                return (this.atual().indexOf("quadrinhos") !== -1);
            },
            isIlustracoes: function(){
                return (this.atual().indexOf("ilustracoes") !== -1);
            },
            isJapones: function(){
                return (this.atual().indexOf("japones") !== -1);
            },
            isContato: function(){
                return (this.atual().indexOf("contato") !== -1);
            }
        },
        Modal: {
            contentScale: 1,
            clickPosition: [0,0],
            setClickPosition: function(event){

            },
            openAnimation: function(){

            },
            closeAnimation: function(){

            },
            open: function(callback,zoom){
                var self = this;
                this.create(zoom);
                this.contentScale = 1;
                $('.pmx-modal').fadeIn(500,function(){
                    $('body').addClass('pmx-modal-open');
                    $('.pmx-modal .icon-cancel').on('click', self.close);
                    if(zoom){
                        $('.pmx-modal .icon-zoom-in').on('click', self.zoomIn.bind(self));
                        $('.pmx-modal .icon-zoom-out').on('click', self.zoomOut.bind(self));
                    }
                    if(callback){
                        callback();
                    }
                });
            },
            zoomIn: function(){
                if(this.contentScale < 2){
                    this.contentScale += 0.1;
                    this.setZoom();
                }
            },
            zoomOut: function(){
                if(this.contentScale > 0.5){
                    this.contentScale -= 0.1;
                    this.setZoom();
                }
            },
            setZoom: function(){
                var transform = 'translate(-50%, -50%) scale('+this.contentScale+')';
                $('.pmx-modal-container').css({'transform': transform});
            },
            close: function(){
                $('.pmx-modal').fadeOut(500,function(){
                    $('body').removeClass('pmx-modal-open');
                    $('.pmx-modal').remove();
                });
            },
            code: function(zoom){
                var zoomCode = '<i class="icon icon-zoom-in"></i>'+
                    '<i class="icon icon-zoom-out"></i>';
                var html = '<div class="pmx-modal" >'+
                    '<div class="pmx-modal-background" >'+
                    '<i class="icon icon-cancel" ></i>'+
                    (zoom ? zoomCode : "") +
                    '<img class="loading" src="../wp-content/themes/promix/images/loading.gif" />'+
                    '</div>'+
                    '</div>';
                return html;
            },
            create: function(zoom){
                $( "body" ).append( this.code(zoom) );
            }
        }
    }

    var View = {
        Contact: {
            startForm: function(){
                $('#contact-form').on('submit', function( event ) {
                    event.preventDefault();
                    App.Email.send();
                });
            }
        },

        FullScreen: {
            startTrigger: function(trigger,target){
                var self = this,
                    target = document.getElementsByClassName(target)[0]
                $(trigger).on('click',function(){
                    self.goFullScreen(target)
                });
            },
            goFullScreen: function(target){
                if (target.requestFullscreen) {
                    target.requestFullscreen();
                } else if (target.webkitRequestFullscreen) {
                    target.webkitRequestFullscreen();
                } else if (target.mozRequestFullScreen) {
                    target.mozRequestFullScreen();
                } else if (target.msRequestFullscreen) {
                    target.msRequestFullscreen();
                }
            },
            leaveFullScreen: function(){
                // exit full-screen
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                }
            }
        },

        Games: {
            startTriggers: function(){
                /*var self = this;
                $('.pmx-post-preview').on('click', function(){
                    var element = $(this),
                        url = element.attr('data-url'),
                        size = element.attr('data-size') ? element.attr('data-size') : '640,480',
                        sizes = size.split(',');
                    self.open(url, sizes[0], sizes[1]);
                });
                $('.pmx-mobile-store-link').on('click', function(event){
                    var element = $(this),
                        url = element.attr('href');
                        event.stopPropagation();
                    self.openMobileStore(url);
                });*/
                if(App.Location.isJogos() && Device.isMobile){
                    $('.pmx-game-iframe-content').html('<img style="max-width: 500px;width: 100%;" class="pmx-game-iframe" src="'+$('.pmx-post-featured-img').attr('src')+'" />');
                }
            },
            open: function(url, width, height){
                App.Modal.open(null, true);
                App.Iframe.create(url, width, height);
            },
            openMobileStore: function(url){
                var win = window.open(url, '_blank');
                win.focus();
            }
        },

        Manga: {
            startTriggers: function(){
                var self = this;
                $('.pmx-media-figure').on('click', function(event){
                    var element = $(this),
                        url = element.attr('data-url'),
                        size = element.attr('data-size') ? element.attr('data-size') : '690,485',
                        sizes = size.split(',');
                    self.open(url, sizes[0], sizes[1]);
                });
            },
            open: function(url, width, height){
                App.Modal.open(null, true);
                App.Iframe.create(url, width, height);
            }
        },

        Illustrations: {
            startTriggers: function(){
                var imageList = $('.pmx-media-face'),
                    total = imageList.length;
                if(total > 0){
                    for(var i = 0; i < total; i++){
                        $('.pmx-media-trigger')[i].href = imageList[i].src;
                    }
                }
            }
        },

        Inputs : {
            startLabels: function(){
                $('.pmx-input').on('blur', function(){
                    if( !$(this).val() == "" ){
                        $(this).next().addClass('stay');
                    } else {
                        $(this).next().removeClass('stay');
                    }
                });
            }
        },

        Lists : {
            startViewMode: function(){
                if(localStorage['pmx-list-view-mode'] === 'list'){
                    this.setListViewMode();
                }else{
                    this.setGridViewMode();
                }
            },
            toggleListViewMode: function(){
                if(localStorage['pmx-list-view-mode'] === 'grid'){
                    this.setListViewMode();
                }else{
                    this.setGridViewMode();
                }
            },
            setListViewMode: function(){
                    localStorage['pmx-list-view-mode'] = 'list';
                    $('.pmx-post-list').addClass('list-view-mode').removeClass('grid-view-mode');
                    $('.pmx-list-view-toggle').addClass('grid-view-mode').removeClass('list-view-mode').attr('title', 'Posts em Grade');
            },
            setGridViewMode: function(){
                    localStorage['pmx-list-view-mode'] = 'grid';
                    $('.pmx-post-list').addClass('grid-view-mode').removeClass('list-view-mode');
                    $('.pmx-list-view-toggle').addClass('list-view-mode').removeClass('grid-view-mode').attr('title', 'Posts em Lista');
            }
        }
    };


    $( document ).ready(function() {
        App.start();
    });
    window.APP = App;
    window.VIEW = View;
})();