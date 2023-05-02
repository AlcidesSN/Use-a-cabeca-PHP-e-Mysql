<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Reporte de uma abdução</title>
</head>

<body>
  <?php
  $name = $_POST["firstname"] . " " . $_POST["lastname"];
  $when_it_happerned = $_POST["whenithappened"];
  $how_long = $_POST["howlong"];
  $how_many = $_POST["howmany"];
  $alien_description = $_POST["aliendescription"];
  $what_they_did = $_POST["whattheydid"];
  $fang_spotted = $_POST["fangspotted"];
  $other = $_POST["others"];

  $email = $_POST["email"];
  $to = "alcidessandoli@gmail.com";
  $subject = "Aliens me Abduziram - Relatorio de Abdução";
  $msg = "From: $email \n" .
    "$name foi abduzido $when_it_happerned " .
    "e esteve ausente por $how_long .\n" .
    "Numero de aliens: $how_many\n" .
    "Descrição dos aliens: $alien_description\n" .
    "Que eles fizeram: $what_they_did\n" .
    "Fang foi visto: $fang_spotted\n" .
    "Outros comentarios: $other";
  mail($to, $subject, $msg, "From:$email");


  echo "<h2> \u{1F47D} Obrigado por preencher este formulario. \u{1F47D} </h2>";
  echo "Você foi abduzido  . $when_it_happerned ";
  echo "e esteve ausente por  $how_long <br />";
  echo "Numero de aliens:  $how_many <br />";
  echo "Descrição dos aliens:  $alien_description <br/>";
  echo "Que eles fizeram: $what_they_did <br />";
  echo "Fang foi visto: $fang_spotted <br/>";
  echo "Outros comentarios: $other <br />";
  echo "Seu endereço de email é: $email <br/>";




  ?>
</body>
<footer style="position: absolute; bottom: 0;">
  <p>Alcides Sandoli neto &copy alcidessandoli@gmail.com</p>
</footer>

</html>