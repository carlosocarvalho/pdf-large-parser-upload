#!/bin/sh

composer install
php artisan config:cache
php artisan elastic:update-index App\\Bi\\ChapterIndexConfigurator
php artisan elastic:update-mapping App\\Entities\\Chapter
php artisan migrate --force