rm -rf ../../../global_2007_all_test_results
phpunit -d memory_limit=1024M --bootstrap boot.php --configuration tests.xml --verbose --coverage-html ../../../global_2007_all_test_results