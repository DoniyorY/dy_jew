<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gold_type".
 *
 * @property int $id
 * @property float $value
 * @property string $name
 */
class GoldType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gold_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            ['value', 'number']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'value'=>'Значение'
        ];
    }
}
