<?php

namespace backend\controllers;

use common\models\Products;
use common\models\search\SRequestItemSearch;
use common\models\search\SRequestSearch;
use common\models\SRequest;
use common\models\SRequestItem;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class SRequestController extends Controller
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
                        'create' => ['POST'],
                        'create-item' => ['POST'],
                        'delete-item' => ['POST'],
                        'status' => ['post'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => [
                                'create',
                                'index',
                                'view',
                                'create-item',
                                'delete-item',
                                'status',
                                'index-items'
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
     * Lists all SRequest models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SRequestSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->orderBy(['id' => 3]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SRequest model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $items = SRequestItem::findAll(['s_request_id' => $model->id]);
        return $this->render('view', [
            'model' => $model,
            'items' => $items,
        ]);
    }

    /**
     * Creates a new SRequest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new SRequest();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->created = time();
                $model->status = 0;
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->redirect(\Yii::$app->request->referrer);
        }
        return $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionIndexItems()
    {
        $searchModel = new SRequestItemSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index_items', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function actionCreateItem($id)
    {
        $model = new SRequestItem();
        if ($model->load(\Yii::$app->request->post())) {
            $post = $_POST['SRequestItem'];
            $product = Products::findOne(['id' => $post['product_id']]);
            $check = SRequestItem::findOne(['product_id' => $post['product_id'], 's_request_id' => $id]);
            if ($check) {
                $check->count += $model->count;
                $check->update(false);
                return $this->redirect(\Yii::$app->request->referrer);
            }
            $model->s_request_id = $id;
            $model->status = 0;
            $model->created = time();
            $model->content = ' ';
            $model->gold_type_id = $product->gold_type_id;
            $model->save();
            return $this->redirect(\Yii::$app->request->referrer);
        }
        return $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionDeleteItem($id)
    {
        $model = SRequestItem::findOne(['id' => $id]);
        $model->delete();
        \Yii::$app->session->setFlash('success', 'Изделие успешно удалено');
        return $this->redirect(\Yii::$app->request->referrer);
    }

    /**
     * Updates an existing SRequest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionStatus($id, $status)
    {
        $model = $this->findModel($id);
        $model->status = $status;
        $model->update(false);
        \Yii::$app->session->setFlash('success', 'Статус успешно изменен');
        return $this->redirect(\Yii::$app->request->referrer);
    }


    /**
     * Finds the SRequest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return SRequest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SRequest::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}