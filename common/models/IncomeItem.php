<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "income_item".
 *
 * @property int $id
 * @property int $product_id
 * @property int $count
 * @property int $unit_amount
 * @property int $income_id
 * @property int $is_deleted
 * @property int $deleted_user_id
 * @property int $deleted_time
 */
class IncomeItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'income_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'count', 'unit_amount', 'income_id'], 'required'],
            [['product_id', 'count', 'unit_amount', 'income_id', 'is_deleted', 'deleted_time', 'deleted_user_id'], 'integer'],
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
            'count' => 'Количество',
            'unit_amount' => 'Итоговая цена',
            'income_id' => 'Приход',
        ];
    }

    public function create(){
        $check = IncomeItem::findOne(['income_id' => $this->income_id, 'product_id' => $this->product_id]);
        if ($check) {
            $check->count += $this->count;
            $check->update(false);
            return true;
        }
        $this->unit_amount = 0;
        $this->is_deleted = 0;
        $this->deleted_time = 0;
        $this->deleted_user_id = 0;
        $this->save();
        return true;
    }
    public function getIncome()
    {
        return $this->hasOne(Income::className(), ['id' => 'income_id']);
    }

    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }
}
