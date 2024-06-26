Lesson Schedule System
This project is a lesson scheduling system built using Laravel and designed with the AdminLte theme. The system supports four types of users: Admin, Faculty Member, Department Head, and Guest/Student. Each user role has specific functionalities and access levels.

Features
Admin: Can create and manage units, departments, classes, and courses. Can also create and manage lesson schedules.
Department Head: Can create and manage lesson schedules.
Faculty Member: Can view their own lesson schedule.
Guest/Student: Can view their own lesson schedule and the overall lesson schedule.
Installation
Follow these steps to set up the project on your local machine.

Prerequisites
PHP >= 7.4
Composer
Laravel
MySQL
Step-by-Step Guide

Clone the repository:
git clone [https://github.com/yourusername/lesson-schedule-system.git](https://github.com/musttoprak/Lesson-Schedule-System.git)
cd DersProgrami

Install dependencies:
composer install

Configure the .env file:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password

Generate the application key:
php artisan key:generate

Run the database migrations:
php artisan migrate

Serve the application:
php artisan serve

AdminLte Theme
The project utilizes the AdminLte theme located in the public/tema/AdminLte directory for the design and layout of the admin panel and user interfaces.

Contributing
Contributions are welcome! Please fork the repository and submit a pull request for review.
