<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;

class employeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $payload = [
            [
                'name' => 'John Smith',
                'job_title' => 'Manager',
                'salary' => 60000,
                'department' => 'Sales',
                'join_date' => '2022-01-15',
            ],
            [
                'name' => 'John Doe',
                'job_title' => 'Analyst',
                'salary' => 45000,
                'department' => 'Marketing',
                'join_date' => '2022-02-01',
            ],
            [
                'name' => 'Mike Brown',
                'job_title' => 'Developer',
                'salary' => 55000,
                'department' => 'IT',
                'join_date' => '2022-03-10',
            ],
            [
                'name' => 'Anna Lee',
                'job_title' => 'Manager',
                'salary' => 65000,
                'department' => 'Sales',
                'join_date' => '2021-12-05',
            ],
            [
                'name' => 'Mark Wong',
                'job_title' => 'Developer',
                'salary' => 50000,
                'department' => 'IT',
                'join_date' => '2023-05-20',
            ],
            [
                'name' => 'Emily Chen',
                'job_title' => 'Analyst',
                'salary' => 48000,
                'department' => 'Marketing',
                'join_date' => '2023-06-02',
            ],
        ];

        Employee::insert($payload);
    }
}
