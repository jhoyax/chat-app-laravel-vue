#!/bin/sh

# Drop All Tables & Migrate
php artisan migrate:fresh

# Generate new secret key
php artisan passport:install

# Important if FILESYSTEM_DRIVER is set to public
php artisan storage:link
