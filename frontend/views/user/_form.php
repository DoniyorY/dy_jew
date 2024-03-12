<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['action'=>\yii\helpers\Url::to(['user/create'])]); ?>
    <div class="modal-body">

        <?=$form->field($model,'fullname')->textInput()?>

        <?=$form->field($model,'username')->textInput()?>

        <?=$form->field($model,'password')->passwordInput()?>

        <?=$form->field($model,'role_id')->dropDownList(Yii::$app->params['user_role'],['prompt'=>'Роли'])?>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
        <button type="submit" class="btn btn-primary">Добавить</button>
    </div>

    <?php ActiveForm::end(); ?>

</div>
