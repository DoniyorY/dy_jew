<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "warehouse".
 *
 * @property int $id
 * @property int $product_id
 * @property int $gold_type_id
 * @property int $updated
 * @property int $user_id
 * @property int $status
 * @property int $count
 */
class Warehouse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'warehouse';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'gold_type_id', 'updated', 'user_id', 'status', 'count'], 'required'],
            [['product_id', 'gold_type_id', 'updated', 'user_id', 'status', 'count'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Изделие',
            'gold_type_id' => 'Проба',
            'updated' => 'Дата обновления',
            'user_id' => 'Пользователь',
            'status' => 'Статус',
            'count' => 'Количество',
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }

    public function getGoldType()
    {
        return $this->hasOne(GoldType::className(), ['id' => 'gold_type_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getInfo()
    {
        return $this->product->info . ' На складе: ' . $this->count . ' шт';
    }
}
