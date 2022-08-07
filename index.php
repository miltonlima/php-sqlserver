<?php

require_once "conexao.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BPSPESSOASWEB_PESSOAS</title>

    <style>
        html {
            border: 0;
            width: 100%;
            font-size: 14px;
        }


        table tr td {
            border: 1px solid #000000;
        }

       
    </style>
</head>

<body>
    <form method="GET" name="frmpost" action="">
        <h4>Bpspessoasweb</h4>
        <?php
        $s = '';
        $txt = '';

        if (isset($_GET['txtsearch'])) {
            $txt = $_GET['txtsearch'];
            $s = " and nome_pessoa like '%" . $txt . "%' or email like '%" . $txt . "%' ";
        }
        ?>
        <div>Procurar: <input type="text" name="txtsearch" value="<?=$txt?>"> <button type="submit">Buscar</button></div>
        <?php
        try {

            $Conexao    = Conexao::getConnection();
            $query      = $Conexao->query("select count(*) total from BPSPESSOASWEB_PESSOAS where 1=1 $s");
            $objrs   = $query->fetchAll();
        } catch (Exception $e) {

            echo $e->getMessage();
            exit;
        }

        $total = 0;
        $tpage = 0;

        $total = $objrs[0]['total'];

        if (!empty($objrs[0]['total'])) {
            echo "<div style='padding-bottom: 10px;'>Total de alunos: " . $total . "</div><div><a href='#'><</a> ";
        }

        $total % 100 ? $tpage = $total / 100 + 1 : $tpage / 100;

        for ($i = 1; $i <= $tpage; $i++) {
            echo " <a href='?page=$i&txtsearch=$txt'>$i</a> ";
        }
        if (!empty($objrs[0]['total'])) {
            echo " <a href='#'>></a></div>";
        }

        $p = 'OFFSET 0 ROWS FETCH NEXT 100 ROWS ONLY';
        $n = 0;

        if (isset($_GET['page'])) {
            $n = ($_GET['page'] - 1) * 100;
            $p = " OFFSET $n ROWS FETCH NEXT 100 ROWS ONLY";
        }
        ?>
        <table>
            <tr>
                <td>
                    <div"></div>
                </td>
                <td>
                    <div"><a href="#">Nome</a></div>
                </td>
                <td>
                    <div"><a href="#">E-mail</a></div>
                </td>
                <td>
                    <div"><a href="#">CPF</a></div>
                </td>
                <td>
                    <div"><a href="#">ID</a></div>
                </td>
                <td>
                    <div"><a href="#">Telefone</a></div>
                </td>
                <td>
                    <div"><a href="#">Matrícula</a></div>
                </td>
                <td>
                    <div"><a href="#">Registro</a></div>
                </td>
            </tr>
            <?php
            try {
                $query = $Conexao->query("select CPF, data_registro, id_pessoa, MATRICULA, TEL_CONTATO, LTRIM(nome_pessoa) nome, email from BPSPESSOASWEB_PESSOAS where 1=1 $s order by nome asc $p");
                $objrs = $query->fetchAll();
            } catch (Exception $e) {

                echo $e->getMessage();
                exit;
            }

            $i = $n + 1;

            foreach ($objrs as $ors) {
            ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?php echo $ors['nome']; ?></td>
                    <td><?php echo $ors['email']; ?></td>
                    <td><?php echo $ors['CPF']; ?></td>
                    <td><?php echo $ors['id_pessoa']; ?></td>
                    <td><?php echo $ors['TEL_CONTATO']; ?></td>
                    <td><?php echo $ors['MATRICULA']; ?></td>
                    <td><?php echo $ors['data_registro']; ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </form>
</body>

</html>