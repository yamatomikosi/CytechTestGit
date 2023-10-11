@extends('layouts.lyout')

@section('title', '商品登録')

@section('forwardPage', '')

@php
$showView = true;
@endphp

@section('content')
<div class="">
  <h2>商品新規登録</h2>
  <form class="Form Register" id="Register" method="post" name="Register" enctype="multipart/form-data">
    @csrf
    <dl class="Register_menu">
      <dt>商品名 </dt>
      <dd><input name="product_name" type="text" required></dd>
      <dt>メーカー名 </dt>
      <dd><select name="companie_id" required>
          <option selected disabled>-</option>@foreach ($companies as $company) <option value="{{ $company->id }}">{{ $company->company_name }}</option> @endforeach
        </select></dd>
      <dt>価格 </dt>
      <dd><input name="price" type="number" required></dd>
      <dt>在庫数 </dt>
      <dd><input name="stock" type="number" required></dd>
      <dt>コメント </dt>
      <dd><textarea name="comment"></textarea></dd>
      <dt>商品画像 </dt>
      <dd><input id="imgPath" name="img_path" type="file" value=""><img id="Register_img-preview"></dd>
    </dl>
    <img id="imgPathPrev">
    <button class="button-rightside" type="submit">登録</button>
  </form>
</div>
@endsection