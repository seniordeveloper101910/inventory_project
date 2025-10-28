<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInventoryTables extends Migration
{
    public function up()
    {
        // categories
        $this->forge->addField([
            'id' => ['type'=>'INT','constraint'=>11,'unsigned'=>true,'auto_increment'=>true],
            'name' => ['type'=>'VARCHAR','constraint'=>255],
            'created_at' => ['type'=>'DATETIME','null'=>true],
            'updated_at' => ['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('categories', true);

        // products
        $this->forge->addField([
            'id' => ['type'=>'INT','constraint'=>11,'unsigned'=>true,'auto_increment'=>true],
            'sku' => ['type'=>'VARCHAR','constraint'=>64,'null'=>true],
            'name' => ['type'=>'VARCHAR','constraint'=>255],
            'category_id' => ['type'=>'INT','constraint'=>11,'null'=>true],
            'cost' => ['type'=>'DECIMAL','constraint'=>'10,2','default'=>0],
            'price' => ['type'=>'DECIMAL','constraint'=>'10,2','default'=>0],
            'stock_qty' => ['type'=>'INT','constraint'=>11,'default'=>0],
            'created_at' => ['type'=>'DATETIME','null'=>true],
            'updated_at' => ['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('products', true);

        // suppliers
        $this->forge->addField([
            'id' => ['type'=>'INT','constraint'=>11,'unsigned'=>true,'auto_increment'=>true],
            'name' => ['type'=>'VARCHAR','constraint'=>255],
            'contact' => ['type'=>'VARCHAR','constraint'=>255,'null'=>true],
            'email' => ['type'=>'VARCHAR','constraint'=>255,'null'=>true],
            'phone' => ['type'=>'VARCHAR','constraint'=>50,'null'=>true],
            'created_at' => ['type'=>'DATETIME','null'=>true],
            'updated_at' => ['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('suppliers', true);

        // purchases
        $this->forge->addField([
            'id' => ['type'=>'INT','constraint'=>11,'unsigned'=>true,'auto_increment'=>true],
            'supplier_id' => ['type'=>'INT','constraint'=>11],
            'reference' => ['type'=>'VARCHAR','constraint'=>255,'null'=>true],
            'total' => ['type'=>'DECIMAL','constraint'=>'12,2','default'=>0],
            'status' => ['type'=>'VARCHAR','constraint'=>50,'default'=>'pending'],
            'created_at' => ['type'=>'DATETIME','null'=>true],
            'updated_at' => ['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('purchases', true);

        // purchase_items
        $this->forge->addField([
            'id' => ['type'=>'INT','constraint'=>11,'unsigned'=>true,'auto_increment'=>true],
            'purchase_id' => ['type'=>'INT','constraint'=>11],
            'product_id' => ['type'=>'INT','constraint'=>11],
            'qty' => ['type'=>'INT','constraint'=>11],
            'cost' => ['type'=>'DECIMAL','constraint'=>'10,2','default'=>0],
            'created_at' => ['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('purchase_items', true);

        // sales
        $this->forge->addField([
            'id' => ['type'=>'INT','constraint'=>11,'unsigned'=>true,'auto_increment'=>true],
            'customer_name' => ['type'=>'VARCHAR','constraint'=>255,'null'=>true],
            'reference' => ['type'=>'VARCHAR','constraint'=>255,'null'=>true],
            'total' => ['type'=>'DECIMAL','constraint'=>'12,2','default'=>0],
            'status' => ['type'=>'VARCHAR','constraint'=>50,'default'=>'completed'],
            'created_at' => ['type'=>'DATETIME','null'=>true],
            'updated_at' => ['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('sales', true);

        // sale_items
        $this->forge->addField([
            'id' => ['type'=>'INT','constraint'=>11,'unsigned'=>true,'auto_increment'=>true],
            'sale_id' => ['type'=>'INT','constraint'=>11],
            'product_id' => ['type'=>'INT','constraint'=>11],
            'qty' => ['type'=>'INT','constraint'=>11],
            'price' => ['type'=>'DECIMAL','constraint'=>'10,2','default'=>0],
            'created_at' => ['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('sale_items', true);

        // stock_movements
        $this->forge->addField([
            'id' => ['type'=>'INT','constraint'=>11,'unsigned'=>true,'auto_increment'=>true],
            'product_id' => ['type'=>'INT','constraint'=>11],
            'type' => ['type'=>'ENUM','constraint'=>"'in','out','adjust'"],
            'qty' => ['type'=>'INT','constraint'=>11],
            'note' => ['type'=>'VARCHAR','constraint'=>512,'null'=>true],
            'created_at' => ['type'=>'DATETIME','null'=>true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('stock_movements', true);
    }

    public function down()
    {
        $this->forge->dropTable('stock_movements', true);
        $this->forge->dropTable('sale_items', true);
        $this->forge->dropTable('sales', true);
        $this->forge->dropTable('purchase_items', true);
        $this->forge->dropTable('purchases', true);
        $this->forge->dropTable('suppliers', true);
        $this->forge->dropTable('products', true);
        $this->forge->dropTable('categories', true);
    }
}
