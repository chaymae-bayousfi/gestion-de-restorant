# gestion-de-restorant

## Description

Ce projet, **gestion-de-restorant**, est une application web de gestion de restaurant développée en PHP avec MySQL. Il permet aux administrateurs de gérer les différentes entités d’un restaurant, notamment les catégories, les plats (foods) et les administrateurs. L’interface d’administration offre des fonctionnalités de CRUD (Créer, Lire, Mettre à jour, Supprimer) pour faciliter la gestion quotidienne du restaurant.

---

## Fonctionnalités principales

- **Authentification des administrateurs**
- **Gestion des administrateurs** : Ajout, modification, suppression.
- **Gestion des catégories** : Ajout, modification, suppression, image associée, statut "en vedette" et "actif".
- **Gestion des plats** : Ajout, modification, suppression, image, description, prix, catégorie, statut "en vedette" et "actif".
- **Gestion des images** pour les catégories et les plats.
- **Messages de feedback** pour informer l'utilisateur de la réussite ou de l'échec des opérations.
- **Sécurité minimale** : Vérification basique des accès et des opérations.

---

## Structure du projet

```
mini_projet/
├── admin/
│   ├── add-admin.php
│   ├── add-category.php
│   ├── add-food.php
│   ├── delete-admin.php
│   ├── delete-category.php
│   ├── delete-food.php
│   ├── manage-admin.php
│   ├── manage-category.php
│   ├── manage-food.php
│   ├── partials/
│   │   ├── footer.php
│   │   ├── menu.php
│   │   └── ...
│   └── ...
├── config/
│   └── constants.php
├── css/
│   └── style.css
├── images/
│   ├── category/
│   └── food/
├── index.php
└── ...
```

---

## Installation

### Prérequis

- Serveur web (Apache, Nginx…)
- PHP >= 7.x
- MySQL/MariaDB
- Navigateur web

### Étapes

1. **Cloner le dépôt**
   ```sh
   git clone https://github.com/chaymae-bayousfi/gestion-de-restorant.git
   ```

2. **Déplacer le dossier dans votre serveur local**
   - Placez le dossier `mini_projet` dans le répertoire `htdocs` (XAMPP) ou `www` (WAMP/LAMP) de votre serveur web.

3. **Créer la base de données**
   - Créez une base de données nommée (par exemple) `restorant` dans phpMyAdmin ou en ligne de commande.

4. **Configurer la connexion à la base de données**
   - Ouvrez `mini_projet/config/constants.php`
   - Modifiez les constantes `LOCALHOST`, `DB_USERNAME`, `DB_PASSWORD`, et `DB_NAME` selon votre configuration locale.

5. **Lancer l’application**
   - Accédez à `http://localhost/mini_projet/admin/` dans votre navigateur.

---

## Exemples d’utilisation

- **Ajouter un administrateur** : Rendez-vous dans la section "Add Admin", remplissez le formulaire.
- **Ajouter une catégorie** : Ajoutez un titre, une image et définissez si la catégorie est en vedette ou active.
- **Ajouter un plat** : Saisissez le nom, la description, le prix, choisissez une image et la catégorie correspondante.

---

## Auteur

- [chaymae-bayousfi](https://github.com/chaymae-bayousfi)

---
