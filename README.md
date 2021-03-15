## Laravel Vuejs Tailwind - Job Save

- Author: Simon Bashir
- Version: 0.1
- Release Date: Mar 15, 2021
- A hosted demo will be published soon

### Brief Description
Coded in `Laravel v8.32`, Job Save is a demo project.
Personal organizer for professional job hunters. Job Save is an open-source web application with a simple objective - to help job hunters organize and manage the main steps being carried out during the process of searching for a new job. The focus here is on you as a job seeker to keep records about application submissions and interviews. Job Save attempts to give you a snapshot or an overview of the essential pieces of information or activities related to your job search.

### Basic Features
1. This is a "demo" project but the additional sql file "Jobs.sql" contains "real" activities about my application submissions for this month.
2. This demo project shows variety of many techniques for creating API-based projects with Laravel/Vuejs/Tailwind.
3. This project is under development and therefore may contain bugs, incomplete features, or broken "responsive" design.
4. This project does not focus on Authentication and Authorizations (roles & permissions).
5. No image upload is used in this demo project (however, I do have another similar project but only focused on library books with image handling that I plan to push up soon).
6. Some "Form validation" and flash messaging are used in this project.
7. Laravel Breeze is used.

### Screen Shots
Coming soon


### Disclaimer
Job Save is just for demo. Although it is a work in progress with more features to come, I offer no active support and I do not guarantee the stability of the code so be cautious not to use in any production environment.

### Setup Instructions
```
Job Save requires Laravel v8.32 (not tested with other versions).
```


* Clone this repository to your local drive
~~~
    git clone https://github.com/halayuba/laravel-jobsave.git
~~~
* Install the composer dependencies: go to the folder that contains the download and run this command
~~~
    composer install
~~~
* Create a new database. The example below uses MYSQL (replace the * with the associated value)
~~~
    mysql -u*username -p*password
    CREATE DATABASE *db_name;
~~~
* Update .env to your specific needs (replace the * with the associated value)
~~~
    cp .env.example .env
    nano .env
    DB_HOST=localhost
    DB_DATABASE=*db_name
    DB_USERNAME=*username
    DB_PASSWORD=*password
~~~
* Run all migrations to create and populate the database tables
~~~
    php artisan migrate --seed
~~~
* Run the following artisan commands
~~~
    npm install && npm run dev
~~~
* Update the values in "baseUrl.js"
* An additional sql file "Jobs.sql" is included


### Maintainers & Contributors
- Simon Bashir (Designer and Developer)

### License
The project is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
