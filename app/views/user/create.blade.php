@extends('master')
@section('content')
    @if(isset($message))<label class="error">{{$message}}</label>@endif
    <h1>Kullanıcı Formu</h1>
    <form action="" method="post" name="createForm">
        <div class="form-group">
            <label for="code">Kod</label>
            <input type="text" name="code" class="form-control" id="code" placeholder="Kod">
        </div>
        <div class="form-group">
            <label for="first_name">İsim</label>
            <input type="text" name="first_name" class="form-control" id="first_name" placeholder="İsim">
        </div>
        <div class="form-group">
            <label for="first_name">Soyisim</label>
            <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Soyisim">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="mail adresi giriniz">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Şifre</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="şifre giriniz">
        </div>
        <div class="form-group">
            <label for="password_confirm">Şifre Tekrar</label>
            <input type="password" name="password_confirm" class="form-control" id="password_confirm" placeholder="şifre tekrarı">
        </div>
        <div class="form-group">
            <label for="group">Kullanıcı Tipi</label>
            <select name="group" class="form-control">
                @foreach(Sentry::findAllGroups() as $val)
                <option value="{{$val->id}}">{{$val->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
@stop