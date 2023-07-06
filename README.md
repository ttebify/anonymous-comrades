# Anonymous Comrades

Anonymous Comrades is a Laravel-based API-secured anonymous chat platform developed for the Treblle API Security Hackathon. It aims to explore innovative techniques for ensuring privacy, anonymity, and secure communication in an anonymous chat application. Let's revolutionize the world of secure and confidential conversations together using Treblle 🥳!

## Technology Stack

The Anonymous Comrades project utilizes the following technologies:

-   Laravel: A powerful PHP framework for web application development.
-   MySQL: A popular open-source relational database management system.
-   Treblle: A comprehensive API monitoring and security platform.
<img width="500" alt="Screenshot 2023-07-06 at 12 30 59" src="https://github.com/ttebify/anonymous-comrades/assets/86431009/020a5712-aa7f-4421-bd19-48947dd47634">

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

## How to Run the Project with SSL Enabled

To run the project on your local development server with SSL enabled, you can utilize ngrok as a proxy server. Ngrok masks the localhost URL and provides a usable URL for your application.

Follow this steps:

1. Install ngrok:
   Go to https://ngrok.com/download and download the ngrok executable suitable for your operating system. Extract the ngrok executable to a folder on your computer.
2. Start your local development server:
   Open a terminal window and navigate to the root directory of your Laravel project. Initiate your local development server by running `php artisan serve` to start the server.
3. Start ngrok:
   Open another terminal window and navigate to the folder where you extracted the ngrok executable. Start ngrok by running the following command: `./ngrok http <port>`, where `<port>` is the port number your local development server is running on. For example, if you ran `php artisan serve`, the default port is 8000, so the command would be `./ngrok http 8000`. Ngrok will generate a unique URL for your local development server, which you can access from anywhere.
4. Use the ngrok URL to access your project:
   Once ngrok is running, you'll see a screen showing the ngrok URL and some information about the HTTP and HTTPS tunnels.
   Copy the HTTPS ngrok URL (or the HTTP URL if you don't need HTTPS) and paste it into your own Postman environment variable.

Ensure that you adjust the instructions according to your specific setup and requirements.

## Meet the Team

<a href="https://github.com/ttebify/anonymous-comrades/graphs/contributors">
<p>
    <img src="https://contrib.rocks/image?repo=ttebify/anonymous-comrades&anon=1" alt="A table of avatars from the project's contributors" />
</p>
</a>

## References:

Design and Requirements: [Link to Design and Requirements Document](https://docs.google.com/document/d/1bbuqOZqjE02jDvNPEOsTPYvvZo_jeWzAVkCGicUh7fU/edit?usp=sharing)

Postman Collection: [Link to Anonymous Comrades Postman Collection](https://documenter.getpostman.com/view/28339583/2s93zFWJhw)

## License

This project is licensed under the MIT License. Feel free to use and modify the codebase as per the terms of the license.

## Acknowledgments

We would like to express our gratitude to the Treblle team for organizing the API Security Hackathon and providing the opportunity to build innovative and secure APIs. Thank you for your support!
