<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Participant;
use app\models\ParticipantSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\InternalParticipant;
use app\models\Manager;
use app\models\Supervisor;

/**
 * ParticipantController implements the CRUD actions for Participant model.
 */
class ParticipantController extends Controller
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
                        'actions' => ['view', 'update', 'delete', 'create', 'index'],
                        'roles' => ['admin'],
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
     * Lists all Participant models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ParticipantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Participant model.
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
     * Creates a new Participant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Participant();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
	    if(Yii::$app->request->get('type') == 'internal'){
		$internal = new InternalParticipant();
		$internal->id = $model->id;
		$internal->save();
	    }else if(Yii::$app->request->get('type') == 'external'){
		$external = new ExternalParticipant();
		$external->id = $model->id;
		$external->save();
	    } else if(Yii::$app->request->get('type') == 'manager'){
		$internal = new InternalParticipant();
		$internal->id = $model->id;
		$internal->save();
		$manager = new Manager();
		$manager->id=$model->id;
		$manager->save();
	    } else if(Yii::$app->request->get('type') == 'supervisor'){
		$supervisor = new Supervisor();
		$supervisor->id = $model->id;
		$supervisor->fname = $model->fname;
		$supervisor->lname = $model->lname;
     	    }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Participant model.
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
     * Deletes an existing Participant model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
	if(Manager::find(['id'=>$id])->exists()){
		Manager::find()->where(['id'=>$id])->one()->delete();
		InternalParticipant::find()->where(['id'=>$id])->one()->delete();
	}else if(ExternalParticipant::find(['id'=>$id])->one()->exists()){
		ExternalParticipant::find()->where(['id'=>$id])->one()->delete();
	}
	
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Participant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Participant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Participant::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
