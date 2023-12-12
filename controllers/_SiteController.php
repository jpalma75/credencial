<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

use app\models\SucursalRepresentante;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    // public function behaviors()
    // {
    //     return [
    //         'access' => [
    //             'class' => AccessControl::className(),
    //             'only' => ['logout'],
    //             'rules' => [
    //                 [
    //                     'actions' => ['logout'],
    //                     'allow' => true,
    //                     'roles' => ['@'],
    //                 ],
    //             ],
    //         ],
    //         'verbs' => [
    //             'class' => VerbFilter::className(),
    //             'actions' => [
    //                 'logout' => ['post'],
    //             ],
    //         ],
    //     ];
    // }
    public function behaviors()
    {
        return [
            'ghost-access'=> [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {  
        // $_SESSION
        // echo '<pre>'; print_r($_SESSION); echo '</pre>';
        // die();
        if (Yii::$app->getSession()->get('GLOBAL_SUC_ID')) {
            return $this->render('index');
        }else{

            // LISTAR LAS SUCURSALES ACTIVAS DEL ID DE PERSONA DEL USUARIO LOGUEADO.
            $sucursales = SucursalRepresentante::find()->where(['sr_fkrepresentante' => Yii::$app->user->identity->persona->per_id, 'sr_fkestado' => 1])->All();
            // echo '<pre>'; print_r($sucursales); echo '</pre>';
            return $this->render('acceder', compact('sucursales'));
        }
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    // public function actionContact()
    // {
    //     $model = new ContactForm();
    //     if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
    //         Yii::$app->session->setFlash('contactFormSubmitted');

    //         return $this->refresh();
    //     }
    //     return $this->render('contact', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Displays about page.
     *
     * @return string
     */
    // public function actionAbout()
    // {
    //     return $this->render('about');
    // }

    public function actionSucursal($id)
    {  
        Yii::$app->getSession()->remove('GLOBAL_SUC_ID');
        Yii::$app->getSession()->remove('GLOBAL_SUC_RAZON_SOCIAL');
        Yii::$app->getSession()->remove('GLOBAL_SUC_LOGO');
        Yii::$app->getSession()->remove('GLOBAL_SR_COLOR_PLANTILLA');
        Yii::$app->getSession()->remove('GLOBAL_SR_ROL');

        // AQUI HAY QUE VALIDAR QUE LA SUCURSAL QUE VENGA POR GET, SEA UNA DE LAS SUCURSALES VALIDAS DEL USUARIO.
        // PARA QUE NO VAYA A SUCEDER QUE CAMBIEN EL PARAMETRO POR LAS HERRAMIENTAS DE DESARROLLO.
        $sucursales = SucursalRepresentante::find()->where(['sr_fkrepresentante' => Yii::$app->user->identity->persona->per_id, 'sr_fkestado' => 1])->All();

        foreach ($sucursales as $key => $sucursal) {
            
            // if ($sucursal->sr_fksucursal == $id) {
            if ($sucursal->sr_id == $id) {

                Yii::$app->getSession()->set('GLOBAL_SUC_ID',             $sucursal->sr_fksucursal);
                Yii::$app->getSession()->set('GLOBAL_SUC_RAZON_SOCIAL',   $sucursal->srFksucursal->suc_razon_social);
                Yii::$app->getSession()->set('GLOBAL_SUC_LOGO',           $sucursal->srFksucursal->suc_logo);
                Yii::$app->getSession()->set('GLOBAL_SR_COLOR_PLANTILLA', $sucursal->sr_color_plantilla);
                Yii::$app->getSession()->set('GLOBAL_SR_ROL',             $sucursal->sr_rol);

                return $this->redirect(['index']);
                break;
            }
            // else{
                // echo "no: ". $sucursal->sr_fksucursal .' - '.$id;
            // }
        }

        return $this->redirect(['index']);

    }

    public function actionCambiarSucursal(){

        // unset($_SESSION['GLOBAL_SUC_ID']);
        // unset($_SESSION['GLOBAL_SR_COLOR_PLANTILLA']);
        // unset($_SESSION['GLOBAL_SR_ROL']);
        Yii::$app->getSession()->remove('GLOBAL_SUC_ID');
        Yii::$app->getSession()->remove('GLOBAL_SUC_RAZON_SOCIAL');
        Yii::$app->getSession()->remove('GLOBAL_SUC_LOGO');
        Yii::$app->getSession()->remove('GLOBAL_SR_COLOR_PLANTILLA');
        Yii::$app->getSession()->remove('GLOBAL_SR_ROL');
        return $this->redirect(['index']);
    }
}
