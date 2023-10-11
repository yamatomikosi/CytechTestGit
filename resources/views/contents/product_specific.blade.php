@extends('layouts.lyout')

@section('title', '商品詳細情報')

@section('forwardPage', '')

@php
$showView = true;
@endphp

@section('content')

<div class="">
  <h2>商品詳細情報</h2>
  <form class="Form Product-Specific" method="get" action="{{ route('prodIntEd') }}" enctype="multipart/form-data">
    <table class="Product-Specific_menu">
      <tr>
        <th>商品情報ID</th>
        <td><input name="id" type="text" value="{{ $product->id }}" readonly></td>
      </tr>
      <tr>
        <th>商品名</th>
        <td><input name="product_name" type="text" value="{{ $product->product_name }}" readonly></td>
      </tr>
      <tr>
        <th>メーカー</th>
        <td><select name="companie_id">
            <option value="{{ $product->companie_id }}">{{ $product->companies->company_name }}</option>
          </select></td>
      </tr>
      <tr>
        <th>価格</th>
        <td><input name="price" type="text" value="{{ $product->price }}" readonly></td>
      </tr>
      <tr>
        <th>在庫数</th>
        <td><input name="stock" type="text" value="{{ $product->stock }}" readonly></td>
      </tr>
      <tr>
        <th>コメント</th>
        <td><textarea name="comment" readonly>{{ $product->comment }}</textarea></td>
      </tr>
      <tr>
        <th>商品画像</th>
        <td><input type="text" name="img_path" value="{{ asset( $product->img_path) }}" hidden></td>
      </tr>
    </table>
    <img id="imgPathPrev" src="{{ asset( $product->img_path) }}">
    <button class="button-rightside" type="submit">編集</button>
  </form>
</div>
@endsection