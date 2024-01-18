<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\CurrencyRate $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="currency-rate-form">

    <?php $form = ActiveForm::begin(['action' => \yii\helpers\Url::to(['currency-rate/create'])]); ?>
    <div class="modal-body">
        <?= $form->field($model, 'amount')->textInput() ?>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>

    <?php ActiveForm::end(); ?>

</div>
