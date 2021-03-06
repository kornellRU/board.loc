<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use \yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use app\models\ImageUpload;

/**
 * This is the model class for table "ads".
 *
 * @property int $id
 * @property string $title
 * @property string $body
 * @property string $price
 * @property string $created_at
 * @property string $updated_at
 */
class Ads extends ActiveRecord
{

    public $imageFiles;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ads';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // если вместо метки времени UNIX используется datetime:
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function getImages()
    {
        return $this->hasMany(ImageUpload::className(), ['ads_id' => 'id']);
    }

    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'body', 'price'], 'required'],
            [['body'], 'string'],
            [['title', 'price', 'created_at', 'updated_at'], 'string', 'max' => 199],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'body' => 'Body',
            'price' => 'Price',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
