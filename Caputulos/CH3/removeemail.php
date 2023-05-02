<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles3.css">
  <title>Remove email</title>
</head>

<body>
  <header>
    <img src="elvislogo.gif" alt="Meke elvis logo">
  </header>
  <main class="infor">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
      <?php
      $bdc = mysqli_connect('localhost', 'root', '', 'elvis_store')
        or die("Erro ao conectar com MYSQL");
      if (isset($_POST['submit'])) {
        foreach ($_POST['todelete'] as $delete_id) {
          $query = "DELETE FROM email_list WHERE id = $delete_id";
          $result = mysqli_query($bdc, $query)
            or die("Erro ao assesar o banco de dados.");
        }
        echo '<b>Cliente(s) Removido(s).</b> <br/><br/>';
      }



      $query = "SELECT * FROM email_list";
      $result = mysqli_query($bdc, $query);

      while ($row = mysqli_fetch_array($result)) {
        echo '<input type="checkbox" value="' . $row['id'] . '" name="todelete[]" />';
        echo ' ' . $row['first_name'];
        echo ' ' . $row['last_name'];
        echo ' ' . $row['email'];
        echo '<br />';
        echo '<br />';
      }

      mysqli_close($bdc);

      ?>
      <input type="submit" value="Apagar" name="submit">
    </form>
  </main>
  <footer>
    <p>Alcides Sandoli neto &copy alcidessandoli@gmail.com</p>
  </footer>
</body>

</html>