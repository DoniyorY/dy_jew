<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var common\models\search\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <div class="row">
        <div class="col-md-8">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-4">
            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Новый пользователь
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Новый пользователь</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <?php echo $this->render('_form', ['model' => new \common\models\SignupForm()]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model) {
            if ($model->status == 10) {
                return ['class' => 'table-success'];
            } else {
                return ['class' => 'table-danger'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'fullname',
            'username',
            [
                'attribute' => 'role_id',
                'value' => function ($data) {
                    return Yii::$app->params['user_role'][$data->role_id];
                }
            ],
            [
                'attribute' => 'created_at',
                'value' => function ($data) {
                    return date('d.m.Y', $data->created_at);
                }
            ],
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            //'email:email',
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    if ($data->status == 10) {
                        return Html::a(Yii::$app->params['user_status'][$data->status], ['status', 'id' => $data->id, 'status' => 9], [
                            'class' => 'btn btn-success w-100 btn-sm',
                            'data' => [
                                'method' => 'post',
                                'confirm' => 'Подтвердите действие!!!',
                            ]
                        ]);
                    } else {
                        return Html::a(Yii::$app->params['user_status'][$data->status], ['status', 'id' => $data->id, 'status' => 10], [
                            'class' => 'btn btn-danger w-100 btn-sm',
                            'data' => [
                                'method' => 'post',
                                'confirm' => 'Подтвердите действие!!!',
                            ]
                        ]);
                    }
                },
                'format' => 'raw',
            ],

            //'updated_at',
            //'verification_token',
            /*[
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],*/
        ],
    ]); ?>


</div>
