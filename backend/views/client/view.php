<?php

use common\models\SaleItem;
use yii\helpers\Html;
use yii\helpers\Url;
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
        </div>
        <div class="col-md-4 text-end mt-2">
            <?php if(Yii::$app->user->identity->role_id == 0):?>
            <div class="btn-group">
                <a href="<?= \yii\helpers\Url::to(['update', 'id' => $model->token]) ?>" class="btn btn-primary">
                    <i class="bi bi-pencil"></i> Редактировать
                </a>
                <a href="<?= \yii\helpers\Url::to(['delete', 'id' => $model->token]) ?>" class="btn btn-danger"
                   data-method="post" data-confirm="Вы точно хотите удалить этого клиента??">
                    Удалить <i class="bi bi-trash"></i>
                </a>
            </div>
            <?php endif;?>
        </div>
        <div class="col-md-12 mt-4">
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
