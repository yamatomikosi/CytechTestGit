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
  <form class="Form Edit" id="formEditer" method="post" enctype="multipart/form-data">

    <table class="Edit_menu">
      <tr>
        <th>商品情報ID</th>
        <td><input name="id" type="text" value="{{$date['id']}}" readonly></td>
      </tr>
      <tr>
        <th>商品名</th>
        <td><input name="product_name" type="text" value="{{$date['product_name']}}" require></td>
      </tr>
      <tr>
        <th>メーカー</th>
        <td><select name="companie_id">
            @foreach ($companies as $company) <option value="{{ $company->id }}">{{ $company->company_name }}</option>@endforeach
          </select></td>
      </tr>
      <tr>
        <th>価格</th>
        <td><input name="price" type="number" value="{{$date['price']}}" require></td>
      </tr>
      <tr>
        <th>在庫数</th>
        <td><input name="stock" type="number" value="{{$date['stock']}}" require></td>
      </tr>
      <tr>
        <th>コメント</th>
        <td><textarea name="comment">{{$date['comment']}}</textarea></td>
      </tr>
      <tr>
        <th>商品画像</th>
        <td><input id="imgPath" name="img_path" type="file" value="{{$date['img_path']}}"></td>
      </tr>
    </table>
    <img id="imgPathPrev" src="{{$date['img_path']}}">
    <button class="button-rightside" type="submit">更新</button>
  </form>
</div>
@endsection