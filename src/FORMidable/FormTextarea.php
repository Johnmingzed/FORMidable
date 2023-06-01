<?php

namespace FORMidable;

/**
 * Class FormTextarea
 *
 * This class represents a textarea form element.
 */
class FormTextarea extends FormElement
{
    /**
     * FormTextarea constructor.
     *
     * @param array       $attributes An associative array of attributes to set for the textarea element.
     * @param string|null $label      The label text for the textarea element. (optional)
     */
    public function __construct(array $attributes, ?string $label = null)
    {
        $this->setType('textarea');

        foreach ($attributes as $k => $v) {
            $this->setAttribute($k, $v);
        }
    }
}
