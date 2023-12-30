<?php
$html = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" 
\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" lang=\"iso-8859-1\" xml:lang=\"iso-8859-1\">
<head>
<META HTTP-EQUIV=\"Content-Language\" content=\"pt-br\" />
<META HTTP-EQUIV=\"Expires: Mon, 26 Jul 1997 05:00:00 GMT\" />
<title>Relatorio de E-mails</title>
<style type=\"text/css\">
body {
       font-family: arial;
       font-size:15px;
       color:black;
       background-color:#ffffff;
       font-weight:bold;
       }
input {
       border: 1px solid grey;
       }
h1 {
       text-align:center;
       border-bottom: 1px solid black;
       }
h2 {
       margin-top:0px;
       margin-bottom:0px;
       }
.erro {
       font-weight:bold;
       color:red;
       }
.inexistentes {
       font-weight:bold;
       color:black;
       background-color:yellow;
       }
</style>
</head>
<body>
<h1>Relatório de E-mails</h1>
<hr />
";

$emailServidor = $_POST['email'];


       $comandos = file('servidor.txt');
       $resultados = array();
       foreach ($comandos as $comando) {
               list($rotulo,$cmd) = explode("\t",$comando);
               $cmd = str_replace('email_aqui',$emailServidor,$cmd);
               $r = shell_exec($cmd);
               $resultados[] = array($rotulo,$r);
       }
       $novalinha = true;
       foreach ($resultados as $resultado) {
               list($rotulo,$linhas) = $resultado;
               $html .= "<h2>{$rotulo}</h2>\n";
               $linhas = htmlentities($linhas);
               $linhas = explode("\n",$linhas);
               foreach ($linhas as $linha) {
                       $linha = trim($linha);
                       if ($linha != '') {
                               $linha = str_replace('_frmi_','<span class="inexistentes">',$linha);
                               $linha = str_replace('_frmf_','</span>',$linha);
                               $html .= "{$linha}<br />\n";
                       }
               }
       }

$html .= "\n</body>\n</html>";
echo $html;
?>