# Service Publication Project with Laravel and Breeze

This is a web application that allows authenticated users to publish their services and establish a chat with interested parties. The application is built with Laravel, a popular PHP framework, and uses Blade for views and Breeze for user authentication.

## Installation

To install and run the application, follow these steps:

1. Clone this repository on your computer:

  git clone https://github.com/mpauher/services-chats.git

2. Install the PHP dependencies with Composer:

  composer install

3. Install the JavaScript dependencies with npm:

  npm install

4. Create a copy of the .env.example file and rename it to .env:

5. Generate a new application key:

  php artisan key:generate

6. Configure your database in the .env file:

  DB_DATABASE=your_database_name
  DB_USERNAME=your_database_username
  DB_PASSWORD=your_database_password

7. Run the database migrations:

  php artisan migrate 

8. Create a symbolic link between the public and storage directories by running the following command:

  php artisan storage:link

9. Start the development server and compile the JavaScript assets:

  npm run dev
  php artisan serve

9. Access the application in your web browser at http://localhost:8000.

## Usage

The application has a single type of user, registered users. To use the application, follow these steps:

1. Register as a new user from the registration page at http://localhost:8000/register.

2. Log in to your account from the login page at http://localhost:8000/login.

3. Publish your services from the user control panel at http://localhost:8000/service/new

4. Interested users can send a message to the service publisher from the service details page.

5. Publishers can reply to messages from the chat page.