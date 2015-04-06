@extends('master')
@section('content')
    @if(isset($message))<label class="error">{{$message}}</label>@endif
    <h1>Sınıf ve Kat Formu</h1>
    <form action="" method="post" name="createForm">
        <div class="form-group">
            <label for="code">Kod</label>
            <input type="text" name="code" class="form-control" id="code" placeholder="Kod" value="{{$classroom->code}}">
        </div>
        <div class="form-group">
            <label for="name">İsim</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Ders Adı" value="{{$classroom->name}}">
        </div>
        <div class="form-group">
            <label for="type">Tip</label>
            <select name="type" class="form-control type_select">
                <option {{ $classroom->type == 0 ? 'selected="selected"' : '' }} value="0">Kat</option>
                <option {{ $classroom->type == 1 ? 'selected="selected"' : '' }} value="1">Sınıf</option>
            </select>
        </div>
        <?php $parents = Classroom::where('parentid',0)->get();?>
        @if(isset($parents))
            <div class="form-group parentid_select" @if($classroom->type == 0)style="display:none;"@endif>
                <label for="parentid">Kat</label>
                <select name="parentid" class="form-control">
                    @foreach($parents as $k=>$val)
                        <option {{ $val->id == $classroom->parentid ? 'selected="selected"' : '' }} value="{{$val->id}}">{{$val->name}}</option>
                    @endforeach
                </select>
            </div>
        @endif
        <button type="submit" class="btn btn-default">Submit</button>
    </form>

    <script type="text/javascript">
        $( ".type_select" ).change(function() {
            if($(this).val() == 1){
                $(".parentid_select").show();
            }else{
                $(".parentid_select").hide();
            }
        });
    </script>
@stop