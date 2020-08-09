<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project_part_participant".
 *
 * @property int $idparticipant
 * @property int $idproject
 * @property int $idpart
 *
 * @property Part $idpart0
 * @property ParticipantProject $idparticipant0
 */
class ProjectPartParticipant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project_part_participant';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idparticipant', 'idproject', 'idpart'], 'required'],
            [['idparticipant', 'idproject', 'idpart'], 'integer'],
            [['idparticipant', 'idproject', 'idpart'], 'unique', 'targetAttribute' => ['idparticipant', 'idproject', 'idpart']],
            [['idpart'], 'exist', 'skipOnError' => true, 'targetClass' => Part::className(), 'targetAttribute' => ['idpart' => 'id']],
            [['idparticipant', 'idproject'], 'exist', 'skipOnError' => true, 'targetClass' => ParticipantProject::className(), 'targetAttribute' => ['idparticipant' => 'idparticipant', 'idproject' => 'idproject']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idparticipant' => 'Idparticipant',
            'idproject' => 'Idproject',
            'idpart' => 'Idpart',
        ];
    }

    /**
     * Gets query for [[Idpart0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdpart0()
    {
        return $this->hasOne(Part::className(), ['id' => 'idpart']);
    }

    /**
     * Gets query for [[Idparticipant0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdparticipant0()
    {
        return $this->hasOne(ParticipantProject::className(), ['idparticipant' => 'idparticipant', 'idproject' => 'idproject']);
    }
}
