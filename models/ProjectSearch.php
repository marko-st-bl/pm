<?php

namespace app\models;

use Yii;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Project;

/**
 * ProjectSearch represents the model behind the search form of `app\models\Project`.
 */
class ProjectSearch extends Project
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'idmanager'], 'safe'],
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
        $query = Project::find();

        // add conditions that should always apply here
	$pid = Yii::$app->user->identity->getParticipantId(Yii::$app->user->id);			//participant
	if(Manager::find()->where(['id' => $pid])->exists()){
	$query->andFilterWhere(['idmanager' => $pid]);
	}else{
	     if(PartParticipant::find()->where(['idparticipant' => $pid])->exists()){
	     	$pp = PartParticipant::find()->where(['idparticipant' => $pid])->all();
	     	foreach($pp as $p){
			$part = Part::findOne($p->idpart);
			$query->orFilterWhere(['id' => $part->idproject]);
	     }
	}else{
		$query->andFilterWhere(['id'=> 0]);
	     }
	}
	$sid = Yii::$app->user->identity->getSupervisorId(Yii::$app->user->id);
	if(Supervisor::find()->where(['id' => $sid])->exists()){
	$query->andFilterWhere(['idsupervisor' => $sid->id]);
	}

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
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
        ->andFilterWhere(['like', 'participant.fname', $this->idmanager]);

        return $dataProvider;
    }
}
