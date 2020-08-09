<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectFinance */
/* @var $finance app\models\Finance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-finance-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idproject')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'idfinance')->hiddenInput()->label(false) ?>

    <?= $form->field($finance, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($finance, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($finance, 'date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
