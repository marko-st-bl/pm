<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $name
 * @property int $idmanager
 * @property int|null $idsupervisor
 *
 * @property Part[] $parts
 * @property ParticipantProject[] $participantProjects
 * @property Participant[] $idparticipants
 * @property Supervisor $idsupervisor0
 * @property Manager $idmanager0
 * @property ProjectFinance[] $projectFinances
 * @property Finance[] $idfinances
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'idmanager'], 'required'],
            [['idmanager', 'idsupervisor'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['idsupervisor'], 'exist', 'skipOnError' => true, 'targetClass' => Supervisor::className(), 'targetAttribute' => ['idsupervisor' => 'id']],
            [['idmanager'], 'exist', 'skipOnError' => true, 'targetClass' => Manager::className(), 'targetAttribute' => ['idmanager' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'idmanager' => 'Manager',
            'idsupervisor' => 'Supervisor',
        ];
    }

    /**
     * Gets query for [[Parts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParts()
    {
        return $this->hasMany(Part::className(), ['idproject' => 'id']);
    }

    /**
     * Gets query for [[ParticipantProjects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParticipantProjects()
    {
        return $this->hasMany(ParticipantProject::className(), ['idproject' => 'id']);
    }

    /**
     * Gets query for [[Idparticipants]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdparticipants()
    {
        return $this->hasMany(Participant::className(), ['id' => 'idparticipant'])->viaTable('participant_project', ['idproject' => 'id']);
    }

    /**
     * Gets query for [[Idsupervisor0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdsupervisor0()
    {
        return $this->hasOne(Supervisor::className(), ['id' => 'idsupervisor']);
    }

    /**
     * Gets query for [[Idmanager0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdmanager0()
    {
        return $this->hasOne(Manager::className(), ['id' => 'idmanager']);
    }

    /**
     * Gets query for [[ProjectFinances]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjectFinances()
    {
        return $this->hasMany(ProjectFinance::className(), ['idproject' => 'id']);
    }

    /**
     * Gets query for [[Idfinances]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdfinances()
    {
        return $this->hasMany(Finance::className(), ['id' => 'idfinance'])->viaTable('project_finance', ['idproject' => 'id']);
    }
}
