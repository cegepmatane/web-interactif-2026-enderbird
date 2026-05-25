<?php
session_start();

$reussite = [];

if (!empty($_SESSION['wizard'])) {
    $reussite = [
        'message' => 'Succès',
        'name' => $_SESSION['wizard']['name'] ?? null,
        'email' => $_SESSION['wizard']['email'] ?? null,
    ];
}

session_destroy();
?>

<h1>Formulaire terminé</h1>

<?php if (!empty($reussite)) : ?>
    <p style="color: green;">
        <?= $reussite['message'] ?>
    </p>

    <p>Nom : <?= $reussite['name'] ?></p>
    <p>Email : <?= $reussite['email'] ?></p>

    <p>Merci !</p>
<?php else: ?>
    <p>Oh oh ! Aucune donnée enregistrée.</p>
<?php endif; ?>

<a href="step1.php">Recommencer</a>