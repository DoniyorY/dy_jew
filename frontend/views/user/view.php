<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\User $model */

$this->title = $model->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">
    <div class="row">
        <div class="col-md-8">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-4 text-end">
            <div class="btn-group">
                <?= Html::a('Сбросить пароль', ['reset-pass', 'id' => $model->id], [
                    'class' => 'btn btn-primary',
                    'data' => [
                        'confirm' => 'Подтвердите действие!',
                        'method' => 'post',
                    ]
                ]) ?>
                <?php
                if ($model->id != Yii::$app->user->id){
                    if ($model->status === 10) {
                        echo Html::a('Отключить', ['status', 'id' => $model->id, 'status' => 9], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Подтвердите действие!',
                                'method' => 'post',
                            ],
                        ]);
                    } else {
                        echo Html::a('Включить', ['status', 'id' => $model->id, 'status' => 10], [
                            'class' => 'btn btn-success',
                            'data' => [
                                'confirm' => 'Подтвердите действие!',
                                'method' => 'post',
                            ],
                        ]);
                    }
                } ?>
            </div>
        </div>
    </div>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'fullname',
            'username',
            [
                'attribute' => 'role_id',
                'value' => function ($data) {
                    return Yii::$app->params['user_role'][$data->role_id];
                }
            ],
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            //'email:email',
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    return Yii::$app->params['user_status'][$data->status];
                }
            ],
            [
                'attribute' => 'created_at',
                'value' => function ($data) {
                    return date('d.m.Y', $data->created_at);
                }
            ],
            //'updated_at',
            //'verification_token',
        ],
    ]) ?>

</div>
