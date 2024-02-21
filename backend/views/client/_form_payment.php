<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<?php $form = ActiveForm::begin(['action' => Url::to(['make-payment']), 'method' => 'post']); ?>
<div class="row">
    <div class="col-md-12">
        <?= $form->field($model, 'amount')->textInput() ?>
        <?= $form->field($model, 'rate_amount')->textInput() ?>
        <?= $form->field($model, 'content')->textInput() ?>
        <?= $form->field($model, 'method_id')->radioList(Yii::$app->params['payment_method']) ?>
        <?= $form->field($model, 'amount_type')->dropDownList(Yii::$app->params['amount_type']) ?>
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success w-100']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
