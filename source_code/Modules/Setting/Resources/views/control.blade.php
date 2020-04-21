@if($setting->type == 'text')
    <input type="text" name="setting[{{ $setting->key }}][value]" class="form-control" value="{{ old($setting->key, $setting->value) }}">
@elseif($setting->type == 'textarea')
    <textarea class="form-control" name="setting[{{ $setting->key }}][value]">{!! old($setting->key, $setting->value) !!}</textarea>
@elseif($setting->type == 'file')
    {!! gallery_init($setting->key, 'setting['.$setting->key.'][value]', old($setting->key, $setting->value)) !!}
@endif
<input type="hidden" name="setting[{{$setting->key}}][label]" value="{{ $setting->label }}">
<input type="hidden" name="setting[{{$setting->key}}][key]" value="{{ $setting->key }}">
<input type="hidden" name="setting[{{$setting->key}}][type]" value="{{ $setting->type }}">