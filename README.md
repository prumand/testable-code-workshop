testable-code-workshop
======================

# Setup

Run the following
```
# install setup containers
docker-compose up
# install dependencies
php composer.phar install
# see if web app is working
open http://localhost/web/reviews/1
```

# run tests
```docker exec web ./vendor/bin/simple-phpunit```
