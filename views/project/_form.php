<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Participant;
use app\models\Supervisor;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$supervisors=Supervisor::find()
->select(["CONCAT(fname, ' ', lname)"])
->indexBy('id')
->column();

$managers=Participant::find()
->select(["CONCAT(fname, ' ', lname)"])
->innerJoin('manager', 'manager.id=participant.id')
->indexBy('id')
->column();
?>



<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idmanager')->dropDownList($managers,
    ['prompt'=>'Select Supervisor']) ?>

    <?= $form->field($model, 'idsupervisor')->dropDownList($supervisors,
    ['prompt'=>'Select Supervisor']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
