@extends('layouts.app')

@section('head')
    <style>
        .error{
            color: red;
            font-style: italic;
        }
    </style>

@endsection

@section('content')
    <section>
        <div class="container">
            <form method="POST" action="{{action('WebsiteController@store')}}" id="formAddWebsite">
                @csrf
                <div class="form-group">
                    <label for="websiteName">Website Name</label>
                    <input type="text" class="form-control" id="websiteName" name="websiteName" value="{{old('websiteName')}}">
                    <span class="error"></span>
                    <p class="is-invalid alert-danger">{{$errors->first('websiteName')}}</p>
                </div>


                <div class="form-group">
                    <label for="url">Website URL</label>
                    <input type="url" class="form-control" id="url" name="url" value="{{old('url')}}">
                    <p class="is-invalid alert-danger">{{$errors->first('url')}}</p>
                </div>


                <div class="form-group">
                    <label for="titleDOM">Title CSS Class</label>
                    <input type="text" class="form-control" id="titleDOM" name="titleDOM" value="{{old('titleDOM')}}">
                    <p class="is-invalid alert-danger">{{$errors->first('titleDOM')}}</p>
                </div>


                <div class="form-group">
                    <label for="excerptDOM">Excerpt CSS Class</label>
                    <input type="text" class="form-control" id="excerptDOM" name="excerptDOM" value="{{old('excerptDOM')}}">
                    <p class="is-invalid alert-danger">{{$errors->first('excerptDOM')}}</p>
                </div>


                <div class="form-group">
                    <label for="urlDOM">URL CSS Class</label>
                    <input type="text" class="form-control" id="urlDOM" name="urlDOM" value="{{old('urlDOM')}}">
                    <p class="is-invalid alert-danger">{{$errors->first('urlDOM')}}</p>
                </div>

                <div class="form-group" style="margin-top: 2em">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="{{ asset('js/formValidation.js') }} "></script>

@endsection
