<?php
// Configuração compartilhada para PHP 8.2+.
date_default_timezone_set('America/Recife');
error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('log_errors', '1');

if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_httponly' => true,
        'cookie_samesite' => 'Lax',
        'use_strict_mode' => true,
        'cookie_secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
    ]);
}

set_exception_handler(function (Throwable $error): void {
    // Não expor consultas, credenciais ou dados enviados nos logs/resposta.
    error_log('GOV: ' . get_class($error) . ' em ' . basename($error->getFile()) . ':' . $error->getLine());
    http_response_code($error instanceof mysqli_sql_exception ? 503 : 500);
    header('Content-Type: text/html; charset=UTF-8');
    echo '<!doctype html><html lang="pt-BR"><meta charset="utf-8"><title>Serviço indisponível</title><h1>Serviço temporariamente indisponível</h1><p>Tente novamente em alguns instantes.</p><a href="/">Voltar ao site</a></html>';
});

function h(mixed $value): string
{
    return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function post_text(string $key): string
{
    $value = $_POST[$key] ?? '';
    return is_string($value) ? trim($value) : '';
}

function csrf_token(): string
{
    return $_SESSION['csrf_token'] ??= bin2hex(random_bytes(32));
}

function require_post(bool $csrf = true): void
{
    if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
        http_response_code(405);
        header('Allow: POST');
        exit('Use o formulário para enviar esta solicitação.');
    }
    if ($csrf && !hash_equals(csrf_token(), post_text('csrf_token'))) {
        http_response_code(403);
        exit('Sua sessão expirou. Recarregue o formulário e tente novamente.');
    }
}

function redirect(string $path): never
{
    header('Location: ' . $path, true, 303);
    exit;
}

function image_url(mixed $value): string
{
    $url = trim((string) ($value ?? ''));
    $parts = parse_url($url);
    if ($parts === false) {
        return '';
    }
    if (isset($parts['scheme']) && !in_array(strtolower($parts['scheme']), ['http', 'https'], true)) {
        return '';
    }
    // Cópias verificadas das imagens externas legadas da galeria.
    $imported = ['2AO7EXT.png', '0u5KOyW.png', 'LFz8Ttc.png', 'fN64xfI.png', 'ty8nMEJ.png', 'HpCxGGx.png'];
    $externalName = basename($parts['path'] ?? '');
    if (strtolower($parts['host'] ?? '') === 'i.imgur.com' && in_array($externalName, $imported, true)
        && is_file(dirname(__DIR__) . '/img/gov/imported/' . $externalName)) {
        return '/img/gov/imported/' . $externalName;
    }
    // Imagens já incluídas no projeto não precisam depender do domínio publicado.
    $path = $parts['path'] ?? '';
    if ((!isset($parts['host']) || in_array(strtolower($parts['host']), ['govpe.com.br', 'www.govpe.com.br'], true))
        && str_starts_with(ltrim($path, '/'), 'img/')
        && is_file(dirname(__DIR__) . '/' . ltrim($path, '/'))) {
        return '/' . ltrim($path, '/');
    }
    return $url;
}
