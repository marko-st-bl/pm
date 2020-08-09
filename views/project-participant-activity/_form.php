<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectParticipantActivity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-participant-activity-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idparticipant')->textInput() ?>

    <?= $form->field($model, 'idproject')->textInput() ?>

    <?= $form->field($model, 'idactivity')->textInput() ?>

    <?= $form->field($model, 'hours')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
