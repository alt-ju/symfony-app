#!/bin/bash
# Démarre PHP-FPM en arrière-plan
php-fpm &

# Démarre nginx au premier plan (pas de daemon)
nginx -g "daemon off;"