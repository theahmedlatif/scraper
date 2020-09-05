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
                        <div class="col-lg-6">
                            <a href="{{route('websites.list')}}">
                                <div class="d-flex align-items-center justify-content-center p-3 py-5 mb-2 bg-light rounded" style="font-size: 20em;">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bookmark-check-fill text-success" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M4 0a2 2 0 0 0-2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4zm6.854 5.854a.5.5 0 0 0-.708-.708L7.5 7.793 6.354 6.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"></path>
                                    </svg>
                                </div>
                                <p class="text-xl-center ">Saved Websites</p>
                            </a>
                        </div>
                        <div class="col-lg-6">
                            <a href="{{route('website.create')}}">
                                <div class="d-flex align-items-center justify-content-center p-3 py-5 mb-2 bg-light rounded" style="font-size: 20em;">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bookmark-plus text-danger" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"></path>
                                        <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5V6H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V7H6a.5.5 0 0 1 0-1h1.5V4.5A.5.5 0 0 1 8 4z"></path>
                                    </svg>
                                </div>
                                <p class="text-xl-center">Add Website</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
