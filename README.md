# Setup Laravel

1. > cp .env.example .env
2. > composer install
3. > ./scripts/fresh.sh
4. copy Client ID:2 and Client Secret to .env file
```
PASSPORT_CLIENT_ID=2
PASSPORT_CLIENT_SECRET=DdH27rrhA9avk5XS5JdfdaMWyFm3UIMqBNwRjcTj
```

# Setup Vue

> npm install

# Compile Vue

> npm run dev


# Laradock

```
PHP_VERSION=7.3
MYSQL_VERSION=latest
```

#### Replace these files inside laradock

```
> cp ./scripts/laradock/nginx/sites/app.conf ./laradock/nginx/sites/app.conf
> cp ./scripts/laradock/laravel-echo-server/package.json ./laradock/laravel-echo-server/package.json
> cp ./scripts/laradock/laravel-echo-server/laravel-echo-server.json ./laradock/laravel-echo-server/laravel-echo-server.json
```

#### Run

> docker-compose up -d mysql nginx redis laravel-echo-server
