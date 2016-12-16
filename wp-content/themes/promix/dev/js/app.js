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
                return (this.atual() === "jogos");
            },
            isManga: function(){
                return (this.atual() === "manga");
            },
            isQuadrinhos: function(){
                return (this.atual() === "quadrinhos");
            },
            isIlustracoes: function(){
                return (this.atual() === "ilustracoes");
            },
            isJapones: function(){
                return (this.atual() === "japones");
            },
            isContato: function(){
                return (this.atual() === "contato");
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
                $('#contact-form').submit(function( event ) {
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
                var self = this;
                $('.pmx-media-figure').on('click', function(){
                    var element = $(this),
                        url = element.attr('data-url'),
                        size = element.attr('data-size') ? element.attr('data-size') : '640,480',
                        sizes = size.split(',');
                    self.open(url, sizes[0], sizes[1]);
                });
            },
            open: function(url, width, height){
                App.Modal.open(null, true);
                App.Iframe.create(url, width, height);
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