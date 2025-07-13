<?php
require_once __DIR__ . '/../../../../../../framework/Configuration/config.php';

header('Content-Type: application/json');

// Configuration de l'adresse e-mail
$recipient = "hooxie@live.fr";
$subject = "Retours d'un utilisateur pour GSH";

// Vérifier si la requête est POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	http_response_code(405);
	echo json_encode(['success' => false, 'error' => 'Méthode non autorisée.']);
	exit;
}

// Récupérer les données
$page = $_POST['page'] ?? null;
$type = $_POST['type'] ?? null;
$contact = $_POST['contact'] ?? null;
$details = $_POST['details'] ?? null;

if (!$page || !$type || !$details || !$contact) {
	http_response_code(400);
	echo json_encode(['success' => false, 'error' => 'Tous les champs sont obligatoires.']);
	exit;
}

// Sécurisation
$page = htmlspecialchars($page, ENT_QUOTES, 'UTF-8');
$type = htmlspecialchars($type, ENT_QUOTES, 'UTF-8');
$contact = htmlspecialchars($contact, ENT_QUOTES, 'UTF-8');
$details = htmlspecialchars_decode(strip_tags($details, '<p><a><br><strong><em><ul><ol><li><b><i>'));

// Infos techniques
$phpVersion = phpversion();
$domain = $_SERVER['HTTP_HOST'];
$date = date('Y-m-d H:i:s');

// Message HTML
$message = <<<EOD
<html>
<head><title>Retour d'un utilisateur pour GSH</title></head>
<body>
	<h2>Retour d'un utilisateur pour GSH</h2>
	<p><strong>Contact :</strong> $contact</p>
	<p><strong>Page concernée :</strong> $page</p>
	<p><strong>Type de problème :</strong> $type</p>
	<p><strong>Détails :</strong><br>$details</p>
	<hr>
	<h4>Informations supplémentaires</h4>
	<ul>
		<li><strong>Date et heure :</strong> $date</li>
		<li><strong>Nom de domaine :</strong> $domain</li>
		<li><strong>Version de PHP :</strong> $phpVersion</li>
	</ul>
</body>
</html>
EOD;

// Envoi email
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type:text/html;charset=UTF-8\r\n";
$headers .= "From: no-reply@$domain\r\n";

if (mail($recipient, $subject, $message, $headers)) {
	echo json_encode(['success' => true, 'message' => 'Merci pour votre retour.']);
} else {
	http_response_code(500);
	echo json_encode(['success' => false, 'error' => 'Échec de l\'envoi de l\'e-mail.']);
}
?>