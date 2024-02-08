# Charger le css
Rendez vous à l'intérieur du container php :

    docker exec -it 3i-frame-php bash

Puis exécuter la commande pour compliler le css :

    npx tailwindcss -i ./assets/css/app.css -o ./assets/css/tailwind.css --watch

# Exécuter les migrations
Pour setup les migrations :

    make migration-setup

Pour lancer les migrations :

    make migration-migrate

Pour générer un fichier de migration :

    make migration-generate

Pour annuler une migration :

    make migration-rollback

# Ajouter la sécurité avec un jeton CSRF
Lors de la création d'un formulaire, rajouter la ligne :

```<input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>"> ```

