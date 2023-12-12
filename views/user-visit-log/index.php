<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserVisitLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Visit Logs';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="user-visit-log-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'           => 'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel'  => $searchModel,
            'pjax'         => true,
            'columns'      => require(__DIR__.'/_columns.php'),
            'toolbar'      => [
                ['content' =>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],
                    ['role'=>'modal-remote','title'=> 'Crear','class'=>'btn btn-success']).
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Limpiar']).
                    '{toggleData}'.
                    '{export}'
                ],
            ],          
            
            'striped'        => false,
            'hover'          => true,
            'condensed'      => true,
            'responsive'     => true, 
            'responsiveWrap' => false,  

            'panel'      => [
                'type' => 'default', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> '.$this->title,
                // 'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
                'after'=>BulkButtonWidget::widget([
                            'buttons'=>Html::a('<i class="glyphicon glyphicon-trash"></i>&nbsp; Anular Todo',
                                ["bulk-delete"] ,
                                [
                                    "class"                => "btn btn-danger btn-xs",
                                    'role'                 => 'modal-remote-bulk',
                                    'data-confirm'         => false,
                                    'data-method'          => false,// for overide yii data api
                                    'data-request-method'  => 'post',
                                    'data-confirm-title'   => '¿Está seguro?',
                                    'data-confirm-message' => '¿Seguro que quiere anular este elemento?'
                                ]),
                        ]).                        
                        '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id"     => "ajaxCrudModal",
    "size"   => "modal-lg",
    "footer" => "",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
