<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Empleados */
?>
<div class="empleados-update">

    <?= $this->render('_form', [
        'model' => $model,
        'lstdepartamentos' => $lstdepartamentos,
        'lstencargados' => $lstencargados,
    ]) ?>

</div>
