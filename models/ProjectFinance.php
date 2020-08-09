<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project_finance".
 *
 * @property int $idfinance
 * @property int $idproject
 *
 * @property Finance $idfinance0
 * @property Project $idproject0
 */
class ProjectFinance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project_finance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idfinance', 'idproject'], 'required'],
            [['idfinance', 'idproject'], 'integer'],
            [['idfinance', 'idproject'], 'unique', 'targetAttribute' => ['idfinance', 'idproject']],
            [['idfinance'], 'exist', 'skipOnError' => true, 'targetClass' => Finance::className(), 'targetAttribute' => ['idfinance' => 'id']],
            [['idproject'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['idproject' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idfinance' => 'ID Finance',
            'idproject' => 'Idproject',
        ];
    }

    /**
     * Gets query for [[Idfinance0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdfinance0()
    {
        return $this->hasOne(Finance::className(), ['id' => 'idfinance']);
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
}
