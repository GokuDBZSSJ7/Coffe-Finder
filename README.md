# ☕ Coffe-Finder - Backend

Este é o backend de um projeto fullstack que tem o objetivo de conectar pessoas com cafeterias locais. As cafeterias podem se cadastrar, listar produtos com apresentação, criar eventos e receber avaliações.

Já o usuário comum, podem explorar as cafeterias, favoritar as que estão guardadas no coração e deixar um feedback.

## 🛠️ Tecnologias Utilizadas

PHP+8 \
Laravel 11 \
MySQL \
Laravel Sanctum

## 🚀 Como Rodar o Projeto

1° - `git clone https://github.com/GokuDBZSSJ7/Coffe-Finder.git`

2° - `composer install`

3° - `cp .env.example .env`

4° - `php artisan key:generate`

5° - `php artisan serve`

## 💻​ Configurando o seu .env

1° - DB_DATABASE=dbname \
        DB_USERNAME=root \
        DB_PASSWORD=sua_senha

2° - `php artisan migrate`