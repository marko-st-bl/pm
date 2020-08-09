<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "useracc".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
 *
 * @property Participant[] $participants
 */
class Useracc extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'useracc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'authKey', 'accessToken'], 'required'],
            [['username', 'accessToken'], 'string', 'max' => 20],
            [['password', 'authKey'], 'string', 'max' => 64],
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
        ];
    }

    public function getParticipantId($uid)
    {
        return Participant::find()
	->where(['iduseracc' => $uid])
	->one();
    }
    public function getSupervisorId($uid)
    {
        return Supervisor::find()
	->where(['iduseracc' => $uid])
	->one();
    }

    public function getAuthKey(){
        return $this -> authKey;
    }

    public function getId(){
        return $this -> id;
    }

    public function validateAuthKey($authKey){
        return $this -> authKey === $authKey;
    }

    public static function findIdentity($id){
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type=null){
        throw new \yii\base\NotSupportedException;
    }

    public static function findByUsername($username){
        return self::findOne(['username'=>$username]);
    }

    public function validatePassword($password){
        return $this->password === $password;
    }

    public function generateAuthKey(){
	Yii::$app->security->generateRandomString(12);
    }
}
