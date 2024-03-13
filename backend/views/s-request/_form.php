<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\SRequest $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="srequest-form">
    <?php $form = ActiveForm::begin(['action'=>Url::to('create')]); ?>
    <div class="modal-body">
        <?= $form->field($model, 'client_id')->widget(\kartik\select2\Select2::className(), [
            'data' => \yii\helpers\ArrayHelper::map(\common\models\Clients::findAll(['status' => 0]), 'id', 'fullname'),
            'language'=>'ru',
            'options'=>[
                    'placeholder'=>'Выберите клиента'
            ]
        ]) ?>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>
    <?php ActiveForm::end(); ?>

</div>
