<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PartParticipant */

$this->title = 'Update Part Participant: ' . $model->idparticipant;
//$this->params['breadcrumbs'][] = ['label' => 'Part Participants', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->idparticipant, 'url' => ['view', 'idparticipant' => $model->idparticipant, 'idpart' => $model->idpart]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="part-participant-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
