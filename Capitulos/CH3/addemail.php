<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles3.css">
  <title>Confirmação</title>
</head>

<body>
  <header>
    <img src="elvislogo.gif" alt="Meke Me elvis logo">
  </header>
  <main class="infor">
    <?php
    $first_name = $_POST['firstname'];
    $last_name = $_POST['lastname'];
    $email = $_POST['email'];

    $bdc = mysqli_connect("localhost", "root", "", "elvis_store")
      or die("Erro ao conectar com MYSQL");

    $query = "INSERT INTO email_list(first_name,last_name,email)" .
      "VALUES('$first_name','$last_name','$email')";

    mysqli_query($bdc, $query) or die("Falha no Envio!");
    echo "Formulario enviado com susesso!";

    mysqli_close($bdc);
    ?>
  </main>
  <footer>
    <p>Alcides Sandoli neto &copy alcidessandoli@gmail.com</p>
  </footer>
</body>

</html>