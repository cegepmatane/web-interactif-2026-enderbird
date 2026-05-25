<?php
  session_start();
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $_SESSION['wizard']['email'] = $_POST['email'];
      header('Location: step3.php');
      exit;
    } else {
      $error = "Email invalide";
    }
  }
?>

<form method="POST">
  <input type="email" name="email" placeholder="Email">
  <button type="submit">Suivant</button>

  <?php if (!empty($error)) echo $error; ?>
</form>