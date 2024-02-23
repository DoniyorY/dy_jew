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
$total = $card + $cash;
$total_today = $today_card + $today_cash;
?>
<div class="payment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-sm table-bordered text-center">
                <tr>
                    <th class="table-primary">Общая</th>
                    <th class="table-secondary"><i class="bi bi-cash"></i> Наличные:</th>
                    <td><?= Yii::$app->formatter->asDecimal($cash, 0) ?> UZS</td>
                    <th class="table-secondary"><i class="bi bi-credit-card"></i> Карта:</th>
                    <td><?= Yii::$app->formatter->asDecimal($card, 0) ?> UZS</td>
                    <th class="table-secondary"><i class="bi bi-cash-stack"></i> Итого:</th>
                    <td><?= Yii::$app->formatter->asDecimal($total, 0) ?> UZS</td>
                    <th>---</th>
                    <th class="table-warning">Сегодня</th>
                    <th class="table-secondary"><i class="bi bi-cash"></i> Наличные:</th>
                    <td><?= Yii::$app->formatter->asDecimal($today_cash, 0) ?> UZS</td>
                    <th class="table-secondary"><i class="bi bi-credit-card"></i> Карта:</th>
                    <td><?= Yii::$app->formatter->asDecimal($today_card, 0) ?> UZS</td>
                    <th class="table-secondary"><i class="bi bi-cash-stack"></i> Итого:</th>
                    <td><?= Yii::$app->formatter->asDecimal($total_today, 0) ?> UZS</td>
                </tr>
            </table>
        </div>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'client_id',
                'value' => function ($data) {
                    return $data->client->fullname;
                }
            ],
            [
                'attribute' => 'payment_type',
                'value' => function ($data) {
                    return Yii::$app->params['payment_type_badge'][$data->payment_type];
                },
                'format' => 'raw',
                'filter' => Yii::$app->params['payment_type'],
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
                    return Yii::$app->formatter->asDecimal($data->amount, 0) . ' UZS';
                }
            ],
            [
                'attribute' => 'rate_amount',
                'value' => function ($data) {
                    return Yii::$app->formatter->asDecimal($data->rate_amount, 0) . ' ( ' . date('d.m.Y', $data->rate_date) . ' ) ';
                }
            ],
            [
                'attribute' => 'method_id',
                'value' => function ($data) {
                    return Yii::$app->params['payment_method'][$data->method_id];
                },
                'format' => 'raw',
                'filter' => Yii::$app->params['payment_method']
            ],
            //'payment_type',
            'content',
            //'token',
            //'is_deleted',
            //'deleted_user_id',
            //'deleted_time:datetime',
        ],
    ]); ?>


</div>
