<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Clients $model */

$this->title = $model->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Клиент', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="clients-view">
    <div class="row">
        <div class="col-md-4">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-4 text-center mt-2">
            <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#clientBalanceModal">
                <i class="bi bi-cash-stack"></i> Баланс: <?= Yii::$app->formatter->asDecimal($model->balance, 0) ?>
            </button>
        </div>
        <div class="col-md-4 text-end mt-2">
            <div class="btn-group">
                <a href="<?= \yii\helpers\Url::to(['update', 'id' => $model->token]) ?>" class="btn btn-primary">
                    <i class="bi bi-pencil"></i> Редактировать
                </a>
                <a href="<?=\yii\helpers\Url::to(['delete','id'=>$model->token])?>" class="btn btn-danger" data-method="post" data-confirm="Вы точно хотите удалить этого клиента??">
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
                    <h4>Добавить номер</h4>
                    <?= $this->render('_phone_form', ['model' => new \common\models\ClientPhone(), 'client_id' => $model->id]) ?>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 mt-3">
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
                </div>
            </div>

        </div>
        <div class="col-md-7 pt-3 pl-5">
            <h4>История заказов</h4>
            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills justify-content-between">
                        <li class="nav-item">
                             <a href="#" target="_blank" class="btn btn-primary btn-sm">
                                 <i class="bi bi-journal-text"></i> Заказ № 999 от 20.01.2024
                            </a>
                        </li>
                        <li class="nav-item">
                            <div class="badge bg-success">
                                Активный
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <table class="table-bordered table-sm table-striped table">
                        <thead>
                        <tr class="table-primary">
                            <th>#</th>
                            <th>Наименование товара</th>
                            <th>Сумма за грамм</th>
                            <th>Кол-во товаров</th>
                            <th>Вес</th>
                            <th>Итого</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>Куйма</td>
                            <td>300 000 uzs</td>
                            <td> 5 </td>
                            <td>27.3гр</td>
                            <td>20 000 000 uzs</td>
                        </tr>
                        <tr class="table-dark">
                            <th></th>
                            <th></th>
                            <th>Итого</th>
                            <th>5</th>
                            <th>27.3 гр</th>
                            <th>20 000 000 uzs</th>
                        </tr>
                        </tbody>

                    </table>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
        <hr>
        <div class="col-md-12">
            <h4>История оплат <i class="bi bi-hourglass-split"></i></h4>
            <table class="table table-sm table-bordered table-striped text-center">
                <thead>
                <tr class="table-warning">
                    <th>#</th>
                    <th>Дата создания</th>
                    <th>Сумма</th>
                    <th>Метод</th>
                    <th>Курс</th>
                    <th>Тип оплаты</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>20.01.2024</td>
                    <td>300 000 uzs</td>
                    <td>Приход</td>
                    <td>12 430 uzs</td>
                    <td>Не помню</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>20.01.2024</td>
                    <td>300 000 uzs</td>
                    <td>Приход</td>
                    <td>12 430 uzs</td>
                    <td>Не помню</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>20.01.2024</td>
                    <td>300 000 uzs</td>
                    <td>Приход</td>
                    <td>12 430 uzs</td>
                    <td>Не помню</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>20.01.2024</td>
                    <td>300 000 uzs</td>
                    <td>Приход</td>
                    <td>12 430 uzs</td>
                    <td>Не помню</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
                <tr class="table-dark">
                    <th></th>
                    <th>Итого</th>
                    <th>1 200 000 uzs</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="clientBalanceModal" tabindex="-1" aria-labelledby="clientBalanceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="clientBalanceModalLabel">Пополнить баланс</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
</div>
