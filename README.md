# Vite & Gourmand - ECF

Projet réalisé dans le cadre de l’ECF du titre professionnel Développeur Web et Web Mobile.

## Description

Vite & Gourmand est une application web de traiteur permettant :

- d’afficher les menus disponibles
- de filtrer les menus par prix, thème et régime
- de consulter le détail d’un menu
- de créer un compte utilisateur
- de se connecter / se déconnecter
- de passer une commande
- de consulter ses commandes
- d’annuler une commande si elle est encore en attente
- de gérer les menus côté administrateur
- de gérer les commandes côté administrateur/employé

## Technologies utilisées

- HTML5
- CSS3
- JavaScript
- PHP
- PDO
- MySQL / MariaDB
- MAMP
- phpMyAdmin

## Installation en local

## Déploiement

L’application est déployée sur AlwaysData.

Lien de l’application déployée :

https://nzimbietienne.alwaysdata.net

Le déploiement a été réalisé en envoyant les fichiers du projet sur l’hébergement via SFTP, puis en configurant le répertoire racine du site vers le dossier `public`.

La base de données MySQL a été créée sur AlwaysData, puis le fichier SQL `database/vite_gourmand.sql` a été importé via phpMyAdmin.

### 1. Cloner le projet

```bash
git clone https://github.com/nzimbietienne-glitch/Vite-Gourmand-ecf.git