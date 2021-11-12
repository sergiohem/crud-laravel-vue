# CRUD Laravel/VueJS

- O projeto tem como implementação um CRUD de Pessoas, utilizando PHP/Laravel para o desenvolvimento do backend e VueJS para o desenvolvimento do frontend;
- Para autenticação de usuários, foi utilizado o [JWT](https://jwt.io/) (JSON Web Token);
- O banco de dados escolhido foi o MySQL.

## Aplicação Backend

Abra a pasta "backend" deste repositório no terminal e siga os passos abaixo:

#### 1) Instalação do Composer

1.1) Baixe e instale o Composer (https://getcomposer.org/download/) em sua máquina, caso ainda não tenha instalado.

1.2) Na pasta raiz do projeto execute o seguinte comando:
    
    composer install
   
Este comando adicionará todos os pacotes presentes no projeto.

1.3) Referente ao pacote JWT (https://jwt-auth.readthedocs.io/en/docs/) instalado para este projeto, pode ser que se faça necessária a publicação de seu provider, caso após a primeira execução do projeto ocorra algum erro. Se for necessária, execute o seguinte comando:

    php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
    
#### 2) Configurando o arquivo .env

2.1) Utilize o arquivo .env.example presente na pasta raiz do projeto e o replique criando seu arquivo .env

    cp .env.example .env
    
2.2) Altere as configurações de banco de dados no seu arquivo .env criado, com as credenciais do seu banco.

    DB_CONNECTION=mysql
    DB_HOST={SUBSTITUA PELO HOST}
    DB_PORT={SUBSTITUA PELA PORTA}
    DB_DATABASE={SUBSTITUA PELO SCHEMA}
    DB_USERNAME={SUBSTITUA PELO USUÁRIO}
    DB_PASSWORD={SUBSTITUA PELA SENHA}
    
2.4) Execute o comando a seguir para gerar a chave secreta do JWT no arquivo .env:
        
    php artisan jwt:secret
    
#### 3) Configurando o banco de dados

3.1) O banco de dados utilizado para o projeto é o MySQL. Crie um schema no seu gerenciador de preferência para que ele receba as tabelas que serão geradas no próximo item (lembre-se de utilizar o mesmo nome que definiu no arquivo .env).
3.2) Como o schema criado, execute o seguinte comando para gerar as tabelas:

    php artisan migrate
    
3.3) Com as tabelas geradas, execute o seguinte comando para inserir registros pré-cadastrados pelos seeders:

    php artisan db:seed
    
3.4) O usuário padrão que será criado pelo seeder "UsersSeeder" tem as seguintes credenciais:
    
    - email: admin@teste.com
    - password: 123456
    
#### 4) Executando o projeto

4.1) Para executar o projeto em seu ambiente local, execute o comando a seguir:

    php artisan serve
    
Por padrão, a API será executada em http://localhost:8000. Caso queira alterar a porta, execute o comando a seguir:

    php artisan serve --port {SUBSTITUA PELA PORTA DESEJADA}
    
## Aplicação Frontend

Abra a pasta "frontend" deste repositório no terminal e siga os passos abaixo:

#### 5) Instalando pacotes NPM

5.1) Execute o seguinte comando para instalar todas as dependências do frontend:

    npm install

#### 6) Executando o projeto

6.1) Para executar o projeto em seu ambiente local, execute o comando a seguir:

    npm run serve
