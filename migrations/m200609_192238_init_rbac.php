<?php

use yii\db\Migration;

/**
 * Class m200609_192238_init_rbac
 */
class m200609_192238_init_rbac extends Migration
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
        echo "m200609_192238_init_rbac cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $auth = Yii::$app->authManager;

        //add create project permission
        $createProject = $auth->createPermission('createProject');
        $createProject->description = 'Create project.';
        $auth->add($createProject);

        //add upadate project permission
        $updateProject = $auth->createPermission('updateProject');
        $updateProject->description = 'Update project';
        $auth->add($updateProject);

        //add delete project permission
        $deleteProject = $auth->createPermission('deleteProject');
        $deleteProject->description = 'Delete project';
        $auth->add($deleteProject);

        //add view project permission
        $viewProject = $auth->createPermission('viewProject');
        $viewProject->description = 'View project';
        $auth->add($viewProject);

        //add manager role and give it all permissions
        $manager=$auth->createRole('manager');
        $auth->add($manager);
        $auth->addChild($manager, $createProject);
        $auth->addChild($manager, $updateProject);
        $auth->addChild($manager, $viewProject);
        $auth->addChild($manager, $deleteProject);

        //add supervisor role and view permission
        $supervisor=$auth->createRole('supervisor');
        $auth->add($supervisor);
        $auth->addChild($supervisor, $viewProject);

        //add internal participant and view, update Permissions
        $internalParticipant = $auth->createRole('internal');
        $auth->add($internalParticipant);
        $auth->addChild($internalParticipant, $viewProject);
        $auth->addChild($internalParticipant, $updateProject);

        //add external participant and view Permissions
        $externalParticipant = $auth->createRole('external');
        $auth->add($externalParticipant);
        $auth->addChild($externalParticipant, $viewProject);

        //assigning  manager roles
        $auth->assign($manager, 1);
        $auth->assign($manager, 3);

        //assigning internal participants
        $auth->assign($internalParticipant, 2);



    }

    public function down()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
    }
}
