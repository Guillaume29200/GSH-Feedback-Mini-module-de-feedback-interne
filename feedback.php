<?php
ob_start();
require_once __DIR__ . '/../../../../header.php';
?>
						<div class="row">
							<div class="col-12">
								<div class="page-title-box d-sm-flex align-items-center justify-content-between">
									<h4 class="mb-sm-0 font-size-18">Retours de bug & Feedback</h4>
									<div class="page-title-right">
										<ol class="breadcrumb m-0">
											<li class="breadcrumb-item"><a href="<?= BASE_URI ?>admin/">Administration</a> > </li>
											<li class="breadcrumb-item"><a href="<?= BASE_URI ?>admin/modules/index.php">Gestion des modules</a> > </li>
											<li class="breadcrumb-item"><a href="../../accueil.php">Game Server Hub</a> > </li>
											<li class="breadcrumb-item active">Retours de bug & Feedback</li>
										</ol>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
								<?php include __DIR__ . '/../../sidebar.php'; ?>
							</div>
							<div class="col-md-10">
								<div class="card">
									<div class="card-header">
										<h5 class="my-0 fw-normal">📩 Envoyez vos retours</h5>
									</div>
									<div class="card-body">
										<div class="mb-4">
											<h5 class="text-center"><i class="fas fa-comments text-primary"></i> Retour d'expérience et Signalement</h5>
											<p class="text-muted">Cette section vous permet de nous faire part de vos retours ou de signaler des problèmes rencontrés sur <strong>Game Server Hub</strong>. Votre contribution est précieuse pour améliorer notre module et offrir une meilleure expérience utilisateur.</p>
											<hr>
											<ul class="list-unstyled">
												<li class="mb-2"><i class="fas fa-bug text-danger"></i> <strong>Signalement de bugs :</strong> Aidez-nous à identifier et corriger les erreurs.</li>
												<li class="mb-2"><i class="fas fa-book text-info"></i> <strong>Améliorations de la documentation :</strong> Suggérez des corrections ou compléments.</li>
												<li class="mb-2"><i class="fas fa-tools text-warning"></i> <strong>Fonctionnalités manquantes :</strong> Partagez vos idées pour rendre GSH encore plus performant.</li>
											</ul>
										</div>
										<hr />
										<div class="alert alert-primary" role="alert"><p>Avant d’envoyer votre retour, nous vous invitons à consulter le <a href="https://esport-cms.net/forum" target="_blank"><i class="fas fa-comments"></i> forum communautaire</a>. Il est possible que votre problème ait déjà été signalé ou qu’une solution y soit déjà disponible. Cela pourrait vous faire gagner du temps.<br /><strong>Important :</strong> Le délai de réponse peut varier en fonction du volume de demandes. Si vous ne recevez pas de réponse sous <strong>7 jours</strong>, n’hésitez pas à nous relancer pour vous assurer que votre retour a bien été pris en compte.</p></div>				
										<hr />
										<form id="feedbackForm" method="POST">
											<div class="row mb-3">
												<div class="col-md-6">
													<label for="pageSelect" class="form-label"><i class="fas fa-file-alt"></i> Page concernée</label>
													<select name="page" id="pageSelect" class="form-control">
														<option value="accueil">Accueil</option>
														<option value="mes-serveurs-dedie">Mes serveurs dédiés</option>
														<option value="liste-des-serveurs-de-jeux">Liste des serveurs</option>
														<option value="gestion-jeux">Gestion des jeux & mods</option>
														<option value="logs">Voir les logs</option>
														<option value="sauvegarde-restauration">Sauvegarde et restauration</option>
														<option value="liste-ftp">Liste des FTP</option>
														<option value="amm">AutoMod Manager (AMM)</option>
														<option value="ailogguard">AI LogGuard (V.E.G.A ou O.D.I.N)</option>
														<option value="configuration-general">Configuration générale</option>
														<option value="documentation">Documentation</option>
														<option value="autre">Autre</option>
													</select>
												</div>
												<div class="col-md-6">
													<label for="typeSelect" class="form-label"><i class="fas fa-exclamation-circle"></i> Type de problème</label>
													<select name="type" id="typeSelect" class="form-control">
														<option value="bug-mineur">Bug mineur</option>
														<option value="bug-majeur">Bug majeur</option>
														<option value="page-blanche">Page blanche</option>
														<option value="erreur-documentation">Erreur de documentation</option>
														<option value="demande-de-fonctionnalite">Ajout de fonctionnalité</option>
														<option value="autre">Autre</option>
													</select>
												</div>
											</div>
											<div class="mb-3">
												<label for="contactInput" class="form-label"><i class="fas fa-envelope"></i> Contact (Email ou Discord)</label>
												<input type="text" name="contact" id="contactInput" class="form-control" placeholder="Votre email ou identifiant Discord" required>
											</div>
											<div class="mb-3">
												<label for="detailsTextarea" class="form-label"><i class="fas fa-pencil-alt"></i> Détails du problème</label>
												<textarea name="details" class="form-control" rows="6" required></textarea>
											</div>
											<!-- Zone d’affichage AJAX -->
											<div id="feedbackMessage" class="mt-3"></div>
											<hr />											
											<!--<button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Envoyer votre retour</button>-->
											<button type="submit" id="submitButton" class="btn btn-primary" disabled>
												<i class="fas fa-spinner fa-spin d-none me-1" id="btnLoader"></i>
												<span id="btnText">Chargement...</span>
											</button>											
										</form>
										<hr />
										<div class="alert alert-info" role="alert"><i class="fas fa-info-circle"></i> <b>Information :</b> Game Server Hub collecte certaines informations afin d'aider nos développeurs à améliorer le service. Lors de l'envoi de votre feedback, votre version de PHP ainsi que votre nom de domaine seront transmis à des fins de diagnostic et de suivi technique. Ces informations sont strictement confidentielles et ne seront jamais partagées ou revendues.</div>	
									</div>
								</div>
							</div>
						</div>
						<!-- SCRIPT AJAX -->
						<script>
						document.addEventListener("DOMContentLoaded", function () {
							const form = document.getElementById("feedbackForm");
							const messageBox = document.getElementById("feedbackMessage");
							const submitBtn = document.getElementById("submitButton");
							const spinner = document.getElementById("btnLoader");
							const btnText = document.getElementById("btnText");

							// Activer le bouton une fois le DOM chargé
							submitBtn.disabled = false;
							btnText.textContent = "Envoyer votre retour";

							form.addEventListener("submit", function (e) {
								e.preventDefault();

								// Désactiver bouton + afficher spinner
								submitBtn.disabled = true;
								spinner.classList.remove("d-none");
								btnText.textContent = "Envoi en cours...";

								const formData = new FormData(form);

								fetch("Controllers/ControllerFeedback.php", {
									method: "POST",
									body: formData
								})
								.then(response => response.json())
								.then(data => {
									if (data.success) {
										messageBox.innerHTML = `<div class="alert alert-success"><i class="fas fa-check-circle"></i> ${data.message}</div>`;
										form.reset();
									} else {
										messageBox.innerHTML = `<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> ${data.error || "Une erreur est survenue."}</div>`;
									}
								})
								.catch(() => {
									messageBox.innerHTML = `<div class="alert alert-danger"><i class="fas fa-exclamation-triangle"></i> Erreur réseau. Veuillez réessayer.</div>`;
								})
								.finally(() => {
									// Réactiver bouton + cacher spinner
									spinner.classList.add("d-none");
									btnText.textContent = "Envoyer votre retour";
									submitBtn.disabled = false;
								});
							});
						});
						</script>
<?php require_once __DIR__ . '/../../../../footer.php'; ?>