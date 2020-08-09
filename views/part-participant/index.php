<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Participant;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PartParticipantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Participants';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="part-participant-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Add Participant', ['create', 'idpart' => Yii::$app->request->get('idpart')], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
	[
        	'label'=>'First',
                'attribute'=>'iparticipant',
                'value' => function($model){
                    $participant = Participant::find()
                    ->where(['id'=> $model->idparticipant])
                    ->one();
                    return $participant->fname;
                }
         ],
	[
        	'label'=>'Last',
                'attribute'=>'iparticipant',
                'value' => function($model){
                    $participant = Participant::find()
                    ->where(['id'=> $model->idparticipant])
                    ->one();
                    return $participant->lname;
                }
         ],
            //'idparticipant',
            //'idpart',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
