<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectActivityParticipant */

$this->title = 'Add Participant';
//$this->params['breadcrumbs'][] = ['label' => 'Participants', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-activity-participant-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
