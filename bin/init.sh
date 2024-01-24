#!/bin/bash -e

APP_NAME=$(basename "$PWD")

echo "Creating docker containers"
docker-compose up -d

echo "Installing dependencies"
docker exec ${APP_NAME}-php composer install

echo "Chargement des assets"
docker exec ${APP_NAME}-php npm install

echo "Adding git hooks"
bash bin/git-hooks.sh
