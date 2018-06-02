<?php
/**
 * Created by PhpStorm.
 * User: kornell
 * Date: 31.05.18
 * Time: 16:02
 */

namespace app\modules\profile\models;

use Faker\Calculator\Iban;
use yii\base\Model;
use yii\web\UploadedFile;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use \yii\db\ActiveRecord;

class ImageUpload extends ActiveRecord
{
    public static function tableName()
    {
        return 'image_ads';
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

    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 5],
        ];
    }

    public function upload($model = null)
    {
        if ($this->validate()) {

            foreach ($this->imageFiles as $file) {
                $image = new ImageUpload();
                $random = Yii::$app->security->generateRandomString(8);
                $file->saveAs('images/uploads/ads/' . $file->baseName .'-' .$random. '.' . $file->extension);
                $image->ads_id = $model->id;
                $image->path = $file->baseName .'-' .$random. '.' . $file->extension;
                $image->save(false);
            }
            return true;
        } else {
            return false;
        }
    }
}