<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Part */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="part-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idproject')->textInput()->hiddenInput(['value'=>Yii::$app->request->get('idproject')])->label(false); ?>

    <?= $form->field($model, 'part_idpart')->textInput() ?>

    <?= $form->field($model, 'startdate')->textInput() ?>

    <?= $form->field($model, 'enddate')->textInput() ?>

    <?= $form->field($model, 'progress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'staffrequired')->textInput() ?>

    <?= $form->field($model, 'hoursrequired')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
