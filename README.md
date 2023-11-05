# Clash

---

## Setup

``` bash
# Install dependencies (only for first time)
composer install

# Make migrations
php bin/console make:migration

# Run migrations
php bin/console doctrine:migrations:migrate

# Load fixtures
php bin/console doctrine:fixtures:load

# Serve at localhost
symfony serve

