# Qwikkar Website and REST

Rent a car with driver to reach from your current location to other by click on map.

## Prequisites
- PHP 5.6
- MySQL 5.7 / Redis
- Composer
- NPM

## Project Setup

Following steps are involved to successfully setup this project:

- Clone this project to your machine
```
$ cd /path/where/you/want/to/clone
$ git clone <http_url_of_repository>
```
- Setup Database credentials in **.env** file of the project
- Run this command in project root directory to generate **.env**
```
/inside/project/directory$ composer run-script post-root-package-install
```

- Ensure that you should have relevant API keys added to **.env** file
- Run this command in project root directory to generate key
```
/inside/project/directory$ php artisan key:generate
```

- Run Migrations
```
/inside/project/directory$ php artisan migrate
```
- Run Seeds
```
/inside/project/directory$ php artisan db:seed
```
- Verify passport keys by using this command
```
/inside/project/directory$ php artisan passport:install
```

- Server needs to allow **storage** directory and **cache** and allow **passport keys** to read by laravel
```
/inside/project/directory$ sudo chmod -R gu+w storage/
/inside/project/directory$ sudo chmod -R guo+w storage/

/inside/project/directory$ sudo chmod -R gu+w bootstrap/cache/
/inside/project/directory$ sudo chmod -R guo+w bootstrap/cache/

/inside/project/directory$ sudo chown www-data:www-data storage/oauth-*.key
/inside/project/directory$ sudo chmod 600 storage/oauth-*.key
```

- Now we need to configure **assets management**
- Run these commands to ensure assets

```
/inside/project/directory$ sudo npm install
/inside/project/directory$ sudo npm run prod
```
