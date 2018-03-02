@if($data)
    <div class="form-group">
        @if($label)
            {{ Form::label($label, null, ['class' => 'control-label']) }}
        @endif
        {{ Form::select($name, $data, $default, array_merge(['class' => 'form-control'], $attributes)) }}
    </div>
@endif