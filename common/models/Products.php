<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $name
 * @property int $gold_type_id
 * @property int $created
 * @property int $status
 * @property int $updated
 * @property int $is_deleted
 * @property int $deleted_time
 * @property int $deleted_user_id
 * @property int $code
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'gold_type_id', 'created', 'status', 'updated', 'code'], 'required'],
            [['gold_type_id', 'created', 'status', 'updated', 'is_deleted', 'deleted_time', 'deleted_user_id', 'code'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'gold_type_id' => 'Тип Золота',
            'created' => 'Дата создания',
            'status' => 'Статус',
            'updated' => 'Дата обновления',
            'is_deleted' => 'Is Deleted',
            'deleted_time' => 'Deleted Time',
            'deleted_user_id' => 'Deleted User ID',
            'code' => 'Код',
        ];
    }
}
