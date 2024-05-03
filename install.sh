#!/bin/bash

echo '------------------------------------------------'
echo '## Start'

echo '# Copy .env'
cp .env.local .env

echo '# Composer dependencies'
composer install

echo '# Nodejs dependencies'
npm install
npm run build

echo '# Cache'
php artisan optimize:clear

echo '# Storage link'
php artisan storage:link

echo '# Migrate'
php artisan migrate:fresh --seed

echo '## End'
echo '------------------------------------------------'
