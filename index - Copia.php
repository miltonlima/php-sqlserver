<?php
define('DB_HOST', "192.168.0.101");
define('DB_USER', "root");
define('DB_PASSWORD', "123456");
define('DB_NAME', "mybd");
define('DB_DRIVER', "sqlsrv");

require_once "conexao.php";

try {

    $Conexao    = Conexao::getConnection();
    $query      = $Conexao->query("select fileid, userid, filename, binaryvalue from files_table_rg_cpf where fileid = 3843 order by fileid desc");


    $fornecedores   = $query->fetchAll();
} catch (Exception $e) {

    echo $e->getMessage();
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        table tr td {
            border: 1px solid #000000;
        }
    </style>
</head>

<body>
    <form>
        <table>
            <tr>
                <td>fileid</td>
                <td>userid</td>
                <td>filename</td>
                <td>binaryvalue</td>
                <td>teste</td>
            </tr>
            <?php
            foreach ($fornecedores as $fornecedor) {
            ?>
                <tr>
                    <td><?php echo $fornecedor['fileid']; ?></td>
                    <td><?php echo $fornecedor['userid']; ?></td>
                    <td><?php echo $fornecedor['filename']; ?></td>
                    <td><?php echo $fornecedor['binaryvalue']; ?></td>
                    <td><?php echo $fornecedor['binaryvalue']; ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
        <?php

        $data = 'data:image/png;base64,AAAFBfj42Pj4';

        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);

        file_put_contents('/tmp/image.png', $data);

        /*
        try {
            $stmt = $conn->query("select binaryvalue from files_table_rg_cpf where fileid = 3843");
            $stmt->bindColumn('binaryvalue', $img, PDO::PARAM_LOB, 0, PDO::SQLSRV_ENCODING_BINARY);
            $row = $stmt->fetch(PDO::FETCH_BOUND);
            var_dump($img);
          }
          
          //catch exception
          catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
          }
          */
        ?>
    </form>
</body>

</html>