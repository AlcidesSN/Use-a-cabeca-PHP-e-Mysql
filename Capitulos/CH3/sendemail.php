<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="styles3.css">
  <title>Envio de email</title>
</head>

<body>
  <header>
    <img src="elvislogo.gif" alt="Meke Me elvis logo">
  </header>

  <main class="infor">

    <?php
    $suject = '';
    $text = '';
    if (isset($_POST['submit'])) {
      $from = "alcidessandoli@edu.unifil.br";
      $suject = $_POST['subject'];
      $text = $_POST['elvimail'];
      $output_form = false;

      if ((empty($suject)) && (empty($text))) {
        echo '<p class ="warning">Você esqueceu de preencher os campos de ASSUNTO e CORPO DO TEXTO.<p><br>';
        $output_form = true;
      }

      if ((empty($suject)) && (!empty($text))) {
        echo '<p class ="warning">Você esqueceu de preencher o campo ASSUNTO.<br><p>';
        $output_form = true;
      }

      if ((!empty($suject)) && (empty($text))) {
        echo '<p class ="warning">Você esqueceu de preencher o campo CORPO DO TEXTO.<br><p>';
        $output_form = true;
      }

      if ((!empty($suject)) && (!empty($text))) {
        $bdc = mysqli_connect('localhost', 'root', '', 'elvis_store');
        $query = "SELECT * FROM email_list";
        $result = mysqli_query($bdc, $query);

        while ($row = mysqli_fetch_array($result)) {
          $first_name = $row['first_name'];
          $last_name = $row['last_name'];

          $to = $row['email'];

          $msg = "Olá $first_name $last_name, \n $text";

          mail($to, $suject, $msg, 'From: ' . $from);
          echo "Mensagem enviada para $first_name $last_name.<br>";
        }

        mysqli_close($bdc);
      }
    } else {
      $output_form = true;
    }
    if ($output_form = true) {

    ?>
      <div>
        <p><b>Privato:</b>Para uso exclusivo de Elmer.</p>
        <p>Escreva emails para os cadastrados.</p><br><br>
        <form id="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <label class="sendemail" for="subject">Assunto:</label><br>
          <input class="input" type="text" name="subject" id="subject" value="<?php echo $suject; ?>"><br>
          <label class="sendemail" for="elvimail">Corpo do texto:</label><br>
          <textarea name="elvimail" id="elvimail" cols="60" rows="10"><?php echo $text; ?></textarea><br>
          <input class="bnt" class="input" type="submit" name="submit" value="Enviar">
        </form>
      </div>
      <div>
        <img src="blankface.jpg" alt="blank face">
      </div>

    <?php
    }

    ?>
  </main>
  <footer>
    <p>Alcides Sandoli neto &copy alcidessandoli@gmail.com</p>
  </footer>


</body>

</html>