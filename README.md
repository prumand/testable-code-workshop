testable-code-workshop
======================

# Setup

Run the following
```
# install setup containers
docker-compose up
# install dependencies
php composer.phar install
# TODO do this automatically
# updated db
docker exec web php bin/console doctrine:schema:update --force
# see if web app is working
open http://localhost/web/reviews/1
```

# run tests
```docker exec web ./vendor/bin/simple-phpunit```
