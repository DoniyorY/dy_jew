<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SRequestItem;

/**
 * SRequestItemSearch represents the model behind the search form of `common\models\SRequestItem`.
 */
class SRequestItemSearch extends SRequestItem
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 's_request_id', 'product_id', 'gold_type_id', 'count', 'status', 'created'], 'integer'],
            [['content'], 'safe'],
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
        $query = SRequestItem::find()->joinWith('sRequest');
        $query->andFilterWhere(['s_request.status'=>1]);
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
            's_request_id' => $this->s_request_id,
            'product_id' => $this->product_id,
            'gold_type_id' => $this->gold_type_id,
            'count' => $this->count,
            'status' => $this->status,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
