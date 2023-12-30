<?php
$path = "arquivos/";
$diretorio = dir($path);

echo "Logs pflogsumm";
while($arquivo = $diretorio -> read()){
echo "<a href='".$path.$arquivo."'>".$arquivo."</a><br />";
}
$diretorio -> close();
?>