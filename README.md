# 📻 Gestionnaire de Podcasts PHP

## Pré-requis

- Base de données **MySQL** configurée et accessible
- PHP installé (version 7.4+ recommandée)
- [Composer](https://getcomposer.org/) installé

---

## Installation et lancement

0. **Installer les dépendances**
```
composer install
```

1. **Modifier les variables d'environnements dans le fichier .env avec les informations de votre base de données MySQL**
```
DB_HOST=lien_de_ma_base_de_données
DB_NAME=nom_de_la_base_de_donnée
DB_USER=mon_utilisateur_de_base_de_données
DB_PASS=mon_mot_de_passe_de_base_de_données
```

2. **Créer la base de données et les tables :**

```bash
php migrate.php
```

3. **Démarrer le serveur PHP local pour tester le projet :**

```bash
php -S localhost:9000
```

## API

- Récupérer tous les podcasts (méthode GET) :
/api/podcast.php

- Récupérer un podcast en particulier (méthode GET) :
/api/podcast.php?id=1

## Exemple de lien URL de podcast à ajouter
```
https://cdn.pixabay.com/audio/2025/04/30/audio_77a9f52926.mp3
```

## Conseil pour le déploiement

Assurer vous que votre serveur web dispose de PHP

Vous pouvez déployer votre site en ligne de commandes grâce à [LFTP](https://doc.ubuntu-fr.org/lftp)
```
lftp ftp://identifiant:mot_de_passe@site_de_connexion -e "mirror -e emplacement_local /emplacement_distant ; quit"
```