@extends('master')
@section('content')

    <h1>Dersler</h1>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Kod</th>
                <th>Ders Adı</th>
                <th>Tip</th>
                <th>Kat</th>
                <th>İşlem</th>
            </tr>
        </thead>
        @if(isset($classrooms))
        <tbody>
            @foreach($classrooms as $k=>$val)
                <tr>
                    <td>{{$val->id}}</td>
                    <td>{{$val->code}}</td>
                    <td>{{$val->name}}</td>
                    <td>{{$val->getType()}}</td>
                    <td>@if($val->type==1) {{Classroom::where('id',$val->parentid)->first()->name}} @endif</td>
                    <td>{{link_to('classroom/update/'.$val->id, 'Düzenle', $attributes = array(), $secure = null);}}</td>
                </tr>
            @endforeach
        </tbody>
        @endif

    </table>
@stop