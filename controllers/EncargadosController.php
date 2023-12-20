<?php

namespace app\controllers;

use Yii;
use app\models\Encargados;
use app\models\EncargadosSearch;
use app\models\UploadForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\web\UploadedFile;
use yii\helpers\Html;
use app\components\Utilidades;
use yii\helpers\Url;

/**
 * EncargadosController implements the CRUD actions for Encargados model.
 */
class EncargadosController extends Controller
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
     * Lists all Encargados models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new EncargadosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Encargados model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Encargado #".$id,
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
     * Creates a new Encargados model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Encargados();  

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Crear Nuevo Encargado",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post())){

                return $this->subirFirma($model);
                // return [
                //     'forceReload'=>'#crud-datatable-pjax',
                //     'title'=> "Crear Nuevo Encargado",
                //     'content'=>'<span class="text-success">Create Encargados success</span>',
                //     'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                //             Html::a('Crear Más',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
        
                // ];         
            }else{           
                return [
                    'title'=> "Crear Nuevo Encargado",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
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
     * Updates an existing Encargados model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Actualizar Encargado #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post())){ 

                return $this->subirFirma($model);
                // return [
                //     'forceReload'=>'#crud-datatable-pjax',
                //     'title'=> "Encargado #".$id,
                //     'content'=>$this->renderAjax('view', [
                //         'model' => $model,
                //     ]),
                //     'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                //             Html::a('Editar',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                // ];    
            }else{
                 return [
                    'title'=> "Actualizar Encargado #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
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
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing Encargados model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;

        $model = $this->findModel($id);

        $dir = Yii::$app->params['FirmasEncargados'];
        
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

    /**
     * Finds the Encargados model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Encargados the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Encargados::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('La página solicitada no existe.');
        }
    }

    protected function subirFirma(Encargados $model)
    {
        $request = Yii::$app->request;
        $model->archivo= UploadedFile::getInstance($model, 'archivo');

        if($model->validate()){

            if($model->archivo){

                $dir = Yii::$app->params['FirmasEncargados'];
        
                if ($dir) {
                    $tmp = $model->ruta_firma;
                    if (file_exists($tmp)) {
                        unlink($tmp);                
                    }
                }

                $rutaArchivo = Yii::$app->params['FirmasEncargados'].Utilidades::nombreArchivo().'.'.$model->archivo->extension;

                // $rutaArchivo = 'archivos/firmas/encargados/'.time()."_".$model->archivo->basename.".".$model->archivo->extension;

                if($model->archivo->SaveAs($rutaArchivo)){

                    $model->ruta_firma = $rutaArchivo;
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
                return $this->redirect(['index']);
            }

            // echo json_encode(array('redirect'=>yii\web\Application::createUrl('encargados/index')));

            // return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
            // echo CJSON::encode(array('status'=>'200', 'redirect'=>Yii::app()->createUrl('/controller/action/')));
            
            // $url = Url::to(['index']);
            // return $url;

            // return $this->redirect(array('index'));
            // return $this->redirect(['index']);

            // return [
            //         'forceReload'=>'#crud-datatable-pjax',
            //         'title'=> "Crear Nuevo Encargado",
            //         'content'=>'<span class="text-success">Create Encargados success</span>',
            //         'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
            //                 Html::a('Crear Más',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
            //         ];
        }

        
    }
}
