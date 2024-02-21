<?php

use common\models\Payment;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\PaymentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Касса';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'client_id',
                'value' => function ($data) {
                    return $data->client->name;
                }
            ],
            [
                'attribute' => 'created',
                'value' => function ($data) {
                    return date('d.m.Y', $data->created);
                }
            ],
            [
                'attribute' => 'amount',
                'value' => function ($data) {
                    return Yii::$app->formatter->asDecimal($data->amount, 0);
                }
            ],
            [
                'attribute' => 'rate_amount',
                'value' => function ($data) {
                    return Yii::$app->formatter->asDecimal($data->rate_amount,0) . ' ( '. date('d.m.Y',$data->rate_date) . ' ) ';
                }
            ],
            'method_id',
            //'payment_type',
            'content',
            //'token',
            //'is_deleted',
            //'deleted_user_id',
            //'deleted_time:datetime',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Payment $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
