<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "client".
 *
 * @property int $id
 * @property string $fullname
 * @property string $phone
 * @property string $address
 * @property int $balance
 * @property int $created
 * @property int $updated
 * @property int $status
 * @property int $client_type_id
 * @property string $token
 * @property int $is_deleted
 * @property int $deleted_time
 * @property int $deleted_user_id
 */
class Clients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fullname', 'phone', 'created', 'updated', 'client_type_id', 'token', 'address'], 'required'],
            [['balance', 'created', 'updated', 'status', 'client_type_id', 'is_deleted', 'deleted_time', 'deleted_user_id'], 'integer'],
            [['fullname', 'address'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 12],
            [['token'], 'string', 'max' => 6],
            [['is_deleted', 'deleted_time', 'deleted_user_id'], 'default', 'value' => 0]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fullname' => 'Ф.И.О',
            'phone' => 'Номер телефона',
            'address' => 'Адрес',
            'balance' => 'Баланс',
            'created' => 'Дата создания',
            'updated' => 'Дата обновления',
            'status' => 'Статус',
            'client_type_id' => 'Тип клиента',
            'token' => 'Токен',
            'is_deleted' => 'Удалено',
            'deleted_time' => 'Deleted Time',
            'deleted_user_id' => 'Deleted User ID',
        ];
    }
}
