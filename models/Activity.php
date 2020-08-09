<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "activity".
 *
 * @property int $id
 * @property int $idproject
 * @property string|null $name
 *
 * @property Project $idproject0
 * @property ProjectActivityParticipant[] $projectActivityParticipants
 * @property ParticipantProject[] $idparticipants
 */
class Activity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'activity';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idproject'], 'required'],
            [['idproject'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['idproject'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['idproject' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idproject' => 'Idproject',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Idproject0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdproject0()
    {
        return $this->hasOne(Project::className(), ['id' => 'idproject']);
    }

    /**
     * Gets query for [[ProjectActivityParticipants]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjectActivityParticipants()
    {
        return $this->hasMany(ProjectActivityParticipant::className(), ['idactivity' => 'id']);
    }

    /**
     * Gets query for [[Idparticipants]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdparticipants()
    {
        return $this->hasMany(ParticipantProject::className(), ['idparticipant' => 'idparticipant', 'idproject' => 'idproject'])->viaTable('project_activity_participant', ['idactivity' => 'id']);
    }
}
