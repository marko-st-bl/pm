<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\ProjectFinance;
use app\models\ProjectFinanceSearch;
use app\models\Finance;
use app\models\FinanceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProjectFinanceController implements the CRUD actions for ProjectFinance model.
 */
class ProjectFinanceController extends Controller
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
     * Lists all ProjectFinance models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectFinanceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProjectFinance model.
     * @param integer $idfinance
     * @param integer $idproject
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idfinance, $idproject)
    {
        $finance = Finance::findOne($idfinance);

        return $this->render('view', [
            'model' => $this->findModel($idfinance, $idproject),
            'finance' => $finance
        ]);
    }

    /**
     * Creates a new ProjectFinance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProjectFinance();

        $finance = new Finance();

        if ($finance->load(Yii::$app->request->post()) && $finance->save()) {
            $model->idproject=$idproject;
            $model->idfinance= $finance->getDb()->getLastInsertId();
            $model->save();
            return $this->redirect(['view', 'idfinance' => $model->idfinance, 'idproject' => $model->idproject]);
        }

        return $this->render('create', [
            'model' => $model,
            'finance' => $finance,
        ]);
    }

    /**
     * Updates an existing ProjectFinance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idfinance
     * @param integer $idproject
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idfinance, $idproject)
    {
        $model = $this->findModel($idfinance, $idproject);

        $finance = Finance::findOne($idfinance);

        if (!$finance) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        //$finance->scenario('update');

        if ($model->load(Yii::$app->request->post()) && $finance->load(Yii::$app->request->post())) {
            $isValid = $model->validate();
            $isValid = $finance->validate() && $isValid;
            if ($isValid) {
                $model->save(false);
                $finance->save(false);
                return $this->redirect(['index', 'idfinance' => $finance->id, 'idproject' => $model->idproject]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'finance' => $finance,
        ]);
    }

    /**
     * Deletes an existing ProjectFinance model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idfinance
     * @param integer $idproject
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idfinance, $idproject)
    {
        $this->findModel($idfinance, $idproject)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProjectFinance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idfinance
     * @param integer $idproject
     * @return ProjectFinance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idfinance, $idproject)
    {
        if (($model = ProjectFinance::findOne(['idfinance' => $idfinance, 'idproject' => $idproject])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
