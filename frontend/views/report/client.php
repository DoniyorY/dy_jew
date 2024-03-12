<?php
/** @var yii\web\View $this */
/** @var common\models\search\ProductsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Отчёты клиентов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-10">
        <h1><?=$this->title?></h1>
    </div>
    <div class="col-md-2">
        <button type="button" class="btn btn-primary w-100"><i class="bi bi-printer"></i> Распечатать</button>
    </div>
    <div class="col-md-12">
        <table class="table table-sm table-bordered table-striped text-center">
            <thead>
            <th>#</th>
            <th>Клиент</th>
            <th>Изделие</th>
            <th>Вес</th>
            <th>Сумма за грамм</th>
            <th>Итого</th>
            </thead>
        </table>
    </div>
</div>
