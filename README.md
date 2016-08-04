# Doctrine Pplayground

[![Build Status](https://travis-ci.org/marius-rizac/doctrine-play.svg?branch=master)](https://travis-ci.org/marius-rizac/doctrine-play)


## Codeception commands

```bash
# generate codeception structure
vendor/bin/codecept bootstrap

# generate phpunit test
vendor/bin/codecept generate:phpunit unit PostEntityTest

# run tests with coverage report
vendor/bin/codecept run --steps --html

# run only unit tests
vendor/bin/codecept run unit

# run only tests for one class
vendor/bin/codecept run unit PostEntityTest
```
