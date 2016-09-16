<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    private $tables = [
        // 'users',
        'presenters',
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->cleanDatabase();

        $this->call(PresentersTableSeeder::class);
    }

    private function cleanDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach ($this->tables as $tableName) {
            DB::table($tableName)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}

// class UsersTableSeeder extends Seeder {
// 	public function run()
// 	{
//            $faker = Faker::create();

//            foreach(range(1,5) as $index)
//            {
//                User::create([
//                    'name' => $faker->name,
//                    'email' => $faker->safeEmail,
//                    'password' => bcrypt(str_random(10))
//                ]);
//            }
// 	}
// }

class PresentersTableSeeder extends Seeder
{
    public function run()
    {
        factory(App\Models\Presenter::class, 6)->create()->each(function ($presenter) {
            $presenter->myPresentations()->save(factory(App\Models\Presentation::class)->make())->each(function (
                $article
            ) {
                $article->tags()->save(factory(App\Tag::class)->make());
            });
        });
    }
}

