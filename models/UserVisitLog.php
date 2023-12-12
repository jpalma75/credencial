<?php

namespace app\models;

use Yii;
use lisi4ok\auditlog\behaviors\LoggableBehavior;

/**
 * This is the model class for table "user_visit_log".
 *
 * @property int $id
 * @property string $token
 * @property string $ip
 * @property string $language
 * @property string $user_agent
 * @property int $user_id
 * @property int $visit_time
 * @property string $browser
 * @property string $os
 *
 * @property User $user
 */
class UserVisitLog extends \yii\db\ActiveRecord
{
    public function behaviors() {
        return [
            [
                'class'                      => LoggableBehavior::className(),
                'ignoredAttributes'          => ['created_at', 'updated_at', 'created_by', 'updated_by'], // default []
                'ignorePrimaryKey'           => true, // default false
                'ignorePrimaryKeyForActions' => ['insert', 'update'], //default [] Note: (if ignorePrimaryKey set to true, ignorePrimaryKeyForActions is empty will apply for all)
                'dateTimeFormat'             => 'Y-m-d H:i:s', // default 'Y-m-d H:i:s'
            ],
        ];
    }

    public function beforeSave($insert) {
        if ($insert) {
            // $this->usuario_creacion = Yii::$app->user->identity->username;
            // $this->CreatedOn = time();
        } else {
            // $this->fecha_modificacion = 'NOW()';
            // $this->fecha_modificacion    = date('Y-m-d H:m:s');
            // $this->usuario_modificacion  = Yii::$app->user->identity->username;
        }
        return parent::beforeSave($insert);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_visit_log';
    }

    /**
     * {@inheritdoc}
     */

    // REGLAS DE VALIDACIÓN.
    public function rules()
    {
        return [
            [['token', 'ip', 'language', 'user_agent', 'visit_time'], 'required'],
            [['user_id', 'visit_time'], 'integer'],
            [['token', 'user_agent'], 'string', 'max' => 255],
            [['ip'], 'string', 'max' => 15],
            [['language'], 'string', 'max' => 2],
            [['browser'], 'string', 'max' => 30],
            [['os'], 'string', 'max' => 20],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */

    // ETIQUETAS.
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'token' => 'Token',
            'ip' => 'Ip',
            'language' => 'Language',
            'user_agent' => 'User Agent',
            'user_id' => 'User ID',
            'visit_time' => 'Visit Time',
            'browser' => 'Browser',
            'os' => 'Os',
        ];
    }

    // HINT DE CADA ATRIBUTO/CAMPO.
    public function attributeHints()
    {
        return array_merge(parent::attributeHints(), [
            'id' => '<code><b>'.'ID'.'</b></code>',
            'token' => '<code><b>'.'Token'.'</b></code>',
            'ip' => '<code><b>'.'Ip'.'</b></code>',
            'language' => '<code><b>'.'Language'.'</b></code>',
            'user_agent' => '<code><b>'.'User Agent'.'</b></code>',
            'user_id' => '<code><b>'.'User ID'.'</b></code>',
            'visit_time' => '<code><b>'.'Visit Time'.'</b></code>',
            'browser' => '<code><b>'.'Browser'.'</b></code>',
            'os' => '<code><b>'.'Os'.'</b></code>',
        ]);
    }

    // RELACIONES.

    /**
     * @return \yii\db\ActiveQuery
     */
     
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
