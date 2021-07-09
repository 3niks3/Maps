
## Mapon task

## Task Description
1. Created simple authorization process (email and password authorization)
2. Get information form API (unit information, route and markers information)
3. process information and send it to google maps javascript API;
4. Show information in map (route and markers)

## user information Description;
1. Used Marria DB database.
2. in data base there is 2 users
2.1 user with email `user@test.te` and password `password` (password is sha1 has in database)
2.2 user with email `user1@test.te` and password `password` (password is sha1 has in database)

## Information About code architecture
1. Project works with simple Framework
2 project file autoload use PSR-4 coding standards
3. all incoming request will always land on `/index.php` file
4. url path which fallows after host will determinate which action in system to run, exeption is home path `/` it will run function `index` in `app/Controllers/Controller.php`
5 Separately there is loaded environment file with Database access `/env.php`
6 Controllers are stored in `app/Controllers/`.
7 All routs refers to method names Controller file `app/Controllers/Controller.php` example if controler is method `helloWorld` then route to this method will be `/helloWorld`
8 views are stored in `app\views` folder
9 There is one model `Users` this model only provides functionality to check user authorization
10 Core system elements are stored in `app/Core` directory. Elements like Database connection, Request data process, Data Validators, etc.
11.  working with provided api `https://mapon.com/api/` are mostly handled by class `app\Services\MapsService.php` 

## Vendor services
1. Phinx database migration tool
2. PHP unit test.

## Setup guide
1. Go to root directory where is located `docker-compose.yaml` file
2. Build project `docker-compose build`
3. Run project `docker-compose up -d`
4. Install composer `docker exec box composer install`
5. Migrate data base `docker exec box vendor/bin/phinx migrate -e development`
6. Seed database `docker exec box vendor/bin/phinx seed:run -e development`
7. Open project `http://127.0.0.1:8000`
