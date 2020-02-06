<?php
// Verificar campos vazios
if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  http_response_code(500);
  exit();
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));
$data_envio = date('d/m/Y');
$hora_envio = date('H:i:s');

// Create the email and send the message
$to = "wesley1535@hotmail.com"; // Adicione seu endereço de e-mail entre os "" substituindo yourname@seudominio.com.br - Aqui é onde o formulário enviará uma mensagem.
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
$header = 'MIME-Version: 1.0' . "\r\n";
$header .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$header .= "From: noreply@govpe.com.br\n";
$header .= "Reply-To: $email";	

if(!mail($to, $subject, $body, $header))
  http_response_code(500);
?>
