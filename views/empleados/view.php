<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Empleados */
?>
<div class="empleados-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_departamento',
            'id_encargado',
            'nombre',
            'ap_paterno',
            'ap_materno',
            'curp',
            'tipo_sanguineo',
            'num_seguro',
            'categoria',
            'fecha_inicio_vigencia',
            'fecha_termino_vigencia',
            'ruta_firma',
            'ruta_foto',            
            [                                                  // nombre del propietario del modelo
                'label' => 'Ruta Credencial',
                'value' => $ruta_credencial,
                // 'contentOptions' => ['class' => 'bg-red'],     // atributos HTML para personalizar el valor
                // 'captionOptions' => ['tooltip' => 'Tooltip'],  // atributos HTML para personalizar la etiqueta
            ],
            'tel_emergencia',
            // 'estatus_registro',
            // 'creado_por',
            // 'fecha_creacion',
            // 'modificado_por',
            // 'fecha_modificacion',
        ],
    ]) ?>

</div>
