**Создание моделей и миграций**

`php artisan make:model Models/BlogCategory -m`

`php artisan make:model Models/BlogPost -m`

**Создание seeds**

`php artisan make:seeder UserTableSeeder`

`php artisan make:seeder BlogCategoriesTableSeeder`

**Запуск seeds**

`php artisan db:seed`

`php artisan db:seed --class=UserTableSeeder`

`php artisan migrate:refresh --seed`

**Создание фабрик**

**Миграции**

`Откат php artisan migrate:rollback`

`Перезапуск php artisan migrate:refresh`

**Создание связи**

`$table->foreign('столбец')->references('поле в связываемой таблице')->on('таблица');`