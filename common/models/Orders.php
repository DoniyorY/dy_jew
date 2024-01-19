<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $created
 * @property int $client_id
 * @property int $user_id
 * @property int $updated
 * @property int $total_amount
 * @property int $status
 * @property string $token
 * @property int $is_deleted
 * @property int $deleted_user_id
 * @property int $deleted_time
 * @property string $content
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created', 'client_id', 'total_amount', 'status', 'token', 'content'], 'required'],
            [['created', 'client_id', 'total_amount', 'status', 'is_deleted', 'deleted_user_id', 'deleted_time'], 'integer'],
            [['token'], 'string', 'max' => 6],
            [['content'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Заказ № ',
            'created' => 'Дата создания',
            'client_id' => 'Клиент',
            'total_amount' => 'Общая сумма',
            'status' => 'Статус',
            'token' => 'Токен',
            'is_deleted' => 'Is Deleted',
            'deleted_user_id' => 'Deleted User ID',
            'deleted_time' => 'Deleted Time',
            'content' => 'Примечание',
            'user_id'=>'Пользователь'
        ];
    }

    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['id' => 'client_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getDeletedUser()
    {
        return $this->hasOne(User::className(), ['id' => 'deleted_user_id']);
    }
}
