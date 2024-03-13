<?php

use common\models\SRequestItem;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\search\SRequestItemSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Список изделий';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="srequest-item-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            's_request_id',
            [
                'attribute' => 'product_id',
                'value' => function ($data) {
                    return $data->product->info;
                }
            ],
            [
                'attribute' => 'gold_type_id',
                'value' => function ($data) {
                    return $data->type->name;
                }
            ],
            'count',
            //'status',
            //'created',
            'content',
            /*[
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, SRequestItem $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],*/
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
