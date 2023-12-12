<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = "User-visit-log";

/* @var $this yii\web\View */
/* @var $model app\models\UserVisitLog */
?>
<div class="user-visit-log-view">

    <div class="panel panel-default">

        <?php  if (!Yii::$app->request->isAjax){ ?>

        <div class="panel-heading">
            <?=  Html::a('<i class="glyphicon glyphicon-list"></i> '.$this->title, ['index'], ['class' => 'btn btn-default btn-sm']) ?>

            <div class="pull-right">
                <?=  Html::a('Crear más', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
                <?=  Html::a('Editar', ['update', 'id' => $model], ['class' => 'btn btn-primary btn-sm']) ?>

                <!-- ANULAR REGISTRO SI NO TIENE REGISTROS ASIGNADOS -->
                <?php // if (count($model) == 0): ?>
                    
                    <?=  Html::a('Anular', ['delete', 'id' => $model], [
                        'class' => 'btn btn-danger btn-sm',
                        'data'  => [
                            'confirm' => '¿Esta seguro de anular este registro?',
                            'method'  => 'post',
                        ],
                    ]) ?>

                <?php // endif ?>
            </div>
        </div>
        <?php } ?>        
        <div class="panel-body">
    
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
            'token',
            'ip',
            'language',
            'user_agent',
            'user_id',
            'visit_time:datetime',
            'browser',
            'os',
            ],
        ]) ?>

        <?php  if (Yii::$app->user->identity->superadmin): ?>
        <hr>
        <?php /* DetailView::widget([
            'model' => $model,
            'attributes' => [
                'fecha_creacion',
                'usuario_creacion',
                'fecha_modificacion',
                'usuario_modificacion',
            ],
        ]) */ ?>

        <?php  endif ?>

        </div>
    </div>
</div>
