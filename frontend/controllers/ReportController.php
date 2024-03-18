<?php

namespace frontend\controllers;

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
        $query=SaleItem::find()->joinWith('sale')->where(['sale.is_deleted'=>0]);
        $dataProvider= new ActiveDataProvider([
            'query'=>$query,
        ]);


        return $this->render('client',[
            'model'=>$dataProvider->models
        ]);

    }
}