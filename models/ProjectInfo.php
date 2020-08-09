<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project_info".
 *
 * @property int $id
 * @property string $name
 * @property string|null $manager
 */
class ProjectInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 45],
            [['manager'], 'string', 'max' => 41],
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
            'manager' => 'Manager',
        ];
    }

    public static function primaryKey()
    {
        return array('id');
    }
}
