
# Teste Laravel/Vue Onfly

Este é um projeto de teste da Onfly desenvolvido em Laravel e Vue.js com o framework Quasar

## Backend

Renomeie o arquivo .env.exemple para .env e configure o banco de dados:

`DB_CONNECTION=mysql`
`DB_HOST=127.0.0.1`
`DB_PORT=3306`
`DB_DATABASE=db`
`DB_USERNAME=root`
`DB_PASSWORD=`

Para realizar a configurações da API em Laravel rode os seguintes comandos na pasta **/api**

```bash
  composer install
  php artisan migrate
  php artisan db:seed --class=UserSeeder
```

Após a instalação inicial rode os seguintes comandos para iniciar a aplicação e a fila

```bash
  php -S localhost:8000
  php artisan queue:listen --timeout=0 --tries=1
```

O comando *seeder* irá criar um usuário padrão para testes com as seguintes credenciais:

Email: teste@onfly.com.br

Senha: 123456

## Frontend

Para realizar a configurações da API em Laravel rode os seguintes comandos na pasta **/front**

```bash
  npm install
```

Após a instalação inicial rode o comando:

```bash
  quasar dev
```

## Testes unitários

Foram implementados alguns testes unitários para executá-los rode o comando:

```bash
  php ./vendor/bin/phpunit
```
    
## Funcionalidades implementadas

- Login
- CRUD de despesas

## Autor

- Fernando Rodrigues [@nandorodpires](https://github.com/nandorodpires)

