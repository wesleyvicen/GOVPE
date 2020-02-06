jQuery.fn.toggleText = function(a,b) {

    return   this.html(this.html().replace(new RegExp("("+a+"|"+b+")"),function(x){return(x==a)?b:a;}));

}

$(document).ready(function(){

    $('.tgl').before('<span style = "cursor: pointer"><font color=white>Veja Mais »</font></span>');

    $('.tgl').css('display', 'none')

    $('span', '#box-toggle').click(function() {

        $(this).next().slideToggle('slow')

            .siblings('.tgl:visible').slideToggle('fast');

// aqui começa o funcionamento do plugin

        $(this).toggleText('Veja Mais','Veja Menos')

            .siblings('span').next('.tgl:visible').prev()

            .toggleText('more »','« less')

    });

})