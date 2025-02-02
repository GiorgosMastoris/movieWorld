# Movie World

## Prerequisites
| Component | Version |
|--------------|---------|
| MariaDB      | 10.6    |
| PHP          | 8.3     |
| Node.js      | 18.19.1 |
| Composer     | 2.5.8   |
| npm          | 9.2     |
| Laravel      | 11.31   |

## Installation
Clone the Repository from [GitHub](https://github.com/GiorgosMastoris/movieWorld).

```bash
git clone https://github.com/GiorgosMastoris/movieWorld.git
cd movieWorld
```

Run composer install in the root project directory to install PHP dependencies.

```bash
composer install
```

Ensure Node version with  [`nvm`]('https://github.com/nvm-sh/nvm'), and install Node.js dependencies.

```bash
nvm install 18 & nvm use 18 & npm install
```

## Configuration
Create a `.env` copy from `.env.example` file, run `php artisan key:generate` to fill the `APP_KEY` variable and proceed to the following modifications.


### 1. Database setup
Create a new database on your system and modify `.env` file with the creandentials.

```diff
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
+DB_DATABASE=
+DB_USERNAME=
+DB_PASSWORD=
```

## Run Locally
### 1. Run Vite Development Server
Run the development server via the `dev` command, while developing locally.
```bash
npm run dev
```

Or, `npm run build` to bundle your application's assets.

```bash
php artisan storage:link
```

### 2. Migrate Database
Run the database migrations.
```bash
php artisan migrate
```

### 3. Seed Database
If needed, you can add dummy data to the database.
```bash
php artisan db:seed
```

### 4. 🚀
Run the development server using `artisan`.
```bash
php artisan serve
```
