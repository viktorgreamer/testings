<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>FOR ADMIN CONTENT</h1>

        <p class="lead">this content is for admin</p>

        <?= Yii::$app->user->isGuest; ?>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>


</div>
