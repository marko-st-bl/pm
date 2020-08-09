<?php
namespace app\controllers;

use yii\rest\ActiveController;
use app\models\LoginForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\ContactForm;

class LoginController extends ActiveController
{
    public $modelClass = 'app\resources\LoginForm';

    public function actionLogin(){
        $request = Yii::$app->request;
        $model = new LoginForm();
        $username = $request->get('username');
        $password = $request->get('password');
        $model->username = $username;
        $model->password = $password;
        return $model->login();
    }
}
?>