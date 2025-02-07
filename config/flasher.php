<?php // config/flasher.php

return [
    'plugins' => [
        'toastr' => [
            'scripts' => [
                '/vendor/flasher/jquery.min.js',
                '/vendor/flasher/toastr.min.js',
                '/vendor/flasher/flasher-toastr.min.js',
            ],
            'styles' => [
                '/vendor/flasher/toastr.min.css',
            ],
            'options' => [
                'positionClass' => 'toast-top-right', // Centrar la alerta
                'timeOut' => 10000, // Tiempo en milisegundos (10 segundos)
                'extendedTimeOut' => 5000, // Tiempo adicional si el usuario interactúa
                'closeButton' => true, // Mostrar botón de cerrar
                'progressBar' => true, // Mostrar barra de progreso
            ],
        ],
    ],
];
