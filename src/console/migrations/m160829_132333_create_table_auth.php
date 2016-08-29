<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use console\components\Migration;

class m160829_132333_create_table_auth extends Migration
{
    public $tableName = '{{%auth}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'userId' => $this->integer()->notNull(),
            'source' => $this->string()->notNull(),
            'sourceId' => $this->string()->notNull(),
        ]);

        $this->addForeignKey('fk-auth-userId-userId', $this->tableName, 'userId', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }

}
