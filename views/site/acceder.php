<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Acceder';
?>
<div class="site-index">

    <!-- <div class="jumbotron"> -->
        <h2 class="text-center"><?= Yii::$app->params['SistemaNombre']; ?></h2>
    	
    	<?php
    		// Yii::$app->user->identity->superadmin
    		// Yii::$app->user->identity->username
    		// Yii::$app->user->id
    		// Yii::$app->user->identity->id
    		// Yii::$app->user->identity->persona->per_id
        	// Yii::$app->getSession()->get('GLOBAL_SUC_ID')
        	// Yii::$app->getSession()->get('GLOBAL_SR_ROL')
    	?>

        <p class="lead"><?= Yii::$app->params['SistemaDescripcion']; ?></p>
    <!-- </div> -->

        <hr>

        <div class="row">
        	
        	<div class="col-md-4">
        		
        		<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Datos de personales</h3>
                </div>

                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" id="frmAcceder" name="frmAcceder">
                  <div class="box-body">
                  <div class="row">
                    <div class="col-xs-12">
                          
                        <div class="box box-widget widget-user-2">
                          <!-- Add the bg color to the header using any of the bg-* classes -->
                          <div class="widget-user-header bg-yellow">
                            <div class="widget-user-image">
                              <img class="img-circle" src="<?= Url::home(true)?>/img/perfil/foto.jpg" alt="Usuario">
                            </div><!-- /.widget-user-image -->
                            <h3 class="widget-user-username"><?= Yii::$app->user->identity->username; ?></h3>
                            <!-- <h5 class="widget-user-desc">Administrador</h5> -->
                            <h5 class="widget-user-desc">-----</h5>
                        </div>

                        <div class="box-footer no-padding">
                            <ul class="nav nav-stacked">
                              <!-- <li><a href="#"><strong>Documento:</strong>&nbsp; DNI 47715777<span class="pull-right badge bg-red"><i class="fa fa-fw fa-book"></i></span></a></li> -->
                              <li>
                              	<a href="#">
                              		<strong>Nombre:</strong>&nbsp; <?= Yii::$app->user->identity->persona->nombrecompleto; ?> <span class="pull-right badge bg-aqua"><i class="fa fa-fw fa-user"></i></span>
                              	</a>
                              </li>
                              
                              <li>
                              	<a href="#">
                              		<strong>Telefono:</strong>&nbsp; <?= Yii::$app->user->identity->persona->per_telefono; ?> <span class="pull-right badge bg-blue"><i class="fa fa-fw fa-mobile-phone"></i></span>
                              	</a>
                              </li>
                              
                              <!-- <li><a href="#"><strong>Direccion:</strong>&nbsp; Chiclayo 1215 <span class="pull-right badge bg-aqua"><i class="fa fa-fw fa-taxi"></i></span></a></li> -->
                              <li>
                              	<a href="#">
                              		<strong>Email:</strong>&nbsp; <?= Yii::$app->user->identity->persona->per_email; ?> <span class="pull-right badge bg-green"><i class="fa fa-fw fa-envelope"></i></span>
                              	</a>
                              </li>

                            </ul>
                          </div>
                        </div><!-- /.widget-user -->

                    </div>
                  </div> 
                  </div><!-- /.box-body -->

                  <div class="box-footer text-center">
                    <?=
                        Html::a(
                            'Cambiar Contraseña',
                            ['/user-management/auth/change-own-password'],
                            // ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                            // ['data-method' => 'post', 'class' => 'btn btn-danger btn-flat btn-block bg-red']
                            ['class' => 'btn btn-warning']
                            // ['data-method' => 'post', 'class' => 'btn btn-danger bg-red']
                        )
                    ?>

                    <?=
                        Html::a(
                            'Cerrar Sesión',
                            ['/site/logout'],
                            // ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                            // ['data-method' => 'post', 'class' => 'btn btn-danger btn-flat btn-block bg-red']
                            ['class' => 'btn btn-danger bg-red']
                            // ['data-method' => 'post', 'class' => 'btn btn-danger bg-red']
                        )
                    ?>

                  </div>
                </form>
              </div>

        	</div>

        	<div class="col-md-8">
        		<div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Acceso a las Sucursales</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                
                  <div class="box-body">
	                  <div class="box">
	                
		                <div class="box-body">

		                	<div class="table-responsive">
		                		
			                  <table class="table table-hover">
			                    <thead>

				                    <tr>                      
				                      <th>Opción</th>
				                      <th>Rol</th>
				                      <th>Sucursal</th>
				                      <th>Logo</th>
				                      
				                    </tr>
			                    
			                    </thead>

			                    <tbody>

			                    	<?php foreach ($sucursales as $key => $sucursal): ?>

			                    		<tr>
			                    			<td>
			                    				<?=
			                    					// Html::a('Acceder', ['sucursal', 'id' => $model->sr_fksucursal],
			                    					Html::a('Acceder', ['sucursal', 'id' => $sucursal->sr_id],
	                    							['data-pjax'=>0,'title'=> 'Acceder','class'=>'btn btn-success btn-md']);
			                    				?>
			                    			</td>

			                    			<td>
			                    				<?=
			                    					$sucursal->sr_rol
			                    				?>
			                    			</td>

			                    			<td>
			                    				<?=
			                    					$sucursal->srFksucursal->suc_razon_social
			                    				?>
			                    			</td>
			                    			<td>
						                		<img class="img-thumbnail" width="50px" height="50px" src="<?= Url::home(true).$sucursal->srFksucursal->suc_logo ?>">
			                    			</td>
			                    		</tr>
			                    		
			                    	<?php endforeach ?>
			                    	
			            		</tbody>
			                    
			                  </table>
		                	</div>

		                </div><!-- /.box-body -->
		              </div><!-- /.box -->

	                  
	              </div><!-- /.box -->
                </div>
        	</div>
        </div>

    
</div>