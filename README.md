# MFO
## Описание
___
    REST API для управления займами. 
    Реализованы следующие API методы:
    POST api/loans — создание нового займа.
      {
        "borrower_name":"string|max:20",
        "borrow_volume":"integer",
        "borrow_date":"date",
        "monthly_payment":"integer",
      }
    GET api/loans/{id} — получение информации о займе.
    PUT api/loans/{id} — обновление информации о займе.
        {
        "borrower_name":"string|max:20",
        "borrow_volume":"integer",
        "borrow_date":"date",
        "monthly_payment":"integer",
        }
    DELETE api/loans/{id} — удаление займа.
    GET api/loans — получение списка всех займов.
___
## Устанвока
___
### Docker
    Вся среда разработки собрана в Docker.
    Перед тем как начать, убедитесь, что у вас установлен Docker. Вы можете скачать 
    Docker с официального сайта [Docker](https://www.docker.com/get-started).

### Проверка установки Docker
___
    Для проверки, установлен ли Docker, выполните следующую команду в терминале:
```bash
    docker --version
```
    Если Docker установлен правильно, вы увидите сообщение с версией Docker, например:
    Docker version 20.10.7, build f0df350
___
### Запуск
___
    1. Клонируйте репозиторий 
    2. Соберите контейнеры Docker
```bash
    make build
```
    3.Проверьте статус контейнеров
    
```bash
    make status
``` 
    Eсли контейнеры запущены правильно, вы увидите сообщение с информацией о контейнерах, например:
    mfo-php-1           mfo-php       "docker-php-entrypoi…"   php           13 hours ago   Up 13 hours   0.0.0.0:8000->8000/tcp, 9000/tcp
    mfo-postgres_db-1   postgres:16   "docker-entrypoint.s…"   postgres_db   13 hours ago   Up 13 hours   0.0.0.0:5432->5432/tcp

    4. Установите и обновите все зависимости composer (В контейнере PHP)
```bash
    docker compose exec php bash 
    make composer
```
    5. В корневой дирриктории проекта создайте файл .env и скопируйте туда содержимое .env.example
    6. Выполните миграцию
```bash
    docker compose exec php bash 
    make migrate
```
    После выполнения миграции вы можете отправить запросы на сервер
    !!!Сервер по умолчанию http://localhost:8000, он запускает автоматически при запуске контейнера с PHP.
    Если Вы хотите поменять его, то вам необходимо изменить его в docker/php/Dockerfile и в docker-compose.yaml!!!

    7. Запуски тестов
```bash
    docker compose exec php bash 
    make test 
```

