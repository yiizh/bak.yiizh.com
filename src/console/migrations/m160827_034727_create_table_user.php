<?php
/**
 * @link http://www.yiizh.com/
 * @copyright Copyright (c) 2016 yiizh.com
 * @license http://www.yiizh.com/license/
 */


use common\helpers\DateHelper;
use common\models\User;
use console\components\Migration;

class m160827_034727_create_table_user extends Migration
{
    public $tableName = '{{%user}}';

    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->comment('主键'),
            'name' => $this->string(50)->notNull()->comment('姓名'),
            'email' => $this->string(100)->notNull()->unique()->comment('邮箱'),
            'authKey' => $this->string(100)->notNull()->comment('授权秘钥'),
            'passwordHash' => $this->string(200)->notNull()->comment('加密密码'),
            'passwordResetToken' => $this->string(200)->unique()->comment('密码重置令牌'),
            'status' => $this->smallInteger()->notNull()->defaultValue(User::STATUS_ACTIVE)->comment('状态'),
            'registerDatetime' => $this->dateTime()->comment('注册时间'),
            'createdAt' => $this->integer()->comment('创建时间'),
            'updatedAt' => $this->integer()->comment('更新时间'),
        ]);

        $this->createIndex('idx-user-email', $this->tableName, ['email']);
        $this->createIndex('idx-user-status', $this->tableName, ['status']);

        $security = Yii::$app->security;
        $this->insert($this->tableName, [
            'name' => '管理员',
            'email' => 'admin@example.com',
            'authKey' => $security->generateRandomString(),
            'passwordHash' => $security->generatePasswordHash('admin'),
            'registerDatetime' => DateHelper::now(),
            'createdAt' => time(),
            'updatedAt' => time(),
        ]);
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
