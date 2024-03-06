<?php

use common\models\SaleItem;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Clients $model */

$this->title = $model->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Клиенты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="clients-view">
    <div class="row">
        <div class="col-md-4">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-4 text-center mt-2">
            <button type="button" class="btn btn-success w-100" data-bs-toggle="modal"
                    data-bs-target="#clientBalanceModal">
                <i class="bi bi-cash-stack"></i> Баланс: <?= Yii::$app->formatter->asDecimal($model->balance, 0) ?> UZS
            </button>
        </div>
        <div class="col-md-4 text-end mt-2">
            <div class="btn-group">
                <a href="<?= \yii\helpers\Url::to(['update', 'id' => $model->token]) ?>" class="btn btn-primary">
                    <i class="bi bi-pencil"></i> Редактировать
                </a>
                <a href="<?= \yii\helpers\Url::to(['delete', 'id' => $model->token]) ?>" class="btn btn-danger"
                   data-method="post" data-confirm="Вы точно хотите удалить этого клиента??">
                    Удалить <i class="bi bi-trash"></i>
                </a>
            </div>

        </div>
        <div class="col-md-5 mt-4">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-client-info" data-bs-toggle="tab"
                            data-bs-target="#client-info" type="button" role="tab" aria-controls="client-info"
                            aria-selected="true">Информация
                    </button>
                    <button class="nav-link" id="client-phone-tab" data-bs-toggle="tab" data-bs-target="#client-phone"
                            type="button" role="tab" aria-controls="client-phone" aria-selected="false">Дополнительные
                        номера
                    </button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="client-info" role="tabpanel"
                     aria-labelledby="nav-client-info" tabindex="0">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            //'id',
                            'fullname',
                            'phone',
                            [
                                'attribute' => 'balance',
                                'value' => function ($data) {
                                    return Yii::$app->formatter->asDecimal($data->balance, 0) . ' UZS';
                                }
                            ],
                            [
                                'attribute' => 'created',
                                'value' => function ($data) {
                                    return date('d.m.Y H:i', $data->created);
                                }
                            ],
                            [
                                'attribute' => 'updated',
                                'value' => function ($data) {
                                    return date('d.m.Y H:i', $data->updated);
                                }
                            ],
                            [
                                'attribute' => 'status',
                                'value' => function ($data) {
                                    return Yii::$app->params['client_status'][$data->status];
                                }
                            ],
                            [
                                'attribute' => 'client_type_id',
                                'value' => function ($data) {
                                    return Yii::$app->params['client_type'][$data->client_type_id];
                                }
                            ],
                            //'token',
                            //'is_deleted',
                            //'deleted_time:datetime',
                            //'deleted_user_id',
                        ],
                    ]) ?>
                </div>
                <div class="tab-pane p-1 fade" id="client-phone" role="tabpanel" aria-labelledby="client-phone-tab"
                     tabindex="0">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Дополнительные номера</h4>
                        </div>
                        <div class="col-md-6">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#createAdditionalPhone">
                                Добавить номер <i class="bi bi-plus-square"></i>
                            </button>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="desktop-table">
                            <div class="col-md-12 mt-3 d-none d-md-block">
                                <table class="table table-sm table-bordered table-striped align-items-center">
                                    <thead>
                                    <th>#</th>
                                    <th>Номер телефона</th>
                                    <th>Примечание</th>
                                    <th>Дата создания</th>
                                    <th></th>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1;
                                    foreach ($phone as $item): ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $item->phone ?></td>
                                            <td><?= $item->content ?></td>
                                            <td><?= date('d.m.Y', $item->created) ?></td>
                                            <td>
                                                <a href="<?= \yii\helpers\Url::to(['delete-phone', 'id' => $item->id]) ?>"
                                                   class="btn btn-danger btn-sm" data-method="post"
                                                   data-confirm="Подтвердите действие">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php $i++; endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="mobile-table d-block d-md-none">
                            <table class="table table-sm table-bordered table-striped align-items-center">
                                <thead>
                                <th>#</th>
                                <th>Номер телефона</th>
                                <th>Примечание</th>
                                <th></th>
                                </thead>
                                <tbody>
                                <?php $i = 1;
                                foreach ($phone as $item): ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $item->phone ?></td>
                                        <td><?= $item->content ?></td>
                                        <td>
                                            <a href="<?= \yii\helpers\Url::to(['delete-phone', 'id' => $item->id]) ?>"
                                               class="btn btn-danger btn-sm" data-method="post"
                                               data-confirm="Подтвердите действие">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php $i++; endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-7 pt-3 pl-5">
            <div class="row">
                <div class="col-md-9">
                    <h4>История заказов</h4>
                </div>
                <div class="col-md-3">
                    <a href="<?= Url::to(['sale/create', 'id' => $model->token]) ?>"
                       class="btn btn-success w-100" data-method="post" data-confirm="Подтвердите действие">
                        Создать заказ <i class="bi bi-plus-square"></i>
                    </a>
                </div>
            </div>
            <?php foreach ($sales as $item): ?>
                <div class="card text-center mt-1">
                    <div class="card-header">
                        <ul class="nav nav-pills card-header-pills justify-content-between">
                            <li class="nav-item">
                                <a href="<?= Url::to(['sale/view', 'id' => $item->token]) ?>" target="_blank"
                                   class="btn btn-primary btn-sm">
                                    <i class="bi bi-journal-text"></i> Заказ № <?= $item->id ?>
                                    от <?= date('d.m.Y', $item->created) ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <div class="<?= Yii::$app->params['sale_status_badge'][$item->status] ?>">
                                    <?= Yii::$app->params['sale_status'][$item->status] ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="desktop-table d-none d-md-block">
                        <div class="card-body pb-1">
                            <table class="table-bordered table-sm table-striped table">
                                <thead>
                                <tr class="table-primary">
                                    <th>#</th>
                                    <th>Наименование товара</th>
                                    <th>Сумма за грамм</th>
                                    <th>Вес</th>
                                    <th>Итого</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1;
                                $sale_items = SaleItem::findAll(['sale_id' => $item->id]);
                                $weight = 0;
                                $total = 0;
                                foreach ($sale_items as $val):?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $val->product->name . ' ( ' . $val->product->type->name . ' ) ' ?></td>
                                        <td><?= Yii::$app->formatter->asDecimal($val->price, 0) ?> UZS</td>
                                        <td><?= $val->weight ?> гр</td>
                                        <td><?= Yii::$app->formatter->asDecimal($val->total_price, 0) ?> UZS</td>
                                    </tr>
                                    <?php $i++;
                                    $weight += $val->weight;
                                    $total += $val->total_price; endforeach; ?>
                                <tr class="table-dark">
                                    <th></th>
                                    <th>Итого</th>
                                    <th></th>
                                    <th><?= $weight ?> гр</th>
                                    <th><?= Yii::$app->formatter->asDecimal($total, 0) ?> UZS</th>
                                </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <div class="mobile-table d-block d-md-none">
                        <div class="card-body pb-1">
                            <table class="table-bordered table-sm table-striped table">
                                <thead>
                                <tr class="table-primary">
                                    <th>#</th>
                                    <th>Изделие</th>

                                    <th>Итого</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1;
                                $sale_items = SaleItem::findAll(['sale_id' => $item->id]);
                                $weight = 0;
                                $total = 0;
                                foreach ($sale_items as $val):?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $val->product->name . ' ( ' . $val->product->type->name . ' ) ' ?></td>
                                        <td><?= Yii::$app->formatter->asDecimal($val->total_price, 0) ?> UZS</td>
                                    </tr>
                                    <?php $i++;
                                    $weight += $val->weight;
                                    $total += $val->total_price; endforeach; ?>
                                <tr class="table-dark">
                                    <th></th>
                                    <th>Итого</th>
                                    <th><?= Yii::$app->formatter->asDecimal($total, 0) ?> UZS</th>
                                </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <hr>
        <div class="col-md-12">
            <h4>История оплат <i class="bi bi-hourglass-split"></i></h4>
            <div class="desktop-table d-none d-md-block">
                <table class="table table-sm table-bordered table-striped text-center">
                    <thead>
                    <tr class="table-warning">
                        <th>#</th>
                        <th>Дата создания</th>
                        <th>Сумма</th>
                        <th>Курс</th>
                        <th>Метод</th>
                        <th>Примечание</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1;
                    $total = 0;
                    foreach ($payment as $item): ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= date('d.m.Y', $item->created) ?></td>
                            <td><?= Yii::$app->formatter->asDecimal($item->amount, 0) ?> <?= Yii::$app->params['amount_type'][$item->amount_type] ?></td>
                            <td><?= Yii::$app->formatter->asDecimal($item->rate_amount, 0) ?> UZS</td>
                            <td><?= Yii::$app->params['payment_method'][$item->method_id] ?></td>
                            <td><?= $item->content ?></td>
                        </tr>
                        <?php $i++;
                        $total += $item->amount; endforeach; ?>

                    <tr class="table-dark">
                        <th></th>
                        <th>Итого</th>
                        <th><?= Yii::$app->formatter->asDecimal($total, 0) ?> UZS</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="mobile-table d-block d-md-none">
                <table class="table table-sm table-bordered table-striped text-center">
                    <thead>
                    <tr class="table-warning">
                        <th>#</th>
                        <th>Дата создания</th>
                        <th>Сумма</th>
                        <th>Курс</th>
                        <th>Примечание</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1;
                    $total = 0;
                    foreach ($payment as $item): ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= date('d.m.Y', $item->created) ?></td>
                            <td><?= Yii::$app->formatter->asDecimal($item->amount, 0) ?> <?= Yii::$app->params['amount_type'][$item->amount_type] ?></td>
                            <td><?= Yii::$app->formatter->asDecimal($item->rate_amount, 0) ?> UZS</td>
                            <td></td>
                        </tr>
                        <?php $i++;
                        $total += $item->amount; endforeach; ?>

                    <tr class="table-dark">
                        <th></th>
                        <th>Итого</th>
                        <th><?= Yii::$app->formatter->asDecimal($total, 0) ?> UZS</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="clientBalanceModal" tabindex="-1" aria-labelledby="clientBalanceModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="clientBalanceModalLabel">Пополнить баланс</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= $this->render('_form_payment', ['model' => new \common\models\Payment(), 'client_id' => $model->id]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="createAdditionalPhone" tabindex="-1" aria-labelledby="createAdditionalPhoneLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createAdditionalPhoneLabel">Новый номер</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= $this->render('_phone_form', ['model' => new \common\models\ClientPhone(), 'client_id' => $model->id]) ?>
            </div>
        </div>
    </div>
</div>