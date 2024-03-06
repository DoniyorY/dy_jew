<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\IncomeItem $model */

$this->title = 'Create Income Item';
$this->params['breadcrumbs'][] = ['label' => 'Income Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="income-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
