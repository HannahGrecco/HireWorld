# HireWorld

System developed with Laravel to help companies expand internationally and hire professionals in other countries.

The project aims to generate reports with relevant information about different countries, including:
- local labor laws
- national holidays
- average market salary
- hiring and contract models
- currency and exchange rates
- workplace cultural insights

## Status

🚧 Project under development.

Currently, the system includes:
- country import using Seeders
- database storage
- country search by name
- search autocomplete
- Blade interface with TailwindCSS

## Technologies

- Laravel
- PHP
- Blade
- TailwindCSS
- MySQL

## Running the project

```bash
composer install
npm install
php artisan migrate
php artisan db:seed
npm run dev
php artisan serve
