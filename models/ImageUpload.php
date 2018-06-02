<?php
/**
 * Created by PhpStorm.
 * User: kornell
 * Date: 31.05.18
 * Time: 16:02
 */

namespace app\models;

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

}