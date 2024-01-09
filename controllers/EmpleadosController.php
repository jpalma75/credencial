<?php

namespace app\controllers;

use Yii;
use app\models\Empleados;
use app\models\EmpleadosSearch;
use app\models\Departamentos;
use app\models\Encargados;        
use app\models\Credenciales;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\components\Utilidades;

/**
 * EmpleadosController implements the CRUD actions for Empleados model.
 */
class EmpleadosController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        // return [
        //     'verbs' => [
        //         'class' => VerbFilter::className(),
        //         'actions' => [
        //             'delete' => ['post'],
        //             'bulk-delete' => ['post'],
        //         ],
        //     ],
        // ];
        return [
        'ghost-access'=> [
            'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
        ];
    }

    /**
     * Lists all Empleados models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new EmpleadosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $departamentosDesc = ArrayHelper::map(Departamentos::find()->all(),'nombre', 'nombre');
        $encargadosDesc = ArrayHelper::map(Encargados::find()->all(),'nombre', 'nombre');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'departamentosDesc' => $departamentosDesc,
            'encargadosDesc' => $encargadosDesc,
        ]);
    }


    /**
     * Displays a single Empleados model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Empleados #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                        'ruta_credencial' => $this->findModel($id)->ruta_Credencial,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Editar',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
                'ruta_credencial' => $this->findModel($id)->ruta_Credencial,
            ]);
        }
    }

    /**
     * Creates a new Empleados model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Empleados();  

        $lstdepartamentos = ArrayHelper::map(Departamentos::find()->where(['estatus_registro' => 'VIG'])->orderBy('nombre')->all(), 'id', 'nombre');
        $lstencargados = ArrayHelper::map(Encargados::find()->where(['estatus_registro' => 'VIG'])->orderBy('nombre')->all(), 'id', 'nombre');

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Crear Nuevo Empleado",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'lstdepartamentos' => $lstdepartamentos,
                        'lstencargados' => $lstencargados,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];
            }else if($model->load($request->post())){

                return $this->subirArchivos($model);
                // return [
                //     'forceReload'=>'#crud-datatable-pjax',
                //     'title'=> "Crear Nuevo Empleado",
                //     'content'=>'<span class="text-success">Create Empleados success</span>',
                //     'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                //             Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                // ];  
            }else{
                return [
                    'title'=> "Crear Nuevo Empleado",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'lstdepartamentos' => $lstdepartamentos,
                        'lstencargados' => $lstencargados,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing Empleados model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);  

        $lstdepartamentos = ArrayHelper::map(Departamentos::find()->where(['estatus_registro' => 'VIG'])->orderBy('nombre')->all(), 'id', 'nombre');
        $lstencargados = ArrayHelper::map(Encargados::find()->where(['estatus_registro' => 'VIG'])->orderBy('nombre')->all(), 'id', 'nombre');     


// if($request->isAjax){
//         echo '<pre>es ajax'; print_r($model); echo '</pre>';
//             if($request->isGet){
//         echo '<pre>es get'; print_r($model); echo '</pre>';

//             }else if($model->load($request->post())){
//         echo '<pre>post'; print_r($model); echo '</pre>';

//              }else{
//         echo '<pre>ajax no post'; print_r($model); echo '</pre>';
//         }
                
// }else{
//             /*
//             *   Process for non-ajax request
//             */
//             if ($model->load($request->post()) && $model->save()) {
//                 return $this->redirect(['view', 'id' => $model->id]);
//             } else {
//                 return $this->render('update', [
//                     'model' => $model,
//                 ]);
//             }

