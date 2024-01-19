<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Clients $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="clients-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'client_type_id')->dropDownList(Yii::$app->params['client_type'], ['prompt' => 'Тип клиента']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'type' => 'number']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'balance')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'address')->textInput() ?>
        </div>
        <div class="mt-2">
            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success w-100']) ?>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>