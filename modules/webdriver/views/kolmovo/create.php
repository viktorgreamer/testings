<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Kolmovo */

$this->title = 'Create Kolmovo';
$this->params['breadcrumbs'][] = ['label' => 'Kolmovos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kolmovo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
