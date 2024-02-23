<?php

namespace backend\controllers;

use common\models\ClientPhone;
use common\models\Clients;
use common\models\Payment;
use common\models\Sale;
use common\models\search\ClientsSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClientController implements the CRUD actions for Clients model.
 */
class ClientController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                        'create-phone' => ['post'],
                        'delete-phone' => ['post'],
                        'make-payment' => ['post']
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => [
                                'create',
                                'index',
                                'delete',
                                'create-phone',
                                'view',
                                'delete-phone',
                                'update',
                                'make-payment',
                            ],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ]
            ]
        );
    }

    /**
     * Lists all Clients models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ClientsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionMakePayment()
    {
        $model = new Payment();
        if ($model->load(\Yii::$app->request->post())) {
            $post = $_POST['Payment'];
            $model->token = \Yii::$app->security->generateRandomString(6);
            $model->created = time();
            $model->rate_date = time();
            $model->is_deleted = 0;
            $model->deleted_user_id = 0;
            $model->deleted_time = 0;
            $model->method_id = 0;

            if ($post['amount_type'] == 1) {
                $model->content=$model->content . "( Приём оплаты в USD " . $post['amount'] . ' )';
                $total = $post['amount'] * $post['rate_amount'];
                $model->amount = $total;
            }
            if ($model->save(false)) {
                $client = Clients::findOne(['id' => $model->client_id]);
                $client->balance += $model->amount;
                $client->updated = time();
                $client->update(false);
                return $this->redirect(\Yii::$app->request->referrer);
            }
        }
    }

    /**
     * Displays a single Clients model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $phone = ClientPhone::findAll(['client_id' => $model->id]);
        $sales = Sale::find()->where(['client_id' => $model->id])->orderBy(['id' => SORT_DESC])->limit(3)->all();
        $payment = Payment::findAll(['client_id' => $model->id]);
        return $this->render('view', [
            'model' => $model,
            'phone' => $phone,
            'sales' => $sales,
            'payment' => $payment,
        ]);
    }

    public function actionCreatePhone()
    {
        $model = new ClientPhone();
        if ($model->load(\Yii::$app->request->post())) {
            $model->created = time();
            $model->save();
        }
        return $this->redirect(\Yii::$app->request->referrer);
    }

    /**
     * Creates a new Clients model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Clients();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->status = 0;
                $model->created = time();
                $model->updated = time();
                $model->token = \Yii::$app->security->generateRandomString(6);
                $model->save();
                return $this->redirect(['view', 'id' => $model->token]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Clients model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->token]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Clients model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->is_deleted = 1;
        $model->deleted_time = time();
        $model->deleted_user_id = \Yii::$app->user->id;
        $model->updated = time();
        $model->update();
        return $this->redirect(['index']);
    }

    public function actionDeletePhone($id)
    {
        $phone = ClientPhone::findOne(['id' => $id]);
        $phone->delete();
        return $this->redirect(\Yii::$app->request->referrer);
    }

    /**
     * Finds the Clients model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Clients the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Clients::findOne(['token' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
