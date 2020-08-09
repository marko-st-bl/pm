<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project_activity_participant".
 *
 * @property int $idparticipant
 * @property int $idproject
 * @property int $idactivity
 * @property int|null $hours
 *
 * @property Activity $idactivity0
 */
class ProjectActivityParticipant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project_activity_participant';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idparticipant', 'idproject', 'idactivity'], 'required'],
            [['idparticipant', 'idproject', 'idactivity', 'hours'], 'integer'],
            [['idparticipant', 'idproject', 'idactivity'], 'unique', 'targetAttribute' => ['idparticipant', 'idproject', 'idactivity']],
            [['idactivity'], 'exist', 'skipOnError' => true, 'targetClass' => Activity::className(), 'targetAttribute' => ['idactivity' => 'id']],
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
            'idactivity' => 'Idactivity',
            'hours' => 'Hours',
        ];
    }

    /**
     * Gets query for [[Idactivity0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdactivity0()
    {
        return $this->hasOne(Activity::className(), ['id' => 'idactivity']);
    }
}
