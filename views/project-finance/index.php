<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Finance;
use app\models\Income;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProjectFinanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Project Finances';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-finance-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Add Income', ['finance/create', 'type' => 'income', 'idproject' => Yii::$app->request->get('idproject')], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Add Outcome', ['finance/create', 'type' => 'outcome', 'idproject' => Yii::$app->request->get('idproject')], ['class' => 'btn btn-danger']) ?>
    </p>

    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions' => function($model){
            if(Income::find()
            ->where(['id'=> $model->idfinance])
            ->exists()){
                return ['class' => 'success'];
            }
            return ['class' => 'danger'];
        },
        //'filterModel' => $searchModel,
        'columns' => [

            'idfinance',
            [
                'label'=>'Description',
                'attribute'=>'idproject',
                'value' => function($model){
                    $finance = Finance::find()
                    ->where(['id'=> $model->idfinance])
                    ->one();
                    return $finance->description;
                }
            ],
            [
                'label'=>'Amount',
                'attribute'=>'idproject',
                'format' => ['currency', 'BAM'],
                'value' => function($model){
                    $finance = Finance::find()
                    ->where(['id'=> $model->idfinance])
                    ->one();
                    return $finance->amount;
                }
            ],

            [
                'label'=>'Date',
                'attribute'=>'idproject',
                'format' => 'date',
                'value' => function($model){
                    $finance = Finance::find()
                    ->where(['id'=> $model->idfinance])
                    ->one();
                    return $finance->date;
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>



</div>
