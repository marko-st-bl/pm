<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PartSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Parts';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="part-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Part', ['create', 'idproject' => Yii::$app->request->get('idproject')], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            //'idproject',
            //'part_idpart',
            'startdate:date',
            'enddate:date',
            'progress:percent',
            'staffrequired',
            'hoursrequired',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
