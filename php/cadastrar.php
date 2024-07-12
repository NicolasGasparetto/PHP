<?php
include_once('./conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastrar Fornecedor</title>
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
  <h1>Cadastrar Fornecedor</h1>

  <?php
  $dados = filter_input_array(INPUT_GET, FILTER_DEFAULT);

  if (!empty($dados['cadastrarForn'])) {

    $empty_input = false;
    $dados = array_map('trim', $dados);
    if (in_array("", $dados)) {
      $empty_input = true;
      echo "<p style='color: red;'>Existem campos em branco!</p><br>";
    } elseif (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
      $empty_input = true;
      echo "<p style='color: red;'>E-mail informado não é válido!</p><br>";
    }

    if ($empty_input == false) {
      $queryForn = "INSERT INTO teste.fornecedor (idFornecedor, razaoSocial, nomeFantasia, CNPJ, responsavel, email, ddd, telefone) VALUES('" . $dados['idFornecedor'] . "', '" . $dados['razaoSocial'] . "', '" . $dados['nomeFantasia'] . "', '" . $dados['CNPJ'] . "', '" . $dados['responsavel'] . "', '" . $dados['email'] . "', '" . $dados['ddd'] . "', '" . $dados['telefone'] . "')";

      $cadFornecedor = $pdo->prepare($queryForn);
      $cadFornecedor->execute();

      if ($cadFornecedor->rowCount()) {
        echo "<p style='color: green;'>Fornecedor cadastrado com sucesso!</p><br>";
        unset($dados);
      } else {
        echo "<p style='color: red;'>Erro: Fornecedor não cadastrado!</p><br>";
      }
    } else {
      echo "<p style='color: red;'>Erro: Existem campos em branco ou e-mail inválido!</p><br>";
    }
  }

  ?>

  <form name="cadastrarFornecedor" method="GET" action="">
    <label>ID Fornecedor:</label>
    <input type="text" name="idFornecedor" id="idFornecedor" placeholder="ID Fornecedor" value="<?php if(isset($dados['idFornecedor'])){echo $dados['idFornecedor'];}?>"><br><br>

    <label>Razão Social:</label>
    <input type="text" name="razaoSocial" id="razaoSocial" placeholder="Razão Social" value="<?php if(isset($dados['razaoSocial'])){echo $dados['razaoSocial'];}?>"><br><br>

    <label>Nome Fantasia:</label>
    <input type="text" name="nomeFantasia" id="nomeFantasia" placeholder="Nome Fantasia" value="<?php if(isset($dados['nomeFantasia'])){echo $dados['nomeFantasia'];}?>"><br><br>

    <label>CNPJ:</label>
    <input type="text" name="CNPJ" id="CNPJ" placeholder="CNPJ" value="<?php if(isset($dados['CNPJ'])){echo $dados['CNPJ'];}?>"><br><br>

    <label>Responsável:</label>
    <input type="text" name="responsavel" id="responsavel" placeholder="Responsável" value="<?php if(isset($dados['responsavel'])){echo $dados['responsavel'];}?>"><br><br>

    <label>E-mail:</label>
    <input type="email" name="email" id="email" placeholder="E-mail" value="<?php if(isset($dados['email'])){echo $dados['email'];}?>"><br><br>

    <label>DDD:</label>
    <input type="text" name="ddd" id="ddd" placeholder="DDD" value="<?php if(isset($dados['ddd'])){echo $dados['ddd'];}?>"><br><br>

    <label>Telefone:</label>
    <input type="text" name="telefone" id="telefone" placeholder="Telefone" value="<?php if(isset($dados['telefone'])){echo $dados['telefone'];}?>"><br><br>

    <input type="submit" value="Cadastrar" name="cadastrarForn">
  </form>

</body>

</html>
