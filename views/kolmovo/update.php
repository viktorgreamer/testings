<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Kolmovo */

$this->title = 'Update Kolmovo: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Kolmovos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kolmovo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
