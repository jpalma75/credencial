<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "encargados".
 *
 * @property int $id
 * @property string $nombre
 * @property string $cargo
 * @property string|null $ruta_firma
 * @property string|null $estatus_registro
 * @property string|null $creado_por
 * @property string|null $fecha_creacion
 * @property string|null $modificado_por
 * @property string|null $fecha_modificacion
 *
 * @property Departamentos[] $departamentos
 */
class Encargados extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'encargados';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nombre', 'cargo'], 'required'],
            [['id'], 'default', 'value' => null],
            [['id'], 'integer'],
            [['fecha_creacion', 'fecha_modificacion'], 'safe'],
            [['nombre'], 'string', 'max' => 150],
            [['cargo', 'ruta_firma'], 'string', 'max' => 100],
            [['estatus_registro'], 'string', 'max' => 3],
            [['creado_por', 'modificado_por'], 'string', 'max' => 50],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'cargo' => 'Cargo',
            'ruta_firma' => 'Ruta Firma',
            'estatus_registro' => 'Estatus Registro',
            'creado_por' => 'Creado Por',
            'fecha_creacion' => 'Fecha Creacion',
            'modificado_por' => 'Modificado Por',
            'fecha_modificacion' => 'Fecha Modificacion',
        ];
    }

    /**
     * Gets query for [[Departamentos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamentos()
    {
        return $this->hasMany(Departamentos::className(), ['id_encargado' => 'id']);
    }
}
