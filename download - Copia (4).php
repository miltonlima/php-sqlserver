<?php

$server = '192.168.0.101';
$db = 'mydb';
$user = 'root';
$password = '123456';

$link = @new \PDO("odbc:Driver={SQL Server};Server=$server;Database=$db", $user, $password);
//$stmt = $link->prepare("SELECT DATALENGTH([File]) AS [Size] , CONVERT(VARCHAR(MAX),[File],2) AS [File] FROM [Attachment] WHERE [ModuleCde] = ? AND [AppID] = ? AND [Seq] = ? AND [StaffID] = ?");
$stmt = $link->prepare("DECLARE @Hex VARCHAR(10)= (select binaryvalue from files_table_rg_cpf where fileid = ? order by fileid desc)
DECLARE @DecValue BIGINT=0
DECLARE @Power TINYINT = 0

SET @Hex=REVERSE(REPLACE(@Hex,'0x',''))
WHILE LEN(@Hex)>0
BEGIN
    SET @DecValue=@DecValue+(POWER(16,@Power)*CONVERT(TINYINT,LEFT(@Hex,1)))
    SET @Power=@Power+1
    SET @Hex=RIGHT(@Hex,LEN(@Hex)-1)
END

SELECT convert(varbinary(max),@DecValue) as binaryvalue ");
$stmt->bindValue(1,$_GET["id"],PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
echo  $result["binaryvalue"];
exit();