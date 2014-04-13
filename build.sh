#!/bin/bash

if [ -z "$1" ]
then
    env="dev"
else
    env=$1
fi

# ReBuild db
php app/console doctrine:database:drop --force --env=$env -q
php app/console doctrine:database:create --env=$env
php app/console doctrine:schema:create --env=$env

# Load fixtures
php app/console doctrine:query:sql "INSERT INTO article (id, quantity, price) VALUES (1, 1, 1)"

# Clear cache
php app/console cache:clear --env=$env