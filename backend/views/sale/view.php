<?php

use common\models\SaleItem;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Sale $model */

$this->title = 'Заказ № ' . $model->id . ' от ' . date('d.m.Y', $model->created);
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="orders-view">
    <div class="row">
        <div class="col-md-4">
            <h2><?= Html::encode($this->title) ?></h2>
        </div>
        <div class="col-md-8 text-end">
            <div class="btn-group">
                <?php
                if ($model->status == 1):
                    ?>
                    <a href="<?= Url::to(['status', 'id' => $model->token, 'status' => 2]) ?>" class="btn btn-success" data-method="post" data-confirm="Подтвердите действие!!!">
                        Завершить
                    </a>
                <?php
                endif;
                ?>
                <a href="<?= Url::to(['update', 'id' => $model->token]) ?>" class="btn btn-primary">
                    <i class="bi bi-pencil"></i> Редактировать
                </a>
                <a href="<?= Url::to(['delete', 'id' => $model->token]) ?>" class="btn btn-danger">
                    <i class="bi bi-trash"></i> Удалить
                </a>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <table class="table-bordered table-sm table">
                <tr>
                    <th class="table-secondary">Клиент:</th>
                    <td>
                        Дониёр Юсупов
                        <a class="btn btn-sm btn-primary"
                           href="<?= Url::to(['client/view', 'id' => $model->client->token]) ?>">
                            <i class="bi bi-person"></i>
                        </a>
                    </td>
                    <th class="table-secondary">
                        Пользователь:
                    </th>
                    <td>
                        <?= $model->user->fullname ?>
                    </td>
                    <th class="table-secondary">
                        Дата обновления
                    </th>
                    <td>
                        <?= date('d.m.Y', $model->updated) ?>
                    </td>
                    <th class="table-secondary">
                        Статус
                    </th>
                    <td>
                        <span class="<?= Yii::$app->params['sale_status_badge'][$model->status] ?>">
                            <?= Yii::$app->params['sale_status'][$model->status] ?>
                        </span>
                    </td>
                </tr>
            </table>
        </div>
        <hr>
        <div class="col-md-12">
            <h2>Изделия</h2>
            <div class="row">
                <div class="col-md-12">
                    <?= $this->render('_form_item', ['model' => new SaleItem(), 'sale_id' => $model->id]) ?>
                </div>
                <hr class="mt-4">
                <div class="col-md-12">
                    <table class="table table-sm table-bordered table-striped text-center">
                        <thead>
                        <tr class="table-primary">
                            <th>#</th>
                            <th>Название товара</th>
                            <th>Цена</th>
                            <th>Вес</th>
                            <th>Итоговая сумма</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1;
                        $total_weight = 0;
                        $total_price = 0;
                        foreach ($items as $item): ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $item->product->info ?></td>
                                <td><?= Yii::$app->formatter->asDecimal($item->price, 0) ?> UZS</td>
                                <td><?= $item->weight ?> гр</td>
                                <td><?= Yii::$app->formatter->asDecimal($item->total_price, 0) ?> UZS</td>
                                <td>
                                    <?php if ($model->status == 0 or $model->status == 1) {
                                        echo Html::a('<i class="bi bi-trash"></i>', ['delete-item', 'id' => $item->id], ['class' => 'btn btn-sm btn-danger', 'data' => [
                                            'method' => 'post',
                                            'confirm' => 'Подтвердите действие!!!'
                                        ]]);
                                    } ?>
                                </td>
                            </tr>
                            <?php $total_weight += $item->weight;
                            $total_price += $item->total_price;
                            $i++; endforeach; ?>
                        <tr class="table-dark">
                            <th></th>
                            <th></th>
                            <th>Итого:</th>
                            <th><?= $total_weight ?> гр</th>
                            <th><?= Yii::$app->formatter->asDecimal($total_price, 0) ?> UZS</th>
                            <th></th>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>