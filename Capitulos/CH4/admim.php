<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles4.css">
  <title>Adiministrador de Pontuações</title>
</head>

<body>
  <header>
    <h1>Guitar Wars - Administração de Pontos</h1>
  </header>
  <main>
    <?php
    require_once('vars/appvars.php');
    require_once('vars/connectvars.php');

    //conecta ao banco de dados
    $bdc = mysqli_connect(BD_HOST, BD_USER, BD_PASSWORD, BD_NAME)
      or die('Erro ao conectar ao banco de dados.');

    //Obtem os dados do banco de dados
    $query = "SELECT * FROM guitarwars ORDER BY score DESC, date ASC";
    $data = mysqli_query($bdc, $query)
      or die('Erro ao consultar o banco de dados.');

    //faz um loop atravez de do array para montrar as informaçoes formantando com HTML
    echo '<table>';

    while ($row = mysqli_fetch_array($data)) {
      //Exibe o record
      //exibe os dados das pontuações
      echo '<tr class= "scorerow"><td><strong>' . $row['name'] . '</strong></td>';
      echo '<td>' . $row['date'] . '</td>';
      echo '<td> -<em> ' . $row['score'] . '</em>:</td>';
      echo '<td><a href="removescore.php?id=' . $row['id'] . '&amp;date=' . $row['date'] . '&amp;name=' . $row['name'] . ' &amp;score=' . $row['score'] . '&amp;screenshot=' . $row['screenshot'] . '">Remover</a></td></tr>';
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