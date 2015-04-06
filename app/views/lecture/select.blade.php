@extends('master')
@section('content')
    @if(isset($message))<label class="error">{{$message}}</label>@endif

    <h1>Ders Seçme Formu</h1>
    <form action="" method="post" name="createForm">
        <div class="form-group">
            <label for="code">Zorunlu Dersler</label>
            <?php $isMandatory = \Lecture::where('ismandatory',1)->get();?>
            <div style="margin-left: 50px;">
                @foreach($isMandatory as $k=>$val)
                    <label for="{{$val->id}}">{{$val->name}}</label> <input type="checkbox" value="{{$val->id}}" name="ismandatory[]" id="{{$val->id}}" class="ismandatory" {{ $val->getLog() ? 'checked="checked"' : '' }} ><br />
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <label for="code">Seçmeli Dersler</label>
            <?php $isMandatory = \Lecture::where('ismandatory',0)->get();?>
            <div style="margin-left: 50px;">
                @foreach($isMandatory as $k=>$val)
                    <label for="not_{{$val->id}}">{{$val->name}}</label> <input type="checkbox" value="{{$val->id}}" name="ismandatoryNot[]" id="not_{{$val->id}}" class="ismandatoryNot" {{ $val->getLog() ? 'checked="checked"' : '' }} ><br />
                @endforeach
            </div>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>

    <script type="text/javascript">
        var countChecked = function(className, total) {
            var n = $( 'input.'+className+':checked' ).length;

            if(n >= total){
                $('input.'+className+':checkbox:not(:checked)').attr("disabled", true);
            }else{
                $('input.'+className+':checkbox:not(:checked)').attr("disabled", false);
            }
        };


        countChecked('ismandatory',3);
        countChecked('ismandatoryNot',2);

        $( ".ismandatory" ).on( "click", function(){
            countChecked('ismandatory',3);
        });

        $( ".ismandatoryNot" ).on( "click", function(){
            countChecked('ismandatoryNot',2);
        });
    </script>

@stop