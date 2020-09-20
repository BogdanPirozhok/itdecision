<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        DB::table('roles')->insert([
            [
                'name'    => 'dev',
                'access'  => 'frontend',
                'stacks'  => '[1]'
            ],[
                'name'    => 'dev',
                'access'  => 'backend',
                'stacks'  => '[2]'
            ],[
                'name'    => 'dev',
                'access'  => 'fullstack',
                'stacks'  => '[1, 2]'
            ],[
                'name'    => 'admin',
                'access'  => '',
                'stacks'  => null
            ],[
                'name'    => 'pm',
                'access'  => '',
                'stacks'  => null
            ],[
                'name'    => 'sales',
                'access'  => '',
                'stacks'  => null
            ]
        ]);

        DB::table('users')->insert([
            'name'  => 'bogdan.pirozhok',
            'email' => 'bogdan.pirozhok@gmail.com',
            'role'  => 3,
            'password' => bcrypt('41esunit')
        ]);

        DB::table('stacks')->insert([
            [
                'name' => 'frontend'
            ],[
                'name' => 'backend'
            ]
        ]);

        DB::table('projects')->insert([
            [
                'name' => 'Landing Page'
            ],[
                'name' => 'Интернет магазин'
            ],[
                'name' => 'Блог'
            ],[
                'name' => 'WEB APP'
            ]
        ]);

        DB::table('categories')->insert([
            [
                'name' => 'Элементы интерфейса'
            ],[
                'name' => 'Работа с данными'
            ],[
                'name' => 'Функциональные модули'
            ]
        ]);

        $tasks = [
            [
                'name' => 'Слайдер контента',
                'categories' => 1,
                'projects' => [1, 2, 3, 4],
                'stacks' => [1]
            ],[
                'name' => 'Слайдер "карусель"',
                'categories' => 1,
                'projects' => [1, 2, 3, 4],
                'stacks' => [1]
            ],[
                'name' => 'Навигация со вложенностью',
                'categories' => 1,
                'projects' => [1, 2, 3, 4],
                'stacks' => [1]
            ],[
                'name' => 'Динамический контент',
                'categories' => 1,
                'projects' => [1, 2, 3, 4],
                'stacks' => [1, 2]
            ],[
                'name' => 'Галерея',
                'categories' => 1,
                'projects' => [1, 2, 3, 4],
                'stacks' => [1]
            ],[
                'name' => 'Акардеон',
                'categories' => 1,
                'projects' => [1, 2, 3, 4],
                'stacks' => [1]
            ],[
                'name' => 'Табуляция',
                'categories' => 1,
                'projects' => [1, 2, 3, 4],
                'stacks' => [1]
            ],[
                'name' => 'График',
                'categories' => 1,
                'projects' => [1, 2, 3, 4],
                'stacks' => [1]
            ],[
                'name' => 'Таймер',
                'categories' => 1,
                'projects' => [1, 2, 3, 4],
                'stacks' => [1]
            ],[
                'name' => 'Калькулятор стоимости',
                'categories' => 1,
                'projects' => [1, 2, 3, 4],
                'stacks' => [1, 2]
            ],[
                'name' => 'Карты',
                'categories' => 1,
                'projects' => [1, 2, 3, 4],
                'stacks' => [1]
            ],[
                'name' => 'Автоподсказки',
                'categories' => 1,
                'projects' => [1, 2, 3, 4],
                'stacks' => [1, 2]
            ],[
                'name' => 'Anchor',
                'categories' => 1,
                'projects' => [1, 2, 3, 4],
                'stacks' => [1]
            ],[
                'name' => 'Confirm',
                'categories' => 1,
                'projects' => [1, 2, 3, 4],
                'stacks' => [1]
            ],[
                'name' => 'Alert',
                'categories' => 1,
                'projects' => [1, 2, 3, 4],
                'stacks' => [1]
            ],[
                'name' => 'Tooltip',
                'categories' => 1,
                'projects' => [1, 2, 3, 4],
                'stacks' => [1]
            ],[
                'name' => 'Поиск',
                'categories' => 2,
                'projects' => [1, 2, 3, 4],
                'stacks' => [1, 2]
            ],[
                'name' => 'Фильтр',
                'categories' => 2,
                'projects' => [1, 2, 3, 4],
                'stacks' => [1, 2]
            ],[
                'name' => 'Сортировка',
                'categories' => 2,
                'projects' => [1, 2, 3, 4],
                'stacks' => [1, 2]
            ],[
                'name' => 'Пагинация "пейджер"',
                'categories' => 2,
                'projects' => [1, 2, 3, 4],
                'stacks' => [1, 2]
            ],[
                'name' => 'Пагинация "бесконечный скролл"',
                'categories' => 2,
                'projects' => [1, 2, 3, 4],
                'stacks' => [1, 2]
            ],[
                'name' => 'Конвертация едениц',
                'categories' => 2,
                'projects' => [1, 2, 3, 4],
                'stacks' => [1, 2]
            ],[
                'name' => 'Мультиязычность',
                'categories' => 2,
                'projects' => [1, 2, 3, 4],
                'stacks' => [1, 2]
            ],[
                'name' => 'Загрузка файлов',
                'categories' => 2,
                'projects' => [1, 2, 3, 4],
                'stacks' => [1, 2]
            ],[
                'name' => 'Обработка изображений',
                'categories' => 2,
                'projects' => [1, 2, 3, 4],
                'stacks' => [1, 2]
            ],[
                'name' => 'Обработка запросов с сохранением данных',
                'categories' => 2,
                'projects' => [1, 2, 3, 4],
                'stacks' => [2]
            ],[
                'name' => 'Валидация запросов',
                'categories' => 2,
                'projects' => [1, 2, 3, 4],
                'stacks' => [1, 2]
            ],[
                'name' => 'Обработка ответов',
                'categories' => 2,
                'projects' => [1, 2, 3, 4],
                'stacks' => [1]
            ],[
                'name' => 'Отправка сообщения на E-mail',
                'categories' => 2,
                'projects' => [1, 2, 3, 4],
                'stacks' => [2]
            ],[
                'name' => 'Отправка файла на E-mail',
                'categories' => 2,
                'projects' => [1, 2, 3, 4],
                'stacks' => [2]
            ],[
                'name' => 'Отправка сообщение в Telegram',
                'categories' => 2,
                'projects' => [1, 2, 3, 4],
                'stacks' => [2]
            ],[
                'name' => 'Отправка файла в Telegram',
                'categories' => 2,
                'projects' => [1, 2, 3, 4],
                'stacks' => [2]
            ],[
                'name' => 'Корзина',
                'categories' => 3,
                'projects' => [2],
                'stacks' => [1, 2]
            ],[
                'name' => 'Отзывы',
                'categories' => 3,
                'projects' => [1, 2, 3],
                'stacks' => [1, 2]
            ],[
                'name' => 'Блок "вопрос ответ"',
                'categories' => 3,
                'projects' => [1, 2, 3, 4],
                'stacks' => [1, 2]
            ],[
                'name' => 'Избранное',
                'categories' => 3,
                'projects' => [2, 3, 4],
                'stacks' => [1, 2]
            ],[
                'name' => 'Сравнение',
                'categories' => 3,
                'projects' => [2, 4],
                'stacks' => [1, 2]
            ],[
                'name' => 'Блок "схожие данные"',
                'categories' => 3,
                'projects' => [2, 3, 4],
                'stacks' => [2]
            ],[
                'name' => 'История заявок',
                'categories' => 3,
                'projects' => [2, 4],
                'stacks' => [1, 2]
            ],[
                'name' => 'Список заявок',
                'categories' => 3,
                'projects' => [1, 2, 3, 4],
                'stacks' => [1, 2]
            ],[
                'name' => 'Регистрация + Авторизация + Восстановление пароля',
                'categories' => 3,
                'projects' => [2, 3, 4],
                'stacks' => [1, 2]
            ],[
                'name' => 'Туториал',
                'categories' => 3,
                'projects' => [1, 2, 3, 4],
                'stacks' => [1, 2]
            ],[
                'name' => 'Квиз',
                'categories' => 3,
                'projects' => [1, 2, 3],
                'stacks' => [1, 2]
            ]
        ];

        foreach ( $tasks as &$item) {
            $item['projects'] = json_encode($item['projects'], JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
            $item['stacks'] = json_encode($item['stacks'], JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
        }

        DB::table('tasks')->insert($tasks);
    }
}
