<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Departamentos */
?>
<div class="departamentos-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'id_encargado',
            'nombre',
            'cp',
            'direccion',
            'estatus_registro',
            // 'creado_por',
            // 'fecha_creacion',
            // 'modificado_por',
            // 'fecha_modificacion',
        ],
    ]) ?>

</div>
