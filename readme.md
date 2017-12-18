# Project Management System

V 1.0

Project Management System based on Larvel 5.5.* and Vue.js :)

## Features
    -   Clients Management
    -   Projects Management
    -   Tasks Management
    -   Task Conversations
    -   Role / Permissions based actions

## Todos
    - [ ] Notifications.
    - [ ] Role and Permissions customization UI.
    - [ ] Migrate to Vue( such as model popups, forms, Datatable and etc ).
    - [ ] Charts.
    - [ ] Project Time Handling.
    - [ ] Co-workers and their permissions.

## Get Involved
    -   Clone or fork the project.
    -   Create feature branches off develop branch.
    -   Once your changes are ready create a pull request into the master branch.

## Installation
    -   Clone the repo
    -   Copy .env.example to .env
    -   Set values in .env file
    -   Run `composer install`
    -   Run `php artisan key:generate`
    -   Run `php artisan migrate`
    -   Run `php artisan db:seed`
    -   Run `npm install`
    -   Run `npm run dev`
    -   Start developing!

## Notes
    If you run `php artisan db:seed` it will create a one default user and five status ( `draft,open,ongoing,close,cancel.` ). These Details are stored in `DatabaseSeeder.php` class.
    By Default
    - **User Name** : Admin
    - **Email Address** : admin@pms.com
    - **Password** : admin

    Configurations are stored in `config/pms.php` file.
    