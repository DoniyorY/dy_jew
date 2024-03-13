<?php

use common\models\SRequestItem;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\SRequest $model */

$this->title = $model->client->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Спосок заявок', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="srequest-view">
    <div class="row">
        <div class="col-md-8">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-4">
            <?php
            if ($model->status == 0) {
                echo Html::a('Принять', ['status', 'id' => $model->id, 'status' => 1], [
                    'class' => 'btn btn-primary w-100',
                    'data' => [
                        'method' => 'post',
                    ]
                ]);
            } else {
                echo Html::a('Редактировать', ['status', 'id' => $model->id, 'status' => 0], [
                    'class' => 'btn btn-warning w-100',
                    'data' => [
                        'method' => 'post',
                    ]
                ]);
            }
            ?>
        </div>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
                    return '<span class="' . Yii::$app->params['request_status_class'][$data->status] . '">' . Yii::$app->params['request_status'][$data->status] . '</span>';
                },
                'format'=>'html'
            ],
        ],
    ]) ?>

    <hr>
    <div class="row">
        <div class="col-md-12">
            <h4>
                Изделия
            </h4>
            <?php if ($model->status == 0):
                $new_item = new SRequestItem();
                $form = ActiveForm::begin(['action' => \yii\helpers\Url::to(['create-item', 'id' => $model->id])]); ?>
                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($new_item, 'product_id')->widget(Select2::className(), [
                            'data' => \yii\helpers\ArrayHelper::map(\common\models\Warehouse::find()->all(), 'product_id', 'info'),
                            'language' => 'ru',
                            'options' => [
                                'placeholder' => 'Выберите изделие'
                            ]
                        ]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($new_item, 'count')->textInput(['type' => 'number']) ?>
                    </div>
                    <div class="mt-4 col-md-4">
                        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success w-100']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); endif; ?>
            <div class="mt-3">
                <table class="table table-sm table-bordered table-striped text-center">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Изделие</th>
                        <th>Количество</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1;
                    foreach ($items as $item): ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $item->product->info ?></td>
                            <td><?= $item->count ?></td>
                            <td>
                                <?php
                                if ($model->status == 0) {
                                    echo Html::a('Удалить', ['delete-item', 'id' => $item->id], [
                                        'class' => 'btn btn-sm btn-danger',
                                        'data' => [
                                            'method' => 'post',
                                            'conform' => 'Подтвердите действие!',
                                        ]
                                    ]);
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
