<?php

namespace app\modules\profile\models;

use Yii;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $email
 * @property string $photo
 * @property int $sex
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class User extends \yii\db\ActiveRecord
{

    const STATUS_NEW = 1;
    const STATUS_ACTIVE = 2;
    const STATUS_BLOCKED = 3;

    const SEX_MALE = 1;
    const SEX_FEMALE = 2;
    const SEX_UNCKNOW = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    public static function getSexArray()
    {
        return [
            self::SEX_MALE => 'Мужской',
            self::SEX_FEMALE => 'Женский',
            self::SEX_UNCKNOW => 'Не выбран',
        ];
    }
    public static function getSex($sex)
    {
        switch ($sex) {
            case self::SEX_UNCKNOW:
                $sexName = 'Не выбран';
                break;
            case self::SEX_MALE:
                $sexName = 'Мужской';
                break;
            case self::SEX_FEMALE:
                $sexName = 'Женский';
                break;
            default:
                $sexName = 'Не выбран';
                break;
        }
        return $sexName;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'created_at', 'updated_at'], 'required'],
            [['sex', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'email', 'photo'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'email' => 'Email',
            'photo' => 'Photo',
            'sex' => 'Sex',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }


    public function getReviews()
    {
        return $this->hasMany(Reviews::className(), ['author_id' => 'id']);
    }
    public function getRecipient()
    {
        return $this->hasMany(Reviews::className(), ['recipient_id' => 'id']);
    }

    public function getProfileUser($id)
    {
        if (($model =  User::find()->where('id=:id', [':id' => $id])->one()) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Пользователь с таким id не существует.');
    }

}
