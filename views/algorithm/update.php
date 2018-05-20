<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Algorithm */

$this->title = 'Update Algorithm: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Algorithms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="algorithm-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
