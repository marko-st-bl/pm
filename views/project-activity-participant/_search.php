<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectActivityParticipantSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-activity-participant-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idparticipant') ?>

    <?= $form->field($model, 'idproject') ?>

    <?= $form->field($model, 'idactivity') ?>

    <?= $form->field($model, 'hours') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
