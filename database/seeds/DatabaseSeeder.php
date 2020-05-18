<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User::class, 5)->create()->each(function ($user) {
            $user->feeds()->save(factory(App\Models\Feed::class)->make([
                'name' => 'php.net',
                'url' => 'http://www.php.net/news.rss',
            ]));

            $user->feeds()->save(factory(App\Models\Feed::class)->make([
                'name' => 'Slashdot',
                'url' => 'http://slashdot.org/rss/slashdot.rss',
            ]));

            $user->feeds()->save(factory(App\Models\Feed::class)->make([
                'name' => 'BBC News',
                'url' => 'http://newsrss.bbc.co.uk/rss/newsonline_uk_edition/front_page/rss.xml',
            ]));
        });
    }
}
