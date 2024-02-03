#!/bin/bash -e

APP_NAME=$(basename "$PWD")

echo "Creating docker containers"
docker-compose up -d

echo "Installing dependencies"
docker exec ${APP_NAME}-php composer install

echo "Installing assets"
docker exec ${APP_NAME}-php npm install

echo "Initializing database"
make migration-setup
make migration-migrate

echo "Adding git hooks"
bash bin/git-hooks.sh
