<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['password']) && strlen($_POST['password']) >= 6) {

        $_SESSION['wizard']['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);

        header('Location: finish.php');
        exit;

    } else {
        $error = "Mot de passe trop court";
    }
}
?>

<form method="POST">
    <input type="password" name="password" placeholder="Mot de passe">
    <button type="submit">Terminer</button>

    <?php if (!empty($error)) echo $error; ?>
</form>