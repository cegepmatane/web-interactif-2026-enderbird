<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['name'])) {
        $_SESSION['wizard']['name'] = $_POST['name'];
        header('Location: step2.php');
        exit;
    } else {
        $error = "Nom requis";
    }
}
?>

<form method="POST">
    <input type="text" name="name" placeholder="Nom">
    <button type="submit">Suivant</button>

    <?php if (!empty($error)) echo $error; ?>
</form>