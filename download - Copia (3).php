<?php

$server = '192.168.0.101';
$db = 'mydb';
$user = 'root';
$password = '123456';

$link = @new \PDO("odbc:Driver={SQL Server};Server=$server;Database=$db", $user, $password);
//$stmt = $link->prepare("SELECT DATALENGTH([File]) AS [Size] , CONVERT(VARCHAR(MAX),[File],2) AS [File] FROM [Attachment] WHERE [ModuleCde] = ? AND [AppID] = ? AND [Seq] = ? AND [StaffID] = ?");
$stmt = $link->prepare("select CONVERT(VARBINARY(MAX),binaryvalue) from files_table_rg_cpf where fileid = ? order by fileid desc");
$stmt->bindValue(1,$_GET["id"],PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);


header("Content-type: image/jpg");
header('Content-Disposition: attachment; filename="aaaa.jpg"');
header("Content-Transfer-Encoding: binary");
header('Expires: 0');
header('Pragma: no-cache');

echo  hex2bin($result["binaryvalue"]);

exit();