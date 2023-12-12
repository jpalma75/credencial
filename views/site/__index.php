<?php

/* @var $this yii\web\View */

$this->title = 'Inicio';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?= Yii::$app->params['SistemaNombre']; ?></h1>

        <p class="lead"><?= Yii::$app->params['SistemaDescripcion']; ?></p>

    </div>
    
</div>