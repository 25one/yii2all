<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m180915_190150_project
 */
class m180915_190150_project extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('project', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING,
        ]);
        $this->batchInsert('project', ['name'], [
          ['ПРОЕКТ 1'],
          ['ПРОЕКТ 2'],
          ['ПРОЕКТ 3'],
          ['ПРОЕКТ 4'],
          ['ПРОЕКТ 5'],
          ['ПРОЕКТ 6'],
          ['ПРОЕКТ 7'],          
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180915_190150_project cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180915_190150_project cannot be reverted.\n";

        return false;
    }
    */
}
