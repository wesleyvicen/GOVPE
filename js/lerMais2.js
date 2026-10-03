$(function () {
    $('.tgl2').each(function () {
        var $panel = $(this).hide();
        var $button = $('<button type="button" class="btn btn-primary" aria-expanded="false">Veja Mais »</button>');
        $panel.before($button);
        $button.on('click', function () {
            var expanded = $button.attr('aria-expanded') === 'true';
            $button.attr('aria-expanded', String(!expanded)).text(expanded ? 'Veja Mais »' : 'Veja Menos «');
            $panel.stop(true, true).slideToggle('slow');
        });
    });
});
