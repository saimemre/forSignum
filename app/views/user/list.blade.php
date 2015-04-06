@extends('master')
@section('content')

    <h1>Kullanıcılar</h1>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Kod</th>
                <th>Kullanıcı Adı</th>
                <th>Email</th>
                <th>Kullanıcı Tipi</th>
                <th>İşlem</th>
            </tr>
        </thead>
        @if(isset($users))
        <tbody>
            @foreach($users as $k=>$val)
                <?php $groups = $val->getGroups();?>
                <tr>
                    <td>{{$val->id}}</td>
                    <td>{{$val->code}}</td>
                    <td>{{$val->first_name.' '.$val->last_name}}</td>
                    <td>{{$val->email}}</td>
                    <td>{{$groups[0]->name}}</td>
                    <td>{{link_to('user/update/'.$val->id, 'Düzenle', $attributes = array(), $secure = null);}}</td>
                </tr>
            @endforeach
        </tbody>
        @endif

    </table>
@stop