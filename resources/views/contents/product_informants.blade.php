@extends('layouts.lyout')

@section('title', '商品一覧')

@section('forwardPage', '')

@section('content')
@php
$showView = false;
@endphp

  <h2>商品検索</h2>
  <form class="Form Search" id="Search" method="get" name="Search">
      <div class="Search_item"><input type="search" name="product_name" placeholder="検索キーワード"></div>
      <div class="Search_item"><select class="Search_drp" id="drpCompany" name="company_id" >
          <option value="" selected >メーカー名</option>
          @foreach ($companies as $company) <option value="{{ $company->id }}">{{ $company->company_name }}</option>@endforeach
        </select></div>
    <button class="Search_item" id = "searchButton" type="submit">検索</button>
  </form>
  
  <dl class="searched-products" id="searchedProducts">
    <div class="product_information">
      <dt>ID</dt>
      <dt>商品画像</dt>
      <dt>商品名</dt>
      <dt>価格</dt>
      <dt>在庫数</dt>
      <dt>メーカー名</dt>
      <dt class="flex--size-big"><button  type="button"><a href="{{ route('new') }}">新規登録</a></button></dt>
    </div>
    
   
    @foreach ($products as $product)
        <div class="product">
          <dd>{{ $product->id }}.</dd>

          <img class = "product_img"  src = "{{ $product->img_path }}">

          <dd>{{ $product->product_name }}</dd>

          <dd>{{ $product->price }}</dd>
 
          <dd>{{ $product->stock }}</dd>
  
          <dd>{{ $product->companies->company_name }}</dd>

          <dd class="flex--size-big"><form class="product_buttons" method="GET" action="?">
        <button class="product_specific_button" type="submit" name="product_id" value="{{ $product->id }}" formaction="{{ route('prodSp') }}"><span class="font-color--white">詳細</span></button>
        <button class="product_delete_button" type="submit" name="product_id" value="{{ $product->id }}" formaction=""><span class="font-color--white">削除</span></button>
        </form></dd>
        </div>
    @endforeach
    </dl>
    <div class="slider" id="slider">
  <span class="slider_element"> < </span>
  <span class="slider_element"> > </span>
</div>
<script src="{{asset('assets/js/slidingPage.js')}}"></script>
@endsection