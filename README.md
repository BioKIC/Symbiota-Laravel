<p align="center">
    <a href="https://symbiota.org/" target="_blank">
        <img width="500px" src="https://github.com/user-attachments/assets/94a3507e-675f-4fe8-8504-12a567f268e9" />
    </a>
</p>

![testing workflow](https://github.com/BioKIC/Symbiota-Laravel/actions/workflows/laravel.yml/badge.svg)
[![License: GPL v2](https://img.shields.io/badge/License-GPL_v2-blue.svg)](https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html)

## Notice
This is a heavlity WIP Progress Repo and not ready for Production uses yet.

## Intial Setup
### Native 
1. Install PHP with minimum version of 8.2. If you cannot get PHP 8.2 on your machine consider using docker or another container solution.
2. Enable php extensions `curl`, `iconv`, `mysqli`, `pdo_mysql`, `zip`
3. Install Composer
4. Run `composer install`
5. Install npm
6. Run `npm install && npm run build` to install the necessary packages and prepare the javascript and css
7. Setup the require `.env` variables following [Laravel Installation Documenation](https://laravel.com/docs/11.x/installation#environment-based-configuration)
8. To run locally for development use `php artisan serve`

### Docker / Sail
1. Install docker and docker-compose
2. Setup the require `.env` variables following [Laravel Installation Documenation](https://laravel.com/docs/11.x/installation#environment-based-configuration)
3. If you want to use `sail` then follow [Laravel Sail Documentation](https://laravel.com/docs/11.x/sail) skip the dev install step (it is already installed)
4. If you want to use base docker then you will need to setup your own docker compose file as of now a supported configuration is in the works.

## Integrating with Current Symbiota
1. Copy or Clone [BioKIC/Symbiota](https://github.com/BioKIC/Symbiota) into repo
2. Add `PORTAL_NAME=` to your `.env` file and give it the name of the folder you just created
3. Setup the rest of the `.env` to connect `DB` secrets to match your symbiota config
4. Test by Navigating to a no laravel page like `sitemap` on the navbar

#### Note: Moving portal into Laravel's public folder will not make use of any of laravel's features. This step is just a means to slowly port the project in a non blocking fashion. 

## Pages Running Laravel
- [x] Media Search
- [x] Login | Registration
