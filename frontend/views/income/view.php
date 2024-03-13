<?php

use common\models\IncomeItem;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Income $model */
/** @var common\models\IncomeItem $items */

$this->title = 'Приход № ' . $model->id . " от " . date('d.m.Y', $model->created);
$this->params['breadcrumbs'][] = ['label' => 'Приходы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="income-view">
    <div class="row">
        <div class="col-md-8">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-4 text-end">
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <?php
                if ($model->status == 0) {
                    echo Html::a('<i class="bi bi-check-square"></i> Завершить', ['status', 'id' => $model->token, 'status' => 1], ['class' => 'btn btn-success', 'data' => [
                        'method' => 'post',
                        'confirm' => 'Подтвердите действие'
                    ]]);
                    echo Html::a('Удалить <i class="bi bi-trash"></i>', ['delete', 'id' => $model->token], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]);
                }
                if ($model->status == 1 and Yii::$app->user->identity->role_id == 0) {
                    echo Html::a('<i class="bi bi-arrow-counterclockwise"></i> Редактировать', ['status', 'id' => $model->token, 'status' => 0], ['class' => 'btn btn-primary','data-method'=>'post']);
                }
                ?>
            </div>
        </div>
    </div>
    <?php try {
        DetailView::widget([
            'model' => $model,
            'attributes' => [
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
                    }
                ],
                [
                    'attribute' => 'status',
                    'value' => function ($data) {
                        return Yii::$app->params['income_status'][$data->status];
                    },
                    'format' => 'html'
                ],
                //'total_amount',
            ],
        ]);
    } catch (Throwable $e) {
    } ?>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <h2>Изделия</h2>
        </div>
        <div class="col-md-12">
            <?= $this->render('_form_item', ['model' => new IncomeItem(), 'income_id' => $model->id]) ?>
        </div>
        <div class="col-md-12 mt-3">
            <table class="table table-sm table-bordered table-striped text-center">
                <thead>
                <tr class="table-primary">
                    <th>#</th>
                    <th>Изделие</th>
                    <th>Количество</th>
                    <th></th>
                </tr>
                <?php $i = 1;
                foreach ($items as $item): ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $item->product->info ?></td>
                        <td><?= $item->count ?></td>
                        <td>
                            <?php if ($model->status == 0): ?>
                                <a href="<?= Url::to(['delete-item', 'id' => $item->id]) ?>"
                                   class="btn btn-danger btn-sm" data-method="post" data-confirm="Подтвердите действие">
                                    <i class="bi bi-trash"></i>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php $i++; endforeach; ?>
                </thead>
            </table>
        </div>
    </div>
</div>
