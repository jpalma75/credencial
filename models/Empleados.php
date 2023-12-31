<?php

namespace app\models;
use yii\web\UploadedFile;
use app\models\Credenciales;

use Yii;

/**
 * This is the model class for table "empleados".
 *
 * @property int $id
 * @property int $id_departamento
 * @property int $id_encargado
 * @property int|null $id_empleado_anterior
 * @property string $nombre
 * @property string $ap_paterno
 * @property string|null $ap_materno
 * @property string $curp
 * @property string|null $tipo_sanguineo
 * @property string $num_seguro
 * @property string $categoria
 * @property string $fecha_inicio_vigencia
 * @property string $fecha_termino_vigencia
 * @property string|null $ruta_firma
 * @property string|null $ruta_foto
  * @property string|null $tel_emergencia
 * @property string|null $estatus_registro
 * @property string|null $creado_por
 * @property string|null $fecha_creacion
 * @property string|null $modificado_por
 * @property string|null $fecha_modificacion
 *
 * @property Departamentos $departamento
 * @property Empleados $empleadoAnterior
 * @property Empleados[] $empleados
 * @property Encargados $encargado
 */
class Empleados extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $archivo_firma, $archivo_foto, $ruta_credencial;  // , $archivo_credencial;

    public static function tableName()
    {
        return 'empleados';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['archivo_firma', 'archivo_foto'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxSize' => 1024*1024],             
            [['id_departamento', 'id_encargado', 'nombre', 'ap_paterno', 'curp', 'num_seguro', 'categoria', 'fecha_inicio_vigencia', 'fecha_termino_vigencia'], 'required'],
            [['id_departamento', 'id_encargado', 'id_empleado_anterior'], 'default', 'value' => null],
            [['id_departamento', 'id_encargado', 'id_empleado_anterior'], 'integer'],
            [['fecha_creacion', 'fecha_modificacion', 'ruta_credencial_f'], 'safe'],
            [['nombre', 'ap_paterno', 'ap_materno', 'creado_por', 'modificado_por'], 'string', 'max' => 50],
            [['curp'], 'string', 'max' => 19],
            [['tipo_sanguineo', 'estatus_registro'], 'string', 'max' => 3],
            [['num_seguro'], 'string', 'max' => 8],
            [['categoria'], 'string', 'max' => 40],
            [['ruta_firma', 'ruta_foto'], 'string', 'max' => 100],
            [['tel_emergencia'], 'string', 'max' => 12],
            [['id'], 'unique'],
            [['id_departamento'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::className(), 'targetAttribute' => ['id_departamento' => 'id']],
            [['id_empleado_anterior'], 'exist', 'skipOnError' => true, 'targetClass' => Empleados::className(), 'targetAttribute' => ['id_empleado_anterior' => 'id']],
            [['id_encargado'], 'exist', 'skipOnError' => true, 'targetClass' => Encargados::className(), 'targetAttribute' => ['id_encargado' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_departamento' => 'Departamento',
            'departamento_nombre' => 'Departamento',
            'id_encargado' => 'Encargado',
            'encargado_nombre' => 'Encargado',
            'id_empleado_anterior' => 'Empleado Anterior',
            'nombre' => 'Nombre',
            'ap_paterno' => 'Paterno',
            'ap_materno' => 'Materno',
            'curp' => 'CURP',
            'tipo_sanguineo' => 'Tipo Sanguineo',
            'num_seguro' => 'No. Seguro',
            'categoria' => 'Categoría',
            'fecha_inicio_vigencia' => 'Inicio Vigencia',
            'fecha_termino_vigencia' => 'Termino Vigencia',
            // 'ruta_firma' => 'Ruta Firma',
            // 'ruta_foto' => 'Ruta Foto',
            'archivo_firma' => 'Ruta Firma', 
            'archivo_foto' => 'Ruta Foto', 
            // 'archivo_credencial' => 'Ruta Credencial',
            'tel_emergencia' => 'Tel Emergencia',
            'estatus_registro' => 'Estatus Registro',
            'creado_por' => 'Creado Por',
            'fecha_creacion' => 'Fecha Creacion',
            'modificado_por' => 'Modificado Por',
            'fecha_modificacion' => 'Fecha Modificacion',
        ];
    }

    /**
     * Gets query for [[Departamento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamento()
    {
        return $this->hasOne(Departamentos::className(), ['id' => 'id_departamento']);
    }

    // /**
    //  * Gets query for [[EmpleadoAnterior]].
    //  *
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getEmpleadoAnterior()
    // {
    //     return $this->hasOne(Empleados::className(), ['id' => 'id_empleado_anterior']);
    // }

    // /**
    //  * Gets query for [[Empleados]].
    //  *
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getEmpleados()
    // {
    //     return $this->hasMany(Empleados::className(), ['id_empleado_anterior' => 'id']);
    // }

    /**
     * Gets query for [[Empleado]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCredenciales()
    {
        return $this->hasMany(Credenciales::className(), ['id_empleado' => 'id']);
    }

    /**
     * Gets query for [[Encargado]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEncargado()
    {
        return $this->hasOne(Encargados::className(), ['id' => 'id_encargado']);
    }

    public function getDepartamento_Nombre()
    {
        return $this->departamento->nombre;
    }

    public function getEncargado_Nombre()
    {
        return $this->encargado->nombre;
    }

    public function getCredencial_Disponible()
    {
        if(!empty($this->ruta_firma) || !empty($this->ruta_foto)){            
            return true;
        }
        return false;
    }

    public function getRuta_Credencial()
    {
        if($this->id != null)
        {
            $submodel = Credenciales::find()
                      ->select([ 'MAX(anio_inicio) as anio_inicio', ])
                      ->where("id_empleado = " . $this->id)
                      ->one();

            if(isset($submodel)){
                if(isset($submodel->anio_inicio)){
                    $model = Credenciales::find()
                           ->select([ 'MAX(anio_termino) as anio_termino', ])
                           ->where("id_empleado = " . $this->id)
                           ->andWhere("anio_inicio = ".$submodel->anio_inicio)
                           ->one();
                }
            }

            if(isset($model)){
                return $submodel->anio_inicio . '-' . $model->anio_termino;
            }
        }
        return '';
    }

}
