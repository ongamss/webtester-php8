<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
$image_dir = "test-images/1";
// $path = "arquivos/";
var_dump ($image_dir);
$diretorio = dir($image_dir);
 
echo "Lista de Arquivos do diretório '<strong>".$image_dir."</strong>':<br />";
while($arquivo = $diretorio -> read()){
echo "<a href='".$path.$arquivo."'>".$arquivo."</a><br />";
}
$diretorio -> close();
?>
<hr>

<?php
$pasta = realpath("test-images/1");
$d = dir($pasta);
echo "Handle: " . $d->handle . "<br/>";
echo "Caminho: " . $d->path . "<br/>";
while (false !== ($entry = $d->read())) {
   echo $entry."<br/>";
}
$d->close();
?>

</body>
</html>