@extends('layouts.lyout')

@section('title', '商品詳細情報')

@section('forwardPage', '')

@php
$showView = true;
@endphp

@section('content')

  <h2>商品詳細情報画面</h2>
  <form class="content-box" method="get" action="{{ route('prodIntEd') }}" enctype="multipart/form-data">
    <dl class="information-form">
      <div class="information-form_item">
        <dt>ID</dt>
        <dd>{{ $product->id }}.</dd>
      </div>
      <div class="information-form_item">
        <dt>商品画像</dt>
        <dd><input type="text" name="img_path" value="{{ asset( $product->img_path) }}" ></dd>
      </div>
      <div class="information-form_item">
        <dt>商品名</dt>
        <dd>{{ $product->product_name }}"</dd>
      </div>
      <div class="information-form_item">
        <dt>メーカー</dt>
        <dd>{{ $product->companies->company_name }}</dd>
      </div>
      <div class="information-form_item">
        <dt>価格</dt>
        <dd>{{ $product->price }}</dd>
      </div>
      <div class="information-form_item">
        <dt>在庫数</dt>
        <dd>{{ $product->stock }}</dd>
      </div>
      <div class="information-form_item">
        <dt>コメント</dt>
        <dd><textarea name="comment" readonly>{{ $product->comment }}</textarea></dd>
      </div>
    </dl>
    <button  type="submit" name="id" value="{{ $product->id }}">編集</button>
  @endsection
  </form>