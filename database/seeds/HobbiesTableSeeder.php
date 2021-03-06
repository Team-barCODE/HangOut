<?php

use Illuminate\Database\Seeder;
use App\Models\Hobby;

class HobbiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $genre = ['その他','釣り','登山','サイクリング','ランニング','ドライブ','キャンプ','カメラ','読書','プログラミング','ゲーム','音楽鑑賞','映画鑑賞','アニメ','ライブ','雑貨屋巡り','喫茶店巡り','ショッピング','料理','園芸','筋トレ','ジム','格闘技','剣道','弓道','ゴルフ','テニス','バドミントン','ダーツ','サーフィン','野球','ダンス','サッカー','バレーボール','バスケットボール','ビリヤード','チェス','将棋','DIY','イラスト','プラモデル','インテリア','アクアリウム','カラオケ','外国語','書道','サバイバルゲーム','漫画','ラジオ','ペット','ファッション','パチンコ','SNS','ネット','囲碁','ボルタリング','美術館・博物館巡り','手芸','乗馬','競馬','占い','飲み会'];

        for($i = 0 ; $i < count($genre) ; $i++){
            Hobby::create([
                'genre' => $genre[$i],

            ]);
        }

    }
}
