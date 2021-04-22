# Deploy Apartool technical test with docker container
in the root directory of the project copy env-docker to .env

```sudo cp .env-example .env```

run:

```docker-compose up```

Enter to docker container:

```docker exec -it apartool_test bash```

install the dependencies of the project:

````composer install````
and 
````npm install````

fill the database with the script:

```php artisan migrate```

```php artisan db:seed```

And run the tests

```php artisan test tests/Feature/ApartmentTest.php```

File for testing in postman

```apartool_test.postman_collection.json```
