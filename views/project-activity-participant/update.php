<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectActivityParticipant */

$this->title = 'Update Project Activity Participant: ' . $model->idparticipant;
//$this->params['breadcrumbs'][] = ['label' => 'Project Activity Participants', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->idparticipant, 'url' => ['view', 'idparticipant' => $model->idparticipant, 'idproject' => $model->idproject, 'idactivity' => $model->idactivity]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="project-activity-participant-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
