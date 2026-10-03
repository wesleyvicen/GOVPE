"""Executar somente na instância de teste 8001, com schema temporário govpe_test."""
import re
import urllib.request
import urllib.error
import urllib.parse
import http.cookiejar

base = 'http://127.0.0.1:8001'
class NoRedirect(urllib.request.HTTPRedirectHandler):
    def redirect_request(self, req, fp, code, msg, headers, newurl):
        return None
opener = urllib.request.build_opener(urllib.request.HTTPCookieProcessor(http.cookiejar.CookieJar()), NoRedirect)
def req(path, code=200, data=None):
    body = None if data is None else urllib.parse.urlencode(data).encode()
    try:
        res = opener.open(urllib.request.Request(base+path, data=body), timeout=10)
    except urllib.error.HTTPError as error:
        res = error
    text = res.read().decode()
    assert res.code == code, (path,res.code,text[:200])
    assert not any(x in text for x in ['Fatal error:', 'Deprecated:', 'Warning:', 'Stack trace:'])
    return text

def token(path):
    return re.search(r'name="csrf_token" value="([a-f0-9]+)"',req(path))[1]

home = req('/')
assert 'Em breve, novas entregas' in home
csrf = token('/painel/index.php')
req('/painel/login.php',303,{'csrf_token':csrf,'usuario':'teste','senha':'invalida'})
assert 'Usuário ou senha inválidos' in req('/painel/index.php')
req('/painel/login.php',303,{'csrf_token':csrf,'usuario':'teste','senha':'teste-local'})
for path in ['/painel/painel.php','/painel/listar_sonho.php','/painel/excluir.php','/painel/cadastro.php']:
    req(path)
assert 'Nenhuma entrega' in req('/painel/listar_sonho.php')
csrf=token('/painel/cadastrar_sonho.php')
req('/painel/postagem.php',403,{'csrf_token':'invalido'})
req('/painel/postagem.php',422,{'csrf_token':csrf})
req('/painel/postagem.php',303,{'csrf_token':csrf,'inputTitulo':"João d'Ávila <script>", 'inputEndereco':'Vicência', 'inputfullthumbnails':'/img/bg1.jpeg', 'inputfullSize':'/img/bg1.jpeg'})
assert 'João d&#039;Ávila &lt;script&gt;' in req('/painel/listar_sonho.php')
assert 'João d&#039;Ávila &lt;script&gt;' in req('/')
req('/painel/remover.php',422,{'csrf_token':csrf,'id':'abc'})
req('/painel/remover.php',303,{'csrf_token':csrf,'id':'1'})
assert 'Nenhuma entrega' in req('/painel/listar_sonho.php')
req('/painel/cadastrar.php',422,{'csrf_token':csrf})
req('/painel/cadastrar.php',303,{'csrf_token':csrf,'nome':'Nova conta local','usuario':'nova','senha':'senha-local'})
assert 'Cadastro efetuado' in req('/painel/cadastro.php')
req('/painel/cadastrar.php',303,{'csrf_token':csrf,'nome':'Duplicada','usuario':'nova','senha':'senha-local'})
assert 'já existe' in req('/painel/cadastro.php')
req('/painel/logout.php',303)
req('/painel/painel.php',303)
csrf=token('/painel/index.php')
req('/painel/login.php',303,{'csrf_token':csrf,'usuario':'nova','senha':'senha-local'})
assert 'nova' in req('/painel/painel.php')
req('/mail/contact_me.php',503,{'name':'Teste local','email':'teste@example.com','phone':'81999999999','message':'Nenhum envio; transporte desabilitado.'})
req('/painel/logout.php',303)
print('OK: login/logout, CSRF, galeria vazia, cadastro/listagem/exclusão, UTF-8, usuário duplicado e e-mail local desabilitado. Somente banco temporário.')
