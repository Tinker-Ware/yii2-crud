<?php

use yii\db\Schema;
use yii\db\Migration;

class m151206_180249_foreign_keys extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey('customercustomerdemo_customerid_fkey', '{{CustomerCustomerDemo}}', '[[CustomerID]]', '{{Customers}}', '[[CustomerID]]');
        $this->addForeignKey('customercustomerdemo_customertypeid_fkey', '{{CustomerCustomerDemo}}', '[[CustomerTypeID]]', '{{CustomerDemographics}}', '[[CustomerTypeID]]');
        $this->addForeignKey('employees_reportsto_fkey', '{{Employees}}', '[[ReportsTo]]', '{{Employees}}', '[[EmployeeID]]');
        $this->addForeignKey('employeeterritories_employeeid_fkey', '{{EmployeeTerritories}}', '[[EmployeeID]]', '{{Employees}}', '[[EmployeeID]]');
        $this->addForeignKey('employeeterritories_territoryid_fkey', '{{EmployeeTerritories}}', '[[TerritoryID]]', '{{Territories}}', '[[TerritoryID]]');
        $this->addForeignKey('order_details_orderid_fkey', '{{OrderDetails}}', '[[OrderID]]', '{{Orders}}', '[[OrderID]]');
        $this->addForeignKey('order_details_productid_fkey', '{{OrderDetails}}', '[[ProductID]]', '{{Products}}', '[[ProductID]]');
        $this->addForeignKey('orders_customerid_fkey', '{{Orders}}', '[[CustomerID]]', '{{Customers}}', '[[CustomerID]]');
        $this->addForeignKey('orders_employeeid_fkey', '{{Orders}}', '[[EmployeeID]]', '{{Employees}}', '[[EmployeeID]]');
        $this->addForeignKey('orders_shipvia_fkey', '{{Orders}}', '[[ShipVia]]', '{{Shippers}}', '[[ShipperID]]');
        $this->addForeignKey('products_supplierid_fkey', '{{Products}}', '[[SupplierID]]', '{{Suppliers}}', '[[SupplierID]]');
        $this->addForeignKey('products_categoryid_fkey', '{{Products}}', '[[CategoryID]]', '{{Categories}}', '[[CategoryID]]');
        $this->addForeignKey('territories_regionid_fkey', '{{Territories}}', '[[RegionID]]', '{{Regions}}', '[[RegionID]]');
    }

    public function safeDown()
    {
        $this->dropForeignKey('customercustomerdemo_customerid_fkey', '{{CustomerCustomerDemo}}');
        $this->dropForeignKey('customercustomerdemo_customertypeid_fkey', '{{CustomerCustomerDemo}}');
        $this->dropForeignKey('employees_reportsto_fkey', '{{Employees}}');
        $this->dropForeignKey('employeeterritories_employeeid_fkey', '{{EmployeeTerritories}}');
        $this->dropForeignKey('employeeterritories_territoryid_fkey', '{{EmployeeTerritories}}');
        $this->dropForeignKey('order_details_orderid_fkey', '{{OrderDetails}}');
        $this->dropForeignKey('order_details_productid_fkey', '{{OrderDetails}}');
        $this->dropForeignKey('orders_customerid_fkey', '{{Orders}}');
        $this->dropForeignKey('orders_employeeid_fkey', '{{Orders}}');
        $this->dropForeignKey('orders_shipvia_fkey', '{{Orders}}');
        $this->dropForeignKey('products_supplierid_fkey', '{{Products}}');
        $this->dropForeignKey('products_categoryid_fkey', '{{Products}}');
        $this->dropForeignKey('territories_regionid_fkey', '{{Territories}}');
    }
}
