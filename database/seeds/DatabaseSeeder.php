<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
	private $tables = [
		'users'
	];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->cleanDatabase();

        $this->call(UsersTableSeeder::class);
    }

    private function cleanDatabase()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS=0');

    	foreach ($this->tables as $tableName)
    	{
    		DB::table($tableName)->truncate();
    	}
  
    	DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}

	class UsersTableSeeder extends Seeder {
		public function run()
		{
			factory(App\User::class, 6)->create()->each(function($user) {
				$user->articles()->save(factory(App\Article::class)->make())->each(function($article) {
					$article->tags()->save(factory(App\Tag::class)->make());
				});
			});
		}
	}
