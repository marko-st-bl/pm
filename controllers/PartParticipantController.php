<?php

namespace app\controllers;

use Yii;
use app\models\PartParticipant;
use app\models\PartParticipantSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PartParticipantController implements the CRUD actions for PartParticipant model.
 */
class PartParticipantController extends Controller
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
     * Lists all PartParticipant models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PartParticipantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PartParticipant model.
     * @param integer $idparticipant
     * @param integer $idpart
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idparticipant, $idpart)
    {
        return $this->render('view', [
            'model' => $this->findModel($idparticipant, $idpart),
        ]);
    }

    /**
     * Creates a new PartParticipant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PartParticipant();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'PartParticipantSearch[idpart]' => $model->idpart, 'idpart' => $model->idpart]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PartParticipant model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $idparticipant
     * @param integer $idpart
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idparticipant, $idpart)
    {
        $model = $this->findModel($idparticipant, $idpart);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idparticipant' => $model->idparticipant, 'idpart' => $model->idpart]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PartParticipant model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $idparticipant
     * @param integer $idpart
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idparticipant, $idpart)
    {
        $this->findModel($idparticipant, $idpart)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PartParticipant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $idparticipant
     * @param integer $idpart
     * @return PartParticipant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idparticipant, $idpart)
    {
        if (($model = PartParticipant::findOne(['idparticipant' => $idparticipant, 'idpart' => $idpart])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
