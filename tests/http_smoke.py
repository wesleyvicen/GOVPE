"""Smoke HTTP sem escrever no banco nem enviar e-mail."""
import sys
import urllib.request
import urllib.error
import urllib.parse
from html.parser import HTMLParser

base = (sys.argv[1] if len(sys.argv) > 1 else 'http://127.0.0.1:8000').rstrip('/')
class NoRedirect(urllib.request.HTTPRedirectHandler):
    def redirect_request(self, req, fp, code, msg, headers, newurl):
        return None
opener = urllib.request.build_opener(NoRedirect)
def request(path, expected, data=None):
    req = urllib.request.Request(base + path, data=data)
    try:
        res = opener.open(req, timeout=15)
    except urllib.error.HTTPError as error:
        res = error
    assert res.code == expected, (path, res.code, expected)
    body = res.read().decode('utf-8', errors='replace')
    assert not any(x in body for x in ['Fatal error:', 'Deprecated:', 'Warning:', 'Stack trace:']), path
    return body, res.headers
home, _ = request('/', 200)
assert home.lower().count('<!doctype html>') == 1
assert home.lower().count('<head>') == 1
assert 'Sonhos Realizados' in home and 'Fale Conosco' in home
request('/index.php', 200)
about, _ = request('/sobre.html', 200)
request('/painel/', 200)
request('/painel/index.php', 200)
for route in ['painel.php', 'listar_sonho.php', 'excluir.php', 'cadastrar_sonho.php', 'cadastro.php', 'postagem.php', 'remover.php', 'cadastrar.php']:
    _, headers = request('/painel/' + route, 303, b'' if route in ['postagem.php','remover.php','cadastrar.php'] else None)
    assert headers.get('Location') == '/painel/index.php'
request('/painel/login.php', 405)
request('/painel/login.php', 403, b'usuario=teste&senha=teste')
request('/mail/contact_me.php', 405)
request('/mail/contact_me.php', 422, b'name[]=bad&email=invalid')
notfound, _ = request('/pagina-que-nao-existe/teste', 404)
assert 'PÁGINA NÃO ENCONTRADA' in notfound
request('/.git/config', 403)
request('/painel/conexao.php', 403)
request('/app/bootstrap.php', 403)
request('/tests/regression.php', 403)
request('/proibido_personalizado.html', 200)
class Assets(HTMLParser):
    def __init__(self):
        super().__init__()
        self.paths = set()
    def handle_starttag(self, tag, attrs):
        a = dict(attrs)
        field = 'src' if tag in ['img','script'] else 'href' if tag == 'link' and a.get('rel') in ['stylesheet','icon'] else None
        if field and a.get(field):
            self.paths.add(a[field])
parser = Assets()
parser.feed(home + about)
for path in parser.paths:
    url = urllib.parse.urlparse(path)
    if not url.scheme and not url.netloc:
        asset = urllib.parse.urlparse(urllib.parse.urljoin(base + '/', path))
        request(asset.path + ('?' + asset.query if asset.query else ''), 200)
print('OK: home, sobre, assets locais, painel, formulários inválidos, 403 e 404.')
