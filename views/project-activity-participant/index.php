<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Participant;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectActivityParticipantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Participants';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-activity-participant-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Add Participant', ['create', 'idproject' => Yii::$app->request->get('idproject'), 'idactivity' => Yii::$app->request->get('idactivity')], ['class' => 'btn btn-success']) ?>
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
            //'idproject',
            //'idactivity',
            'hours',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
