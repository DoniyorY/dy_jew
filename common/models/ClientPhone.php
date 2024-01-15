<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "client_phone".
 *
 * @property int $id
 * @property int $client_id
 * @property string $phone
 * @property string $content
 * @property int $created
 */
class ClientPhone extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client_phone';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'phone', 'content', 'created'], 'required'],
            [['client_id', 'created'], 'integer'],
            [['phone'], 'string', 'max' => 12],
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
            'client_id' => 'Клиент',
            'phone' => 'Номер телефона',
            'content' => 'Примечание',
            'created' => 'Дата создания',
        ];
    }

    public function getClient()
    {
        return $this->hasOne(Clients::className(),['id'=>'client_id']);
    }
}
