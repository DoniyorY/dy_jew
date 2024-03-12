<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "s_request".
 *
 * @property int $id
 * @property int|null $client_id
 * @property int|null $created
 * @property int|null $status
 */
class SRequest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 's_request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'created', 'status'], 'integer'],
            ['client_id', 'required']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Клиент',
            'created' => 'Дата создания',
            'status' => 'Статус',
        ];
    }
    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['id' => 'client_id']);
    }
}
