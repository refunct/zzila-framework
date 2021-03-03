<?php
return array(
    'name' => 'routes',
    'list' => array(
        array(

            /** 
             * Шаблон пути
             * например /to/path
             * или если нужен ID, то /to/path/(?P<id>[a-z0-9]{1,10})
             */
            'path' => '/',

            /** 
             * Имя страницы
             * Потребуется, например, для переводчка. {name}_title, {name}__description, {name}__keywords
             */
            'name' => 'start_page',

            /** 
             * Контроллер
             * namespase контроллера для обработки страницы
             */
            'controller' => App\Controllers\StartController::class,

            /** 
             * Метод класса контроллера
             */
            'method' => 'index',

            
            /** 
             * Mime тип страницы
             * @link https://developer.mozilla.org/ru/docs/Web/HTTP/Basics_of_HTTP/MIME_types
             */
            'mime' => 'text/html',

            /** 
             * Тип индексации роботами
             * @link https://developers.google.com/search/docs/advanced/robots/robots_meta_tag?hl=ru
             * @link https://yandex.ru/support/webmaster/controlling-robot/meta-robots.html
             */
            'robot' => 'all',

            /** 
             * Шаблон страницы
             * Используется для
             * /app/templates/{template}
             * /public/images/{template}
             * /public/scripts/{template}
             * /public/styles/{template}
             */
            'template' => 'default'
        )
    )
);
