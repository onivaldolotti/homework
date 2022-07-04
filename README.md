# homework

## Executando o projeto

1. Na pasta raiz executar os seguintes comandos

    - ```composer install```

    - ```docker-compose build && docker-compose up -d```

2. Comando necessario durante o desenvolvimento para dar permissão ao laravel

    - ```docker-compose exec php chmod -R 777 /var/www/html/storage```

3. Usando sua ferramenta favorita acesse o banco de dados:

    - host: 127.0.0.1/localhost

    - user: teste

    - senha:123456

    - port:4306 (alterada da padrão 3306 para evitar conflitos)

    - Dentro da ferramenta crie um database chamada de homework. Ou pode importar o arquivo db.sql.

4. Comando para executar o banco de dados

    - ```docker-compose exec php php /var/www/html/artisan migrate```

5. A aplicação será executada em:

    - http://localhost:8090

6. Para executar os teste use o seguinte comando:

    - ```docker-compose exec php php /var/www/html/artisan test```
