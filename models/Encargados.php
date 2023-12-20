<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;


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

    public $archivo;

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
            [['archivo'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['nombre', 'cargo'], 'required'],
            [['fecha_creacion', 'fecha_modificacion'], 'safe'],
            [['nombre'], 'string', 'max' => 150],
            [['cargo','ruta_firma'], 'string', 'max' => 100],
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
            // 'id' => 'ID',
            'nombre' => 'Nombre',
            'cargo' => 'Cargo',
            'archivo' => 'Ruta Firma',
            // 'estatus_registro' => 'Estatus Registro',
            // 'creado_por' => 'Creado Por',
            // 'fecha_creacion' => 'Fecha Creacion',
            // 'modificado_por' => 'Modificado Por',
            // 'fecha_modificacion' => 'Fecha Modificacion',
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

    // public function upload()
    // {
    //     if ($this->validate()) {
    //         $ruta_firma_encargado = Yii::$app->params['FirmasEncargados'];
    //         $this->imageFile->saveAs($ruta_firma_encargado . $this->imageFile->baseName . '.' . $this->imageFile->extension);
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
}
