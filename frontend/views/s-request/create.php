<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\SRequest $model */

$this->title = 'Create S Request';
$this->params['breadcrumbs'][] = ['label' => 'S Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="srequest-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
