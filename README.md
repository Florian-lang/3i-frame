# Charger le css
Rendez vous à l'intérieur du container php :

    docker exec -it container-name bash

Puis exécuter la commande pour compliler le css :

    npx tailwindcss -i ./assets/css/app.css -o ./assets/css/tailwind.css --watch
