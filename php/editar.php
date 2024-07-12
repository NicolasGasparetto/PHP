<?php
include_once('./conexao.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Fornecedor</title>
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
   
    <h1>Editar Fornecedor</h1>
    <?php 
    $queryFornecedor = "SELECT idFornecedor, razaoSocial, nomeFantasia, CNPJ, responsavel, email, ddd, telefone FROM teste.fornecedor";
    $result = $pdo->prepare($queryFornecedor);
    $result->execute();

    if (!empty($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        $queryFornecedorConsultaUpdate = "SELECT * FROM teste.fornecedor WHERE idFornecedor=$id"; 

        $resultConsultaUpdate = $pdo->prepare($queryFornecedorConsultaUpdate);
        $resultConsultaUpdate->execute();
        $rowTableEditar = $resultConsultaUpdate->fetch(PDO::FETCH_ASSOC);
    ?>
        
    <form name="AtualizarFornecedor" method="GET" action="">
        <label>ID:</label>
        <input type="text" name="id" value="<?php echo $rowTableEditar['idFornecedor']?>"><br><br>
        <label>Razão Social:</label>
        <input type="text" name="razaoSocial" id="razaoSocial" placeholder="Razão Social" value="<?php echo $rowTableEditar['razaoSocial']?>"><br><br>

        <label>Nome Fantasia:</label>
        <input type="text" name="nomeFantasia" id="nomeFantasia" placeholder="Nome Fantasia" value="<?php echo $rowTableEditar['nomeFantasia']?>"><br><br>

        <label>CNPJ:</label>
        <input type="text" name="CNPJ" id="CNPJ" placeholder="CNPJ" value="<?php echo $rowTableEditar['CNPJ']?>"><br><br>

        <label>Responsável:</label>
        <input type="text" name="responsavel" id="responsavel" placeholder="Responsável" value="<?php echo $rowTableEditar['responsavel']?>"><br><br>

        <label>E-mail:</label>
        <input type="email" name="email" id="email" placeholder="E-mail" value="<?php echo $rowTableEditar['email']?>"><br><br>

        <label>DDD:</label>
        <input type="text" name="ddd" id="ddd" placeholder="DDD" value="<?php echo $rowTableEditar['ddd']?>"><br><br>

        <label>Telefone:</label>
        <input type="text" name="telefone" id="telefone" placeholder="Telefone" value="<?php echo $rowTableEditar['telefone']?>"><br><br>

        <input type="submit" value="Atualizar" name="AtualizarForn"><br><br>
    </form>

    <?php 

    $dados = filter_input_array(INPUT_GET, FILTER_DEFAULT);

        if (!empty($dados['AtualizarForn'])) {
            $sqlUpdate = "UPDATE teste.fornecedor
                          SET razaoSocial = '". $dados['razaoSocial'] ."',
                          nomeFantasia = '". $dados['nomeFantasia'] ."', 
                          CNPJ = '". $dados['CNPJ'] ."',
                          responsavel = '". $dados['responsavel'] ."',
                          email = '". $dados['email'] ."',
                          ddd = '". $dados['ddd'] ."',
                          telefone = '". $dados['telefone'] ."'
                          WHERE idFornecedor=$id"; 
            $resultAtualizar = $pdo->prepare($sqlUpdate);
            $resultAtualizar->execute();
            header("Refresh:1");
            echo date('H:i:s Y-m-d');
        }
    ?>

    <?php   
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
                        <th>Editar</th>
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
                                <a class="btn btn-sm btn-danger" href="editar.php?id=<?php echo $idFornecedor?>">Editar</a>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table> 
        <?php
    } else {
        echo "<p style='color: red;'>Erro: Fornecedor não encontrado!</p><br>";
    }
    ?>
</body>
</html>
