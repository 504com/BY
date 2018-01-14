<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FrontContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('front_contents')->insert([
            [
                'blurb' => 'by livraison halal',
                'subBlurb' => 'le meilleur de la restauration halal',
                'catchPhrase1' => 'le concept en 3 étapes',
                'catchPhrase2' => 'les mieux notés',
                'catchPhrase3' => 'les nouveaux',
                'descTitle' => 'votre texte ici',
                'descText' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'title_1' => 'indiquez votre lieu de livraison',
                'text_1' => 'Lariatur, excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est',
                'title_2' => 'choisissez un restaurant',
                'text_2' => 'Lariatur, excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est',
                'title_3' => 'payez par carte, via paypal ou en espèces',
                'text_3' => 'Lariatur, excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est',
				'rank_1' => 1,
                'rank_2' => 2,
                'rank_3' => 3,
				'new_1' => 1,
                'new_2' => 2,
                'new_3' => 3,
				'radius' => 10
            ],
        ]);
    }
}