// }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;


            if($request->isGet){
                return [
                    'title'=> "Actualizar Empleado #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'lstdepartamentos' => $lstdepartamentos,
                        'lstencargados' => $lstencargados,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post())){

                return $this->subirArchivos($model);

                // return [
                //     'forceReload'=>'#crud-datatable-pjax',
                //     'title'=> "Empleados #".$id,
                //     'content'=>$this->renderAjax('view', [
                //         'model' => $model,
                //     ]),
                //     'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                //             Html::a('Editar',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                // ];
            }else{
                 return [
                    'title'=> "Actualizar Empleado #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                        'lstdepartamentos' => $lstdepartamentos,
                        'lstencargados' => $lstencargados,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
                ];        
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post())) {
                return $this->subirArchivos($model);
                // return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'lstdepartamentos' => $lstdepartamentos,
                    'lstencargados' => $lstencargados,
                ]);
            }
        }
    }

    /**
     * Delete an existing Empleados model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;

        $model = $this->findModel($id);

        $dir = Yii::$app->params['FirmasEmpleados'];
        
        if ($dir) {
            $tmp = $model->ruta_firma;
            if (file_exists($tmp)) {
                unlink($tmp);
            }
        }

        $dir = Yii::$app->params['FotosEmpleados'];
        
        if ($dir) {
            $tmp = $model->ruta_foto;
            if (file_exists($tmp)) {
                unlink($tmp);
            }
        }

        $model->delete();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

    public function actionImprimir($id)
    {
        // $ruta_credencial
        // $model->ruta_Credencial;
        $model = $this->findModel($id);
        
        if(isset($model)){
            $this->imprimirFrente($model, $id, !empty($model->ruta_Credencial));
        }
    }

    public function imprimirFrente($model, $id, $existeCredencial)
    {
        $nombre = $model->nombre;
        $apellidos = $model->ap_paterno . ' ' . $model->ap_materno;
        $departamento = $model->departamento_nombre;
        $categoria = $model->categoria;
        $tipo_contrato = Yii::$app->params['TipoContrato'];
        $ruta_foto = $model->ruta_foto;
        $ruta_firma = $model->ruta_firma;
        $tam_extra_chico = Yii::$app->params['TamExtraChico'];
        $tam_chico = Yii::$app->params['TamChico'];
        $tam_mediano = Yii::$app->params['TamMediano'];
        $tam_grande = Yii::$app->params['TamGrande'];
        $tam_extra_grande = Yii::$app->params['TamExtraGrande'];
        $inicio_vigencia = $model->fecha_inicio_vigencia;
        $termino_vigencia = $model->fecha_termino_vigencia;
        $ruta_credencial = $model->ruta_Credencial;
        // $ruta_cred_v = $model->ruta_credencial_v;

        $homedir = dirname(__DIR__, 1);
        $fuente1 = $homedir . Yii::$app->params['RutaFuentes'] . Yii::$app->params['Fuente1'];
        $fuente2 = $homedir . Yii::$app->params['RutaFuentes'] . Yii::$app->params['Fuente2'];
        // $fuente1 = __DIR__ . "/" . "/web/fonts/"" . "sansita.ttf";
        $imgPlantilla = $homedir . Yii::$app->params['RutaPlantillas'] . 'CRED GUBERNATURA F.png';
        // $imgPlantilla = __DIR__ . "/" . "imagen.png";
        // $rutaCredenciales = Yii::$app->params['Credenciales'];

        $imgFoto = $homedir . '/web/' . $ruta_foto;
        // $imgFoto = $homedir . '/web/' . Yii::$app->params['FotosEmpleados'] . 'mary.png';
        $imgFirma = $homedir . '/web/' . $ruta_firma;
        // $imgFirma = $homedir . '/web/' . Yii::$app->params['FirmasEmpleados'] . '20231222013355.png';
        // imagen => C:\repositorio\credencial\controllers/imagen.png
        // fuentes => C:\repositorio\credencial\controllers/sansita.ttf
        // $fuente1 = Yii::$app->params['Fuentes'] . "sansita.ttf";
        // $imgPlantilla = $rutaPlantillas . 'CRED GUBERNATURA F.jpg';
        // $imagen = imagecreatefrompng($imgPlantilla);
        // $imagen = imagecreatefromjpeg($imgPlantilla);

        // Crear instancias de imágenes
        $plantilla = imagecreatefrompng($imgPlantilla);
        $foto = imagecreatefrompng($imgFoto);
        $firma = imagecreatefrompng($imgFirma);
        $contenedor = imagecreatetruecolor(imagesx($plantilla), imagesy($plantilla));
         
        //ver el tamaño de la original
        // Copiar
        imagecopy($contenedor, $plantilla, 0, 0, 0, 0, imagesx($plantilla), imagesy($plantilla));
        imagecopy($contenedor, $foto, 210, 300, 0, 0, imagesx($foto), imagesy($foto));
        imagecopy($contenedor, $firma, 160, 775, 0, 0, imagesx($firma), imagesy($firma));

        /*
        imagecopy(
            GdImage $dst_image,
            GdImage $src_image,
            int $dst_x,
            int $dst_y,
            int $src_x,
            int $src_y,
            int $src_width,
            int $src_height
        ): bool
        */

        $color1 = imagecolorallocate($contenedor, 0, 0, 0);    //Color Negro
        $color2 = imagecolorallocate($contenedor, 255, 0, 0);  //Color Rojo
        $angulo = 0;
        $espacio = 15;
        // $x = 220;

        $bbox = imageftbbox($tam_grande, 0, $fuente1, $nombre);
        $x = $bbox[0] + (imagesx($contenedor) / 2) - ($bbox[4] / 2) - 10;
        $y = 580;

        $bbox = imageftbbox($tam_grande, 0, $fuente1, $apellidos);
        $x2 = $bbox[0] + (imagesx($contenedor) / 2) - ($bbox[4] / 2) - 10;
        $y2 = $y + $espacio + $tam_grande;
        
        // $x3 = 90;
        $bbox = imageftbbox($tam_extra_chico, 0, $fuente2, $departamento);
        $x3 = $bbox[0] + (imagesx($contenedor) / 2) - ($bbox[4] / 2) - 10;
        $y3 = $y2 + (2 * $espacio) + $tam_grande;
        
        // $x4 = 90;
        $bbox = imageftbbox($tam_extra_chico, 0, $fuente2, $categoria);
        $x4 = $bbox[0] + (imagesx($contenedor) / 2) - ($bbox[4] / 2) - 5;
        $y4 = $y3 + $espacio + $tam_extra_chico;
        
        // $x5 = 90;
        $bbox = imageftbbox($tam_mediano, 0, $fuente2, $tipo_contrato);
        $x5 = $bbox[0] + (imagesx($contenedor) / 2) - ($bbox[4] / 2) - 10;
        $y5 = $y4 + $espacio + $tam_extra_chico;

        imagettftext($contenedor, $tam_grande, $angulo, $x, $y, $color1, $fuente1, $nombre);
        imagettftext($contenedor, $tam_grande, $angulo, $x2, $y2, $color1, $fuente1, $apellidos);
        imagettftext($contenedor, $tam_extra_chico, $angulo, $x3, $y3, $color1, $fuente2, $departamento);
        imagettftext($contenedor, $tam_extra_chico, $angulo, $x4, $y4, $color1, $fuente2, $categoria);
        imagettftext($contenedor, $tam_mediano, $angulo, $x5, $y5, $color2, $fuente1, $tipo_contrato);

        // obtener carpeta en la que se guardará
        $carpeta = Utilidades::crearCarpetaCredencial(Yii::$app->params['Credenciales'], $inicio_vigencia, $termino_vigencia);

        // Imprimir y liberar memoria
        /* Version para visualizar en pantalla
        header('Content-Type: image/png');
        imagepng($contenedor);
         
        imagedestroy($destino);
        imagedestroy($origen);
        imagedestroy($contenedor);
        */

        /* Versión que forza la descarga de la imagen
        header("Content-Type: image/png");
        $salida = "imagen_procesada.png";
        header('Content-Disposition: attachment; filename="' . $salida . '"');
        imagepng($contenedor);
        imagedestroy($contenedor);*/

        // Versión para guardar el archivo en servidor
        $salida = $carpeta . 'cred_'.Utilidades::nombreArchivo().'.png';

        $inicio_seg = strtotime($inicio_vigencia);
        $termino_seg = strtotime($termino_vigencia);

        $credenciales = '';

        header("Content-Type: image/png");
        imagepng($contenedor, $salida);
        imagedestroy($contenedor);

        if(!$existeCredencial) {
            $credenciales = new Credenciales();
            $credenciales->id_empleado = $model->id;
            $credenciales->anio_inicio = date("Y", $inicio_seg);
            $credenciales->anio_termino = date("Y", $termino_seg);
            $credenciales->ruta_credencial_f = $salida;
            $credenciales->save();
        } else {
                // echo '<pre>carpeta:'; print_r($carpeta); echo '</pre>';
                // echo '<pre>ruta_cred:'; print_r($model->ruta_Credencial); echo '</pre>';
            
            // echo '<pre>id_emp:'; print_r($model->id); echo '</pre>';
            
            if($model->id != null)
            {
                    // echo '<pre>inicio:'; print_r(date("Y", $inicio_seg)); echo '</pre>';
                    // echo '<pre>termino:'; print_r(date("Y", $termino_seg)); echo '</pre>';
                    
                $credenciales = Credenciales::findOne([
                    'id_empleado' => $model->id,
                    'anio_inicio' => date("Y", $inicio_seg),
                    'anio_termino' => date("Y", $termino_seg),
                ]);

                // echo '<pre>'; print_r($credenciales); echo '</pre>';
                // echo '<pre>salida:'; print_r($salida); echo '</pre>';
                if(strpos($credenciales->ruta_credencial_f, $carpeta) !== false){
                // echo '<pre>carpeta:'; print_r($carpeta); echo '</pre>';
                // echo '<pre>ruta_cred:'; print_r($credenciales->ruta_credencial_f); echo '</pre>';
                
                // echo '<pre>'; var_dump( strpos($credenciales->ruta_credencial_f, $carpeta)); echo '</pre>';
                // die();
                    if (file_exists($credenciales->ruta_credencial_f)) {
                        unlink($credenciales->ruta_credencial_f);
                    }
                }

                $credenciales->ruta_credencial_f = $salida;
                $credenciales->save();
            }
                // actualizar la credencial
                //**** $credenciales = 
            

            /*$dir = Yii::$app->params['FirmasEmpleados'];
            
                    if ($dir) {
                        $tmp = $model->ruta_firma;
                        if (file_exists($tmp)) {
                            unlink($tmp);
                        }
                    }

                    $rutaArchivo = Yii::$app->params['FirmasEmpleados'].Utilidades::nombreArchivo().'.'.$model->archivo_firma->extension;*/
        }
    }


    public function imprimirAdverso($id)
    {
        $homedir = dirname(__DIR__, 1);
        $fuente1 = $homedir . Yii::$app->params['RutaFuentes'] . Yii::$app->params['Fuente1'];
        // echo '<pre>'; print_r($fuente1); echo '</pre>';
        // die();
        // $fuente1 = __DIR__ . "/" . "/web/fonts/"" . "sansita.ttf";        
        $nombreImagen = $homedir . Yii::$app->params['RutaPlantillas'] . '\CRED GUBERNATURA F.jpg';
        // $nombreImagen = __DIR__ . "/" . "imagen.png";
        $rutaPlantillas = Yii::$app->params['Plantillas'];
        $rutaCredenciales = Yii::$app->params['Credenciales'];
        // imagen => C:\repositorio\credencial\controllers/imagen.png
        // fuentes => C:\repositorio\credencial\controllers/sansita.ttf
        // $fuente1 = Yii::$app->params['Fuentes'] . "sansita.ttf";
        // $nombreImagen = $rutaPlantillas . 'CRED GUBERNATURA F.jpg';
        // $imagen = imagecreatefrompng($nombreImagen);
        $imagen = imagecreatefromjpeg($nombreImagen);
        $color = imagecolorallocate($imagen, 0, 0, 0);
        $texto1 = "texto1";
        $texto2 = "texto2";
        $tamanio = 20;
        $angulo = 0;
        $espacio = 10;
        $x = 400;
        $y = 50;
        $x2 = 400;
        $y2 = $y + $espacio + $tamanio;
        imagettftext($imagen, $tamanio, $angulo, $x, $y, $color, $fuente1, $texto1);
        imagettftext($imagen, $tamanio, $angulo, $x2, $y2, $color, $fuente1, $texto2);
        header("Content-Type: image/png");
        imagepng($imagen);
        imagedestroy($imagen);
    }

    /**
     * Finds the Empleados model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Empleados the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Empleados::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function subirArchivos(Empleados $model)
    {
        $request = Yii::$app->request;
        $model->archivo_firma = UploadedFile::getInstance($model, 'archivo_firma');
        $model->archivo_foto = UploadedFile::getInstance($model, 'archivo_foto');

        if($model->validate()){


            if($model->archivo_firma){

                $dir = Yii::$app->params['FirmasEmpleados'];
        
                if ($dir) {
                    $tmp = $model->ruta_firma;
                    if (file_exists($tmp)) {
                        unlink($tmp);
                    }
                }

                $rutaArchivo = Yii::$app->params['FirmasEmpleados'].Utilidades::nombreArchivo().'.'.$model->archivo_firma->extension;

                // $rutaArchivo = 'archivos/firmas/encargados/'.time()."_".$model->archivo->basename.".".$model->archivo->extension;

                if($model->archivo_firma->SaveAs($rutaArchivo)){

                    $model->ruta_firma = $rutaArchivo;
                }
            }

            if($model->archivo_foto){

                $dir = Yii::$app->params['FotosEmpleados'];
        
                if ($dir) {
                    $tmp = $model->ruta_foto;
                    if (file_exists($tmp)) {
                        unlink($tmp);
                    }
                }

                $rutaArchivo = Yii::$app->params['FotosEmpleados'].Utilidades::nombreArchivo().'.'.$model->archivo_foto->extension;

                // $rutaArchivo = 'archivos/firmas/encargados/'.time()."_".$model->archivo->basename.".".$model->archivo->extension;

                if($model->archivo_foto->SaveAs($rutaArchivo)){

                    $model->ruta_foto = $rutaArchivo;
                }
            }
        }

        if($model->save(false)){
            
            if($request->isAjax){
            /*
            *   Process for ajax request
            */
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
            }else{
                /*
                *   Process for non-ajax request
                */                
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        
    }
}
