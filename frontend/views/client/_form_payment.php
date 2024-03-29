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
    <div class="row m-0 border-0" >
        <div class="col-md-8 d-none" id="uzs-input" style="padding-left: 0;">
            <?= $form->field($model, 'amount')->textInput(['type' => 'number']) ?>
        </div>
        <div class="col-md-8 d-none" id="gld-input" style="padding-left: 0;">
            <?= $form->field($model, 'gld_weight')->textInput(['type' => 'number', 'step' => '0.01'])->label('Вес') ?>
        </div>
        <div class="col-md-4 p-0">
            <?= $form->field($model, 'rate_amount')->textInput(['type' => 'number', 'value' => 0])->label('Курс лома') ?>
        </div>
    </div>
    <div class="col-md-12 mt-2">
        <?= $form->field($model, 'content')->textInput(['value'=>'-']) ?>
    </div>
    <div class="col-md-12 mt-2">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success w-100']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
<script>
    let input = document.getElementById('uzs-input')
    let input1 = document.getElementById('gld-input')
    console.log(input)
    function kovrik(i) {
        if (i == '2') {
            input.className = 'd-none';
            input1.className = 'col-md-8';

        } else {
            input1.className = 'd-none';
            input.className = 'col-md-8';

        }
    }

</script>