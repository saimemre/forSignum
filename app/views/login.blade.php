@extends('master')
@section('content')
    @if(isset($message))<label class="error">{{$message}}</label>@endif
    <h1>Giriş Formu</h1>
    <form action="login" method="post" name="loginForm">
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="mail adresi giriniz">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Şifre</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="şifre giriniz">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
@stop