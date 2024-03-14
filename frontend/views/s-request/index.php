<?php

use common\models\SRequest;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\SRequestSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Список заявок';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="srequest-index">
    <div class="row">
        <div class="col-md-10">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Новая заявка
            </button>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Новая заявка</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?= $this->render('_form', ['model' => new SRequest()]) ?>
            </div>
        </div>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'prevPageLabel' => '<span class="page-item">Пред</span>',
            'nextPageLabel' => '<span class="page-item">След</span>',
            'disabledPageCssClass' => 'page-link',
            'activePageCssClass' => 'page-item active',
            'maxButtonCount' => 5,
            'linkOptions' => ['class' => 'page-link'],
            'options' => [
                'tag' => 'ul',
                'class' => 'pagination',
                'style' => 'margin-left: 1px;'
            ],
        ],
        'rowOptions' => function ($data) {
            if ($data->status == 0) {
                return ['class' => 'table-secondary'];
            } else {
                return ['class' => 'table-success'];
            }
        },
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
                'attribute' => 'created',
                'value' => function ($data) {
                    return date('d.m.Y', $data->created);
                }
            ],
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    return Yii::$app->params['request_status'][$data->status];
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, SRequest $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'template' => '{view}'
            ],
        ],
    ]); ?>


</div>
