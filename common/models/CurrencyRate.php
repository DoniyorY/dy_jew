<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "currency_rate".
 *
 * @property int $id
 * @property int $created
 * @property int $updated
 * @property int $amount
 * @property int $status
 */
class CurrencyRate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'currency_rate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created', 'updated', 'amount', 'status'], 'required'],
            [['created', 'updated', 'amount', 'status'], 'integer'],
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
            'updated' => 'Дата обновления',
            'amount' => 'Сумма',
            'status' => 'Статус',
        ];
    }
}
