<?php

use common\models\Clients;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\search\ClientsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Клиенты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clients-index">
    <?php
    Pjax::begin()
    ?>
    <div class="row">
        <div class="col-6">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-6">
            <button class="btn btn-primary w-100" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
               Поиск <i class="bi bi-search"></i>
            </button>
        </div>
        <div class="col-12">
            <div class="collapse collapse-horizontal" id="collapseWidthExample">
                <?php echo $this->render('_search', ['model' => $searchModel]); ?>
            </div>
        </div>
    </div>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'fullname',
            'phone',
            /*[
                'attribute' => 'balance',
                'value' => function ($data) {
                    return Yii::$app->formatter->asDecimal($data->balance, 0) . ' uzs';
                }
            ],*/
            /*[
                'attribute' => 'created',
                'value' => function ($data) {
                    return date('d.m.Y', $data->created);
                }
            ],*/
            /*[
                'attribute' => 'updated',
                'value' => function ($data) {
                    return date('d.m.Y', $data->updated);
                }
            ],*/
            //'status',
            /*[
                'attribute' => 'client_type_id',
                'value' => function ($data) {
                    return Yii::$app->params['client_type'][$data->client_type_id];
                },

            ],*/
            //'token',
            //'is_deleted',
            //'deleted_time:datetime',
            //'deleted_user_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Clients $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->token]);
                },
                'template'=>'{view}'
            ],
        ],
    ]); Pjax::end() ?>


</div>
