<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Empleados */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="empleados-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- < ?= $form->field($model, 'id')->textInput() ?> -->

    <?= $form->field($model, 'id_departamento')->textInput() ?>

    <?= $form->field($model, 'id_encargado')->textInput() ?>

    <?= $form->field($model, 'id_empleado_anterior')->textInput() ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ap_paterno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ap_materno')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'curp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo_sanguineo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num_seguro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'categoria')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_inicio_vigencia')->textInput() ?>

    <?= $form->field($model, 'fecha_termino_vigencia')->textInput() ?>

    <?= $form->field($model, 'ruta_firma')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ruta_foto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ruta_credencial')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tel_emergencia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estatus_registro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'creado_por')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_creacion')->textInput() ?>

    <?= $form->field($model, 'modificado_por')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_modificacion')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
