<?php

use common\models\Income;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\search\IncomeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Приходы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="income-index">
    <div class="row">
        <div class="col-md-9">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-3">
            <?= Html::a('Создать приход <i class="bi bi-plus-square"></i>', ['create'], ['class' => 'btn btn-success w-100', 'data' => [
                'method' => 'post',
                'confirm' => 'Подтвердите действие',
            ]]) ?>
        </div>
    </div>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'=>[
                'class'=>'text-center'
        ],
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
            [
                'attribute' => 'created',
                'value' => function ($data) {
                    return date('d.m.Y', $data->created);
                }
            ],
            [
                'attribute' => 'user_id',
                'value' => function ($data) {
                    return $data->user->fullname;
                },
                'filter'=>\yii\helpers\ArrayHelper::map(\common\models\User::findAll(['status'=>10]),'id','fullname')
            ],
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    return Yii::$app->params['income_status'][$data->status];
                },
                'filter' => [0=>'Создано',1=>'Завершено'],
                'format'=>'raw'
            ],
            //'total_amount',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Income $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->token]);
                },
                'template' => '{view}'
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
