<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<?php $form = ActiveForm::begin(['action' => Url::to(['make-payment']), 'method' => 'post']); ?>

<?php
echo $form->field($model, 'client_id')->textInput(['value' => $client_id, 'hidden' => true])->label(false);
?>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'method_id')->radioList(Yii::$app->params['payment_method']) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'amount_type')->radioList(Yii::$app->params['amount_type'])->label('Валюта') ?>
    </div>
    <div class="col-md-8">
        <?= $form->field($model, 'amount')->textInput() ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'rate_amount')->textInput() ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($model, 'content')->textInput() ?>
    </div>
    <div class="col-md-12 mt-2">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success w-100']) ?>

    </div>
</div>
<?php ActiveForm::end() ?>
