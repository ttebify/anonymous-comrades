# Anonymous Comrades
Anonymous Comrades is a Laravel-based API-secured anonymous chat platform developed for the Treblle API Security Hackathon. It aims to explore innovative techniques for ensuring privacy, anonymity, and secure communication in an anonymous chat application. Let's revolutionize the world of secure and confidential conversations together using Treblle 🥳!

## Technology Stack
The Anonymous Comrades project utilizes the following technologies:

- Laravel: A powerful PHP framework for web application development.
- MySQL: A popular open-source relational database management system.
- Treblle: A comprehensive API monitoring and security platform.

## Getting Started
To spin up the Anonymous Comrades application locally, follow these steps:

1. Clone the repository:
    ```bash
    git clone https://github.com/ttebify/anonymous-comrades.git
    ```

2. Navigate to the project directory:
    ```bash
    cd anonymous-comrades
    ```

3. Install the dependencies using Composer:
    ```bash
    composer install
    ```

4. Create a copy of the .env.example file and rename it to .env. Update the necessary configuration values, such as the database connection details and Treblle API credentials.

5. Generate a new application key:
    ```bash
    php artisan key:generate
    ```

6. Run the database migrations and seed  the database:
    ```bash
    php artisan migrate:fresh --seed
    ```

7. Start the development server:
    ```bash
    php artisan serve
    ```

8. Open your web browser and visit `http://localhost:8000` to access the Anonymous Comrades application.

## Meet the Team
<a href="https://github.com/ttebify/anonymous-comrades/graphs/contributors" style="display: flex; align-items: center;">
<p>
  <img src="https://contrib.rocks/image?repo=ttebify/anonymous-comrades" alt="A table of avatars from the project's contributors" />
</p>
</a>

## License
This project is licensed under the MIT License. Feel free to use and modify the codebase as per the terms of the license.

## Acknowledgments
We would like to express our gratitude to the Treblle team for organizing the API Security Hackathon and providing the opportunity to build innovative and secure APIs. Thank you for your support!
