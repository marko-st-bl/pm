<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Participant;
use app\models\Supervisor;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Project', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
