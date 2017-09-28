<?php 


require("connecta.php");


//CONECTA AO BANCO DE DADOS
$conn = @mysqli_connect("localhost", $username,$password)
or die("ERRO NA CONEXÃO");

//SELECIONA A BASE DE DADOS A SER UTILIZADA



$db = @mysqli_select_db($conn,"simdaps") or die("ERRO
NA SELEÇÃO DA BASE DE DADOS");

//SQL
$sql = @mysqli_query($conn,"SELECT * FROM
markers") or die("ERRO NO SQL");

//TOTAL DE LINHAS AFETADAS PELA CONSULTA
$row = mysqli_num_rows($sql) or die("ERRO
Contagem de linhas");

//VERIFICA SE A PESQUISA RETORNOU ALGUMA LINHA
if($row > 0) {

//ARQUIVO
$arquivo = "maps.xml";

//ABRE O ARQUIVO(SE NÃO EXISTIR, CRIA)
$ponteiro = fopen($arquivo, "w");

//ESCREVE NO ARQUIVO XML
fwrite($ponteiro, '<?xml version="1.0" encoding="ISO-8859-1"?>');
fwrite($ponteiro, "<markers>");


if($row > 0) {

    /* fetch associative array */
    while ($row = mysqli_fetch_assoc($sql)) {

    $id = $row["id"];

    $name = $row["name"];
    $cel = $row["cel"];
    $addr = $row["address"];
    $lat = $row["lng"];
    $lng = $row["lat"];
    $type = $row["type"];


   //MONTA AS TAGS DO XML

$aspas = '"';

 $conteudo = "<marker";
 $conteudo .= " id=$aspas$id$aspas";
 $conteudo .= " name=$aspas$name$aspas";
 $conteudo .= " cel=$aspas$cel$aspas";
 $conteudo .= " address=$aspas$addr$aspas";
 $conteudo .= " lat=$aspas$lat$aspas";
 $conteudo .= " lng=$aspas$lng$aspas";
 $conteudo .= " type=$aspas$type$aspas";
 $conteudo .= " />";

 //ESCREVE NO ARQUIVO
 fwrite($ponteiro, $conteudo); 


     }

    /* free result set */
    mysqli_free_result($sql);
}

//FECHA A TAG AGENDA
fwrite($ponteiro, "</markers>");

//FECHA O ARQUIVO
fclose($ponteiro);
//MENSAGEM
//echo "<h2>Thiago Braga</h2><br>";
//echo "O arquivo <b>".$arquivo."</b> foi gerado com SUCESSO !";
}//FECHA IF($row)
?>