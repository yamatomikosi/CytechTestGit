@extends('layouts.lyout')

@section('title', '商品登録')

@section('forwardPage', '')

@php
$showView = false;
@endphp

@section('content')
<h2>商品新規登録</h2>
<form class="Register content-box" id="Register" method="post" name="Register" enctype="multipart/form-data">
  @csrf
  <dl class="information-form">
    <div class="information-form_item">
      <dt>商品名<span class="font-color--red">*</span></dt>
      <dd><input name="product_name" type="text" required></dd>
    </div>
    <div class="information-form_item">
      <dt>メーカー名<span class="font-color--red">*</span></dt>
      <dd><select name="companie_id" required>
          <option selected disabled>-</option>@foreach ($companies as $company) <option value="{{ $company->id }}">{{ $company->company_name }}</option> @endforeach
        </select></dd>
    </div>
    <div class="information-form_item">
      <dt>価格<span class="font-color--red">*</span></dt>
      <dd><input name="price" type="number" required></dd>
    </div>
    <div class="information-form_item">
      <dt>在庫数<span class="font-color--red">*</span></dt>
      <dd><input name="stock" type="number" required></dd>
    </div>
    <div class="information-form_item">
      <dt>コメント </dt>
      <dd><textarea name="comment"></textarea></dd>
    </div>
    <div class="information-form_item">
      <dt>商品画像 </dt>
      <dd><input id="imgPath" name="img_path" type="file" value="">
        <img id="Register_img-preview">
      </dd>
    </div>
  </dl>
  <button ><a href="{{route('prodInts')}}">戻る</a></button>
  <button type="submit" name="id">登録</button>

</form>
  @endsection
