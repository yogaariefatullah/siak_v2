# SIAK
SIAK is a Application based on web use lavavel PHP Framework. 

## Getting Started
- CLone your projek on this git
- S

## Running the container
First copy .env.example and rename it to .env and also update the configuration file:

```console
$ cp .env.example .env
```

Set the correct values for the database connection

```console
DB2_HOST=127.0.0.1
DB2_PORT=5432
DB2_DATABASE=db_api
DB2_USERNAME=postgres
DB2_PASSWORD=passrahasia
```

Also don't forget to change below configuration:

```console
APP_ENV=production
APP_DEBUG=false
APP_URL=http://localhost:8000

BASIC_USER=api@kejagung.go.id
BASIC_PASS=secretpass

```

Finally, we can **Run the Container**

```console
$ docker-compose up -d
```

*Last but not least*, run command below to install dependencies and also migrate and seeding a user for Login

```console
$ docker-compose exec app composer install --ignore-platform-reqs
$ docker-compose exec app php artisan migrate --seed
```

## Global Code
You can change default configuration for **Global Code** from file below:

```console
app/Constants/GlobalCode.php
```

Then, edit the value:

```console
const DEFAULT_LIMIT = 10;
```

**Notes:**

**DEFAULT_LIMIT**    : How much data displayed in pagination



## License

The Lumen framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
