<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\GoldType $model */

$this->title = 'Create Gold Type';
$this->params['breadcrumbs'][] = ['label' => 'Gold Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gold-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
