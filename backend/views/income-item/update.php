<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\IncomeItem $model */

$this->title = 'Update Income Item: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Income Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="income-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
