@extends('layouts.lyout')

@section('title', '商品一覧')

@section('forwardPage', '')

@php
$showView = true;
@endphp

@section('content')
<div class="">
  <h2>商品詳細情報</h2>
  <h3>編集中</h3>
  <form class="content-box" id="formEditer" method="post" enctype="multipart/form-data">
    @csrf
    <dl class="information-form">
      <div class="information-form_item">
        <dt>ID.</dt>
        <dd><input name="id" type="text" value="{{$date['id']}}" readonly></dd>
      </div>
      <div class="information-form_item">
        <dt>商品名<span class="font-color--red">*</span></dt>
        <dd><input name="product_name" type="text" value="{{$date['product_name']}}" require></dd>
      </div>
      <div class="information-form_item">
        <dt>メーカー<span class="font-color--red">*</span></dt>
        <dd><select name="companie_id">
            @foreach ($companies as $company) <option value="{{ $company->id }}">{{ $company->company_name }}</option>@endforeach
          </select></dd>
      </div>
      <div class="information-form_item">
        <dt>価格<span class="font-color--red">*</span></dt>
        <dd><input name="price" type="number" value="{{$date['price']}}" require></dd>
      </div>
      <div class="information-form_item">
        <dt>在庫数<span class="font-color--red">*</span></dt>
        <dd><input name="stock" type="number" value="{{$date['stock']}}" require></dd>
      </div>
      <div class="information-form_item">
        <dt>コメント</dt>
        <dd><textarea name="comment">{{$date['comment']}}</textarea></dd>
      </div>
      <div class="information-form_item">
        <dt>商品画像</dt>
        <dd><input id="imgPath" name="img_path" type="file" value="{{$date['img_path']}}"></dd>
      </div>
      <img id="imgPathPrev" src="{{$date['img_path']}}">
    </dl>
    <button  type="submit">更新</button>
  @endsection
  </form>
   
   