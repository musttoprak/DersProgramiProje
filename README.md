# Lesson Schedule System

This project is a lesson scheduling system built using Laravel and designed with the AdminLte theme. The system supports four types of users: Admin, Faculty Member, Department Head, and Guest/Student. Each user role has specific functionalities and access levels.

## Features

- **Admin**: Can create and manage units, departments, classes, and courses. Can also create and manage lesson schedules.
- **Department Head**: Can create and manage lesson schedules.
- **Faculty Member**: Can view their own lesson schedule.
- **Guest/Student**: Can view their own lesson schedule and the overall lesson schedule.

## Installation

Follow these steps to set up the project on your local machine.

### Prerequisites

- PHP >= 7.4
- Composer
- Laravel
- MySQL

### Step-by-Step Guide

1. **Clone the repository:**

    ```bash
    git clone https://github.com/musttoprak/Lesson-Schedule-System.git
    cd DersProgrami
    ```

2. **Install dependencies:**

    ```bash
    composer install
    ```

3. **Copy the `.env` file:**

    ```bash
    cp .env.example .env
    ```

4. **Configure the `.env` file:**

    Open the `.env` file and update the database configuration and other necessary settings.

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ```

5. **Generate the application key:**

    ```bash
    php artisan key:generate
    ```

6. **Run the database migrations:**

    ```bash
    php artisan migrate
    ```

7. **Serve the application:**

    ```bash
    php artisan serve
    ```

    The application will be accessible at `http://localhost:8000`.

## AdminLte Theme

The project utilizes the AdminLte theme located in the `public/tema/AdminLte` directory for the design and layout of the admin panel and user interfaces.

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request for review.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contact

For any questions or issues, please contact [musttoprakk@gmail.com](mailto:musttoprakk@gmail.com).
