<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Algorithm;
use app\models\Sources;


/* @var $this yii\web\View */
/* @var $model app\Models\WebstepSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="webstep-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <? //  echo $form->field($model, 'id') ?>
    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'id_source')->dropDownList(Sources::getSources()) ?>
        </div>
        <div class="col-lg-3">
            <? if ($model->id_source) echo $form->field($model, 'id_algorithm')->dropDownList(Algorithm::getAlgorithm($model->id_source)) ?>
        </div>


        <? // echo $form->field($model, 'text') ?>

        <? // echo $form->field($model, 'selector') ?>
        <div class="col-lg-3">
            <div class="form-group">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
