<?php

use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("insert into offers (`id`, `amount`, `details`, `date`, `notes`, `is_accepted`, `is_archived`, `user_id`, `job_id`, `created_at`, `updated_at`) values
           (1,	'75,500',	'3 weeks vacation and more',	'2017-11-03',	'need to travel to Dallas for the first 3 weeks for training',	0,	1,	1,	26,	'2017-11-04 21:48:08',	'2017-11-10 23:38:41'),
           (2,	'70000',	'401k',	'2017-11-10',	'80% travel',	0,	1,	1,	29,	'2017-11-12 00:15:34',	'2017-11-19 22:14:34')
         ");
    }
}
