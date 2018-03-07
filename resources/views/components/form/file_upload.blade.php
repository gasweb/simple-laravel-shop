@if($action)
    <div>
        {!! Form::open(['action' => $action, 'method' => 'POST', 'files' => true]) !!}
        @if($label)
            {{ Form::label($label, null, ['class' => 'control-label']) }}
        @endif
        {{ Form::file($name, $attributes) }}
        {{ Form::inputSubmit($button_value, $button_attributes) }}
        {!! Form::close() !!}
    </div>
@endif