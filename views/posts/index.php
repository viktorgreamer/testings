<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Posts;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PostsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Posts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'body:ntext',
            'id_user', [
                'label' => 'кнопки',
                'format' => 'raw',
                'value' => function ($model) {
                    $model->trigger(Posts::EVENT_VIEW);
                    if ((Yii::$app->user->can('updateOwnPosts', $model->id_user))
                        OR (Yii::$app->user->can('updatePosts')))
                        $body .= Html::a('edit', ['posts/update', 'id' => $model->id], ['class' => 'btn btn-success', 'target' => '_blank']);
                    if ((Yii::$app->user->can('deleteOwnPosts', $model->id_user))
                        OR (Yii::$app->user->can('deletePosts')))
                        $body .= Html::a('delete', ['posts/delete', 'id' => $model->id], ['class' => 'btn btn-danger', 'target' => '_blank']);
                    return $body;
                }
            ],
            'views_count',
            'views_count_detailed',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
