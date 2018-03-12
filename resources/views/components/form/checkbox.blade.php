<div class="form-check">
    {{ Form::checkbox($name, $value, $checked, array_merge(['class' => 'form-check-input', 'id' => $name], $attributes)) }}
    @if($label)
        {{ Form::label($label, null, ['class' => 'form-check-label', 'for' => $name]) }}
    @endif
</div>