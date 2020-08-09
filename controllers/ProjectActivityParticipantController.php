<?php

namespace app\controllers;

use Yii;
use app\models\ProjectActivityParticipant;
use app\models\ProjectActivityParticipantSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProjectActivityParticipantController implements the CRUD actions for ProjectActivityParticipant model.
 */
class ProjectActivityParticipantController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ProjectActivityParticipant models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectActivityParticipantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProjectActivityParticipant model.
     * @param integer $idparticipant
     * @param integer $idproject
     * @param integer $idactivity
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idparticipant, $idproject, $idactivity)
    {
        return $this->render('view', [
            'model' => $this->findModel($idparticipant, $idproject, $idactivity),
        ]);
    }

    /**
     * Creates a new ProjectActivityParticipant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProjectActivityParticipant();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['activity/view', 'id' => $model->idactivity]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProjectActivityParticipant model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idparticipant
     * @param integer $idproject
     * @param integer $idactivity
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idparticipant, $idproject, $idactivity)
    {
        $model = $this->findModel($idparticipant, $idproject, $idactivity);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['activity/view', 'id' => $model->idactivity]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProjectActivityParticipant model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idparticipant
     * @param integer $idproject
     * @param integer $idactivity
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idparticipant, $idproject, $idactivity)
    {
        $this->findModel($idparticipant, $idproject, $idactivity)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProjectActivityParticipant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idparticipant
     * @param integer $idproject
     * @param integer $idactivity
     * @return ProjectActivityParticipant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idparticipant, $idproject, $idactivity)
    {
        if (($model = ProjectActivityParticipant::findOne(['idparticipant' => $idparticipant, 'idproject' => $idproject, 'idactivity' => $idactivity])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
