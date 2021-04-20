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

``./pap_migrations.sh dev``
