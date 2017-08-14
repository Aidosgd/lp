<?php

return [

    /*
     *	Relative path to admin panel
     */
    'uri' => 'admin',

    'middlewares' => ['web', 'admin_auth'],

    'pagination'  => 10,


    /*
     *	Логирование пользователей
     */
    'user_activity' => [

        /*
         *	Путь до моделей
         */
        'models_path' => app_path('Models'),

        /*
         *	Дополнительные модели для логирования
         */
        'additional_models' => [

        ],

        /*
         *	Модели, которые надо исключить из логирования
         */
        'excluded_models' => [

        ]
    ]
];