<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "reviews".
 *
 * @property int $id
 * @property int $recipient_id
 * @property int $author_id
 * @property string $content
 * @property int $rating
 * @property string $created_at
 * @property string $updated_at
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviews';
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
            [['recipient_id', 'author_id', 'content'], 'required'],
            [['recipient_id', 'author_id'], 'integer'],
            [['rating'], 'number'],
            [['content'], 'string', 'max' => 199],
            [['created_at', 'updated_at'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'recipient_id' => 'Recipient ID',
            'author_id' => 'Author ID',
            'content' => 'Content',
            'rating' => 'Rating',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
