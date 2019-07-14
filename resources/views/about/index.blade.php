@extends('master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="other-page-wrap sub-wrap-tool1">
                        <br>
                        <h1>このサイトについて</h1>
                        <br>
                        <p>この度は「渋谷のお酒サイト」に起こし頂きありがとうございます。</p>
                        <p>このサイトはぐるなびAPIで取得したデータから<span class="strength-ward">東京の渋谷にて営業をしている居酒屋</span>をリストアップして表示しています。</p>
                        <p>最新の店舗情報の他、エリア・お酒の種類のカテゴリーごとに分類することで<span class="strength-ward">行きたい場所にある店舗や飲みたいお酒がある店舗</span>を確認することが出来ます。</p>
                        <p>各店舗情報を選択すると<span class="strength-ward">ぐるなびサイトの店舗情報に画面遷移します。</span>より詳細な情報の確認並びに予約にご利用頂けます。</p>
                        <p>「new」タブを選択すると最新の店舗の情報が一覧となって表示されます。１ページ10店舗のみ表示しており、画面最下部の各ページ番号を割り振ったボタンを押下して頂く事で該当のページに画面遷移する事が出来ます。<br>
                            店舗情報を選択すると、予算と開店時刻を記載したモーダルが表示されます。モーダル内の「予約をする」ボタンを押下する事でぐるなびサイトに遷移します。
                        </p>
                        <p>「area」タブを選択すると該当のエリアごとに店舗の情報が表示されます。<br>
                            店舗名を押下するとぐるなびサイトの店舗情報に画面遷移します。
                        </p>
                        <p>「type」タブを選択するとお酒の種類ごとに店舗の情報が表示されます。<br>
                            お酒と店舗の割り当てはぐるなびで登録されているデータに基いて行っております。<br>
                            店舗名を押下するとぐるなびサイトの店舗情報に画面遷移します。
                        </p>
                    </div>
                    <div class="other-page-wrap sub-wrap-tool1">
                        <br>
                        <h1>問い合わせ先</h1>
                        <br>
                        <p>ご意見・ご感想、ご要望等はお手数かけますが<a href="{{$access}}">Twitter</a>までお願いします。</p>
                        </p>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
@endsection
