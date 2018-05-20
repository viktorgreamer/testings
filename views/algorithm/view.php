<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\Algorithm */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Algorithms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="algorithm-view">

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
            //'id',
            'id_source',
            'name',
            'id_account',
        ],
    ]) ?>

    <?= Html::a('create step', ['webstep/create', 'id_algorithm' => $model->id], ['class' => 'btn btn-primary', 'target' => '_blank']) ?>
    <? $dataProvider = new ActiveDataProvider([
        'query' => $model->getQuerySteps(),
        'sort'=> ['defaultOrder' => ['priority'=>SORT_ASC]]
    ]); ?>
    <? echo $this->render('/webstep/_grid', ['dataProvider' => $dataProvider]); ?>

    <h3>EXCEPTIONS</h3>
    <? $dataProvider = new ActiveDataProvider([
        'query' => $model->getQueryStepsExceptions(),
        'sort'=> [
                'defaultOrder' => [
                    'name' => SORT_ASC,
                    'priority'=>SORT_ASC
                ]
        ]
    ]); ?>
    <? echo $this->render('/webstep/_grid', ['dataProvider' => $dataProvider]); ?>


</div>
