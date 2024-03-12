<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'user.passwordResetTokenExpire' => 3600,
    'user.passwordMinLength' => 6,
    'bsVersion' => '5.x',

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
    ],
    'sale_status' => [
        0 => 'Новый',
        1 => 'В оформлении',
        2 => 'Активный',
        3 => 'Завершенный'
    ],
    'sale_status_badge' => [
        0 => 'badge bg-warning',
        1 => 'badge bg-secondary',
        2 => 'badge bg-primary',
        3 => 'badge bg-success'
    ],
    'amount_type' => [
        0 => 'UZS',
        1 => 'USD',
    ],
    'payment_method' => [
        0 => 'Наличные',
        1 => 'Карта'
    ],
    'payment_type' => [
        0 => 'Приход',
        1 => 'Расход'
    ],
    'payment_type_badge' => [
        0 => '<span class="badge text-bg-success w-100">Приход <i class="bi bi-arrow-down-square"></i></span>',
        1 => '<span class="badge text-bg-danger w-100">Расход <i class="bi bi-arrow-up-square"></i></span>',
    ],
    'income_status' => [
        0 => '<span class="badge text-bg-warning">Созданно</span>',
        1 => '<span class="badge text-bg-success">Завершен</span>',
    ],
    'request_status' => [
        0 => 'в Оформлении',
        1 => 'Подтвержден'
    ],
    'request_status_class' => [
        0 => 'badge text-bg-secondary',
        1 => 'badge text-bg-success',
    ]
];
