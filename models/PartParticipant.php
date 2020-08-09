<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "part_participant".
 *
 * @property int $idparticipant
 * @property int $idpart
 *
 * @property Participant $idparticipant0
 * @property Part $idpart0
 */
class PartParticipant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'part_participant';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idparticipant', 'idpart'], 'required'],
            [['idparticipant', 'idpart'], 'integer'],
            [['idparticipant', 'idpart'], 'unique', 'targetAttribute' => ['idparticipant', 'idpart']],
            [['idparticipant'], 'exist', 'skipOnError' => true, 'targetClass' => Participant::className(), 'targetAttribute' => ['idparticipant' => 'id']],
            [['idpart'], 'exist', 'skipOnError' => true, 'targetClass' => Part::className(), 'targetAttribute' => ['idpart' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idparticipant' => 'Idparticipant',
            'idpart' => 'Idpart',
        ];
    }

    /**
     * Gets query for [[Idparticipant0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdparticipant0()
    {
        return $this->hasOne(Participant::className(), ['id' => 'idparticipant']);
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
}
