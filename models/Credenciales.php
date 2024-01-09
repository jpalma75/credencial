<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "credenciales".
 *
 * @property int $id
 * @property int $id_empleado
 * @property int $anio_inicio
 * @property int $anio_termino
 * @property string $ruta_credencial_f
 * @property string|null $ruta_credencial_v
 * @property string|null $estatus_registro
 * @property string|null $creado_por
 * @property string|null $fecha_creacion
 * @property string|null $modificado_por
 * @property string|null $fecha_modificacion
 *
 * @property Empleados $empleado
 */
class Credenciales extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'credenciales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_empleado', 'anio_inicio', 'anio_termino', 'ruta_credencial_f'], 'required'],
            [['id_empleado', 'anio_inicio', 'anio_termino'], 'default', 'value' => null],
            [['id_empleado', 'anio_inicio', 'anio_termino'], 'integer'],
            [['fecha_creacion', 'fecha_modificacion', 'creado_por', 'modificado_por'], 'safe'],
            [['ruta_credencial_f', 'ruta_credencial_v'], 'string', 'max' => 100],
            [['estatus_registro'], 'string', 'max' => 3],
            [['creado_por', 'modificado_por'], 'string', 'max' => 50],
            [['id_empleado'], 'exist', 'skipOnError' => true, 'targetClass' => Empleados::className(), 'targetAttribute' => ['id_empleado' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_empleado' => 'Id Empleado',
            'anio_inicio' => 'Año Inicio',
            'anio_termino' => 'Año Termino',
            'ruta_credencial_f' => 'Ruta Credencial Frente',
            'ruta_credencial_v' => 'Ruta Credencial Adverso',
            'estatus_registro' => 'Estatus Registro',
            'creado_por' => 'Creado Por',
            'fecha_creacion' => 'Fecha Creacion',
            'modificado_por' => 'Modificado Por',
            'fecha_modificacion' => 'Fecha Modificacion',
        ];
    }

    /**
     * Gets query for [[Empleado]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleado()
    {
        return $this->hasOne(Empleados::className(), ['id' => 'id_empleado']);
    }
}
