<?php use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['action' => \yii\helpers\Url::to(['create-phone'])]) ?>
    <div class="row w-100">
        <?= $form->field($model, 'client_id')->textInput(['hidden' => true, 'value' => $client_id])->label(false) ?>
        <div class="col-md-12">
            <?= $form->field($model, 'phone')->textInput(['type' => 'number']) ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'content')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12 mt-4">
            <?= Html::submitButton('Добавить', ['class' => 'btn btn-success w-100']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>