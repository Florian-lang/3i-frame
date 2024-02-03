# Charger le css
Rendez vous à l'intérieur du container php :

    docker exec -it 3i-frame-php bash

Puis exécuter la commande pour compliler le css :

    npx tailwindcss -i ./assets/css/app.css -o ./assets/css/tailwind.css --watch

# Exécuter les migrations
Pour lancer les migrations faire la commande :

    make migration-migrate

Pour générer un fichier de migration :

    make migration-generate

Pour annuler une migration :

    make migration-rollback

