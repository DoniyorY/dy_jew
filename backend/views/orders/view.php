<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Orders $model */

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
                        <span class="badge bg-success">
                            <?= Yii::$app->params['order_status'][$model->status] ?>
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
