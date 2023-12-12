<?php

/* @var $this yii\web\View */

$this->title = 'Acceder';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?= Yii::$app->params['SistemaNombre']; ?></h1>
        <h1>SUCURSAL</h1>

        <hr>
        A
        <?=
        	Yii::$app->getSession()->get('SUC_ID')
        ?>

        <hr>
        B
        <?php
        	Yii::$app->getSession()->set('SUC_ID', 'valorVariable');
        ?>

        <hr>
        C
        <?=
        	Yii::$app->getSession()->remove('SUC_ID');
        ?>
        <hr>
        D

        <?=
        	Yii::$app->getSession()->get('SUC_ID')
        ?>

        <p class="lead"><?= Yii::$app->params['SistemaDescripcion']; ?></p>

    </div>
    
</div>