Поднятие проекта
#Dev

* docker-compose up -d - Создание и поднятие контейнеров в демоне
* Внутри php контейнера composer install, устанавливает зависимост
* mv .env.example .env
* php artisan key:generate
* Возможно для unix-систем понадобится chmod 777 -R /application внутри пхп контейнера
* Работает на http://localhost:8080
