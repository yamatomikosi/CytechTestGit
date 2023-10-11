@extends('layouts.lyout')

@section('title', '商品一覧')

@section('forwardPage', '')

@section('content')
@php
$showView = false;
@endphp
<div class="">
  <h2>商品検索</h2>
  <form class="Form Search" id="Search" method="get" name="Search">
    <div class="Search_menu">
      <div class="Search_menu_item"><label for="">商品名 </label><input type="search" name="product_name"></div>
      <div class="Search_menu_item"><label for="">メーカー名 </label><select id="drpCompany" name="company_id">
          <option selected>-</option>
          @foreach ($companies as $company) <option value="{{ $company->id }}">{{ $company->company_name }}</option>@endforeach
        </select></div>
    </div>
    <button class="Search_button" type="submit">検索</button>
  </form>
  <button class="newRegister" type="button"><a href="{{ route('new') }}">新規登録</a></button>
  <div class="searched-products">
    @foreach ($products as $product)
    <form class="product " method="GET" action="?">
      <table class="product_information">
        <tr>
          <th>ID</th>
          <td>{{ $product->id }}　</td>
        </tr>
        <tr>
          <th>商品名</th>
          <td>{{ $product->product_name }}　</td>
        </tr>
        <tr>
          <th>価格</th>
          <td>{{ $product->price }}　</td>
        </tr>
        <tr>
          <th>在庫数</th>
          <td>{{ $product->stock }}　</td>
        </tr>
        <tr>
          <th>メーカー名</th>

          <td>{{ $product->company_name }}　</td>
        </tr>
      </table>
      <img class="product_img" src="{{ asset( $product->img_path) }}">
      <div class="product_buttons">
        <button class="product_specific_button" type="submit" name="product_id" value="{{ $product->id }}" formaction="{{ route('prodSp') }}"><span class="font-color--white">詳細</span></button>
        <button class="product_delete_button" type="submit" formaction=""><span class="font-color--white">削除</span></button>
      </div>
    </form>
    @endforeach
  </div>
</div>
@endsection