<?php
/**
 * @var Illuminate\Pagination\LengthAwarePaginator|\App\Models\Post[] $posts
 */
$title = '投稿一覧';
?>
@extends('front.layouts.base')

@section('content')
<div class="card-header">{{ $title }}</div>
<ul class="nav nav-pills mb-2">
    <li class="nav-item">
        {{ link_to_route('front.posts.index', 'すべて', null, [
            'class' => 'nav-link'.
            (request()->segment(3) === null ? ' active' : '')
        ]) }}
    </li>
    @foreach($tags as $tag)
        <li class="nav-item">
            {{ link_to_route('front.posts.index.tag', $tag->name, $tag->slug, [
                'class' => 'nav-link'.
                (request()->segment(3) === $tag->slug ? ' active' : '')
            ]) }}
        </li>
    @endforeach
</ul>
<div class="card-body">
    @if($posts->count() <= 0)
        <p>表示する投稿はありません。</p>
    @else
        <table class="table">
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->published_format }}</td>
                    <td>{!! link_to_route('front.posts.show', $post->title, $post) !!}</td>
                </tr>
            @endforeach
        </table>
        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    @endif
</div>
@endsection
