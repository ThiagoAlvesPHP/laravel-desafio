<div class="area-input">
    <label for={{$name ?? ''}}>
        {{__($label) ?? ''}}
        <span class="span-required">{{empty($required)? '': '*'}}</span>
    </label>
    <select name="{{$name ?? ''}}" id="{{$name ?? ''}}" class="input @error($name) is-invalid @enderror" {{empty($required)? '': 'required'}}>
        @if (!isset($params))
            <option value="0" disabled selected>{{__('Select Option')}}</option>
        @endif

        @if (!empty($data))
            @foreach ($data as $item)
                @if (!isset($params))
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @else
                    @if ($type === "brand")
                        <option {{$params->brand_id == $item->id?'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
                    @endif
                    @if ($type === "model")
                        <option {{$params->model_id == $item->id?'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
                    @endif
                    @if ($type === "modelService")
                        <option {{$params->model_id == $item->model_id?'selected':''}} value="{{$item->id}}">{{$item->name}}</option>
                    @endif
                @endif
            @endforeach
        @endif
    </select>
</div>
