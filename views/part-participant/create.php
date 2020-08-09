<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PartParticipant */

$this->title = 'Add Participant';
//$this->params['breadcrumbs'][] = ['label' => 'Part Participants', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="part-participant-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
