<?php

namespace frontend\controllers;

use common\models\Clients;
use common\models\Sale;
use common\models\SaleItem;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class ReportController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => [
                                'clients',
                                'client-items'
                            ],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ]
            ]
        );
    }

    public function actionClients()
    {
        //$model=Clients::findAll(['is_deleted'=>0]);
        $model = new ActiveDataProvider([
            'query' => Clients::find()->where(['is_deleted' => 0])->orderBy(['fullname' => 4])
        ]);
        if (\Yii::$app->request->get('Client')) {
            $get = $_GET['Client'];
            $model->query->andFilterWhere(['like', 'fullname', $get['fullname']])
                ->andFilterWhere(['like', 'phone', $get['phone']]);
        }
        return $this->render('client', [
            'model' => $model->models,
        ]);
    }

    public function actionClientItems($id)
    {
        $client = Clients::findOne(['token' => $id]);
        $query = SaleItem::find()
            ->joinWith('sale')
            ->where(['sale.is_deleted' => 0, 'sale.client_id' => $client->id])
            ->orderBy(['id' => 3]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        if (\Yii::$app->request->get('Sale')) {
            $get = $_GET['Sale'];
            $begin = strtotime($get['begin']);
            $end = strtotime($get['end']);
            $dataProvider->query->andFilterWhere(['between', 'created', $begin, $end]);

        }


        return $this->render('client_sales', [
            'model' => $dataProvider->models,
            'client' => $client
        ]);
    }
}