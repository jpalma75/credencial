<?php
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\date\DatePicker;
use app\components\Utilidades;

return [
    // [
    //     'class' => 'kartik\grid\CheckboxColumn',
    //     'width' => '20px',
    // ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'id_departamento',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'departamento_nombre',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'departamento_nombre',
        'format'=>'raw',
        // 'value'=> function($model){
        //     if(!empty($model->estadoAutorizacion)){
        //         return $model->estadoAutorizacion;
        //     }
        // },
        'filterType' => GridView::FILTER_SELECT2, 
        'filterWidgetOptions' => [
                    'data'     => $departamentosDesc,
                    'options'  => [
                        'placeholder'   => 'Selecciona un departamento ...'
                    ],
                    'pluginOptions' => [
                         'allowClear'   => true
                    ],
        ],
    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'id_encargado',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'encargado_nombre',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'encargado_nombre',
        'format'=>'raw',
        'filterType' => GridView::FILTER_SELECT2, 
        'filterWidgetOptions' => [
                    'data'     => $encargadosDesc,
                    'options'  => [
                        'placeholder'   => 'Selecciona un encargado ...'
                    ],
                    'pluginOptions' => [
                         'allowClear'   => true
                    ],
        ],
    ],    
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'id_empleado_anterior',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nombre',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ap_paterno',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ap_materno',
    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'curp',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'tipo_sanguineo',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'num_seguro',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'categoria',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'fecha_inicio_vigencia',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'fecha_inicio_vigencia',
        'value'     => function($model){
            return Utilidades::formatoFechaCorta($model->fecha_inicio_vigencia);
        },

        'vAlign'         => 'middle',
        'contentOptions' => ['style'=>'width:20%'],
        'filterType'     => GridView::FILTER_DATE_RANGE,
        'filterWidgetOptions' => [
            'convertFormat'=>true,
            'pluginOptions' => [
                'timePicker'=>false,
                'timePickerIncrement'=>15,
                'locale'=>['format'=>'Y-m-d']
            ],
        ],
    ],

    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'fecha_termino_vigencia',
    // ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'fecha_termino_vigencia',
        'value'     => function($model){
            return Utilidades::formatoFechaCorta($model->fecha_termino_vigencia);
        },

        'vAlign'         => 'middle',
        'contentOptions' => ['style'=>'width:20%'],
        'filterType'     => GridView::FILTER_DATE_RANGE,
        'filterWidgetOptions' => [
            'convertFormat'=>true,
            'pluginOptions' => [
                'timePicker'=>false,
                'timePickerIncrement'=>15,
                'locale'=>['format'=>'Y-m-d']
            ],
        ],
    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'ruta_firma',
    // ],
    [
        'format'=>'html',
        'label' =>'Firma',
        'value'=>function($data){            
            return Html::img($data->ruta_firma, ['width' => '60px']);
        }
    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'ruta_foto',
    // ],
    [
        'format'=>'html',
        'label'=>'Foto',
        'value'=>function($data){
            return Html::img($data->ruta_foto, ['width' => '30px']);
        }
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'ruta_credencial',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'tel_emergencia',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'estatus_registro',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'creado_por',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'fecha_creacion',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'modificado_por',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'fecha_modificacion',
    // ],
    // [
    //     'class' => 'kartik\grid\ActionColumn',
    //     'dropdown' => false,
    //     'vAlign'=>'middle',
    //     'urlCreator' => function($action, $model, $key, $index) { 
    //             return Url::to([$action,'id'=>$key]);
    //     },
    //     'viewOptions'=>['role'=>'modal-remote','title'=>'Ver','data-toggle'=>'tooltip'],
    //     'updateOptions'=>['role'=>'modal-remote','title'=>'Actualizar', 'data-toggle'=>'tooltip'],
    //     'deleteOptions'=>['role'=>'modal-remote','title'=>'Borrar', 
    //                       'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
    //                       'data-request-method'=>'post',
    //                       'data-toggle'=>'tooltip',
    //                       'data-confirm-title'=>'¿Está Seguro?',
    //                       'data-confirm-message'=>'¿Está Seguro de Querer Eliminar Este Elemento?'], 
    // ],


    [
        'class'      => 'kartik\grid\ActionColumn',
        'dropdown'   => false,
        'vAlign'     =>'middle',
        'width'      => '100px',        
        'template'   => '{print} {view} {update} {delete}',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key, 'fecha_creacion'=>$model->fecha_creacion]);
                // return Url::to([$action,'id'=>$key]);
        },
        // 'viewOptions'=>['role'=>'modal-remote','title'=>'Ver','data-toggle'=>'tooltip'],
        // 'contentOptions' => ['style' => 'width: 120px;', 'class' => 'text-center'],
        // 'updateOptions'=>['title'=>'Update', 'data-toggle'=>'tooltip'],
        // 'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
        //                   'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
        //                   'data-request-method'=>'post',
        //                   'data-toggle'=>'tooltip',
        //                   'data-confirm-title'=>'Está seguro?',
        //                   'data-confirm-message'=>'Está seguro que desea eliminar el registro'], 
        'buttons' => [
            'print' => function ($url, $model) {
                $estado = $model->credencial_disponible ? $model->credencial_disponible : false;

                if( $estado ) {
                    return Html::a('<span class="glyphicon glyphicon-print"></span>', ['imprimir','id' => $model->id], [
                                    'target'    => '_blank',                          
                                    'title'     => Yii::t('app', 'lead-print'),
                                    'data-pjax' => 0
                            ]);
                } else {
                    return '';
                }

                                           
            },
            'view'  => function($url,$model){
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['view','id' => $model->id], [
                               'title' => 'Ver', 'data-pjax' => 0 
                        ]);
            },
            'update'  => function($url,$model){
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update','id' => $model->id, 'fecha_creacion'=>$model->fecha_creacion], [
                               'title' => 'Actualizar', 'data-pjax' => 0 
                        ]);
            },
            'delete'  => function($url,$model){
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete','id' => $model->id], [
                               'title' => 'Eliminar',
                               'data' => ['confirm' => '¿Estás seguro de que deseas eliminar este elemento?',
                               'method' => 'post', 'data-pjax' => false],
                        ]);
            },
        ],
    ],

];   