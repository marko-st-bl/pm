<?php

namespace app\controllers;

use Yii;
use app\models\ProjectPartParticipant;
use app\models\ProjectPartParticipantSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProjectPartPaticapantController implements the CRUD actions for ProjectPartParticipant model.
 */
class ProjectPartPaticapantController extends Controller
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
     * Lists all ProjectPartParticipant models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectPartParticipantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProjectPartParticipant model.
     * @param integer $idparticipant
     * @param integer $idproject
     * @param integer $idpart
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idparticipant, $idproject, $idpart)
    {
        return $this->render('view', [
            'model' => $this->findModel($idparticipant, $idproject, $idpart),
        ]);
    }

    /**
     * Creates a new ProjectPartParticipant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProjectPartParticipant();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idparticipant' => $model->idparticipant, 'idproject' => $model->idproject, 'idpart' => $model->idpart]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProjectPartParticipant model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idparticipant
     * @param integer $idproject
     * @param integer $idpart
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idparticipant, $idproject, $idpart)
    {
        $model = $this->findModel($idparticipant, $idproject, $idpart);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idparticipant' => $model->idparticipant, 'idproject' => $model->idproject, 'idpart' => $model->idpart]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProjectPartParticipant model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idparticipant
     * @param integer $idproject
     * @param integer $idpart
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idparticipant, $idproject, $idpart)
    {
        $this->findModel($idparticipant, $idproject, $idpart)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ProjectPartParticipant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idparticipant
     * @param integer $idproject
     * @param integer $idpart
     * @return ProjectPartParticipant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idparticipant, $idproject, $idpart)
    {
        if (($model = ProjectPartParticipant::findOne(['idparticipant' => $idparticipant, 'idproject' => $idproject, 'idpart' => $idpart])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
