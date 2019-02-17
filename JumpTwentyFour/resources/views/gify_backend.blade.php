@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Gifs & Stickers Dashboard</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">

                            <div class="form-group row">
                                <label for="start_date" class="col-md-4 col-form-label text-md-right">{{ __('Start Date ') }}</label>

                                <div class="col-md-6">
                                    <input id="datePicker" type="text" class="form-control" name="start_date"  required autofocus>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="end_date" class="col-md-4 col-form-label text-md-right">{{ __('End Date ') }}</label>

                                <div class="col-md-6">
                                    <input id="datePicker" type="text" class="date form-control" name="end_date"  required autofocus>
                                </div>

                            </div>

                        </form>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Search Random') }}
                                </button>
                            </div>
                        </div>


                        You are here!
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
