<div class="area-input">
    <label for={{$name ?? ''}}>
        {{$label ?? ''}}
        <span class="span-required">{{empty($required)? '': '*'}}</span>
    </label>
    <input
        type="{{empty($type) ? 'text': $type}}"
        name="{{$name ?? ''}}"
        id="{{$name ?? ''}}"
        class="input @error($name) is-invalid @enderror"
        placeholder="{{$placeholder ?? ''}}"
        {{empty($required)? '': 'required'}}
        value="{{ isset($params)?$params->date:old($name) }}"
    >
</div>
