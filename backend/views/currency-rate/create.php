<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\CurrencyRate $model */

$this->title = 'Create Currency Rate';
$this->params['breadcrumbs'][] = ['label' => 'Currency Rates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="currency-rate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
