#!/bin/sh
set -e

composer install --prefer-dist --no-progress --no-suggest --no-interaction

exec "$@"