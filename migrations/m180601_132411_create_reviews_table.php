<?php

use yii\db\Migration;

/**
 * Handles the creation of table `reviews`.
 */
class m180601_132411_create_reviews_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('reviews', [
            'id' => $this->primaryKey(),
            'recipient_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'content' => $this->string(199)->notNull(),
            'rating' => $this->float()->defaultValue(0),
            'created_at' => $this->string(),
            'updated_at' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('reviews');
    }
}
