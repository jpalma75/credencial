<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "empleados".
 *
 * @property int $id
 * @property int $id_departamento
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
 * @property string|null $ruta_credencial
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
 */
class Empleados extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
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
            [['id', 'id_departamento', 'nombre', 'ap_paterno', 'curp', 'num_seguro', 'categoria', 'fecha_inicio_vigencia', 'fecha_termino_vigencia'], 'required'],
            [['id', 'id_departamento', 'id_empleado_anterior'], 'default', 'value' => null],
            [['id', 'id_departamento', 'id_empleado_anterior'], 'integer'],
            [['fecha_inicio_vigencia', 'fecha_termino_vigencia', 'fecha_creacion', 'fecha_modificacion'], 'safe'],
            [['nombre', 'ap_paterno', 'ap_materno', 'creado_por', 'modificado_por'], 'string', 'max' => 50],
            [['curp'], 'string', 'max' => 19],
            [['tipo_sanguineo', 'estatus_registro'], 'string', 'max' => 3],
            [['num_seguro'], 'string', 'max' => 8],
            [['categoria'], 'string', 'max' => 40],
            [['ruta_firma', 'ruta_foto', 'ruta_credencial'], 'string', 'max' => 100],
            [['tel_emergencia'], 'string', 'max' => 12],
            [['id'], 'unique'],
            [['id_departamento'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::className(), 'targetAttribute' => ['id_departamento' => 'id']],
            [['id_empleado_anterior'], 'exist', 'skipOnError' => true, 'targetClass' => Empleados::className(), 'targetAttribute' => ['id_empleado_anterior' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_departamento' => 'Id Departamento',
            'id_empleado_anterior' => 'Id Empleado Anterior',
            'nombre' => 'Nombre',
            'ap_paterno' => 'Ap Paterno',
            'ap_materno' => 'Ap Materno',
            'curp' => 'Curp',
            'tipo_sanguineo' => 'Tipo Sanguineo',
            'num_seguro' => 'Num Seguro',
            'categoria' => 'Categoria',
            'fecha_inicio_vigencia' => 'Fecha Inicio Vigencia',
            'fecha_termino_vigencia' => 'Fecha Termino Vigencia',
            'ruta_firma' => 'Ruta Firma',
            'ruta_foto' => 'Ruta Foto',
            'ruta_credencial' => 'Ruta Credencial',
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

    /**
     * Gets query for [[EmpleadoAnterior]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleadoAnterior()
    {
        return $this->hasOne(Empleados::className(), ['id' => 'id_empleado_anterior']);
    }

    /**
     * Gets query for [[Empleados]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleados()
    {
        return $this->hasMany(Empleados::className(), ['id_empleado_anterior' => 'id']);
    }
}
