<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Sources;
/* @var $this yii\web\View */
/* @var $model app\models\Algorithm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="algorithm-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_source')->dropDownList(Sources::getSources()) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_account')->dropDownList(\app\models\Accounts::getAccounts()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
