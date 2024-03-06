<?php

use common\models\Payment;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\search\PaymentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Касса';
$this->params['breadcrumbs'][] = $this->title;
$total = $card + $cash;
$total_today = $today_card + $today_cash;
?>
<div class="payment-index">

    <div class="row">
        <div class="col-md-10">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-2 mb-2 mb-md-0">
            <button class="w-100 btn btn-warning" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Расход <i class="bi bi-arrow-up-square"></i>
            </button>
        </div>
        <div class="col-md-12 d-none d-md-block">
            <table class="table table-s table-bordered text-center">
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
        <div class="col-6 mb-3 mb-md-0 d-block d-md-none">
            <div class="row text-center">
                <div class="col-12 border">
                    Общая
                </div>
                <div class="col-6 border">
                    Наличные
                </div>
                <div class="col-6 border">
                    <?= Yii::$app->formatter->asDecimal($cash, 0) ?>
                </div>
                <div class="col-6 border">
                    Карта
                </div>
                <div class="col-6 border">
                    <?= Yii::$app->formatter->asDecimal($card, 0) ?>
                </div>
                <div class="col-6 border">
                    Итого
                </div>
                <div class="col-6 border">
                    <?= Yii::$app->formatter->asDecimal($total, 0) ?>
                </div>
            </div>
        </div>
        <div class="col-6 mb-3 mb-md-0 d-block d-md-none">
            <div class="row text-center">
                <div class="col-12 border">
                    Сегодня
                </div>
                <div class="col-6 border">
                    Наличные
                </div>
                <div class="col-6 border">
                    <?= ($today_cash)?Yii::$app->formatter->asDecimal($today_cash, 0):0 ?>
                </div>
                <div class="col-6 border">
                    Карта
                </div>
                <div class="col-6 border">
                    <?= ($today_card)?Yii::$app->formatter->asDecimal($today_card, 0):0 ?>
                </div>
                <div class="col-6 border">
                    Итого
                </div>
                <div class="col-6 border">
                    <?= Yii::$app->formatter->asDecimal($total_today, 0) ?>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="collapse" id="collapseExample">
                <div class="card card-body">
                    <?= $this->render('_form_outcome', ['model' => new Payment()]) ?>
                </div>
            </div>
        </div>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="d-none d-md-block">
        <?php
        Pjax::begin();
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'showFooter'=>true,
            'rowOptions'=>[
                'class'=>'text-center'
            ],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                [
                    'attribute' => 'client_id',
                    'value' => function ($data) {
                        if ($data->client_id == 0) {
                            return 'Не задано!!!';
                        } else {
                            return Html::a($data->client->fullname, ['client/view', 'id' => $data->client->token], ['class' => 'btn btn-sm btn-primary w-100']);
                        }
                    },
                    'format' => 'raw',
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
                        return Yii::$app->formatter->asDecimal($data->amount, 0);
                    },
                    'footer'=>Payment::getTotalCount($dataProvider->models, 'amount')
                ],
                [
                    'attribute' => 'amount_type',
                    'value' => function ($data) {
                        return Yii::$app->params['amount_type'][$data->amount_type];
                    },
                    'filter' => Yii::$app->params['amount_type']
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
                'content',
                //'token',
                //'is_deleted',
                //'deleted_user_id',
                //'deleted_time:datetime',
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, Payment $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->token]);
                    },
                    'template' => '{delete}'
                ],
            ],
        ]);
        Pjax::end();
        ?>
    </div>
    <div class="d-block d-md-none">
        <?php
        Pjax::begin();
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'showFooter'=>true,
            'rowOptions'=>[
                'class'=>'text-center'
            ],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                [
                    'attribute' => 'client_id',
                    'value' => function ($data) {
                        if ($data->client_id == 0) {
                            return 'Не задано!!!';
                        } else {
                            return Html::a($data->client->fullname, ['client/view', 'id' => $data->client->token], ['class' => 'btn btn-sm btn-primary w-100']);
                        }
                    },
                    'format' => 'raw',
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
                        return Yii::$app->formatter->asDecimal($data->amount, 0);
                    },
                    'footer'=>Payment::getTotalCount($dataProvider->models, 'amount')
                ],
                /*[
                    'attribute' => 'amount_type',
                    'value' => function ($data) {
                        return Yii::$app->params['amount_type'][$data->amount_type];
                    },
                    'filter' => Yii::$app->params['amount_type']
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
                ],*/
                //'content',
                //'token',
                //'is_deleted',
                //'deleted_user_id',
                //'deleted_time:datetime',
            ],
        ]);
        Pjax::end();
        ?>
    </div>


</div>
