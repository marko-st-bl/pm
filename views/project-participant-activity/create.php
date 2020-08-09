<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectParticipantActivity */

$this->title = 'Create Project Participant Activity';
$this->params['breadcrumbs'][] = ['label' => 'Project Participant Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-participant-activity-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
