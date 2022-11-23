<?php
function after ($this, $inthat)
    {
        if (!is_bool(strpos($inthat, $this)))
        return substr($inthat, strpos($inthat,$this)+strlen($this));
    };

$hostname_conexao = "localhost";
$database_conexao = "webtester";
$username_conexao = "root";
$password_conexao = "sapinho";
$conexao = mysqli_connect($hostname_conexao, $username_conexao, $password_conexao) or die(mysqli_error());
mysqli_select_db("$database_conexao");

$arquivo = isset($_FILES["file_csv"]) ? $_FILES["file_csv"] : FALSE;

$tipoValido1 = "text/comma-separated-values";
$tipoValido2 = "text/csv";

    if($tipoValido1 != $arquivo["type"] && $tipoValido2 != $arquivo["type"])
    {
	echo $arquivo["type"];
        echo "</br>Arquivo em formato inv&aacute;lido! O arquivo deve ser extens&atilde;o CSV. Envie outro arquivo";
        echo '<br/><a href="loadfileform.php">Fazer Upload de Outro Arquivos</a>';
    }
    else
    {
        preg_match("/\.(csv){1}$/i", $arquivo["name"], $ext);

        $arquivo_nome = date("d-m-Y_H-i-s") . "." . $ext[1];

move_uploaded_file($arquivo["tmp_name"], $arquivo_nome);

$row = 0;
$handle = fopen ($arquivo_nome,"r");
while ($data = fgetcsv ($handle, 1000, ";")) {
   $num = count ($data);
   $row++;
   
   $coluna1 = $data[0];
       $nome = explode(' ',$coluna1); // cria array com cada pedaco do nome
	

   $login = strtolower($nome[0]); //nome em minusculas
   $Nome = $nome[0]; //nome em maiuscula
   $Senha = '827ccb0eea8a706c4c34a16891f84e7b'; //senha padrao 12345
   $Sobrenome= after(' ', $coluna1);
   $Email1 ='magnosilva@gmail.com';
   $Admin = 0; //1 para admin 0 para usuarios
   $testelimit = 1; // 0 para testes ilimitados 1 para limitado
   $Idteste= 6; // Numero do ID do teste
   $Turma ='Seguranca do Trabalho'; // Nome ou numero da turma. opcional
       $query = "INSERT INTO users (Username, Password, FirstName, LastName, Email, Admin, Limited, LimitedSubjects, Location) 
VALUES ( '$login' , '$Senha' , '$Nome' , '$Sobrenome' , '$Email1', '$Admin' , '$testelimit', '$Idteste', '$Turma')";

//echo $query;
//exit();
mysqli_query($query) or die(mysqli_error());

echo "Nome: ".$nome[0]." | "."<br/>".$query."<br/>";
}
echo "<p>Dados da planilha inseridos com sucesso!<br/>Total de linhas inseridas: ".$row."</p>";
	fclose ($handle);

	unlink($arquivo_nome);
    }

?>
