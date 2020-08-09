<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Part;
use app\models\Participant;

/* @var $this yii\web\View */
/* @var $model app\models\PartParticipant */

$this->title = 'Participant';
//$this->params['breadcrumbs'][] = ['label' => 'Part Participants', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="part-participant-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idparticipant' => $model->idparticipant, 'idpart' => $model->idpart], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idparticipant' => $model->idparticipant, 'idpart' => $model->idpart], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
	[
        	'label'=>'Participant',
                'attribute'=>'iparticipant',
                'value' => function($model){
                    $participant = Participant::find()
                    ->where(['id'=> $model->idparticipant])
                    ->one();
                    return $participant->fname . ' ' . $participant->lname;
                }
         ],
	[
        	'label'=>'Part',
                'attribute'=>'idpart',
                'value' => function($model){
                    $part = Part::find()
                    ->where(['id'=> $model->idpart])
                    ->one();
                    return $part->name;
                }
         ],

            //'idparticipant',
            //'idpart',
        ],
    ]) ?>


</div>
