<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Useracc;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Participant;
use app\models\Manager;
use app\models\ExternalParticipant;
use app\models\InternalParticipant;

/**
 * UseraccController implements the CRUD actions for Useracc model.
 */
class UseraccController extends Controller
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
     * Lists all Useracc models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Useracc::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Useracc model.
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
     * Creates a new Useracc model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Useracc();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
	    $pid = Yii::$app->request->get('idparticipant');
	    if(Manager::find()->where(['id' => $pid])->exists()){
		$auth = \Yii::$app->authManager;
        	$authorRole = $auth->getRole('manager');
        	$auth->assign($authorRole, $model->id);
	    }else if(ExternalParticipant::find()->where(['id' => $pid])->exists()){
		$auth = \Yii::$app->authManager;
        	$authorRole = $auth->getRole('external');
        	$auth->assign($authorRole, $model->id);
	    }else{
		$auth = \Yii::$app->authManager;
        	$authorRole = $auth->getRole('internal');
        	$auth->assign($authorRole, $model->id);
	    }
		$participant = Participant::find()->where(['id' => $pid])->one();
		$participant->iduseracc = $model->id;
		$participant->save();
		return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Useracc model.
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
     * Deletes an existing Useracc model.
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
     * Finds the Useracc model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Useracc the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Useracc::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
