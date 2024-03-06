<?php

namespace frontend\controllers;

use common\models\Clients;
use common\models\Sale;
use common\models\SaleItem;
use common\models\Warehouse;
use common\models\search\SaleSearch;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SaleController implements the CRUD actions for Sale model.
 */
class SaleController extends Controller
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
                        'create-item' => ['post'],
                        'delete-items' => ['post'],
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
                                'create-item',
                                'delete-item',
                                'view',
                                'status',
                                'registration',
                                'active'
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
     * Lists all Sale models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SaleSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->orderBy(['id' => SORT_DESC]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRegistration()
    {
        $searchModel = new SaleSearch();
        $searchModel->status = 1;
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->orderBy(['id' => SORT_DESC]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionActive()
    {
        $searchModel = new SaleSearch();
        $searchModel->status = 2;
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->orderBy(['id' => SORT_DESC]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreateItem()
    {
        $model = new SaleItem();
        if ($model->load(\Yii::$app->request->post())) {
            $model->created = time();
            $model->status = 0;
            $model->count = 1;
            $model->save(false);
            return $this->redirect(\Yii::$app->request->referrer);

        }
    }

    /**
     * Displays a single Sale model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
     $today_start=strtotime('today');
     $today_end=$today_start+86399;
        $model = $this->findModel($id);
        if ($model->status == 0) {
            $model->status = 1;
            $model->update(false);
        }
        $items = SaleItem::findAll(['sale_id' => $model->id]);
        return $this->render('view', [
            'model' => $model,
            'items' => $items,
            'today_start'=>$today_start,
            'today_end'=>$today_end,
        ]);
    }

    /**
     * @throws \Throwable
     * @throws StaleObjectException
     * @throws NotFoundHttpException
     */
    public function actionStatus($id, $status)
    {
        $model = $this->findModel($id);
        $model->status = $status;
        $model->updated = time();

        //If Status Complete
        if ($status == 2) {
            $items = SaleItem::findAll(['sale_id' => $model->id]);
            if (!$items) {
                \Yii::$app->session->setFlash('warning', 'Товары отсутствуют!!!');
                return $this->redirect(\Yii::$app->request->referrer);
            }
            $total = 0;

            foreach ($items as $item) {
                $warehouse = Warehouse::findOne(['product_id' => $item->product_id, 'gold_type_id' => $item->product->gold_type_id]);
                $warehouse->count -= $item->count;
                $warehouse->update(false);
                $total += $item->total_price;
                $item->status = 1;
                $item->update(false);
            }
            $model->total_amount = $total;
            $client = Clients::findOne(['id' => $model->client_id]);
            $client->balance -= $total;
            $client->update(false);
        }
        // If Status Returned
        if ($status == 1) {
            $items = SaleItem::findAll(['sale_id' => $model->id]);
            foreach ($items as $item) {
                $warehouse = Warehouse::findOne(['product_id' => $item->product_id, 'gold_type_id' => $item->product->gold_type_id]);
                $warehouse->count += $item->count;
                $warehouse->update(false);
            }
            $client = Clients::findOne(['id' => $model->client_id]);
            $client->balance += $model->total_amount;
            $client->update(false);
        }

        $model->update(false);
        return $this->redirect(\Yii::$app->request->referrer);

    }


    /**
     * Creates a new Sale model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($id = false)
    {
        $model = new Sale();

        if ($this->request->isPost) {
            if (\Yii::$app->request->post()) {
                $model->createSale($id);
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
     * Updates an existing Sale model.
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
     * @throws StaleObjectException
     * @throws \Throwable
     */
    public function actionDeleteItem($id)
    {
        $model = SaleItem::findOne(['id' => $id]);
        $model->delete();
        return $this->redirect(\Yii::$app->request->referrer);
    }

    /**
     * Deletes an existing Sale model.
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
        $model->update(false);
        return $this->redirect(['index']);
    }

    /**
     * Finds the Sale model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Sale the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sale::findOne(['token' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
