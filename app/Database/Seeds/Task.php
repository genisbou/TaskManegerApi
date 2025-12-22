<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Task extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'user_id' => 1,
                'title' => 'Sample Task',
                'description' => 'This is a sample task description.',
                'date_limit' => '2025-12-31 23:59:59',
                
            ],
        ];
        foreach ($data as $row) {
            $this->db->table('tasks')->insert($row);
        }
    }
}
