<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ads`.
 */
class m180531_112742_create_ads_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ads', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'title' => $this->string(199)->notNull(),
            'body' => $this->text()->notNull(),
            'price' => $this->integer()->notNull(),
            'created_at' => $this->string(199),
            'updated_at' => $this->string(199),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ads');
    }
}
