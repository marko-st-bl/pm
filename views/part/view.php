<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Part */

$this->title = $model->name;
//$this->params['breadcrumbs'][] = ['label' => 'Parts', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="part-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'idproject',
            'part_idpart',
            'startdate:date',
            'enddate:date',
            'progress:percent',
            'staffrequired',
            'hoursrequired',
        ],
    ]) ?>
    <p>
        <?= Html::a('Participants', ['part-participant/index', 'PartParticipantSearch[idpart]' => $model->id,'idpart' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

</div>
