<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Clients $model */

$this->title = 'Редактировать: ' . $model->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fullname, 'url' => ['view', 'id' => $model->token]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="clients-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
