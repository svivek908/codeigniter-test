Installation Steps
1. Clone the Repository
git clone https://github.com/svivek908/codeigniter-test.git
cd codeigniter-test
2. Install Dependencies
composer install
3. Setup Environment

Copy .env file:

cp env .env

Update .env:

CI_ENVIRONMENT = development
4. Database Configuration

Update database settings in .env or app/Config/Database.php:

'hostname' => 'localhost',
'username' => 'root',
'password' => '',
'database' => 'codeigniterdb',
'DBDriver' => 'MySQLi',
5. Create Database

Create database manually:

CREATE DATABASE codeigniterdb;
6. Run Migrations (if available)
php spark migrate
7. Start Development Server
php spark serve

Open in browser:

http://localhost:8080