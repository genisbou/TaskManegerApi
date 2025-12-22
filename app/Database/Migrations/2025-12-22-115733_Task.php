<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Task extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'unsigned' => true, // Only positive values
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'description' => [
                'type' => 'TEXT',
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'in_progress', 'completed'],
                'default' => 'pending',
                'null' => false,
            ],
            'date_limit' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'priority' => [
                'type' => 'ENUM',
                'constraint' => ['low', 'medium', 'high'],
                'default' => 'medium',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true, // Permits null values
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tasks');
    }

    public function down()
    {
        $this->forge->dropTable('tasks');
    }
}
