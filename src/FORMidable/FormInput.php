<?php

namespace FORMidable;

/**
 * Class FormInput
 *
 * This class represents an input form element.
 */
class FormInput extends FormElement
{
    /**
     * FormInput constructor.
     *
     * @param array       $attributes An associative array of attributes to set for the input element.
     * @param string|null $label      The label text for the input element. (optional)
     */
    public function __construct(array $attributes, ?string $label = null)
    {
        $this->setType('input');

        foreach ($attributes as $k => $v) {
            $this->setAttribute($k, $v);
        }
    }
}
