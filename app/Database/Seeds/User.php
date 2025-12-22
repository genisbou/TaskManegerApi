<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'password' => password_hash('admin123', PASSWORD_BCRYPT),
            ],
        ];
        foreach ($data as $row) {
            $this->db->table('users')->insert($row);
        }
    }
}
