<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\ProjectFinance;
use app\models\Finance;
use app\models\FinanceSearch;
use app\models\Income;
use app\models\Outcome;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FinanceController implements the CRUD actions for Finance model.
 */
class FinanceController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['index'],
                'rules' => [
                    [
                        'allow' => 'true',
                        'actions' => ['index'],
                        'roles' => ['manager', 'supervisor'],
                    ],

                    [
                        'allow' => 'true',
                        'actions' => ['view', 'update', 'delete', 'create'],
                        'roles' => ['manager'],
                    ],

                    [
                        'allow' => 'true',
                        'actions' => ['view'],
                        'roles' => ['supervisor'],
                    ],
            ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Finance models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FinanceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Finance model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Finance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Finance();
        $income = new Income();
        $outcome = new Outcome();
        $projectFinance = new ProjectFinance();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(Yii::$app->request->get('type') == 'income'){
                $income->id = $model->id;
                $income->save();
            } else if(Yii::$app->request->get('type') == 'outcome'){
                $outcome->id = $model->id;
                $outcome->save();
            }
            $projectFinance->idproject = Yii::$app->request->get('idproject');
            $projectFinance->idfinance = $model->id;
            $projectFinance->save();
            return $this->redirect(['project-finance/index/', 'ProjectFinanceSearch[idproject]' => $projectFinance->idproject, 'idproject' => $projectFinance->idproject] );
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Finance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Finance model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Finance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Finance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Finance::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
