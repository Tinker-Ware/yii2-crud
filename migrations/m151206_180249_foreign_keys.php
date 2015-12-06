<?php

use yii\db\Schema;
use yii\db\Migration;

class m151206_180249_foreign_keys extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey('customercustomerdemo_customerid_fkey', 'customercustomerdemo', '[[CustomerID]]', 'customers', '[[CustomerID]]');
        $this->addForeignKey('customercustomerdemo_customertypeid_fkey', 'customercustomerdemo', '[[CustomerTypeID]]', 'customerdemographics', '[[CustomerTypeID]]');
        $this->addForeignKey('employees_reportsto_fkey', 'employees', '[[ReportsTo]]', 'employees', '[[EmployeeID]]');
        $this->addForeignKey('employeeterritories_employeeid_fkey', 'employeeterritories', '[[EmployeeID]]', 'employees', '[[EmployeeID]]');
        $this->addForeignKey('employeeterritories_territoryid_fkey', 'employeeterritories', '[[TerritoryID]]', 'territories', '[[TerritoryID]]');
        $this->addForeignKey('order_details_orderid_fkey', 'order_details', '[[OrderID]]', 'orders', '[[OrderID]]');
        $this->addForeignKey('order_details_productid_fkey', 'order_details', '[[ProductID]]', 'products', '[[ProductID]]');
        $this->addForeignKey('orders_customerid_fkey', 'orders', '[[CustomerID]]', 'customers', '[[CustomerID]]');
        $this->addForeignKey('orders_employeeid_fkey', 'orders', '[[EmployeeID]]', 'employees', '[[EmployeeID]]');
        $this->addForeignKey('orders_shipvia_fkey', 'orders', '[[ShipVia]]', 'shippers', '[[ShipperID]]');
        $this->addForeignKey('products_supplierid_fkey', 'products', '[[SupplierID]]', 'suppliers', '[[SupplierID]]');
        $this->addForeignKey('products_categoryid_fkey', 'products', '[[CategoryID]]', 'categories', '[[CategoryID]]');
        $this->addForeignKey('territories_regionid_fkey', 'territories', '[[RegionID]]', 'region', '[[RegionID]]');
    }

    public function safeDown()
    {
        $this->dropForeignKey('customercustomerdemo_customerid_fkey', 'customercustomerdemo');
        $this->dropForeignKey('customercustomerdemo_customertypeid_fkey', 'customercustomerdemo');
        $this->dropForeignKey('employees_reportsto_fkey', 'employees');
        $this->dropForeignKey('employeeterritories_employeeid_fkey', 'employeeterritories');
        $this->dropForeignKey('employeeterritories_territoryid_fkey', 'employeeterritories');
        $this->dropForeignKey('order_details_orderid_fkey', 'order_details');
        $this->dropForeignKey('order_details_productid_fkey', 'order_details');
        $this->dropForeignKey('orders_customerid_fkey', 'orders');
        $this->dropForeignKey('orders_employeeid_fkey', 'orders');
        $this->dropForeignKey('orders_shipvia_fkey', 'orders');
        $this->dropForeignKey('products_supplierid_fkey', 'products');
        $this->dropForeignKey('products_categoryid_fkey', 'products');
        $this->dropForeignKey('territories_regionid_fkey', 'territories');
    }
}
