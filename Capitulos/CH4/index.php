<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles4.css">
  <title>Guitar Wars - Pontuações</title>
</head>

<body>
  <header>
    <h2>Guitar Wars - Pontuações</h2>
    <p>Bem-Vindo Guerreiro da guitara, do que você prescisa para alcançar o topo desta lista? É claro que é apenas <a href="addscore.php">adicinar sua pontuação aqui.</a> </p>
    <hr>
  </header>
  <main>
    <?php
   include_once('appvars.php');
   include_once('connectvars.php');
    //Conecta ao banco de dados
    $bdc = mysqli_connect(BD_HOST,BD_USER, BD_PASSWORD, BD_NAME)
      or die('Erro ao conectar ao banco de dados.');

    //Obtem os dados do banco de dados
    $query = "SELECT * FROM guitarwars";
    $data = mysqli_query($bdc, $query)
      or die('Erro ao consultar o banco de dados.');

    //faz um loop atravez de do array para montrar as informaçoes formantando com HTML
    echo '<table>';
    while ($row = mysqli_fetch_array($data)) {
      //exibe os dados das pontuações
      echo '<tr><td class="scoreinfo">';
      echo '<span class="score">' . $row['score'] . '</span><br>';
      echo '<strong>Nome:</strong>' . $row['name'] . '<br>';
      echo '<strong>Data:</strong>' . $row['date'] . '<br>';
      if ((is_file(GW_UPLOADPATH . $row['screenshot'])) && (filesize(GW_UPLOADPATH . $row['screenshot']))) {
        echo '<td><img src="' . GW_UPLOADPATH . $row['screenshot'] . '" alt="Score image"/></td></tr>';
      } else {
        echo '<td><img src="images/sempontuacao.svg" alt="pontuação não disponivel"/></td></tr>';
      }
    }
    echo '</table>';

    mysqli_close($bdc);

    ?>
  </main>
  <footer>
    <p>Alcides Sandoli neto &copy alcidessandoli@gmail.com</p>
  </footer>
</body>

</html>