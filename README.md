# HireWorld

Sistema desenvolvido em Laravel para auxiliar empresas na expansão internacional e contratação de profissionais em outros países.

O projeto tem como objetivo gerar relatórios com informações relevantes sobre diferentes países, incluindo:
- leis trabalhistas locais
- feriados nacionais
- salário médio de mercado
- formas de contratação
- moeda e câmbio
- aspectos culturais do ambiente de trabalho

## Status

🚧 Projeto em desenvolvimento.

Atualmente o sistema possui:
- importação de países via Seeder
- armazenamento em banco de dados
- busca de países por nome
- autocomplete de pesquisa
- interface Blade com TailwindCSS

## Tecnologias utilizadas

- Laravel
- PHP
- Blade
- TailwindCSS
- MySQL

## Como executar

```bash
composer install
npm install
php artisan migrate
php artisan db:seed
npm run dev
php artisan serve
