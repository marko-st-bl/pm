<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Manager;
use app\models\ExternalParticipant;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ParticipantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Participants';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="participant-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Internal Participant', ['create', 'type' => 'internal'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Create External Participant', ['create', 'type' => 'external'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Create Manager', ['create', 'type' => 'manager'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Create Supervisor', ['create', 'type' => 'supervisor'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'fname',
            'lname',
	    ['label' => 'Role',
             'attribute'=>'id',
             'value' => function($model){
                     if(Manager::find()
                    ->where(['id'=> $model->id])
                    ->exists()){
			return 'Manager';
		    }else if(ExternalParticipant::find()
                    ->where(['id'=> $model->id])
                    ->exists()){
			return 'External';
		    }else{
			return 'Internal';
		}
		}	
            ],
            'iduseracc',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
