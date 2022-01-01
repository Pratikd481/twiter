<?php

namespace Database\Seeders;

use App\Models\Network;
use App\Models\User;
use Illuminate\Database\Seeder;

class NetworkSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 50; $i++) {
            for ($j = 0; $j < 10; $j++) {
                $user_1 = User::find($i);
                $user_2 = User::inRandomOrder()->first();
                $check_network = Network::where('followed_by_id', '!=', $user_1->id)->orWhere('followed_by_id', '!=', $user_2->id)->first();
                while (($user_1 == $user_2) && ($check_network != null)) {
                    $user_1 = User::inRandomOrder()->first();
                }
                Network::create([
                    'followed_by_id' => $user_1->id,
                    'following_id' => $user_2->id
                ]);
                Network::create([
                    'followed_by_id' => $user_2->id,
                    'following_id' => $user_1->id
                ]);
            }
        }
    }
}
