<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Encargados */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="encargados-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- < ?= $form->field($model, 'id')->textInput() ?> -->

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cargo')->textInput(['maxlength' => true]) ?>

    <?= Html::img($model->ruta_firma, ['width' => '60px']) ?>

    <?= $form->field($model, 'archivo')->fileInput() ?>
    
    <!-- < ?= $form->field($model, 'ruta_firma')->textInput(['maxlength' => true]) ?> -->

    <!-- < ?= $form->field($model, 'estatus_registro')->textInput(['maxlength' => true]) ?> -->

    <!-- < ?= $form->field($model, 'creado_por')->textInput(['maxlength' => true]) ?>

    < ?= $form->field($model, 'fecha_creacion')->textInput() ?>

    < ?= $form->field($model, 'modificado_por')->textInput(['maxlength' => true]) ?>

    < ?= $form->field($model, 'fecha_modificacion')->textInput() ?> -->

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
