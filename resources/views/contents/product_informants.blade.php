@extends('layouts.lyout')

@section('title', '商品一覧')

@section('forwardPage', '')

@section('content')
@php
$showView = false;
@endphp

  <h2>商品検索</h2>
  <form class="Form Search" id="Search" method="post" name="Search">
  @csrf
      <div class="Search_item"><input type="search" name="product_name" placeholder="検索キーワード"></div>
      <div class="Search_item"><select class="Search_drp" id="drpCompany" name="company_id" >
          <option value="" selected >メーカー名</option>
          @foreach ($companies as $company) <option value="{{ $company->id }}">{{ $company->company_name }}</option>@endforeach
        </select></div>
        <div class="Search_item Search_item--between"> 価格　<input type="number" name="price_min" min="0" placeholder="0"> 
        &nbsp;~&nbsp;
        <input type="number" name="price_max" placeholder="100">
      </div>
        <div class="Search_item Search_item--between">在庫　<input type="number" name="stock_min" min = '0' placeholder="0">
        &nbsp;~&nbsp;
        <input type="number" name="stock_max" placeholder="100">
      </div>
    <button class="Search_item" id = "searchButton" name="" type="submit">検索</button>
  </form>
  
  <dl>
  <div class="product_information">
    <dt class="sort-button--id" data-index="0" data-type="number"><button>ID</button></dt>
    <dt data-index="1" >商品画像</dt>
    <dt class="sort-button--name" data-index="2" data-type="text"><button>商品名</button></dt>
    <dt class="sort-button--price" data-index="3" data-type="number"><button>価格</button></dt>
    <dt class="sort-button--stock" data-index="4" data-type="number"><button>在庫数</button></dt>
    <dt class="sort-button--company" data-index="5" data-type="text"><button>メーカー名</button></dt>
    <dt class="flex--size-big" data-index="6" data-type="text"><button type="button"><a href="{{ route('new') }}">新規登録</a></button></dt>
  </div>

  <div class="searched-products" id="searchedProducts">
    @foreach ($products as $product)
      <div class="product">
        <dd class="order--id sort-button">{{ $product->id }}.</dd>
        <img class="product_img sort-button" src="{{ $product->img_path }}">
        <dd class="order--name sort-button">{{ $product->product_name }}</dd>
        <dd class="order--price sort-button">{{ $product->price }}</dd>
        <dd class="order--stock sort-button">{{ $product->stock }}</dd>
        <dd class="order--company sort-button">{{ $product->companies->company_name }}</dd>
        <dd class="flex--size-big">
          <form class="product_buttons" method="GET" action="?">
            <button class="product_specific_button" type="submit" name="product_id" value="{{ $product->id }}" formaction="{{ route('prodSp') }}"><span class="font-color--white">詳細</span></button>
            <button class="product_delete_button" type="button" name="product_id" value="{{ $product->id }}"><span class="font-color--white">削除</span></button>
          </form>
        </dd>
      </div>
    @endforeach
  </div>
</dl>
    <div class="slider" id="slider">
  <span class="slider_element slider--to-side"> < </span>
  <span class="slider_element slider--to-side"> > </span>
</div>
<p id="a"></p>

<script src="{{asset('assets/js/slidingPage.js')}}"></script>
<script src="{{asset('assets/js/sortable.js')}}"></script>
@endsection