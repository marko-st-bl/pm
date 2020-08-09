<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Participant;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectActivityParticipant */
/* @var $form yii\widgets\ActiveForm */

$participants=Participant::find()
->select(["CONCAT(fname, ' ', lname)"])
->indexBy('id')
->column();

?>

<div class="project-activity-participant-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'idparticipant')->dropDownList($participants,
    ['prompt'=>'Select Participant']) ?>

    <?= $form->field($model, 'idproject')->textInput()->hiddenInput(['value'=>Yii::$app->request->get('idproject')])->label(false); ?>

    <?= $form->field($model, 'idactivity')->textInput()->hiddenInput(['value'=>Yii::$app->request->get('idactivity')])->label(false); ?>

    <?= $form->field($model, 'hours')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
