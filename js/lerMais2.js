jQuery.fn.toggleText = function(a, b) {
    return this.each(function() {
        var $this = $(this);
        var text = $this.html();

        // Verifica se o texto é válido e contém um dos valores a ou b
        if (text && (text.includes(a) || text.includes(b))) {
            $this.html(text.replace(new RegExp("(" + a + "|" + b + ")"), function(x) {
                return (x === a) ? b : a;
            }));
        }
    });
};

$(document).ready(function() {
    $('.tgl2').before('<span style="cursor: pointer; color: white;">Veja Mais »</span>');

    $('.tgl2').css('display', 'none');

    // Use $(document) para garantir que o evento seja vinculado corretamente
    $(document).on('click', 'span', function() {
        var parent = $(this).parent('#box-toggle2'); // Garante que está no contêiner correto
        
        if (parent.length > 0) {
            $(this).next('.tgl2').slideToggle('slow')
                .siblings('.tgl2:visible').slideToggle('fast');

            $(this).toggleText('Veja Mais »', 'Veja Menos «');
        }
    });
});
