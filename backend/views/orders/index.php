<?php

use common\models\Orders;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\OrdersSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'id',
                'value' => function ($data) {
                    return '№ ' . $data->id . ' от ' . date('d.m.Y', $data->created);
                },
            ],
            [
                'attribute' => 'client_id',
                'value' => function ($data) {
                    return $data->client->name;
                }
            ],
            [
                'attribute' => 'user_id',
                'value' => function ($data) {
                    return $data->user->fullname;
                }
            ],
            'total_amount',
            'content',
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    return Yii::$app->params['order_status'][$data->status];
                }
            ],
            //'token',
            //'is_deleted',
            //'deleted_user_id',
            //'deleted_time:datetime',

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Orders $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->token]);
                },
                'template' => '{view}'
            ],
        ],
    ]); ?>


</div>
