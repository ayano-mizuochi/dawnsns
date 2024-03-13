@extends('layouts.app')

@section('content')

<div>
  <div class='container'>
    <h1 class='page-header'>DAWN</h1>
    <h2 class='page-header'>投稿一覧</h2>
    <table class='table table-hover'>
      <tr>
        <th>投稿者id</th>
        <th>投稿内容</th>
        <th>投稿日時</th>
      </tr>
      @foreach ($posts as $post)
      <tr>
        <td>{{ $post->user_id }}</td>
        <td>{{ $post->post }}</td>
        <td>{{ $post->created_at }}</td>
      </tr>
      @endforeach
    </table>
  </div>

</div>

@endsection
