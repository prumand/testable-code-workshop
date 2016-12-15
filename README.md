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

# separate execution of unit and integration tests
## run unit tests only
```docker exec web ./vendor/bin/simple-phpunit tests/Unit```
## run integration tests only
```docker exec web ./vendor/bin/simple-phpunit tests/Integration```

# create test coverage
```docker exec web ./vendor/bin/simple-phpunit --coverage-html coverage```
You can also create coverage for unit tests only:
```docker exec web ./vendor/bin/simple-phpunit tests/Unit --coverage-html coverage/unit```


# check coverage
open coverage/index.html
