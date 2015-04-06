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
            <label for="name">İsim</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Ders Adı">
        </div>
        <div class="form-group">
            <label for="ismandatory">Zorunlu Ders ?</label>
            <input type="checkbox" value="1" name="ismandatory" id="ismandatory" >
        </div>
        <div class="form-group">
            <label for="day">Gün</label>
            <select name="day" class="form-control">
                @foreach(Config::get('variable.days') as $k=>$val)
                    <option value="{{$k}}">{{$val}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="hour">Saat</label>
            <input type="text" name="hour" class="form-control" id="hour" placeholder="12:00">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
@stop