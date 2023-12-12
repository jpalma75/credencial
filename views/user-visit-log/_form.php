<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "User-visit-log";

/* @var $this yii\web\View */
/* @var $model app\models\UserVisitLog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-visit-log-form">

    <div class="panel panel-default">
    
        <?php  if (!Yii::$app->request->isAjax){ ?>

        <div class="panel-heading">
            <?=  Html::a('<i class="glyphicon glyphicon-list"></i> '.$this->title, ['index'], ['class' => 'btn btn-default btn-sm']) ?>
        </div>
        <?php } ?>
        <div class="panel-body">

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'token')
             ->textInput([
                    'maxlength'   => true,
                    'placeholder' => $model->getAttributeLabel('token')
                   ])
             ->labelHint() ?>

    <?= $form->field($model, 'ip')
             ->textInput([
                    'maxlength'   => true,
                    'placeholder' => $model->getAttributeLabel('ip')
                   ])
             ->labelHint() ?>

    <?= $form->field($model, 'language')
             ->textInput([
                    'maxlength'   => true,
                    'placeholder' => $model->getAttributeLabel('language')
                   ])
             ->labelHint() ?>

    <?= $form->field($model, 'user_agent')
             ->textInput([
                    'maxlength'   => true,
                    'placeholder' => $model->getAttributeLabel('user_agent')
                   ])
             ->labelHint() ?>

    <?= $form->field($model, 'user_id')
                 ->textInput(['placeholder' => $model->getAttributeLabel('user_id')])
                 ->labelHint() ?>

    <?= $form->field($model, 'visit_time')
                 ->textInput(['placeholder' => $model->getAttributeLabel('visit_time')])
                 ->labelHint() ?>

    <?= $form->field($model, 'browser')
             ->textInput([
                    'maxlength'   => true,
                    'placeholder' => $model->getAttributeLabel('browser')
                   ])
             ->labelHint() ?>

    <?= $form->field($model, 'os')
             ->textInput([
                    'maxlength'   => true,
                    'placeholder' => $model->getAttributeLabel('os')
                   ])
             ->labelHint() ?>

  
        	<?php if (!Yii::$app->request->isAjax){ ?>
        	  	<div class="form-group text-center">
        	        <?= Html::submitButton('Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        	    </div>
        	<?php } ?>

            <?php ActiveForm::end(); ?>
        
        </div>
    </div>
</div>

<!-- AGREGADO PARA MENSAJE DE AYUDA -->
<?php $popover = "'popover'";
$js = <<<SCRIPT
/* To initialize BS3 popovers set this below */
$(function () { 
    $("[data-toggle={$popover}]").popover();

});
SCRIPT;
$this->registerJs($js);
?>