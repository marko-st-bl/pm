<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "part".
 *
 * @property int $id
 * @property string $name
 * @property int|null $idproject
 * @property int|null $part_idpart
 * @property string $startdate
 * @property string|null $enddate
 * @property float $progress
 * @property int|null $staffrequired
 * @property int|null $hoursrequired
 *
 * @property Part $partIdpart
 * @property Part[] $parts
 * @property Project $idproject0
 * @property ProjectPartParticipant[] $projectPartParticipants
 * @property ParticipantProject[] $idparticipants
 */
class Part extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'part';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'startdate', 'progress'], 'required'],
            [['idproject', 'part_idpart', 'staffrequired', 'hoursrequired'], 'integer'],
            [['startdate', 'enddate'], 'safe'],
            [['startdate', 'enddate'], 'date', 'format' => 'php:Y-m-d'],
            [['progress'], 'number'],
            [['name'], 'string', 'max' => 40],
            [['part_idpart'], 'exist', 'skipOnError' => true, 'targetClass' => Part::className(), 'targetAttribute' => ['part_idpart' => 'id']],
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
            'name' => 'Name',
            'idproject' => 'Idproject',
            'part_idpart' => 'Root part ID',
            'startdate' => 'Start Date',
            'enddate' => 'End Date',
            'progress' => 'Progress',
            'staffrequired' => 'Staff Required',
            'hoursrequired' => 'Hours Required',
        ];
    }

    /**
     * Gets query for [[PartIdpart]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPartIdpart()
    {
        return $this->hasOne(Part::className(), ['id' => 'part_idpart']);
    }

    /**
     * Gets query for [[Parts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParts()
    {
        return $this->hasMany(Part::className(), ['part_idpart' => 'id']);
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
     * Gets query for [[ProjectPartParticipants]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjectPartParticipants()
    {
        return $this->hasMany(ProjectPartParticipant::className(), ['idpart' => 'id']);
    }

    /**
     * Gets query for [[Idparticipants]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdparticipants()
    {
        return $this->hasMany(ParticipantProject::className(), ['idparticipant' => 'idparticipant', 'idproject' => 'idproject'])->viaTable('project_part_participant', ['idpart' => 'id']);
    }
}
