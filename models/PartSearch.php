<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Part;

/**
 * PartSearch represents the model behind the search form of `app\models\Part`.
 */
class PartSearch extends Part
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idproject', 'part_idpart', 'staffrequired', 'hoursrequired'], 'integer'],
            [['name', 'startdate', 'enddate'], 'safe'],
            [['progress'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Part::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'idproject' => $this->idproject,
            'part_idpart' => $this->part_idpart,
            'startdate' => $this->startdate,
            'enddate' => $this->enddate,
            'progress' => $this->progress,
            'staffrequired' => $this->staffrequired,
            'hoursrequired' => $this->hoursrequired,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
