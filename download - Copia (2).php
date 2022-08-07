<?php

require_once "conexao.php";

$id = $_GET['id'];

try {

    $Conexao    = Conexao::getConnection();
    $stmt      = $Conexao->query("select binaryvalue from files_table_rg_cpf where fileid = $id order by fileid desc");
    $stmt->bindColumn('binaryvalue', $img, PDO::PARAM_LOB, 0, PDO::SQLSRV_ENCODING_BINARY);
    $row = $stmt->fetch(PDO::FETCH_BOUND);
    //var_dump($img);

    //$fornecedores   = $query->fetchAll();
} catch (Exception $e) {

    echo $e->getMessage();
    exit;
}

//echo $fornecedores[0]['binaryvalue'];

/*
$name = $fornecedores[0]['filename'];
$ext = substr($name, strpos($name, '.'), strlen($name));
$type = $fornecedores[0]['filetype'];
$image = base64_encode(hex2bin($fornecedores[0]['binaryvalue']));
//$size =  strlen($image);
*/

header("Content-type: image/jpg");
header('Content-Disposition: attachment; filename="aaaa.jpg"');
header("Content-Transfer-Encoding: binary");
header('Expires: 0');
header('Pragma: no-cache');
//header("Content-Length: " . $size);

echo $img;
exit();

/*foreach ($fornecedores as $fornecedor) {
    echo $fornecedor['fileid']."<br>";
    echo $fornecedor['userid']."<br>";
    echo $fornecedor['filename']."<br>";
    echo $fornecedor['binaryvalue']."<br>";
    echo $fornecedor['binaryvalue']."<br>";
}*/
