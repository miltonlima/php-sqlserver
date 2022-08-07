<?php

require_once "conexao.php";

try {

    $Conexao    = Conexao::getConnection();
    $query      = $Conexao->query("select top(9925) fileid, userid, filename from files_table_rg_cpf order by fileid desc");

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
            </tr>
            <?php
            foreach ($fornecedores as $fornecedor) {
            ?>
                <tr>
                    <td><?php echo $fornecedor['fileid']; ?></td>
                    <td><?php echo $fornecedor['userid']; ?></td>
                    <td><a href="download.php?id=<?php echo $fornecedor['fileid']; ?>" target="_blank"><?php echo $fornecedor['filename']; ?></a></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </form>
</body>

</html>