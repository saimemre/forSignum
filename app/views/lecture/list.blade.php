@extends('master')
@section('content')

    <h1>Dersler</h1>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Kod</th>
                <th>Ders Adı</th>
                <th>Zorunlu ?</th>
                <th>Gün</th>
                <th>Saat</th>
                <th>İşlem</th>
            </tr>
        </thead>
        @if(isset($lectures))
        <tbody>
            @foreach($lectures as $k=>$val)
                <tr>
                    <td>{{$val->id}}</td>
                    <td>{{$val->code}}</td>
                    <td>{{$val->name}}</td>
                    <td>{{$val->getIsmandatory()}}</td>
                    <td>{{$val->getDay()}}</td>
                    <td>{{$val->hour}}</td>
                    <td>{{link_to('lecture/update/'.$val->id, 'Düzenle', $attributes = array(), $secure = null);}}</td>
                </tr>
            @endforeach
        </tbody>
        @endif

    </table>
@stop