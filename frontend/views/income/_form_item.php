<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\select2\Select2;

/**
 * @var $model \common\models\IncomeItem
 * @var $income_id \common\models\Income::id
 */
?>

<?php $form = ActiveForm::begin(['action' => Url::to(['create-item']), 'method' => 'post']) ?>
<?= $form->field($model, 'income_id')->textInput(['hidden' => true,'value'=>$income_id])->label(false) ?>
<div class="row">
    <div class="col-md-4">
        <?= $form->field($model, 'product_id')->widget(Select2::className(), [
            'data' => \yii\helpers\ArrayHelper::map(\common\models\Products::find()->all(), 'id', 'info'),
            'language' => 'ru',
            'options' => ['placeholder' => 'Выберите изделие']
        ]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'count')->textInput(['type' => 'number']) ?>
    </div>
    <div class="col-md-4 mt-4">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success w-100']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
