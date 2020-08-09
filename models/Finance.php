<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "finance".
 *
 * @property int $id
 * @property float $amount
 * @property string $description
 * @property string $date
 *
 * @property Income $income
 * @property Outcome $outcome
 * @property ProjectFinance[] $projectFinances
 * @property Project[] $idprojects
 */
class Finance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'finance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount', 'description', 'date'], 'required'],
            [['amount'], 'number'],
            [['date'], 'safe'],
            [['description'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'amount' => 'Amount',
            'description' => 'Description',
            'date' => 'Date',
        ];
    }

    /**
     * Gets query for [[Income]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIncome()
    {
        return $this->hasOne(Income::className(), ['id' => 'id']);
    }

    /**
     * Gets query for [[Outcome]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOutcome()
    {
        return $this->hasOne(Outcome::className(), ['id' => 'id']);
    }

    /**
     * Gets query for [[ProjectFinances]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProjectFinances()
    {
        return $this->hasMany(ProjectFinance::className(), ['idfinance' => 'id']);
    }

    /**
     * Gets query for [[Idprojects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdprojects()
    {
        return $this->hasMany(Project::className(), ['id' => 'idproject'])->viaTable('project_finance', ['idfinance' => 'id']);
    }
}
