<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Encargados */
?>
<div class="encargados-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'nombre',
            'cargo',
            'ruta_firma',
            'estatus_registro',
            // 'creado_por',
            // 'fecha_creacion',
            // 'modificado_por',
            // 'fecha_modificacion',
        ],
    ]) ?>

</div>
