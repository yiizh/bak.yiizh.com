<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use console\components\Migration;

class m160831_114505_add_field_weibo_to_table_user extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'weibo', 'varchar(100)');
        $this->addCommentOnColumn('{{%user}}', 'weibo', '绑定的微博账号');
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'weibo');
    }

}
