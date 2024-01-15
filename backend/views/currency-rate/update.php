<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CurrencyRate $model */

$this->title = 'Update Currency Rate: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Currency Rates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="currency-rate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
