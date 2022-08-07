<?php

require_once "conexao.php";

$id = $_GET['id'];

try {

    $Conexao    = Conexao::getConnection();
    $query      = $Conexao->query("select fileid, userid, filename, binaryvalue, filetype from files_table_rg_cpf where fileid = $id order by fileid desc");

    $fornecedores   = $query->fetchAll();
} catch (Exception $e) {

    echo $e->getMessage();
    exit;
}

//echo $fornecedores[0]['binaryvalue'];

$name = $fornecedores[0]['filename'];
$ext = substr($name, strpos($name, '.'), strlen($name));
$type = $fornecedores[0]['filetype'];
$image = $fornecedores[0]['binaryvalue'];
$size =  strlen($image);

header("Content-type:" . $ext);
header('Content-Disposition: attachment; filename="' . $name . '"');
header("Content-Transfer-Encoding: binary");
header('Expires: 0');
header('Pragma: no-cache');
header("Content-Length: " . $size);

echo $image;
exit();

/*foreach ($fornecedores as $fornecedor) {
    echo $fornecedor['fileid']."<br>";
    echo $fornecedor['userid']."<br>";
    echo $fornecedor['filename']."<br>";
    echo $fornecedor['binaryvalue']."<br>";
    echo $fornecedor['binaryvalue']."<br>";
}*/
