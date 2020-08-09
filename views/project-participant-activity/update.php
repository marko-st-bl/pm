<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectParticipantActivity */

$this->title = 'Update Project Participant Activity: ' . $model->idparticipant;
$this->params['breadcrumbs'][] = ['label' => 'Project Participant Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idparticipant, 'url' => ['view', 'idparticipant' => $model->idparticipant, 'idproject' => $model->idproject, 'idactivity' => $model->idactivity]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="project-participant-activity-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
