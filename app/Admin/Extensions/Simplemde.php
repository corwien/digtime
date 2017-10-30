<?php

namespace App\Admin\Extensions;

use Encore\Admin\Form\Field;

class Simplemde extends Field
{
    protected $view = 'admin::form.editor';

    protected static $css = [
        '/packages/admin/simplemde/dist/simplemde.min.css',
    ];

    protected static $js = [
        '/packages/admin/simplemde/dist/simplemde.min.js',
    ];

    public function render()
    {
        $unique_id = date("YmdHi").rand(10000, 99999);
        $this->script = <<<EOT

 var simplemde = new SimpleMDE({
               autofocus: true,
                autosave: {
                    enabled: true,
                    delay: 5000,
                    unique_id: "$unique_id",
                },
                spellChecker: false,
            });

EOT;
        return parent::render();

    }
}
