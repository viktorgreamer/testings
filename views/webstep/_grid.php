<?php

use yii\grid\GridView;
use app\components\MyChromeDriver;
use yii\helpers\Html;
use yii\widgets\Pjax;

// my_var_dump($dataProvider);
Pjax::begin(['id' => 'pjax_id']);
echo GridView::widget([
    'dataProvider' => $dataProvider,
    //  'filterModel' => $searchModel,
    'columns' => [
        // ['class' => 'yii\grid\SerialColumn'],

        //    'id',
        'priority',

        [
            'label' => 'name',
            'format' => 'raw',
            'value' => function ($model) {
                return span($model->name, 'success');
            }
        ],
        [
            'label' => 'step',
            'format' => 'raw',
            'value' => function ($model) {
                return span(MyChromeDriver::getSteps($model->step));
            }
        ],
        [
            'label' => 'text/url/duration',
            'format' => 'raw',
            'value' => function ($model) {
                return $model->text;
            }
        ],


        'selector',
        'preg_match',
        [
            'label' => 'EXCEPTIONS',
            'format' => 'raw',
            'value' => function ($model) {
                $body = '';
                if ($model->if_true) $body .= span($model->if_true);
                if ($model->if_false) $body .= span($model->if_false,'danger');
                return $body;
            }
        ],
        [
            'label' => 'prioriry',
            'format' => 'raw',
            'value' => function ($model) {
                return Html::a('<span class="glyphicon glyphicon-triangle-top"></span>', null, [
                        'class' => 'btn btn-sm priority_up',
                        'data-pjax' => '1',
                        'data-id' => $model->id,
                        'data-id_algorithm' => $model->id_algorithm,
                    ]) . " " . Html::a('<span class="glyphicon glyphicon-triangle-bottom"></span>', null, [
                        'class' => 'btn btn-sm priority_down',
                        'data-pjax' => '1',
                        'data-pjax-timeout' => 5000,
                        'data-id' => $model->id,
                        'data-id_algorithm' => $model->id_algorithm,
                    ]);
            }
        ],
        [
            'label' => 'actions',
            'format' => 'raw',
            'value' => function ($model) {
                return Html::a('update', ['webstep/update', 'id' => $model->id], ['target' => '_blank']);
            }
        ],

        // ['class' => 'yii\grid\ActionColumn'],
    ],
]);
Pjax::end();
?>
<?php

$script = <<< JS
$(document).on('click', '.priority_up', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var id_algorithm = $(this).data('id_algorithm');
    var direction = 'up';

    $.ajax({
        url: '/webstep/change-priority',
        data: {id: id, direction: direction, id_algorithm: id_algorithm},
        type: 'get',
        success: function (res) {
$.pjax.reload('#pjax_id');
    },

        error: function () {

    }
    });
    this.disabled = true;
});
$(document).on('click', '.priority_down', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var id_algorithm = $(this).data('id_algorithm');
    var direction = 'down';

    $.ajax({
        url: '/webstep/change-priority',
        data: {id: id, direction: direction, id_algorithm: id_algorithm},
        type: 'get',
        success: function (res) {
$.pjax.reload('#pjax_id');
    },

        error: function () {

    }
    });
    this.disabled = true;
});   
JS;
//маркер конца строки, обязательно сразу, без пробелов и табуляции
$this->registerJs($script, yii\web\View::POS_READY);



