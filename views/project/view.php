<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use app\models\Participant;
use app\models\Supervisor;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-view">

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
            //'idmanager',
            [
                'label'=>'Manager',
                'attribute'=>'idmanager',
                'value' => function($model){
                    $manager = Participant::find()
                    ->where(['id'=> $model->idmanager])
                    ->one();
                    return $manager->fname . " " . $manager->lname;
                }
            ],

            [
                'label'=>'Supervisor',
                'attribute'=>'idsupervisor',
                'value' => function($model){
                    $supervisor = Supervisor::find()
                    ->where(['id'=> $model->idsupervisor])
                    ->one();
                    return $supervisor->fname . " " . $supervisor->lname;
                }
            ],
        ],
    ]) ?>

    <p><?= Html::a('State', ['part/index/', 'PartSearch[idproject]' => $model->id, 'idproject'=>$model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Finances', ['project-finance/index/', 'ProjectFinanceSearch[idproject]' => $model->id, 'idproject'=>$model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Activities', ['activity/index/', 'Activiy[idproject]' => $model->id, 'idproject'=>$model->id], ['class' => 'btn btn-primary']) ?></p>

</div>