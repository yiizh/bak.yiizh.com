<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */

use console\components\Migration;

class m160830_125800_add_avatar_field_to_user_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'avatar', 'varchar(200)');
        $this->addCommentOnColumn('{{%user}}', 'avatar', '头像地址');
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'avatar');
    }

}
