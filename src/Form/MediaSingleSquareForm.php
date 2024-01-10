<?php
namespace PageBlocksRM\Form;

use Laminas\Form\Element;
use Laminas\Form\Form;

class MediaSingleSquareForm extends Form
{
    public function init()
    {
        $this->add([
            'name' => 'o:block[__blockIndex__][o:data][html]',
            'type' => Element\Textarea::class,
            'attributes' => [
                'class' => 'block-html full wysiwyg'
            ]
        ]);
    }
}
?>