<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\db\Query;
use app\models\ProjectActivityParticipant;

/* @var $this yii\web\View */
/* @var $model app\models\Activity */

$this->title = $model->name;
//$this->params['breadcrumbs'][] = ['label' => 'Activities', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="activity-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?=  DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'idproject',
            'name',
        ],
    ]) ?>
    <p>
        <?= Html::a('Participants', ['project-activity-participant/index', 'ProjectActivityParticipantSearch[idactivity]' => $model->id, 
        'idproject' => $model->idproject, 'idactivity' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
</div>
