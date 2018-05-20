<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Webstep */

$this->title = 'Create Webstep';
$this->params['breadcrumbs'][] = ['label' => 'Websteps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="webstep-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
