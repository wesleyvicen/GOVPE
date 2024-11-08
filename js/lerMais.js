$(document).ready(function() {
    $('.tgl').before('<span style="cursor: pointer; color: white;">Veja Mais »</span>');

    $('.tgl').css('display', 'none');

    // Use $(document) para garantir que o evento funcione mesmo em elementos dinâmicos
    $(document).on('click', 'span', function() {
        var parent = $(this).parent('#box-toggle'); // Garante que está no contêiner correto

        if (parent.length > 0) {
            $(this).next('.tgl').slideToggle('slow')
                .siblings('.tgl:visible').slideToggle('fast');

            $(this).toggleText('Veja Mais »', 'Veja Menos «');
        }
    });
});
