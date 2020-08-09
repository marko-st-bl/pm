<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supervisor".
 *
 * @property int $id
 * @property string $fname
 * @property string $lname
 * @property int|null $iduseracc
 *
 * @property Project[] $projects
 * @property Useracc $iduseracc0
 */
class Supervisor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'supervisor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fname', 'lname'], 'required'],
            [['iduseracc'], 'integer'],
            [['fname', 'lname'], 'string', 'max' => 20],
            [['iduseracc'], 'exist', 'skipOnError' => true, 'targetClass' => Useracc::className(), 'targetAttribute' => ['iduseracc' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fname' => 'Fname',
            'lname' => 'Lname',
            'iduseracc' => 'Iduseracc',
        ];
    }

    /**
     * Gets query for [[Projects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjects()
    {
        return $this->hasMany(Project::className(), ['idsupervisor' => 'id']);
    }

    /**
     * Gets query for [[Iduseracc0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIduseracc0()
    {
        return $this->hasOne(Useracc::className(), ['id' => 'iduseracc']);
    }
}
