<?php

namespace frontend\controllers;

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
        return $this->render('client');
    }
}