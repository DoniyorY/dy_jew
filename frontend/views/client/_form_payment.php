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
    <div class="col-md-12">
        <?= $form->field($model, 'amount_type')->dropDownList(Yii::$app->params['amount_type'], ['prompt' => 'Выберите способ оплаты', 'onclick' => 'kovrik(this.value)'])->label('Валюта') ?>
    </div>
    <div class="col-md-8">
        <?= $form->field($model, 'amount')->textInput(['type'=>'number']) ?>
    </div>
    <div class="col-md-4">
        <label for="payment-rate_amount" id="payment_label">Курс</label>
        <?= $form->field($model, 'rate_amount')->textInput(['type'=>'number','value'=>0])->label(false) ?>
        <?= $form->field($model, 'gld_weight')->textInput(['class' => 'd-none','type'=>'number','step'=>'0.01'])->label(false) ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($model, 'content')->textInput() ?>
    </div>
    <div class="col-md-12 mt-2">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success w-100']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
<script>
    let input = document.getElementById('payment-rate_amount')
    let input1 = document.getElementById('payment-gld_weight')
    let l=document.getElementById('payment_label')
    function kovrik(i) {
        if (i == '2') {
            input.className = 'd-none';
            input1.className = 'form-control';
            l.innerText='Вес лома'
        } else {
            input1.className = 'd-none';
            input.className = 'form-control';
            l.innerText='Курс'
        }
    }

</script>