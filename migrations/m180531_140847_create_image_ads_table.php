<?php

use yii\db\Migration;

/**
 * Handles the creation of table `image_ads`.
 */
class m180531_140847_create_image_ads_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('image_ads', [
            'id' => $this->primaryKey(),
            'ads_id' => $this->integer()->notNull(),
            'path' => $this->string()->notNull(),
            'created_at' => $this->string(199),
            'updated_at' => $this->string(199),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('image_ads');
    }
}
