@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div style="float: left">{{ __('Dashboard') }}</div>
                    <div style="float: right">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                    <table class="table table-hover table-responsive">
                        <thead class="thead-dark ">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Article Title</th>
                            <th scope="col">Article Description</th>
                            <th scope="col">Article DOM</th>
                            <th scope="col">Created at</th>
                            <th scope="col d-md-table-cell">Article Link</th>
                            <th scope="col">Website Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($articles as $article)
                            <tr>
                                <th scope="row">{{$article->id}}</th>
                                <td>{{$article->articleTitle}}</td>
                                <td class="flex-md-wrap">{{$article->articleExcerpt}}</td>
                                <td style="font-size:0.8em">
                                    {{'Title CSS Selector: ('.$article->website->titleDOM.')'}}</br>----</br>
                                    {{'Excerpt CSS Selector: ('.$article->website->excerptDOM.')'}}</br>----</br>
                                    {{'URL CSS Selector: ('.$article->website->urlDOM.')'}}</br>

                                </td>
                                <td>{{$article->created_at}}</td>
                                <td><a href="{{$article->articleURL}}">Link</a></td>
                                <td>{{$article->website->websiteName}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
