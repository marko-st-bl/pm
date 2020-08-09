<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Useracc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="useracc-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'authKey')->textInput()->hiddenInput(['value'=>Yii::$app->security->generateRandomString(12)])->label(false); ?>

    <?= $form->field($model, 'accessToken')->textInput()->hiddenInput(['value'=>Yii::$app->security->generateRandomString(5)])->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
