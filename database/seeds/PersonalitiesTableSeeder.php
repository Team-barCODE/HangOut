<?php

use Illuminate\Database\Seeder;
use App\Models\Personality;

class PersonalitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Personalities = ['優しい','穏やか','親しみやすい','素直','誠実','謙虚','落ち着きがある','ポジティブ','ネガティブ','楽観的','几帳面','照れ屋','インドア','アウトドア','明るい','真面目','上品','決断力がある','好奇心旺盛','家庭的','面倒見が良い','面白い','聞き上手','爽やか','行動的','合理的','負けず嫌い','熱血','気が利く','大胆','ロマンチック','気前がいい','天然','裏表がない','マイペース','気分屋','頼れる','甘えん坊','ストイック','メリハリがある','頑張り屋','芯が強い','優柔不断','知的','その他'];

        for($i = 0 ; $i < count($Personalities) ; $i++){
            Personality::create([
                'personality' => $Personalities[$i],

            ]);
        }
        //
    }
}
