@extends('layouts.master')

@section('content')
<div class="container m-t-lg">
    <div class="column is-6 mx-auto">
        <article class="card is-rounded has-background-light">
            <div class="card-content">
                <h1 class="title">
                    {{ __('Login') }}
                </h1>
                

                <form action="{{ route('login') }}" method="post">

                    @csrf
                    
                    <div class="field">
                        <div class="control has-icons-left">
                            <input class="input{{ $errors->has('email') ? ' is-danger' : '' }}" type="email" placeholder="Email" name="email">
                            <span class="is-left icon">
                                <i class="fa fa-envelope"></i>
                            </span>
                        </div>
    
                        @if ($errors->has('email'))
                            <p class="help is-danger">
                                {{ $errors->first('email') }}
                            </p>
                        @endif
                    </div>
                    
                    <div class="field">
                        <div class="control has-icons-left">
                            <input class="input{{ $errors->has('password') ? ' is-danger' : '' }}" type="password" placeholder="Password" name="password">
                            <span class="icon is-left">
                                <i class="fa fa-lock"></i>
                            </span>
                        </div>
    
                        @if ($errors->has('password'))
                            <p class="help is-danger">
                                {{ $errors->first('password') }}
                            </p>
                        @endif
                    </div>
    
                    <div class="field">
                        <div class="control">
                            <button type="submit" class="button primary-color is-medium is-fullwidth">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>

                </form>

            </div>
        </article>
    </div>
</div>

@endsection
