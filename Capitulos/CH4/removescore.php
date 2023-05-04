<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles4.css">
  <title>Remover pontuação</title>
</head>
<body>
  <header>
    <h1>Guitar Wars - Remover pontuação</h1>
  </header>
  <main>
    <?php 
    require_once('vars/appvars.php');
    require_once('vars/connectvars.php');
    $id;
    $date;
    $name;
    $score;
    $screenshot;
    //Verifica se o foi requisitado a esclusão de alguem
    if(isset($_GET['id']) && isset($_GET['date']) && isset($_GET['name']) && isset($_GET['score']) && isset($_GET['screenshot'])){
     
      //Pega os dados GET
      $id = $_GET['id'];
      $date = $_GET['date'];
      $name = $_GET['name'];
      $score = $_GET['score'];
      $screenshot = $_GET['screenshot'];



    }else if(isset($_POST['id']) && isset($_POST['name']) && isset($_POST['score'])){
      
      
      //Pega os dados POST
      $id = $_POST['id'];
      $name = $_POST['name'];
      $score = $_POST['score'];
      $screenshot = $_POST['screenshot'];

    }else{
      echo '<p class="error">Nenhum pontuaçao foi expecificada para remoção.</p>';
    }
    if(isset($_POST['submit'])){
      if($_POST['confirm']=='yes'){
        //apaga o arquivo grafico no servidor
        @unlink(GW_UPLOADPATH . $screenshot);
        
        
        //conecta-se ao banco de dados
        $bdc = mysqli_connect(BD_HOST,BD_USER, BD_PASSWORD, BD_NAME)
         or die('Erro ao conectar ao banco de dados.');

        //Obtem os dados do banco de dados
        $query = "DELETE FROM guitarwars WHERE id = '$id'";
        $data = mysqli_query($bdc, $query)
          or die('Erro ao consultar o banco de dados.');
      
        //Confirma exito com o usuario
        echo '<p>A pontuação de '.'for'.' foi removida com susseso.</p>';
        mysqli_close($bdc);
      }else{
        echo '<p class="error">A pontuação não foi removida.</p>';
      }
    }else if(isset($id) && isset($name) && isset($score) && isset($screenshot)){
      ?>
      <p>Você deseja apagar a seguinte pontuação?</p>
      <p><strong>Nome: </strong><?php echo $name; ?></p><br>
      <p><strong>Data: </strong> <?php echo $date; ?></p><br>
      <p><strong>Pontuação: </strong> <?php echo $score; ?></p>
      <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
      <input type="radio" name="confirm" value="yes"> Sim
      <input type="radio" name="confirm" value="no" checked="checked"> Não <br>
      <input type="submit" value="subimt" name="submit">
      <input type="hidden" name="id" value="<?php echo "$id";?>">
      <input type="hidden" name="name" value="<?php echo "$name";?>">
      <input type="hidden" name="score" value="<?php echo "$score";?>">
      <input type="hidden" name="screenshot" value="<?php echo "$screenshot";?>">
      </form>
      <?php 
    }
    echo '<p><a href="admim.php">&lt;&lt; Voltar para pagina de adiministrção</a></p>';
      
    ?>
  </main>
  <footer>
    <p>Alcides Sandoli neto &copy alcidessandoli@gmail.com</p>
  </footer>
</body>
</html>