<?php

use common\models\Warehouse;
use yii\helpers\Html;
use kartik\select2\Select2;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\search\WarehouseSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Информация о складе';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'product_id',
                'value' => function ($data) {
                    return $data->product->name;
                },
                'filter' => Select2::widget([
                    'attribute' => 'product_id',
                    'name' => 'product_id',
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\Products::find()->all(), 'id', 'info'),
                    'options' => ['placeholder' => 'Выберите изделие . . .'],
                    'language' => 'ru',
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])
            ],
            [
                'attribute' => 'gold_type_id',
                'value' => function ($data) {
                    return $data->goldType->name;
                },
                'filter' => \yii\helpers\ArrayHelper::map(\common\models\GoldType::find()->all(), 'id', 'name')
            ],
            /*[
                'attribute' => 'updated',
                'value' => function ($data) {
                    return date('d.m.Y', $data->updated);
                }
            ],*/
            //'user_id',
            //'status',
            'count',
            /*[
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Warehouse $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],*/
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
