<?php

use common\models\Products;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\ProductsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Изделия';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">
    <div class="row">
        <div class="col-md-8">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-4">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Добавить
            </button>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Добавить</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?php echo $this->render('_form', ['model' => new Products()]); ?>
            </div>
        </div>
    </div>


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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'code',
            [
                'attribute' => 'gold_type_id',
                'value' => function ($data) {
                    return $data->type->name;
                }
            ],
            [
                'attribute' => 'created',
                'value' => function ($data) {
                    return date('d.m.Y', $data->created);
                }
            ],
            //'status',
            //'updated',
            //'is_deleted',
            //'deleted_time:datetime',
            //'deleted_user_id',

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Products $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'template'=>'{delete}'
            ],
        ],
    ]); ?>


</div>
