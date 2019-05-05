**Создание REST контроллера**

`php artisan make:controller RestTestController --resource`

`php artisan route:list` посмотреть маршруты

**Контроллеры**

Базовый контроллер

`php artisan make:controller Blog\BaseController`

Контроллер статей

`php artisan make:controller Blog\PostController --resource`