<?php use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['action' => \yii\helpers\Url::to(['create-phone'])]) ?>

<?= $form->field($model, 'client_id')->textInput(['hidden' => true, 'value' => $client_id])->label(false) ?>
    <div class="row">
        <div class="col-md-5">
            <?= $form->field($model, 'phone')->textInput(['type' => 'number']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'content')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3 mt-4">
            <?= Html::submitButton('Добавить', ['class' => 'btn btn-success w-100']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>