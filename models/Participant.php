<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "participant".
 *
 * @property int $id
 * @property string $fname
 * @property string|null $lname
 * @property int|null $iduseracc
 *
 * @property ExternalParticipant $externalParticipant
 * @property InternalParticipant $internalParticipant
 * @property Useracc $iduseracc0
 * @property ParticipantProject[] $participantProjects
 * @property Project[] $idprojects
 */
class Participant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'participant';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fname'], 'required'],
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
            'fname' => 'First Name',
            'lname' => 'Last Name',
            'iduseracc' => 'Iduseracc',
        ];
    }

    /**
     * Gets query for [[ExternalParticipant]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExternalParticipant()
    {
        return $this->hasOne(ExternalParticipant::className(), ['id' => 'id']);
    }

    /**
     * Gets query for [[InternalParticipant]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInternalParticipant()
    {
        return $this->hasOne(InternalParticipant::className(), ['id' => 'id']);
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

    /**
     * Gets query for [[ParticipantProjects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParticipantProjects()
    {
        return $this->hasMany(ParticipantProject::className(), ['idparticipant' => 'id']);
    }

    /**
     * Gets query for [[Idprojects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdprojects()
    {
        return $this->hasMany(Project::className(), ['id' => 'idproject'])->viaTable('participant_project', ['idparticipant' => 'id']);
    }
}
