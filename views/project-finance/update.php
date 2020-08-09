<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProjectFinance */

$this->title = 'Update Project Finance: ' . $model->idfinance;
//$this->params['breadcrumbs'][] = ['label' => 'Project Finances', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->idfinance, 'url' => ['view', 'idfinance' => $model->idfinance, 'idproject' => $model->idproject]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="project-finance-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'finance' => $finance,
    ]) ?>

</div>
