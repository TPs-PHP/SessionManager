<?php
require_once 'session.php';

$session = new Session();

$message = '';
$visiteCount = 1;

$compteurKey = 'nombre_visites';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset'])) {
    $session->destroy();
    header('Location: index.php');
    exit;
}

if (!$session->has($compteurKey)) {
    $session->set($compteurKey, 1);
    $visiteCount = 1;
    $message = "Bienvenu à notre plateforme.";
} else {
    $visiteCount = $session->incrementCounter($compteurKey);
    $message = "Merci pour votre fidélité, c'est votre {$visiteCount}<sup>ème</sup> visite.";
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compteur de Visites</title>
    <link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column justify-content-center align-items-center vh-100">
    <div class="container text-center">
            <h1 class="mb-4 text-primary">Gestion des Sessions</h1>

        <div class="message alert alert-info fs-5 w-50 mx-auto">
            <?php echo $message; ?>
        </div>

        <form method="POST" action="index.php">
            <button type="submit" name="reset"  class="btn btn-secondary btn-lg">
                Réinitialiser la session
            </button>
        </form>
    </div>

</body>
</html>