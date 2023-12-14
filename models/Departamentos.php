<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "departamentos".
 *
 * @property int $id
 * @property int|null $id_encargado
 * @property string $nombre
 * @property string $cp
 * @property string $direccion
 * @property string $estatus_registro
 * @property string $creado_por
 * @property string $fecha_creacion
 * @property string|null $modificado_por
 * @property string|null $fecha_modificacion
 *
 * @property Encargados $encargado
 * @property Empleados[] $empleados
 */
class Departamentos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'departamentos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nombre', 'cp', 'direccion'], 'required'],
            [['id', 'id_encargado'], 'default', 'value' => null],
            [['id', 'id_encargado'], 'integer'],
            [['fecha_creacion', 'fecha_modificacion'], 'safe'],
            [['nombre'], 'string', 'max' => 100],
            [['cp'], 'string', 'max' => 6],
            [['direccion'], 'string', 'max' => 200],
            [['estatus_registro'], 'string', 'max' => 3],
            [['creado_por', 'modificado_por'], 'string', 'max' => 50],
            [['id'], 'unique'],
            [['id_encargado'], 'exist', 'skipOnError' => true, 'targetClass' => Encargados::className(), 'targetAttribute' => ['id_encargado' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_encargado' => 'Id Encargado',
            'nombre' => 'Nombre',
            'cp' => 'Cp',
            'direccion' => 'Direccion',
            'estatus_registro' => 'Estatus Registro',
            'creado_por' => 'Creado Por',
            'fecha_creacion' => 'Fecha Creacion',
            'modificado_por' => 'Modificado Por',
            'fecha_modificacion' => 'Fecha Modificacion',
        ];
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

    /**
     * Gets query for [[Empleados]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpleados()
    {
        return $this->hasMany(Empleados::className(), ['id_departamento' => 'id']);
    }
}
