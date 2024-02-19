<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Sale $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">

        <?= $form->field($model, 'client_id')->widget(Select2::classname(), [
            'data' => \yii\helpers\ArrayHelper::map(\common\models\Clients::findAll(['is_deleted'=>0]),'id','fullname'),
            'language' => 'ru',
            'options' => ['placeholder' => 'Выберите клиента'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

        <?= $form->field($model, 'content')->textInput(['maxlength' => true]) ?>

        <div class="form-group mt-2">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
