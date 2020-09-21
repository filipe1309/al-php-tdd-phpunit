## Generate autoload files
$ composer dump

## Run app
$ php teste-avaliador.php

## Tests patterns
Arrange-Act-Assert: http://wiki.c2.com/?ArrangeActAssert
Given-When-Then: https://martinfowler.com/bliki/GivenWhenThen.html

# PHPUnit
$ composer require --dev phpunit/phpunit ^9
$ vendor/bin/phpunit --version
$ vendor/bin/phpunit tests
$ vendor/bin/phpunit --colors tests/

"Análise de valor limite" & "Particionamento de Equivalência"
http://testwarequality.blogspot.com/p/tenicas-de-teste.html

## After add phpunit xml config file
$ vendor/bin/phpunit

