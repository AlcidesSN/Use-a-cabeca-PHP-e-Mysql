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
      $screenshot = $_FILES['screenshot']['name'];
      $screenshot_size = $_FILES['screenshot']['size'];
      $screenshot_type = $_FILES['screenshot']['type'];
      //verifica se todos os campos do formulario foram preenchidos
      if (!empty($name) && (!empty($score)) && (!empty($screenshot))) {
        if (($screenshot_type == 'image/gif' || $screenshot_type == 'image/jpg' || $screenshot_type == 'image/png') && (($screenshot_size > 0) && ($screenshot_size < GW_MAXFILESIZE))) {
          if ($_FILES['screenshot']['error'] == 0) {
            //move o arquivo para pasta alvo
            $target = GW_UPLOADPATH . time() . $screenshot;
            if (move_uploaded_file($_FILES['screenshot']['tmp_name'], $target)) {


              //Conecta ao banco de dados
              $bdc = mysqli_connect(BD_HOST, BD_USER, BD_PASSWORD, BD_NAME)
                or die('Erro ao conectar ao banco de dados.');

              //Obtem os dados do banco de dados
              $query = "INSERT INTO guitarwars values(0,'$name',NOW(),'$score','" . time() . "$screenshot')";
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
            }
          } else {
            //Mostra mensagem de erro por causa do tamanho do arquivo
            echo '<p class="error">Ouve um erro ao enviar a imagem.</p>';
          }
        } else {
          echo '<p class="error">A imagem enviada deve ter a extenção .png .jpg ou .gif, a imagem tambem não pode ter um tamanho maior que ' . (GW_MAXFILESIZE / 1024) . 'KB.</p>';
        }
        //Tenta excluir o arquivo temporario
        @unlink($_FILES['screenshot']['temp']);
      } else {
        echo '<p class="error">Por favor preencha todas os campos antes de enviar o formulario.</p>';
      }
    }

    ?>
    <hr />
    <!--Criação do formulario -->
    <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo GW_MAXFILESIZE ?>">
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