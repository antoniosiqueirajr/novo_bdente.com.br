function startInteractiveMap(carousel){
    interactiveMapSetPositions();
    interactiveMapSetActiveTrigger(carousel);
    interactiveMapSetHoverEffect();
}

function interactiveMapSetHoverEffect(){
    $('#mapa-clicavel area').each(function(){
        const estado = $(this).attr('title').toLowerCase();
        $(this).hover(function(){
            $('#mapa-'+estado).addClass('hover');
        },
        function(){
            $('#mapa-'+estado).removeClass('hover');
        })
    });
}

function interactiveMapSetPositions(){
    $('#mapa-clicavel img.mapa-estado').each(function(){
        const pageWidth = $(window).width();
        
        const partes = Math.trunc((pageWidth - 40) / 107);
        const prop = 0.125;
        const ajuste = prop * (partes > 8 ? 8 : partes);
        const width = $(this).outerWidth() * ajuste;
        const height = $(this).outerHeight() * ajuste;
        
        const top = $(this).position().top * ajuste;
        const left = $(this).position().left * ajuste;
        $(this).css({
            left: left - (width/2),
            top: top - (height/2),
            width,
            height
        });
    });
}

function interactiveMapSetActiveTrigger(carousel){
    interactiveMapSetActive(carousel);
    carousel.on('changed.owl.carousel', function(event) {
        setTimeout(function (){
            interactiveMapSetActive(carousel);
        },200);
    });
}
function interactiveMapSetActive(carousel){
    const uf = carousel.find('.owl-item.active .item').attr('data-estado');
    $('#mapa-clicavel img#mapa-'+uf)
            .addClass('active')
            .siblings('img')
            .removeClass('active');
}

function selecionar_clinica(estado){
    if(typeof estado !== 'string'){
        estado  =   estado.find('text').html();
    }
    estado = estado.toLowerCase();
    const item = $('.clinicas .owl-carousel .item[data-estado='+estado+']').attr('data-index-mapa');
    $('.clinicas .owl-carousel').trigger('to.owl.carousel', item-1);
}