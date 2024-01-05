<?php

namespace app\controllers;

use Yii;
use app\models\Empleados;
use app\models\EmpleadosSearch;
use app\models\Departamentos;
use app\models\Encargados;        
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
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Editar',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
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
        $this->imprimirFrente($id);
    }


    public function imprimirFrente($id)
    {    
        $model = $this->findModel($id);
        $nombre = $model->nombre;
        $apellidos = $model->ap_paterno . ' ' . $model->ap_materno;
        $departamento = $model->departamento_nombre;
        $categoria = $model->categoria;
        $tipo_contrato = "CONFIANZA";
        $ruta_foto = $model->ruta_foto;
        $ruta_firma = $model->ruta_firma;        

        $homedir = dirname(__DIR__, 1);                
        $fuentes = $homedir . Yii::$app->params['RutaFuentes'] . Yii::$app->params['Fuente1'];
        // $fuentes = __DIR__ . "/" . "/web/fonts/"" . "sansita.ttf";        
        $imgPlantilla = $homedir . Yii::$app->params['RutaPlantillas'] . 'CRED GUBERNATURA F.png';
        // $imgPlantilla = __DIR__ . "/" . "imagen.png";        
        // $rutaCredenciales = Yii::$app->params['Credenciales'];

        $imgFoto = $homedir . '/web/' . $ruta_foto;
        // $imgFoto = $homedir . '/web/' . Yii::$app->params['FotosEmpleados'] . 'mary.png';
        $imgFirma = $homedir . '/web/' . $ruta_firma;
        // $imgFirma = $homedir . '/web/' . Yii::$app->params['FirmasEmpleados'] . '20231222013355.png';
        // imagen => C:\repositorio\credencial\controllers/imagen.png
        // fuentes => C:\repositorio\credencial\controllers/sansita.ttf
        // $fuentes = Yii::$app->params['Fuentes'] . "sansita.ttf";
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
        imagecopy($contenedor, $firma, 160, 760, 0, 0, imagesx($firma), imagesy($firma));

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

        $color = imagecolorallocate($contenedor, 0, 0, 0);
        $texto1 = "texto1";
        $texto2 = "texto2";
        $tamanio = 20;
        $angulo = 0;
        $espacio = 10;
        $x = 220;
        $y = 580;
        $x2 = 220;
        $y2 = $y + $espacio + $tamanio;
        $x3 = 90;
        $y3 = $y2 + (3 * $espacio) + $tamanio;
        $x4 = 90;
        $y4 = $y3 + $espacio + $tamanio;
        $x5 = 90;
        $y5 = $y4 + $espacio + $tamanio;
        imagettftext($contenedor, $tamanio, $angulo, $x, $y, $color, $fuentes, $nombre);
        imagettftext($contenedor, $tamanio, $angulo, $x2, $y2, $color, $fuentes, $apellidos);
        imagettftext($contenedor, $tamanio, $angulo, $x3, $y3, $color, $fuentes, $departamento);
        imagettftext($contenedor, $tamanio, $angulo, $x4, $y4, $color, $fuentes, $categoria);
        imagettftext($contenedor, $tamanio, $angulo, $x5, $y5, $color, $fuentes, $tipo_contrato);

        // Imprimir y liberar memoria
        header('Content-Type: image/png');
        imagepng($contenedor);
         
        imagedestroy($destino);
        imagedestroy($origen);
        imagedestroy($contenedor);
    }


    public function imprimirAdverso($id)
    {
        $homedir = dirname(__DIR__, 1);                
        $fuentes = $homedir . Yii::$app->params['RutaFuentes'] . Yii::$app->params['Fuente1'];
        // echo '<pre>'; print_r($fuentes); echo '</pre>';
        // die();
        // $fuentes = __DIR__ . "/" . "/web/fonts/"" . "sansita.ttf";        
        $nombreImagen = $homedir . Yii::$app->params['RutaPlantillas'] . '\CRED GUBERNATURA F.jpg';
        // $nombreImagen = __DIR__ . "/" . "imagen.png";
        $rutaPlantillas = Yii::$app->params['Plantillas'];
        $rutaCredenciales = Yii::$app->params['Credenciales'];
        // imagen => C:\repositorio\credencial\controllers/imagen.png
        // fuentes => C:\repositorio\credencial\controllers/sansita.ttf
        // $fuentes = Yii::$app->params['Fuentes'] . "sansita.ttf";
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
        imagettftext($imagen, $tamanio, $angulo, $x, $y, $color, $fuentes, $texto1);
        imagettftext($imagen, $tamanio, $angulo, $x2, $y2, $color, $fuentes, $texto2);
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
