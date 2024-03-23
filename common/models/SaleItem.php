<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_item".
 *
 * @property int $id
 * @property int $sale_id
 * @property int $product_id
 * @property float $price
 * @property int $created
 * @property int $count
 * @property int $total_price
 * @property int $status
 * @property float $weight
 */
class SaleItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sale_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sale_id', 'product_id', 'price', 'created', 'count', 'weight'], 'required'],
            [['sale_id', 'product_id', 'created', 'count', 'total_price', 'status'], 'integer'],
            [['price', 'weight'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sale_id' => 'Заказ',
            'product_id' => 'Товар',
            'price' => 'Цена за грамм',
            'created' => 'Дата создания',
            'count' => 'Количество',
            'weight' => 'Вес',
            'total_price' => 'Итоговая цена',
            'status' => 'Статус'
        ];
    }

    public function getSale()
    {
        return $this->hasOne(Sale::className(), ['id' => 'sale_id']);
    }

    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }
}
