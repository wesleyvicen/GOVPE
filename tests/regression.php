<?php
require __DIR__ . '/../app/bootstrap.php';
set_error_handler(function (int $severity, string $message, string $file, int $line): never {
    throw new ErrorException($message, 0, $severity, $file, $line);
});
function check(bool $condition, string $message): void {
    if (!$condition) {
        throw new RuntimeException($message);
    }
}
check(h('<script>"&') === '&lt;script&gt;&quot;&amp;', 'Escape de HTML');
check(h('Vicência') === 'Vicência', 'UTF-8 preservado');
check(h(null) === '', 'Campos nulos');
check(image_url('https://govpe.com.br/img/bg1.jpeg') === '/img/bg1.jpeg', 'Imagem local');
check(image_url('https://i.imgur.com/2AO7EXT.png') === '/img/gov/imported/2AO7EXT.png', 'Cópia local da miniatura externa');
check(image_url('https://i.imgur.com/fN64xfI.png') === '/img/gov/imported/fN64xfI.png', 'Cópia local da imagem ampliada');
check(image_url('javascript:alert(1)') === '', 'Protocolo inválido');
check(image_url('https://i.imgur.com/example.png') === 'https://i.imgur.com/example.png', 'Imagem externa');
$_POST = ['array' => ['bad'], 'text' => ' teste '];
check(post_text('array') === '' && post_text('text') === 'teste', 'Entrada inesperada');
check(strlen(csrf_token()) === 64 && csrf_token() === csrf_token(), 'Token de sessão');
foreach ([0, 1, 6, 7, 12, 13] as $count) {
    $sonhos = [];
    $erroSonhos = false;
    for ($i = 1; $i <= $count; $i++) {
        $sonhos[] = ['titulo' => "Entrega $i <script>", 'endereco' => 'Vicência', 'fullsize' => '/img/bg1.jpeg', 'thumbnails' => '/img/bg1.jpeg'];
    }
    ob_start();
    require __DIR__ . '/../paginas/sonhos.php';
    $html = ob_get_clean();
    check(substr_count($html, 'class="gov-box"') === $count, "Total da galeria: $count");
    check(substr_count($html, '<div') === substr_count($html, '</div>'), "Estrutura da galeria: $count");
    check(!str_contains($html, '<script>'), "Escape da galeria: $count");
    check(str_contains($html, 'class="tgl"') === ($count > 6), "Expandir somente quando necessário: $count");
}
$sonhos = [];
$erroSonhos = true;
ob_start();
require __DIR__ . '/../paginas/sonhos.php';
$html = ob_get_clean();
check(str_contains($html, 'temporariamente indisponíveis'), 'Estado de indisponibilidade');
echo "OK: UTF-8, escape, entradas, CSRF e galeria (0/1/6/7/12/13 itens).\n";
