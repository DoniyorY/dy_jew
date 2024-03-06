<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "income".
 *
 * @property int $id
 * @property int $created
 * @property int $user_id
 * @property int $status
 * @property int $total_amount
 * @property int $is_deleted
 * @property int $deleted_user_id
 * @property int $deleted_time
 * @property string $token
 */
class Income extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'income';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created', 'user_id', 'status', 'total_amount'], 'required'],
            [['created', 'user_id', 'status', 'total_amount', 'is_deleted', 'deleted_user_id', 'deleted_time'], 'integer'],
            ['token', 'string', 'max' => 6],
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
            'user_id' => 'Пользователь',
            'status' => 'Статус',
            'total_amount' => 'Итоговая цена',
        ];
    }

    public function create($model)
    {
        $model->created = time();
        $model->user_id = \Yii::$app->user->id;
        $model->total_amount = 0;
        $model->status = 0;
        $model->token = \Yii::$app->security->generateRandomString(6);
        $model->save();
        return true;
    }

    public function changeStatus($model, $items, $status)
    {
        $referrer = \Yii::$app->request->referrer;
        if ($status == 1) { //STATUS COMPLETE
            foreach ($items as $item) {
                $check_wh = Warehouse::findOne(['product_id' => $item->product_id]);
                if ($check_wh) {
                    $check_wh->count += $item->count;
                    $check_wh->updated = time();
                    $check_wh->update(false);
                } else {
                    $new_wh = new Warehouse();
                    $new_wh->product_id = $item->product_id;
                    $new_wh->gold_type_id = $item->product->gold_type_id;
                    $new_wh->updated = time();
                    $new_wh->user_id = \Yii::$app->user->id;
                    $new_wh->status = 0;
                    $new_wh->count = $item->count;
                    $new_wh->save();
                }
            }
            \Yii::$app->session->setFlash('success', 'Приход успешно завершён');
            return $referrer;
        }
        if ($status == 0) { // STATUS RETURNED
            foreach ($items as $item) {
                $check_wh = Warehouse::findOne(['product_id' => $item->product_id]);
                if ($check_wh) {
                    $check_wh->count -= $item->count;
                    $check_wh->updated = time();
                    $check_wh->update(false);

                }
            }
            return $referrer;
        }
        return $referrer;
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
