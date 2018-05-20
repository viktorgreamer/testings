<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Webstep */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="webstep-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-4">
            <?php if ($model->id_algorithm) {
                echo $form->field($model, 'id_algorithm')->dropDownList(\app\models\Algorithm::getAlgorithm(), ['disabled' => 'disabled']);
            } else {
               echo $form->field($model, 'id_algorithm')->dropDownList(\app\models\Algorithm::getAlgorithm());
            }
            ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'priority')->textInput(['disabled' => 'disabled', 'size' => 3]) ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'type')->dropDownList(\app\models\Webstep::TYPES()) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2">
            <?= $form->field($model, 'step')->dropDownList(\app\components\MyChromeDriver::getSteps()) ?>
        </div>


        <? // echo  Html::dropDownList('id_source',  \app\models\Sources::getSources()) ?>


        <div class="col-lg-2">
            <?= $form->field($model, 'text')->textInput(['maxlength' => true])->label('text\url') ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'selector')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-2">
            <?= $form->field($model, 'preg_match')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
<div class="row">
    <div class="col-lg-2">
        <?= $form->field($model, 'if_true')->dropDownList([ 0 => 'NO'] + \app\models\Webstep::getNamedExceptons($model->id_algorithm)) ?>
    </div>
    <div class="col-lg-2">
        <?= $form->field($model, 'if_false')->dropDownList([ 0 => 'NO'] +  \app\models\Webstep::getNamedExceptons($model->id_algorithm)) ?>
    </div>
    <div class="col-lg-2">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>
</div>
        <div class="col-lg-2">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>

    </div>
