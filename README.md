# GOV — Grupo Oliveira Vasconcelos

Site PHP com MySQL, sem etapa de build. Requer PHP 8.2+ com `mysqli`, MySQL e acesso ao banco configurado. Validado localmente com PHP 8.5.

## Rodar localmente

```sh
sh start.sh
```

Abra http://localhost:8000. Para outra porta: `PORT=8001 sh start.sh`. O script fixa a raiz do projeto, independentemente do diretório de onde é executado. Use o servidor embutido apenas no desenvolvimento.

A conexão aceita `DB_HOST`, `DB_PORT`, `DB_USER`, `DB_PASSWORD` e `DB_NAME` por variáveis de ambiente. Sem essas variáveis, mantém a configuração existente da hospedagem em `painel/conexao.php`. Há credenciais legadas nesse arquivo: não compartilhe uma cópia pública. Não há importação SQL no repositório. Para testar inclusão/exclusão/cadastro, use um banco de desenvolvimento; a configuração original aponta para o banco publicado.

E-mail: na hospedagem, requer `mail()` configurado pelo provedor. Localmente o envio é desabilitado e o formulário mostra uma mensagem clara. `CONTACT_MAIL_ENABLED=1` habilita envio quando houver transporte configurado; `CONTACT_MAIL_ENABLED=0` o desabilita em qualquer ambiente. `CONTACT_TO` permite configurar o destinatário. A revisão não enviou e-mails.

## Validação

```sh
php tests/regression.php
python3 tests/http_smoke.py http://127.0.0.1:8000
```

O teste HTTP lê páginas e envia apenas formulários inválidos ou não autenticados. Não cria usuários, não altera entregas e não envia e-mails.

## Publicar e investigar o 404 intermitente

Envie os arquivos alterados à raiz pública correta da hospedagem, incluindo os arquivos ocultos `.htaccess`. Preserve a configuração do banco. Apache deve ter PHP habilitado, permitir `DirectoryIndex` e `ErrorDocument` no `.htaccess`, e servir o diretório que contém `index.php`. O servidor local usa `router.php`; Apache usa `.htaccess`.

A raiz possui `DirectoryIndex index.php index.html`. O documento de erro 403 também existe agora. Uma URL inexistente continua retornando 404, com a página personalizada — não é redirecionada para a home.

Durante a revisão, `https://govpe.com.br/` respondeu 200. O 404 da home não foi reproduzido. Quando ocorrer novamente, registre horário, endereço completo e cabeçalhos (`curl -I https://govpe.com.br/`), em especial `server`, `cf-ray`, `cf-cache-status` e `x-cache-status`. Peça à hospedagem os logs de acesso/erro nesse horário e confirme a raiz pública, presença de `index.php` e configuração dos domínios com/sem `www`. Isso distingue origem, cache/proxy e deploy incompleto; alterações PHP por si só não provam a correção de um 404 intermitente da infraestrutura.

## Limites da atualização

Foi mantida a estrutura visual, com jQuery 3.7.1 e Bootstrap 4.6.2 (linha compatível com os componentes existentes). Não é uma migração para Bootstrap 5/jQuery 4. Bibliotecas externas e links de tour dependem dos respectivos serviços. As seis imagens legadas do Imgur (três miniaturas e três imagens ampliadas) têm cópias em `img/gov/imported/`, usadas automaticamente sem alterar o banco. Publique também esses arquivos; novas URLs externas cadastradas continuam dependendo de seus serviços de origem.

O painel agora exige sessão nas ações de escrita, valida formulários, usa tokens CSRF e consultas preparadas. O cadastro de usuários exige login. Os hashes MD5 existentes foram preservados para evitar invalidar contas ou mudar o esquema do banco remoto. Uma migração para `password_hash()` exige ampliar a coluna de senha e planejar a transição; não foi executada. Funções de edição/modelos que já eram placeholders não foram implementadas.

O painel também foi validado com login, cadastro, exclusão, acentos, usuário duplicado e CSRF em um MySQL temporário, sem escrita no banco publicado. `tests/panel_integration.py` é exclusivo da instância descartável na porta 8001 e requer um schema vazio `govpe_test` com as tabelas `usuario` e `sonhos`, e o usuário fictício `teste`/`teste-local`. Não o execute contra produção.
