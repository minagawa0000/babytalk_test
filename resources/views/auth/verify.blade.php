@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">メールを送りました</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                        ご登録いただいたメールアドレスに確認用のリンクをお送りしました。
                        </div>
                    @endif

                    メールをご確認ください。<br>
                    もし確認用メールが送信されていない場合は、下記をクリックしてください。<br>
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">再送信する</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
