<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'    =>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'    =>'\kartik\grid\DataColumn',
        'attribute'=>'token',
    ],
    [
        'class'    =>'\kartik\grid\DataColumn',
        'attribute'=>'ip',
    ],
    [
        'class'    =>'\kartik\grid\DataColumn',
        'attribute'=>'language',
    ],
    [
        'class'    =>'\kartik\grid\DataColumn',
        'attribute'=>'user_agent',
    ],
    [
        'class'    =>'\kartik\grid\DataColumn',
        'attribute'=>'user_id',
    ],
    // [
        // 'class'    =>'\kartik\grid\DataColumn',
        // 'attribute'=>'visit_time',
    // ],
    // [
        // 'class'    =>'\kartik\grid\DataColumn',
        // 'attribute'=>'browser',
    // ],
    // [
        // 'class'    =>'\kartik\grid\DataColumn',
        // 'attribute'=>'os',
    // ],
    [
        'class'      => 'kartik\grid\ActionColumn',
        'dropdown'   => false,
        'vAlign'     => 'middle',
        'template'   => '{view} {update} {delete}',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'   =>['role' => 'modal-remote', 'title' => 'Ver',    'data-toggle' => 'tooltip'],
        'updateOptions' =>['role' => 'modal-remote', 'title' => 'Editar', 'data-toggle' => 'tooltip'],
        'deleteOptions' =>['role' => 'modal-remote', 'title' => 'Anular', 
                          'data-confirm'         => false,
                          'data-method'          => false, // for overide yii data api
                          'data-request-method'  => 'post',
                          'data-toggle'          => 'tooltip',
                          'data-confirm-title'   => '¿Está seguro?',
                          'data-confirm-message' => '¿Seguro que quiere anular este elemento?'], 
    ],

];   