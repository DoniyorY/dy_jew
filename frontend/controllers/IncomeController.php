<?php

namespace frontend\controllers;

use common\models\Income;
use common\models\search\IncomeSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\IncomeItem;
use common\models\Warehouse;

/**
 * IncomeController implements the CRUD actions for Income model.
 */
class IncomeController extends Controller
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
                        'create' => ['post'],
                        'create-item' => ['post'],
                        'delete-item' => ['post'],
                        'status' => ['post'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => [
                                'index',
                                'view',
                                'delete',
                                'create',
                                'create-item',
                                'delete-item',
                                'status',
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
     * Lists all Income models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new IncomeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->query->orderBy(['id' => 3]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreateItem()
    {
        $model = new IncomeItem();
        if ($model->load(\Yii::$app->request->post()) and $model->create()) {
            return $this->redirect(\Yii::$app->request->referrer);
        }

    }

    public function actionStatus($id, $status)
    {
        $model = $this->findModel($id);
        $items = IncomeItem::findAll(['income_id' => $model->id]);
        if (!$items and $status == 0) {
            \Yii::$app->session->setFlash('warning', 'Список пуст!!!');
            return $this->redirect(\Yii::$app->request->referrer);
        }
        $model->status = $status;
        $model->update(false);
        $change_status = $model->changeStatus($model, $items, $status);
        return $this->redirect($change_status);
    }

    public function actionDeleteItem($id)
    {
        $model = IncomeItem::findOne(['id' => $id]);
        $model->delete();
        return $this->redirect(\Yii::$app->request->referrer);
    }

    /**
     * Displays a single Income model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $items = IncomeItem::findAll(['income_id' => $model->id]);
        return $this->render('view', [
            'model' => $model,
            'items' => $items,
        ]);
    }

    /**
     * Creates a new Income model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Income();

        if ($this->request->isPost) {
            $model->create($model);
            return $this->redirect(['view', 'id' => $model->token]);
        } else {
            $model->loadDefaultValues();
            return $this->redirect(\Yii::$app->request->referrer);
        }
    }

    /**
     * Deletes an existing Income model.
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
     * Finds the Income model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Income the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Income::findOne(['token' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
