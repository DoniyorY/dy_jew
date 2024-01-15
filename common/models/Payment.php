<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property int $id
 * @property int $created
 * @property int $amount
 * @property int $rate_id
 * @property int $method_id
 * @property int $payment_type
 * @property int $client_id
 * @property int $content
 * @property string $token
 * @property int $is_deleted
 * @property int $deleted_user_id
 * @property int $deleted_time
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created', 'amount', 'rate_id', 'method_id', 'payment_type', 'client_id', 'content', 'token'], 'required'],
            [['created', 'amount', 'rate_id', 'method_id', 'payment_type', 'client_id', 'content', 'is_deleted', 'deleted_user_id', 'deleted_time'], 'integer'],
            [['token'], 'string', 'max' => 6],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created' => 'Дата создания',
            'amount' => 'Сумма',
            'rate_id' => 'Курс',
            'method_id' => 'Метод',
            'payment_type' => 'Тип оплаты',
            'client_id' => 'Клиент',
            'content' => 'Примечание',
            'token' => 'Токен',
            'is_deleted' => 'Is Deleted',
            'deleted_user_id' => 'Deleted User ID',
            'deleted_time' => 'Deleted Time',
        ];
    }

    public function getClient()
    {
        return $this->hasOne(Clients::className(),['id'=>'client_id']);
    }

    public function getRate()
    {
        return $this->hasOne(CurrencyRate::className(),['id'=>'rate_id']);
    }
}
