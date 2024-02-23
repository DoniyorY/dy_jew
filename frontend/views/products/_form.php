<?php

use common\models\GoldType;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Products $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="modal-body">
        <?= $form->field($model, 'gold_type_id')->dropDownList(\yii\helpers\ArrayHelper::map(GoldType::find()->all(), 'id', 'name'),['prompt'=>'Выберите тип золота']) ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'code')->textInput() ?>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>

    <?php ActiveForm::end(); ?>

</div>
