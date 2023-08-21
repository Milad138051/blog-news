<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		DB::statement('truncate permissions');
		$permissions=[
		'create-news','edit-news','delete-news','show-news',
		'create-article','edit-article','delete-article','show-article','show-in-site-comment',
		'show-comment','answer-comment','approved-comment',
		'show-user','create-user','edit-user','delete-user',
		];
		foreach($permissions as $permission){
		     DB::table('permissions')->insert([
            'name' =>$permission,
            'description' => 'توضیحات',
            'status' => 1,
        ]); 	
		}
		
    }
}
