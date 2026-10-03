<?php
// Roteamento exclusivo do servidor de desenvolvimento. Apache usa .htaccess.
$root = __DIR__;
$path = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/');
$segments = explode('/', $path);
if (str_contains($path, "\0") || array_filter($segments, fn ($segment) => str_starts_with($segment, '.'))
    || preg_match('~^/(app|tests)(/|$)~', $path)
    || preg_match('~/(conexao|listar|verifica_login|bootstrap|router)\.php$~', $path)
    || in_array($path, ['/start.sh', '/README.md'], true)) {
    http_response_code(403);
    readfile($root . '/proibido_personalizado.html');
    return true;
}
$file = realpath($root . $path);
if ($file !== false && ($file === $root || str_starts_with($file, $root . DIRECTORY_SEPARATOR))) {
    if (is_dir($file)) {
        if (!str_ends_with($path, '/')) {
            header('Location: ' . $path . '/', true, 301);
            return true;
        }
        foreach (['index.php', 'index.html'] as $index) {
            if (is_file($file . '/' . $index)) {
                $file .= '/' . $index;
                break;
            }
        }
    }
    if (is_file($file)) {
        if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
            require $file;
            return true;
        }
        return false;
    }
}
http_response_code(404);
header('Content-Type: text/html; charset=UTF-8');
readfile($root . '/erro_personalizado.html');
return true;
