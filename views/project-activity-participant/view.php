<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectActivityParticipant */

$this->title = $model->idparticipant;
//$this->params['breadcrumbs'][] = ['label' => 'Project Activity Participants', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-activity-participant-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idparticipant' => $model->idparticipant, 'idproject' => $model->idproject, 'idactivity' => $model->idactivity], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idparticipant' => $model->idparticipant, 'idproject' => $model->idproject, 'idactivity' => $model->idactivity], [
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
            'idparticipant',
            'idproject',
            'idactivity',
            'hours',
        ],
    ]) ?>

</div>
