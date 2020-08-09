<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectFinance */

$this->title = 'Create Project Finance';
$this->params['breadcrumbs'][] = ['label' => 'Project Finances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-finance-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'finance' => $finance,
    ]) ?>

</div>
