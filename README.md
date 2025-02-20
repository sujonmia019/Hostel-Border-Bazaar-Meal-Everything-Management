# Project: Task Management System

## Project Description
The Task Management System is a web application that allows users to manage their tasks efficiently. It includes features for user authentication, task creation, updating, deletion, and filtering. Users can filter tasks by status (e.g., Pending, In Progress, Completed) and sort them by due date.

## Features
- **Register, Login, and Logout**
- **Task Create, Read, Update, and Delete tasks**
- **Filter tasks by status (Pending, In Progress, Completed)**
- **Sort tasks by due date**
- **Task Board List from Create, Update**
- **Task Create, Update Form Validation Using**
- **Task List Server-Side Datatable Uses**
- **Fully functional UI optimized for desktop**

## Database
Database Design Schema <a href="https://drawsql.app/teams/instructory/diagrams/tast-management-system" target="_blank">Click</a>

## API Documentation 
#### Open Postman
Download or browser login and install Postman if you don’t already have it.

please check email **recritment@cloudcore.com.sa** for API Documentation

## Task GUI
- **1. Login**
<img src="https://myolbd.com/image/login.png" width="100%">

- **2. Register**
<img src="https://myolbd.com/image/register.png" width="100%">

- **3. Profile/Password Update**
<img src="https://myolbd.com/image/profile.png" width="100%">

- **4. Task List With Filter**
<img src="https://myolbd.com/image/task-list.png" width="100%">

- **5. Add Task**
<img src="https://myolbd.com/image/create-task.png" width="100%">

- **6. Edit/Update Task**
<img src="https://myolbd.com/image/edit-update-task.png" width="100%">

- **7. Delete Task**
<img src="https://myolbd.com/image/delete-task.png" width="100%">

- **8. Task Board View**
<img src="https://myolbd.com/image/task-board.png" width="100%">

- **9. Task Board Create**
<img src="https://myolbd.com/image/board-add-task.png" width="100%">

- **10. Task Board Update**
<img src="https://myolbd.com/image/board-edit-task.png" width="100%">

## Tech Stack
- **PHP**: 8.2
- **Backend Framework**: Laravel 10x
- **Frontend**: Blade templates (or Javascript/jQuery if applicable)
- **Database**: MySQL
- **Authentication**: Laravel UI Auth
- **Deployment**: Localhost or any hosting platform supporting PHP and Laravel

## Installation Instructions
1. Clone the repository:

   ```bash
    git clone https://github.com/sujonmia019/Task-Management-System.git

2. Navigate to the project directory

    ```bash
    cd Task-Management-System

3. Install dependencies using Composer

    ```bash
    composer install

4. Copy the .env.example file to .env

    ```bash
    cp .env.example .env

5. Generate the application key

    ```bash
    php artisan key:generate

6. Set up your database connection in the .env file

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_user
    DB_PASSWORD=your_database_password

7. Run the migrations with user seeding

    ```bash
    php artisan migrate:fresh --seed

8. Run the migrations without seeding

    ```bash
    php artisan migrate

9. If user profile update with showing

    ```bash
    php artisan storage:link

10. Start the development server

    ```bash
    php artisan serve

## License
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).



