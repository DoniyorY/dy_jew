<?php

use common\models\CurrencyRate;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\CurrencyRateSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Курс';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="currency-rate-index">
    <div class="row">
        <div class="col-md-8">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-4">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Новый курс
            </button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Новый курс</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <?= $this->render('_form', ['model' => new CurrencyRate()]) ?>
                </div>
            </div>
        </div>
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'rowOptions' => function ($model) {
            if ($model->status == 0) {
                return ['class' => 'table-success'];
            } else {
                return ['class' => 'table-danger'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'created',
                'value' => function ($data) {
                    return date('d.m.Y', $data->created);
                }
            ],
            [
                'attribute' => 'updated',
                'value' => function ($data) {
                    if ($data->updated == 0) {
                        return 'Активный';
                    } else {
                        return date('d.m.Y', $data->updated);
                    }
                }
            ],
            [
                'attribute' => 'amount',
                'value' => function ($data) {
                    return Yii::$app->formatter->asDecimal($data->amount, 0) . ' UZS';
                }
            ],
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    return Yii::$app->params['rate_status'][$data->status];
                }
            ],
            /*[
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, CurrencyRate $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],*/
        ],
    ]); ?>


</div>
