GSH-Feedback est un mini module de contact et retour d’expérience, utilisable dans n’importe quel outil PHP (panel, CMS, dashboard...).
Pensé à l'origine pour https://gameserver-hub.com, il permet aux utilisateurs de transmettre des feedbacks ou signaler des bugs rapidement, sans passer par un forum, un Discord ou une boîte mail.

## ✨ Fonctionnalités
- Formulaire AJAX fluide, sans rechargement
- Envoi par e-mail côté serveur
- Sécurité minimale (XSS, méthode POST uniquement)
- Facile à intégrer dans n'importe quel outil PHP
- Prêt à l'emploi et 100% personnalisable

## 🚀 Déploiement rapide
1. Copier les fichiers dans votre module ou page PHP.
2. Personnalisez l’adresse email dans le contrôleur.
3. (Facultatif) Personnalisez les pages concernées, types de bugs, etc.

## 🛠️ Prérequis
- PHP 8.4+
- Serveur avec fonction `mail()` activée (ou personnalisation via SMTP si besoin)
- FontAwesome pour les icônes (sinon vous pouvez les retirer)

## 📦 Utilisation
Le formulaire est pensé pour s’intégrer dans n’importe quelle interface Bootstrap ou admin panel.

## 💡 À venir (ou à adapter)
- Upload facultatif de capture d’écran
- Stockage en base de données
- Dashboard d’administration des feedbacks

## 🧑‍💻 Auteur
Développé par **Guillaume R.** dans le cadre de GameServer Hub.

🖥️ [https://esport-cms.net](https://esport-cms.net)

---

> Libre d'utilisation, adaptation et redistribution. Pas besoin de crédit, mais ça fait toujours plaisir. 😉
