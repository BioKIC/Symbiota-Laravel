<p align="center">
    <a href="https://symbiota.org/" target="_blank">
        <img width="500px" src="https://github.com/user-attachments/assets/94a3507e-675f-4fe8-8504-12a567f268e9" />
    </a>
</p>

![testing workflow](https://github.com/BioKIC/Symbiota-Laravel/actions/workflows/laravel.yml/badge.svg)
[![License: GPL v2](https://img.shields.io/badge/License-GPL_v2-blue.svg)](https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html)

WIP Test Repo to port Symbiota over to the [Laravel Framework](https://laravel.com/) to make use of its rich feature set.

## Integrating with Current Symbiota
1. Copy or Clone [BioKIC/Symbiota](https://github.com/BioKIC/Symbiota) into repo
2. Add `PORTAL_NAME=` to your `.env` file and give it the name of the folder you just created
3. Setup the rest of the `.env` to connect `DB` secrets

#### Note: Moving portal into Laravel's public folder will not make use of any of laravel's features. This step is just a means to slowly port the project in a non blocking fashion. 

## Pages Running Laravel
- [x] Media Search
