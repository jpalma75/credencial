<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $confirmation_token
 * @property int $status
 * @property int $superadmin
 * @property int $created_at
 * @property int $updated_at
 * @property string $registration_ip
 * @property string $bind_to_ip
 * @property string $email
 * @property int $email_confirmed
 *
 * @property AuthAssignment[] $authAssignments
 * @property AuthItem[] $itemNames
 * @property Persona[] $personas
 * @property UserVisitLog[] $userVisitLogs
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */

    // REGLAS DE VALIDACIÓN.
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'created_at', 'updated_at'], 'required'],
            [['status', 'superadmin', 'created_at', 'updated_at', 'email_confirmed'], 'integer'],
            [['username', 'password_hash', 'confirmation_token', 'bind_to_ip'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['registration_ip'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 128],
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
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'confirmation_token' => 'Confirmation Token',
            'status' => 'Status',
            'superadmin' => 'Superadmin',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'registration_ip' => 'Registration Ip',
            'bind_to_ip' => 'Bind To Ip',
            'email' => 'Email',
            'email_confirmed' => 'Email Confirmed',
        ];
    }

    // HINT DE CADA ATRIBUTO/CAMPO.
    public function attributeHints()
    {
        return array_merge(parent::attributeHints(), [
            'id' => '<code><b>'.'ID'.'</b></code>',
            'username' => '<code><b>'.'Username'.'</b></code>',
            'auth_key' => '<code><b>'.'Auth Key'.'</b></code>',
            'password_hash' => '<code><b>'.'Password Hash'.'</b></code>',
            'confirmation_token' => '<code><b>'.'Confirmation Token'.'</b></code>',
            'status' => '<code><b>'.'Status'.'</b></code>',
            'superadmin' => '<code><b>'.'Superadmin'.'</b></code>',
            'created_at' => '<code><b>'.'Created At'.'</b></code>',
            'updated_at' => '<code><b>'.'Updated At'.'</b></code>',
            'registration_ip' => '<code><b>'.'Registration Ip'.'</b></code>',
            'bind_to_ip' => '<code><b>'.'Bind To Ip'.'</b></code>',
            'email' => '<code><b>'.'Email'.'</b></code>',
            'email_confirmed' => '<code><b>'.'Email Confirmed'.'</b></code>',
        ]);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
     
    // RELACIONES.
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
     
    // RELACIONES.
    public function getItemNames()
    {
        return $this->hasMany(AuthItem::className(), ['name' => 'item_name'])->viaTable('auth_assignment', ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
     
    // RELACIONES.
    public function getPersonas()
    {
        return $this->hasMany(Persona::className(), ['per_fkuser' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
     
    // RELACIONES.
    public function getUserVisitLogs()
    {
        return $this->hasMany(UserVisitLog::className(), ['user_id' => 'id']);
    }
}
