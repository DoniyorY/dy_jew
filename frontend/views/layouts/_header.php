<?php

use yii\bootstrap5\Html;
$lang=yii::$app->language;
?>
<!--<form class="w-100" action="" method="post">
    <input class="form-control form-control-dark w-100" type="text" name="search"
           placeholder="<?php /*=Yii::$app->name*/?> " style="background: rgb(33, 37, 41) !important; color: #fff !important;" disabled aria-label="Search">
</form>-->
<div class="w-50" style="height: 55px;">
    <?=Yii::$app->name?>
</div>

<div class="navbar-nav">
    <div class="nav-item text-nowrap">
        <?php
        echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
            . Html::submitButton(
                ($lang=='ru')?'Выход':'Chiqish',
                ['class' => 'nav-link px-3', 'style' => 'background:none;outline:none;border:none;']
            )
            . Html::endForm();
        ?>
    </div>
</div>
