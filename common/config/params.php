<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'user.passwordResetTokenExpire' => 3600,
    'user.passwordMinLength' => 6,


    'rate_status' => [
        0 => 'Нынешний курс',
        1 => 'Старый курс'
    ],
    'secure_status' => [
        'check' => function () {
            if (Yii::$app->user->isGuest) {
                return false;
            } else {
                return true;
            }
        }
    ],
    'user_status' => [
        10 => 'Активный',
        9 => 'Отключённый'
    ],
    'user_role' => [
        0 => 'Администратор',
        1 => 'Офис'
    ],
    'client_type' => [
        0 => 'Физ.лицо',
        1 => 'Юр.лицо'
    ],
    'client_status' => [
        0 => 'Активный',
        1 => 'Неактивный'
    ]
];
