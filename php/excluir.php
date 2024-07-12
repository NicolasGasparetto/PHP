<?php
include_once('./conexao.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Fornecedor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <nav>
            <ul>
                <a href="./index.php"><li>Listar</li></a>
                <a href="./cadastrar.php"><li>Cadastrar</li></a>
                <a href="./excluir.php"><li>Excluir</li></a>
                <a href="./editar.php"><li>Editar</li></a>
            </ul>
        </nav>
    </header>
 
    <h1>Excluir Fornecedor</h1>
    <?php 
        $queryFornecedor = "SELECT idFornecedor, razaoSocial, nomeFantasia, CNPJ, responsavel, email, ddd, telefone FROM teste.fornecedor";
        $result = $pdo->prepare($queryFornecedor);
        $result->execute();

        if (!empty($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            $queryFornecedorConsultaDelete = "SELECT * FROM teste.fornecedor WHERE idFornecedor=$id"; 
            $resultConsultaDelete = $pdo->prepare($queryFornecedorConsultaDelete);
            $resultConsultaDelete->execute();

            if ($resultConsultaDelete->rowCount() > 0) {
                $sqlDelete = "DELETE FROM teste.fornecedor WHERE idFornecedor=$id"; 
                $resultDeletar = $pdo->prepare($sqlDelete);
                $resultDeletar->execute();
                header("Refresh:1");
                echo date('H:i:s Y-m-d');
            }
        }

        if (($result) AND ($result->rowCount() != 0)) {
            ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Razão Social</th>
                            <th>Nome Fantasia</th>
                            <th>CNPJ</th>
                            <th>Responsável</th>
                            <th>E-mail</th>
                            <th>DDD</th>
                            <th>Telefone</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        while ($rowTable = $result->fetch(PDO::FETCH_ASSOC)) {
                            extract($rowTable);
                            ?>
                            <tr>
                                <td align="left"><?php echo $idFornecedor?></td>
                                <td align="left"><?php echo $razaoSocial?></td>
                                <td align="left"><?php echo $nomeFantasia?></td>
                                <td align="left"><?php echo $CNPJ?></td>
                                <td align="left"><?php echo $responsavel?></td>
                                <td align="left"><?php echo $email?></td>
                                <td align="left"><?php echo $ddd?></td>
                                <td align="left"><?php echo $telefone?></td>
                                <td align="center">
                                    <a class="btn btn-sm btn-danger" href="excluir.php?id=<?php echo $idFornecedor?>">Excluir</a>
                                </td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table> 
            <?php
        } else {
            echo "<p style='color: red;'>Não existem registros a serem excluídos.</p><br>";
        }
    ?>
</body>
</html>
