<?php

return [

    'API_KEY' => env('MAILTRAP_API_TOKEN', null),
    'FROM_ADDRESS' => env('MAIL_FROM_ADDRESS', null),
    'FROM_NAME' => env('MAIL_FROM_NAME', config('app.name')),
];