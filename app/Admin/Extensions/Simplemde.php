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
        $this->script = <<<EOT

 var simplemde = new SimpleMDE({
               autofocus: true,
                autosave: {
                    enabled: true,
                    delay: 5000,
                    unique_id: "editor01",
                },
                spellChecker: false,
            });

EOT;
        return parent::render();

    }
}
