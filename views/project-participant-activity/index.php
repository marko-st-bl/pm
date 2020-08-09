<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Participant;
use app\models\Activity;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectParticipantActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Project Participant Activities';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-participant-activity-index">

    <h1><?= Html::encode('Project Activities') ?></h1>

    <p>
        <?= Html::a('Create Project Activity', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label'=>'Participant',
                'attribute'=>'idparticipant',
                'value' => function($model){
                    $participant = Participant::find()
                    ->where(['id'=> $model->idparticipant])
                    ->one();
                    return $participant->fname . " " . $participant->lname;
                }
            ],
            [
                'label'=>'Activity',
                'attribute'=>'idactivity',
                'value' => function($model){
                    $activity = Activity::find()
                    ->where(['id'=> $model->idactivity])
                    ->one();
                    return $activity->name;
                }
            ],
            //'idparticipant',
            //'idproject',
            //'idactivity',
            'hours',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
