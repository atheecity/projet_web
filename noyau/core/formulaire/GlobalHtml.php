<?php

class GlobalHtml
{
    private $attributsGlobal = array(
                         'accesskey' => '',
                         'class' => '',
                         'contenteditable' => '',
                         'contextmenu' => '',
                         'dir' => '',
                         'draggable' => '',
                         'dropzone' => '',
                         'hidden' => '',
                         'id' => '',
                         'lang' => '',
                         'spellcheck' => '',
                         'style' => '',
                         'tabindex' => '',
                         'title' => '',
                         'translate' => ''
                        );

    private $formEvents = array(
                        'onblur' => '',
                        'onchange' => '',
                        'oncontextmenu' => '',
                        'onfocus' => '',
                        'onformchange' => '',
                        'onforminput' => '',
                        'oninput' => '',
                        'oninvalid' => '',
                        'onselect' => '',
                        'onsubmit' => ''
                        );
    
    public function getAttributsGlobal()
    {
        return $this->attributsGlobal;
    }
    
    public function getFormEvents()
    {
        return $this->formEvents;
    }
}