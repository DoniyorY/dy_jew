<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\search\ClientsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="clients-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'fullname') ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'phone') ?>
        </div>
        <div class="col-md-2 mt-3">
            <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary w-100']) ?>
        </div>
        <div class="col-md-2 mt-3">
            <?= Html::a('Сбросить',['index'], ['class' => 'btn btn-outline-secondary w-100']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
