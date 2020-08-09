<?php

use yii\db\Migration;

/**
 * Class m200610_120231_first_rbac
 */
class m200610_120231_first_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200610_120231_first_rbac cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $auth = Yii::$app->authManager;

        $supervisor = $auth->getRole('supervisor');

        $auth->assign($supervisor, 4);
        $auth->assign($supervisor, 5);
    }

    public function down()
    {
        echo "m200610_120231_first_rbac cannot be reverted.\n";

        return false;
    }
}
