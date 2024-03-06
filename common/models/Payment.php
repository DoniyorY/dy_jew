<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property int $id
 * @property int $created
 * @property int $amount
 * @property int $rate_amount
 * @property int $rate_date
 * @property int $method_id
 * @property int $payment_type
 * @property int $amount_type
 * @property int $client_id
 * @property string $content
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
            [['created', 'amount', 'rate_amount', 'method_id', 'payment_type', 'client_id', 'content', 'token'], 'required'],
            [['created', 'amount', 'method_id', 'payment_type', 'client_id', 'is_deleted', 'deleted_user_id', 'deleted_time', 'rate_amount', 'rate_date'], 'integer'],
            [['token'], 'string', 'max' => 6],
            ['content', 'string', 'max' => 255]
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
            'rate_amount' => 'Курс',
            'rate_date' => 'Дата',
            'method_id' => 'Метод',
            'payment_type' => 'Тип оплаты',
            'client_id' => 'Клиент',
            'content' => 'Примечание',
            'token' => 'Токен',
            'is_deleted' => 'Is Deleted',
            'deleted_user_id' => 'Deleted User ID',
            'deleted_time' => 'Deleted Time',
            'amount_type' => 'Валюта'
        ];
    }

    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['id' => 'client_id']);
    }

    public function getRate()
    {
        return $this->hasOne(CurrencyRate::className(), ['id' => 'rate_id']);
    }

    /**
     * @param $dataProvider
     * @param $fieldName
     * @return string|null
     */
    public static function getTotalCount($dataProvider, $fieldName)
    {
        $totalBalance = 0;

        foreach ($dataProvider as $item) {
            $totalBalance += $item[$fieldName];
        }

        return yii::$app->formatter->asDecimal($totalBalance, 0);
    }

    public function createOutcome()
    {

        $post = $_POST['Payment'];
        $this->created = time();
        $this->amount = $post['amount'] * -1;
        $this->rate_amount = $post['rate_amount'];
        $this->rate_date = time();
        $this->method_id = 0;
        $this->content = $post['content'];
        $this->payment_type = 1;
        $this->amount_type = $post['amount_type'];
        if ($post['amount_type'] == 1) {
            $this->amount = ($post['amount'] * $post['rate_amount'] * -1);
            $this->content = $this->content . "( Приём оплаты в USD " . $post['amount'] . ' )';
            $curr = CurrencyRate::findOne(['status' => 0]);
            $curr->status = 1;
            $curr->updated = time();
            $curr->update(false);
            $new_curr = new CurrencyRate();
            $new_curr->created = time();
            $new_curr->amount = $post['rate_amount'];
            $new_curr->updated = 0;
            $new_curr->status = 0;
            $new_curr->save();
        }
        $this->client_id = 0;
        $this->token = \Yii::$app->security->generateRandomString(6);
        $this->is_deleted = 0;
        $this->deleted_time = 0;
        $this->deleted_user_id = 0;
        if ($this->save()) {
            return true;
        }
    }
}
