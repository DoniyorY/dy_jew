<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Payment;

/**
 * PaymentSearch represents the model behind the search form of `common\models\Payment`.
 */
class PaymentSearch extends Payment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'created', 'amount', 'rate_amount','rate_date', 'method_id', 'payment_type', 'content', 'is_deleted', 'deleted_user_id', 'deleted_time'], 'integer'],
            [['token','client_id'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Payment::find()->joinWith('client');
        $query->andFilterWhere(['payment.is_deleted' => 0]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'created' => $this->created,
            'amount' => $this->amount,
            'rate_amount' => $this->rate_amount,
            'rate_date' => $this->rate_date,
            'method_id' => $this->method_id,
            'payment_type' => $this->payment_type,
            'content' => $this->content,
            'payment.is_deleted' => $this->is_deleted,
            'payment.deleted_user_id' => $this->deleted_user_id,
            'payment.deleted_time' => $this->deleted_time,
        ]);

        $query->andFilterWhere(['like', 'token', $this->token])
        ->andFilterWhere(['like','client.fullname',$this->client_id]);

        return $dataProvider;
    }
}
