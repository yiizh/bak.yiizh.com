<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use console\components\Migration;

class m160830_063639_create_table_news extends Migration
{
    public $tableName = '{{%news}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'userId' => $this->integer()->comment('用户 ID'),
            'title' => $this->string(100)->notNull()->comment('标题'),
            'summary' => $this->string(500)->notNull()->comment('摘要'),
            'link' => $this->string(200)->notNull()->comment('链接地址'),
            'status' => $this->smallInteger()->comment('状态'),
            'createdAt' => $this->integer()->comment('创建时间'),
            'updatedAt' => $this->integer()->comment('更新时间'),
        ], $this->tableOptions . ' comment "新闻表"');
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }

}
