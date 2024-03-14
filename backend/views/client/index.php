<?php

use common\models\Clients;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\ClientsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Клиенты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clients-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

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
            [
                'attribute' => 'created',
                'value' => function ($data) {
                    return date('d.m.Y', $data->created);
                }
            ],
            /*[
                'attribute' => 'updated',
                'value' => function ($data) {
                    return date('d.m.Y', $data->updated);
                }
            ],*/
            //'status',
            [
                'attribute' => 'client_type_id',
                'value' => function ($data) {
                    return Yii::$app->params['client_type'][$data->client_type_id];
                },

            ],
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
    ]); ?>


</div>
