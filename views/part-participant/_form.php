<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Participant;

/* @var $this yii\web\View */
/* @var $model app\models\PartParticipant */
/* @var $form yii\widgets\ActiveForm */

$participants=Participant::find()
->select(["CONCAT(fname, ' ', lname)"])
->indexBy('id')
->column();
?>

<div class="part-participant-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idparticipant')->dropDownList($participants,
    ['prompt'=>'Select Participant']) ?>

    <?= $form->field($model, 'idpart')->textInput()->hiddenInput(['value'=>Yii::$app->request->get('idpart')])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
