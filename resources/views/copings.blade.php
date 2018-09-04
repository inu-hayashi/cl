@extends('layouts.app') @section('content')
<!-- Bootstrapの定形コード… -->
<div class="panel-body container">
  <!-- バリデーションエラーの表示 -->
  @include('common.errors')
  <!-- バリデーションエラーの表示 -->
  <div href="#howto" class="bg-success p-2 mb-4 rounded" id="cop">
    <h2 class="text-white text-left h3"><span class="align-middle"><i class="far fa-caret-square-down"></i> 使い方 </span></h2>
  </div>
  <div id="howto">
    <p>下のフォームに「気晴らしやストレス対策に有効だと思うもの」をたくさん入力しリストアップしましょう。</p>
    <p>ストレスを感じたときや落ち込んだときに、リスト内から気分を切り替えるのに効きそうなものをチョイスして実行。</p>
    <p>やった後は「編集」ボタンから満足度を入力して客観的に自分の感情を評価しましょう。</p>
    <p>まだストレスを感じるなら、無くなるまで他のリストを試していきます。繰り返し行い習慣化することでストレス耐性も高まります。</p>
    <h3>リストを作るコツ</h3>
    <ul>
      <li>どんな細かいことでもいいので、できるだけ多く挙げましょう。</li>
      <li>人名や場所など、具体的な名称を入れましょう</li>
      <li>それぞれのストレスの種類に合わせたリストを作りましょう。</li>
    </ul>
    <h3>詳細情報</h3>
    <p>詳しい情報や効果はこちらを御覧ください。</p>
    <ul>
      <li><a href="https://www.nhk.or.jp/special/stress/02.html" target="_blank">NHKスペシャル「シリーズ キラーストレス」第２回内容</a></li>
      <li><a href="https://style.nikkei.com/article/DGXMZO10483670Z01C16A2000000" target="_blank">くよくよ癖を今すぐ脱出　心がラクになる100のリスト　: NIKKEI STYLE</a></li>
    </ul>
  </div>
  <!-- 登録フォーム -->
  <form action="{{ url('copings') }}" method="POST" class="form-horizontal clearfix">
    {{ csrf_field() }}
    <!-- タイトル -->
    <div class="form-group row">
      <div class="col-sm-12 mt-4">
        <h2 class="h3 text-primary"><label for="coping" class="control-label">ストレスが解消される行動</label></h2>
        <input type="text" name="item_name" id="coping-name" class="form-control" placeholder="外食をする、買い物に行く、etc...">
      </div>
      <input type="hidden" name="item_satisfaction" id="coping-satisfaction" class="form-control" value="-">
    </div>
    <!-- 登録ボタン -->
    <div class="form-group">
      <div class="col-sm-6 mx-auto">
        <button type="submit" class="btn btn-primary btn-lg mx-auto d-block btn-block">
          <i class="glyphicon glyphicon-plus" aria-hidden="true"></i>保存
        </button>
      </div>
    </div>
  </form>
  <!-- 現在のリスト -->
  @if (count($copings) > 0)
  <div class="panel panel-default pt-5">
    <div class="panel-heading border-bottom border-info">
      <h2 class="h3 text-primary">コーピングリスト</h2>ストレスを感じたときに行いましょう
    </div>
    <div class="panel-body">
      <table class="table table-striped">
        <!-- テーブルヘッダ -->
        <thead>
          <tr class="">
            <th class="">内容</th>
            <th class="">評価</th>
            <th class="">編集</th>
            <th class="">削除</th>
          </tr>
        </thead>
        <!-- テーブル本体 -->
        <tbody class="">
          @foreach ($copings as $coping)
          <tr>
            <!-- タイトル -->
            <td class="">
              <div>{{ $coping->item_name }}</div>
            </td>
            <td class="">
              <div>{{ $coping->item_satisfaction }}</div>
            </td>
            <!-- 更新ボタン -->
            <td class="">
              <form action="{{ url('copingsedit/'.$coping->id) }}" method="POST">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">
                  <i class="fas fa-pencil-alt"></i>
                </button>
              </form>
            </td>
            <!-- 削除ボタン -->
            <td class="">
              <form action="{{ url('coping/'.$coping->id) }}" method="POST">
                {{ csrf_field() }} {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-danger">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @endif
  <!-- Book: 既に登録されてるリスト -->
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      {{ $copings->links()}}
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>
$(function(){
  $('#howto').hide();
  $('#cop').click(function(){
    //トグル
    $(this).next().slideToggle();
  });
});
</script>

@endsection