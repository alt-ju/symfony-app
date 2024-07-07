# Guide d'utilisation

Vous trouverez ici une application de gestion de tâches créée en Symfony. Pour l'utiliser, il vous faudra mettre en place des éléments sur votre machine.

## Pré-requis : 
1. Assurez-vous que PHP est bien installé sur votre ordinateur. Vous pouvez vérifier, au sein de votre terminal, la version de PHP installée avec la commande :
  ```
  php -v
  ```
   Si PHP n'est pas installé, vous pouvez l'installer en suivant la documentation de configuration et d'installation sur le site officiel de documentation PHP : https://www.php.net/downloads

2. Installez Composer et les dépendances PHP. Il s'agit d'un gestionnaire de dépendances pour PHP permettant de déclarer et gérer les librairies nécessaires
   au projet. Pour installer Composer, vous pouvez vous référer à la documentation officielle : https://getcomposer.org/download/

3. Installez Symfony sur votre machine. Pour connaitre les étapes d'installation, vous pouvez vous référer à la documentation officielle : https://symfony.com/doc/current/setup.html

4. Récupérez le repository sur votre machine en le clonant, localement, grâce à la commande suivante :
   ```
   git clone <lien https du repository>
   ```

5. Pour ouvrir ce projet vous aurez besoin d'un serveur web ainsi qu'une base de données et une interface de gestion (PHPMyAdmin par exemple, qui a été utilisé pour la création de ce projet).

6. Utilisez l'IDE de votre choix (par exemple Visual Studio Code ou PHPStorm)

## Au sein des fichiers : 

7. Configurez le fichier .env afin de modifier le chemin à la base de données. Il s'agit des lignes commençant par DATABASE_URL. Pensez à commenter les lignes qui ne seront pas utilisées.

8. Récupérez le script SQL dans le fichier database.sql au sein du dossier nommé sql et l'importer au sein de votre interface de base de données.

## Démarrer l'application 

9. Ouvrez le repository dans votre IDE et lancez la commande suivante au sein de votre terminal :
    ```
    symfony server:start
    ```

10. Accédez à l'appplication en cliquant sur le lien commençant par "http" dans les réponses de votre terminal. Ou bien en indiquant le lien suivant dans votre navigateur : http://127.0.0.1:8000
    
## Utiliser l'application 

- Inscrivez-vous pour accéder aux fonctionnalités de l'application.
- Une fois connecté, vous pouvez accéder à la liste de vos tâches, leur statut, ainsi qu'à deux boutons d'actions. Un bouton 'modifier', vous permettant de modifier les informations liées à votre
  tâche. Et un bouton 'supprimer' pour supprimer définitivement votre tâche de la liste.
- Chaque tâche possède trois informations : un titre, une description et un statut à trois choix ('à faire', 'en cours', 'terminé')
- Pour visualiser le détail d'une tâche, cliquez sur le titre de celle-ci dans le tableau des tâches.
- Vous pouvez retourner à votre tableau de tâche, soit avec le bouton 'retour', soit en cliquant sur 'Mes tâches' dans la barre de navigation supérieure.
