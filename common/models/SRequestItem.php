<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "s_request_item".
 *
 * @property int $id
 * @property int|null $s_request_id
 * @property int|null $product_id
 * @property int|null $gold_type_id
 * @property int|null $count
 * @property int|null $status
 * @property int|null $created
 * @property string|null $content
 */
class SRequestItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 's_request_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['s_request_id', 'product_id', 'gold_type_id', 'count', 'status', 'created'], 'integer'],
            [['content'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            's_request_id' => 'S Request ID',
            'product_id' => 'Изделие',
            'gold_type_id' => 'Проба',
            'count' => 'Количество',
            'status' => 'Статус',
            'created' => 'Дата создания',
            'content' => 'Примечание',
        ];
    }

    public function getProduct()
    {
        return $this->hasOne(Products::className(),['id'=>'product_id']);
    }

}
