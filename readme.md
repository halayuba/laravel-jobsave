## Laravel Project - Job Save

- Author: Simon Bashir
- Version: 0.1.7
- Release Date: Nov 19th, 2017
- To see a hosted demo you can visit [jobsave.io](http://jobsave.io])

### Brief Description
Personal organizer for professional job hunters.
Coded in `Laravel 5.5`, Job Save is an open-source web application with a simple objective - to help job hunters organize and manage the main steps carried out during the process of searching for a new job. The focus here is on you as a job seeker to keep records about employers, jobs, applications submitted, interviews, and offers. Job Save attempts to give you a snapshot or an overview of the essential pieces of information or activities related to your job search.

Check out the screenshots below to learn the basic workflow or visit <a href="http://jobsave.io/dashboard">Workflow </a>.

### Basic Features
For some of us finding a new job is not a lot of work (relatively speaking) and even switching jobs does not take much time or effort. However, for those who experience a lot of difficulties keeping track of everything about their job search endeavors or may have a hard time remembering details about what are all the jobs that they have been applying for and with whom, when were the submission dates for those job applications, was there an upcoming interview scheduled, how many interviews were completed thus far and what do the notes say about how they went, and so on.

Undoubtedly, there are numerous tools out there to help job seekers improve their chances for getting a job. Job Save, however, is different with a much basic tenet of serving as your personal assistant in keeping records of everything important that revolves around your job search - in the process keeping you informed and organized.

### Screen Shots
For a quick general view of how Job Save works visit <a href="http://jobsave.io/dashboard" >Workflow </a>

#### Resume
![Define a resume](http://albums.c1st.net/uploads/big/8f79eeeef9cd10206bd9b9e83274009f.png)
> Define a resume: usually, most job seekers would have one single resume but in case you have multiple variations of the main resume or if you have skills in more than one field then you can create records for all your resumes.
___
#### Employers
![Define Employer](http://albums.c1st.net/uploads/big/fc8bb3ee7cb8548b215b0bfb7a303588.png)
> Define an employer: unless you are applying for a job with the same employer that you have already created a record for, you will need to define the employer and the posted job that you've applied for (see next step).
___
#### Jobs
![Define Job](http://albums.c1st.net/uploads/big/117738b626616be71935763965293c79.png)
> Define the job you've submitted an application for. This is a cornerstone step in Job Save as all other elements are tied up to the job you define. So you should give as many details as possible and re-confirm the accuracy of the information provided.
___
#### Applications
![Application](http://albums.c1st.net/uploads/big/d9c5cd88b07eecabd33880b46e316089.png)
> Give details about you're submitted application: upon applying for a new job, start filling out the application section. The goal is to ultimately have records of all the different positions you've been applying for.
___
#### Interviews
![Interview](http://albums.c1st.net/uploads/big/1c3c9b5c589afb0291681ffe5c0cd70a.png)
> Enter information about your job interviews: if you get confirmed for an interview, create a new record with details about your upcoming interview. And once the interview has been conducted, you can come back to this form to enter your notes (if desired).
___
#### Overview
![Overview](http://albums.c1st.net/uploads/big/edffd0c30ce0cd8177c2d28a8baf483f.png)
> All the information from the different sections are merged to highlight important summary pertaining to your job search presented in a concise overview.
___


### Disclaimer
Job Save is still a work in progress and in active testing. We offer no active support and we do not guarantee the stability of the code so be cautious not to use Job Save in production as things may not work as smooth as intended.

### Setup Instructions
```
Job Save requires Laravel v5.5 (not tested with other versions).
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
* (optional) In the same .env you need to set the following values if you would like to take advantage of the notification component
~~~
    MAIL_DRIVER=
    MAIL_HOST=
    MAIL_PORT=
    MAIL_USERNAME=
    MAIL_PASSWORD=
    MAIL_ENCRYPTION=
    MAIL_FROM_ADDRESS=
    MAIL_FROM_NAME=
~~~
* Run the following artisan command to generate an application key
~~~
    php artisan key:generate
~~~
* Run all migrations to create and populate the database tables
~~~
    php artisan migrate --seed
~~~
* For using the local driver for storage
~~~
    php artisan storage:link
~~~

### Security Vulnerabilities
If you discover a security vulnerability within jobsave.io, please send us an email to Simon at sb@itproserve.com.

### Interested in helping
This project has just begun with many more new features to be added soon. If you are a coder or someone with an idea for enhancement, we welcome your contributions to help improve this project.

### Roadmap
1. Using Laravel Task Scheduling to update the status of a job (and the associated submitted Application) to `Closed` after 30 days from the submission date.
2. Use image manipulation for oversized images.
3. Use Google map to point to the Employer and Job locations.
4. Add a new section for keeping records of professional references.
5. CRUD for all of the Lookup Tables
6. Create a forum for community support

### Maintainers & Contributors
- Simon Bashir (Developer)
- Jordan Bashir (UAT - brief work as a tester)
- Ayleen Bashir (Designer - only logo design)

### License
The project is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
