## Laravel Vuejs Tailwind - Job Save

- Author: Simon Bashir
- Version: 0.42
- Release Date: Mar 15, 2021 (updated Aug 10, 2021)
- To see a hosted demo you can visit [jobsave.io](http://www.jobsave.io)

### Brief Description
Coded with `Laravel v8.32`, Job Save is a demo project.
Personal organizer for professional job hunters. Job Save is an open-source web application with a simple objective - to help job hunters organize and manage the main steps being carried out during the process of searching for a new job. The focus here is on you as a job seeker to keep records about application submissions and interviews. Job Save attempts to give you a snapshot or an overview of the essential pieces of information or activities related to your job search.

### Basic Features
1. This is a "demo" project but the additional sql files "submissions.sql" and "interviews.sql" contain "real" activities about my own application submissions for job opportunities.
2. This demo project shows variety of many techniques for creating API-based projects with Laravel/Vuejs/Tailwind.
3. This project is under development and therefore may contain bugs, incomplete features, or broken design.
4. This project employs basic Authentication, notification messaging, and form validation.
5. Vuex store is used for state management.
6. Laravel Breeze is used.

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
* Install the composer dependencies: go to the folder that contains the downloaded repo and run this command
~~~
    composer install
~~~
* Create a new database. The example below uses MYSQL (replace the values in [] with your preferences)
~~~
    mysql -u [username] -p [password]
    CREATE DATABASE [db_name];
~~~
* Update .env to your specific needs (replace the values in [] with your preferences)
~~~
    cp .env.example .env
    nano .env
    DB_DATABASE=[db_name]
    DB_USERNAME=[username]
    DB_PASSWORD=[password]
~~~
* Run all migrations to create and populate the database tables
~~~
    php artisan migrate --seed
~~~
* Allow files to be overwritten by giving write permissions as the following
~~~
    sudo chmod -R 777 storage bootstrap/cache
~~~
* Run the following commands
~~~
    npm install && npm run dev
~~~
* Update the values shown in [] below in "baseUrl.js" (in the resources/js/ folder) with your preferences.
~~~
    jobSubmissionsApiUrl: 'http://{url}/api/jobs',
    jobInterviewsApiUrl: 'http://{url}/api/interviews',
    authApiUrl: 'http://{url}/api/auth/user',
~~~
* Optional sql files "submissions.sql" and "interviews.sql" are included as seeders in the "extra" folder (under "jobsave/database/seeders/extra"). You can import these files manually (in the order listed above) into your DB if you prefer to see seeder data for job submissions and interviews.

### Maintainers & Contributors
- Simon Bashir

### License
The project is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
