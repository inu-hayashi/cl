@extends('layouts.app') @section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      @include('common.errors')
      <form action="{{ url('copings/update') }}" method="POST">
        <!-- item_name -->
        <div class="form-group">
          <h2 class="h4"><label for="item_name">コーピング内容</label></h2>
          <input type="text" id="item_name" name="item_name" class="form-control" value="{{$coping->item_name}}">
        </div>
        <!--/ item_name -->
        <!-- item_satisfaction -->
        <div class="form-group">
          <h2 class="h4">リストを行ったあとの満足度</h2>
          <div class="d-block">
            <label>
              <input type="radio" name="item_satisfaction" class="" value="◯"> ◯ よい</label>
          </div>
          <div class="d-block">
            <label>
              <input type="radio" name="item_satisfaction" class="" value="△" checked> △ ふつう
              </label>
          </div>
          <div class="d-block">
            <label>
              <input type="radio" name="item_satisfaction" class="" value="✕"> ✕ よくない
              </label>
          </div>
        </div>
        <!--/ item_satisfaction -->
        <!-- Saveボタン/Backボタン -->
        <div class="well well-sm">
          <button type="submit" class="btn btn-primary">Save</button>
          <a class="btn btn-link pull-right" href="{{ url('/') }}">
                <i class="glyphicon glyphicon-backward"></i>  Back
            </a>
        </div>
        <!--/ Saveボタン/Backボタン -->
        <!-- id値を送信 -->
        <input type="hidden" name="id" value="{{$coping->id}}" />
        <!--/ id値を送信 -->
        <!-- CSRF -->
        {{ csrf_field() }}
        <!--/ CSRF -->
      </form>
    </div>
  </div>
</div>
@endsection