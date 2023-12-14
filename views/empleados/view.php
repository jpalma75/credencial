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
            'id_empleado_anterior',
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
            'ruta_credencial',
            'tel_emergencia',
            'estatus_registro',
            'creado_por',
            'fecha_creacion',
            'modificado_por',
            'fecha_modificacion',
        ],
    ]) ?>

</div>
