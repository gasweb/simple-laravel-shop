<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;

class FormServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Form::component('fileUpload', 'components.form.file_upload', ['name', 'action', 'label' => null, 'attributes' => [], 'button_value', 'button_attributes' => []]);
        Form::component('hidden', 'components.form.hidden', ['name', 'value' => null, 'attributes']);
        Form::component('inputText', 'components.form.text', ['name', 'label' => null, 'value', 'attributes']);
        Form::component('formSelect', 'components.form.select', ['name', 'label' => null, 'data', 'default' => '', 'attributes']);
        Form::component('bsTextArea', 'components.form.textarea', ['name', 'value', 'attributes']);
        Form::component('inputSubmit', 'components.form.submit', ['value' => 'Submit', 'attributes']);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
