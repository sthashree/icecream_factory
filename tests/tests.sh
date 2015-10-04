rm -rf ../test_results
phpunit -d memory_limit=1024M --bootstrap boot.php --configuration tests.xml --verbose --coverage-html ../test_results