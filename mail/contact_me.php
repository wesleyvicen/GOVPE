<?php
require_once __DIR__ . '/../app/bootstrap.php';
header('Content-Type: application/json; charset=UTF-8');
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    exit(json_encode(['message' => 'Use o formulário de contato.']));
}
$rawName = post_text('name');
$rawEmail = post_text('email');
$rawPhone = post_text('phone');
$rawMessage = post_text('message');
if ($rawName === '' || $rawEmail === '' || $rawPhone === '' || $rawMessage === ''
    || !filter_var($rawEmail, FILTER_VALIDATE_EMAIL)
    || preg_match('/[\r\n]/', $rawName . $rawEmail)
    || strlen($rawName) > 200 || strlen($rawEmail) > 254 || strlen($rawPhone) > 50 || strlen($rawMessage) > 10000) {
    http_response_code(422);
    exit(json_encode(['message' => 'Preencha todos os campos com dados válidos.']));
}
// PHP local não configura um serviço de e-mail automaticamente.
$enabled = getenv('CONTACT_MAIL_ENABLED');
if ($enabled === '0' || ($enabled !== '1' && PHP_SAPI === 'cli-server')) {
    http_response_code(503);
    exit(json_encode(['message' => 'O envio de e-mail está indisponível neste ambiente. Entre em contato por telefone ou WhatsApp.']));
}
$name = h($rawName);
$email = h($rawEmail);
$phone = h($rawPhone);
$message = nl2br(h($rawMessage));
$data_envio = date('d/m/Y');
$hora_envio = date('H:i:s');

// Create the email and send the message
$to = getenv('CONTACT_TO') ?: "wesley1535@hotmail.com"; // Adicione seu endereço de e-mail entre os "" substituindo yourname@seudominio.com.br - Aqui é onde o formulário enviará uma mensagem.
$subject = "Contato GOV:  $name";
$body = "
<html style='width:100%;font-family:helvetica, 'helvetica neue', arial, verdana, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0;'>
  <table>
      <tr>
        <td>
          <tr>
            <td align='center' style='padding:0;Margin:0;padding-top:5px;padding-bottom:5px;'>
              <img src='https://govpe.com.br/img/favicon.png' alt style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;' width='175'>
            </td> 
        </tr>
          <tr>
            <td width='500' align='center' style='padding:0;Margin:0;padding-top:5px;padding-bottom:5px;'>
              $name, entrou em contato
            </td>
          </tr>
          <tr>
            <td width='320' align='center' style='padding:0;Margin:0;padding-top:5px;padding-bottom:5px;'>
            o email de $name é <b>$email</b>
            </td>
          </tr>
          <tr>
            <td width='320' align='center' style='padding:0;Margin:0;padding-top:5px;padding-bottom:5px;'>
            Telefone para contato é: <b>$phone</b>
            </td>
          </tr>
          <tr>
          
            <td width='320' align='center' style='Margin:0;padding-top:30px;padding-bottom:30px;'> $message</td>
        </tr>
      </td>
    </tr>  
    <tr>
      <td bgcolor='#f8cb42' align='center' style='padding:0;Margin:0;padding-top:5px;padding-bottom:5px;'>Este e-mail foi enviado em <b>$data_envio</b> às <b>$hora_envio</b></td>
    </tr>
  </table>
</html>
  ";
$headers = [
    'MIME-Version' => '1.0',
    'Content-Type' => 'text/html; charset=UTF-8',
    'From' => 'noreply@govpe.com.br',
    'Reply-To' => $rawEmail,
];
if (!@mail($to, 'Contato GOV: ' . $rawName, $body, $headers)) {
    http_response_code(503);
    exit(json_encode(['message' => 'Não foi possível enviar o e-mail. Tente novamente mais tarde ou entre em contato por telefone.']));
}
echo json_encode(['message' => 'Mensagem enviada com sucesso.']);
