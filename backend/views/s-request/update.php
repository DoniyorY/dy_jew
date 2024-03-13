<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SRequest $model */

$this->title = 'Update S Request: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'S Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="srequest-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
