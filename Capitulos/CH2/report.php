<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Reporte de uma abdução</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>

  <?php
  $first_name = $_POST["firstname"];
  $last_name = $_POST["lastname"];
  $when_it_happerned = $_POST["whenithappened"];
  $how_long = $_POST["howlong"];
  $how_many = $_POST["howmany"];
  $alien_description = $_POST["aliendescription"];
  $what_they_did = $_POST["whattheydid"];
  $fang_spotted = $_POST["fangspotted"];
  $other = $_POST["others"];
  $email = $_POST["email"];

  $bdc = mysqli_connect("localhost", "root", "", "aliendatabase")
    or die("error connecting to MYSQL Server.");


  $query = "INSERT INTO aliens_abduction(first_name, last_name, when_it_happened, how_long, how_many," .
    "alien_descripition, what_they_did, fang_spotted, other, email) VALUES ('$first_name','$last_name','$when_it_happerned'," .
    "'$how_long','$how_many','$alien_description','$what_they_did','$fang_spotted','$other','$email')";


  $result = mysqli_query($bdc, $query)
    or die("Error querying database.");

  mysqli_close($bdc);

  echo "<div class='infor'>";

  echo "<h2> \u{1F47D} Obrigado por preencher este formulario. \u{1F47D} </h2>";
  echo "Você foi abduzido  . $when_it_happerned ";
  echo "e esteve ausente por  $how_long <br />";
  echo "Numero de aliens:  $how_many <br />";
  echo "Descrição dos aliens:  $alien_description <br/>";
  echo "Que eles fizeram: $what_they_did <br />";
  echo "Fang foi visto: $fang_spotted <br/>";
  echo "Outros comentarios: $other <br />";
  echo "Seu endereço de email é: $email <br/>";

  echo "</div>";

  ?>

</body>
<footer>
  <p>Alcides Sandoli neto &copy alcidessandoli@gmail.com</p>
</footer>

</html>