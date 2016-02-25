<?php

use Illuminate\Database\Seeder;
use CodeProject\Entities\ProjectMembers;

class ProjectMembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ProjectMembers::class,50)->create();
    }
}
