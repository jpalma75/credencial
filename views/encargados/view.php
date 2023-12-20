<?php

use yii\widgets\DetailView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Encargados */
?>
<div class="encargados-view">
 
    <?= DetailView::widget([
        'model' => $model,        
        'attributes' => [
            'id',
            'nombre',
            'cargo',
            'ruta_firma',
            [
                'attribute'=>'ruta_firma',
                'value'=>$model->ruta_firma,
                'format' => ['image',['width'=>'100']],
            ]
            // 'estatus_registro',
            // 'creado_por',
            // 'fecha_creacion',
            // 'modificado_por',
            // 'fecha_modificacion',
        ],
    ]) ?>
</div>
