# 🍽️ Gestion de Restaurant – Application Web PHP/MySQL

Bienvenue dans **gestion-de-restorant**, une application web simple et efficace pour gérer toutes les opérations essentielles d’un restaurant.

[![Made with PHP](https://img.shields.io/badge/Made%20with-PHP-blue.svg)](https://www.php.net/)
[![Database: MySQL](https://img.shields.io/badge/Database-MySQL-blue.svg)](https://www.mysql.com/)
[![Status: En développement](https://img.shields.io/badge/Status-En%20cours-yellow)]()
[![Auteur: Chaymae Bayousfi](https://img.shields.io/badge/Auteur-Chaymae%20Bayousfi-green)](https://github.com/chaymae-bayousfi)

---

## 📌 Description

Ce projet est une **interface d’administration complète** permettant de gérer :

- Les administrateurs 👩‍💼
- Les catégories de plats 🍝
- Les plats 🍕 avec images, descriptions et statuts

Développée avec **PHP** et **MySQL**, cette application propose une interface intuitive avec toutes les fonctionnalités **CRUD** (Créer, Lire, Mettre à jour, Supprimer).

---

## ✨ Fonctionnalités

✅ Authentification sécurisée des administrateurs  
✅ Ajout / modification / suppression des **administrateurs**  
✅ Gestion complète des **catégories** : image, statut "en vedette", "actif"  
✅ Gestion des **plats** : prix, description, image, catégorie  
✅ Upload sécurisé des images  
✅ Affichage de **messages de feedback** dynamiques (succès/échec)  
✅ Vérification d’accès simple

---

## 🗂️ Structure du Projet

mini_projet/
├── admin/ # Interface admin
│ ├── add-admin.php
│ ├── manage-category.php
│ ├── ...
│ └── partials/ # Menus & pied de page
├── config/
│ └── constants.php # Paramètres DB
├── css/
│ └── style.css # Feuille de style
├── images/ # Dossier des images
│ ├── category/
│ └── food/
├── index.php # Page d’accueil
└── ...

---

## 🚀 Installation rapide

### 🔧 Prérequis

- 🐘 PHP ≥ 7.x
- 🐬 MySQL/MariaDB
- 🌐 Serveur local : XAMPP, WAMP, LAMP, etc.
- 🧭 Navigateur Web

### 🧑‍💻 Étapes

```bash
# 1. Cloner le dépôt
git clone https://github.com/chaymae-bayousfi/gestion-de-restorant.git

# 2. Copier dans votre serveur local
# Ex: sous XAMPP
mv gestion-de-restorant /xampp/htdocs/mini_projet

# 3. Créer la base de données via phpMyAdmin ou MySQL CLI

# 4. Modifier les infos de connexion dans :
nano mini_projet/config/constants.php

# 5. Lancer le site :
http://localhost/mini_projet/admin/
```
## 👤 Auteur
Made with ❤️ by
me Chaymae Bayousfi
and https://github.com/hasnaeaqe
