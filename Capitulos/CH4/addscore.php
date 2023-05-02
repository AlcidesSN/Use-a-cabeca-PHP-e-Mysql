<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles4.css">
  <title>Guitar Wars - Adicione sua pontuação</title>
</head>

<body>
  <header>
    <h2>Guitar Wars - Adicione sua pontuação</h2>
  </header>
  <main>
    <?php
    //Pega as valores fixos em outros arquivos
    require_once('vars/appvars.php');
    require_once('vars/connectvars.php');

    //Verifica se o formulario foi enviado
    if (isset($_POST['submit'])) {
      //pega os valores do formulario
      $name = $_POST['name'];
      $score = $_POST['score'];
      $screenshot = time() . $_FILES['screenshot']['name'];
      //verifica se todos os campos do formulario foram preenchidos
      if (!empty($name) && (!empty($score)) && (!empty($screenshot))) {
        //move o arquivo para pasta alvo
        $target = GW_UPLOADPATH . $screenshot;
        if (move_uploaded_file($_FILES['screenshot']['tmp_name'], $target)) {


          //Conecta ao banco de dados
          $bdc = mysqli_connect(BD_HOST,BD_USER, BD_PASSWORD, BD_NAME)
            or die('Erro ao conectar ao banco de dados.');

          //Obtem os dados do banco de dados
          $query = "INSERT INTO guitarwars values(0,'$name',NOW(),'$score','$screenshot')";
          $data = mysqli_query($bdc, $query)
            or die('Erro ao consultar o banco de dados.');
          //Mostra as informações retiradas do banco de dados
          echo '<p>Obrigado por adicionar seu recorde.</p>';
          echo '<p><strong>Nome: </strong>' . $name . '<br>';
          echo '<strong>Pontuação: </strong>' . $score . '</p>';
          echo '<td><img src="' . $target . '" alt="Score image"/></td></tr>';
          echo '<p><a href="index.php">&lt;&lt; veja outras pontuaçoes</a></p>';

          $name = "";
          $score = "";

          mysqli_close($bdc);
        } else {
          //Mostra mensagem de erro por causa do tamanho do arquivo
          echo '<p class="error">O tamanho do arquivo é muito grande deve ser menor que 52kbs.</p>';

        }
      } else {
        echo '<p class="error">Por favor preenchar todos os campos para adicionar sua pontuação.</p>';
      }
    }

    ?>
    <hr />
    <!--Criação do formulario -->
    <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_SIZE ?>">
      <label for="name">Nome:</label>
      <input type="text" name="name" id="name" value="<?php if (!empty($name)) echo "$name"; ?>"><br>
      <label for="score">Pontuação:</label>
      <input type="text" name="score" id="score" value="<?php if (!empty($score)) echo "$score"; ?>"><br>
      <label for="screenshot">screenshot: </label>
      <input type="file" name="screenshot" id="screenshot">
      <hr />
      <input type="submit" value="Adicionar" name="submit">
    </form>
  </main>
  <footer>
    <p>Alcides Sandoli neto &copy alcidessandoli@gmail.com</p>
  </footer>
</body>

</html>