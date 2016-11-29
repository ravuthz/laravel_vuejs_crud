
# Laravel VueJS CRUD

1. Config Database: .env

    ```
    DB_DATABASE=laravel_vuejs_crud
    DB_USERNAME=root
    DB_PASSWORD=
    ```

2. Create Database: laravel_vuejs_crud

    ```sql
    CREATE DATABASE laravel_vuejs_crud CHARACTER SET utf8 COLLATE utf8_unicode_ci;
    ```

3. Create Model, Migration, Controller for : Post

    ```php
    php artisan make:model Post -m -c
    php artisan migrate
    ```

4. Generate Auth & Seed Users

    ```php
    php artisan make:auth
    php artisan make:seed UsersTableSeeder
    php artisan migrate --seed
    ```

5. Code Model, Controller & Route
	* Prepare Sublime Project WorkSpace: laravel_vuejs_crud.sublime-project
  
		```javascript
        {
            "folders":
            [
                {
                    "name": "Laravel VueJs CRUD",
                    "follow_symlinks": true,
                    "file_exclude_patterns": [
                        ".*",
                        "artisan",
                        "server.php",
                        "yarn.lock",
                        "phpunit.xml",
                        "composer.lock"
                    ],
                    "folder_exclude_patterns": [
                        "bootstrap",
                        "config",
                        "node_modules",
                        "public",
                        "storage",
                        "tests",
                        "vendor",
                    ],
                    "path": "."
                }
            ],
            "settings": {
                "tab_size": 4
            }
        }
        ```
	* Install Gulp Depedencies
  
		```node
      	install node
      	npm install --global gulp-cli
      	npm install
      	```
	* Code Views & Layout
      

PLAN
---
- [x] Create Laravel 5.3
- [x] Config & Create Database
- [x] Generate Model, Migration & Controller
- [x] Generate Auth & Seed Users
- [x] Code Post: Model, Controller & Route [ add fillable, json functions ]
- [x] Code Post: Views & Layout [ create vuejs views ]
- [ ] Impove the code structure
