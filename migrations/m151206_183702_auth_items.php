<?php

use yii\db\Schema;
use yii\db\Migration;

class m151206_183702_auth_items extends Migration
{
    public $models = [
        'Category',
        'CustomerCustomerDemo',
        'CustomerDemographic',
        'Customer',
        'Employee',
        'EmployeeTerritory',
        'OrderDetail',
        'Order',
        'Product',
        'Region',
        'Shipper',
        'Supplier',
        'Territory',
        'User',
    ];

    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $role = $auth->createRole('admin');
        $auth->add($role);

        foreach ($this->models as $model) {
            foreach (['create', 'read', 'update', 'delete'] as $opName) {
                $authItem = $auth->createPermission('app\\models\\' . $model . '.' . $opName);
                $auth->add($authItem);
                $auth->addChild($role, $authItem);
            }
        }

        $auth->assign($role, 1); // default admin user
    }

    public function safeDown()
    {
        $auth = Yii::$app->authManager;
        $auth->remove($auth->getRole('admin'));

        foreach ($this->models as $model) {
            foreach (['create', 'read', 'update', 'delete'] as $opName) {
                $auth->remove($auth->getPermission($model . '.' . $opName));
            }
        }
    }
}
