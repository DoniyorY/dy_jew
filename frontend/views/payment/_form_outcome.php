<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<?php $form=ActiveForm::begin(['action'=>Url::to(['outcome'])])?>
<div class="row">
    <div class="col-md-1">
        <?=$form->field($model,'amount_type')->radioList(Yii::$app->params['amount_type'])?>
    </div>
    <div class="col-md-3">
        <?=$form->field($model,'amount')->textInput(['type'=>'number'])?>
    </div>
    <div class="col-md-2">
        <?=$form->field($model,'rate_amount')->textInput(['type'=>'number','value'=>0])?>
    </div>
    <div class="col-md-3">
        <?=$form->field($model,'content')->textInput(['value'=>'-'])?>
    </div>
    <div class="col-md-3 mt-4">
        <?=Html::submitButton('Сохранить',['class'=>'btn btn-success w-100'])?>
    </div>
</div>
<?php ActiveForm::end()?>
