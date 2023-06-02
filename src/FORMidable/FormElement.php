<?php

namespace FORMidable;

/**
 * Abstract class FormElement
 *
 * This class serves as the base class for creating HTML form elements.
 */
abstract class FormElement
{
    /**
     * @var array $attributes An array to store the attributes of the form element.
     */
    private array $attributes = [];

    /**
     * @var string $type The type of the form element. The default value is "input".
     */
    private string $type = 'input';

    private string $beforeHtml = '';

    private string $afterHtml = '';

    private bool $labelAfter = false;

    /**
     * @var string $label The label text for the form element.
     */
    private string $label = '';

    /**
     * @var string $id The ID attribute of the form element. It is auto-detected if not explicitly set.
     */
    private string $id = ''; //autodetected

    /**
     * @var string $value The value attribute of the form element. It is auto-detected if not explicitly set.
     */
    private string $value = ''; //autodetected

    /**
     * @var array $options An array to store the options for select dropdowns.
     */
    protected array $options = [];

    /**
     * @var bool $orphan A flag to determine if the form element is an orphan (does not require a closing tag).
     *                   By default, it is set to true.
     */
    private bool $orphan = true;

    /**
     * FormElement constructor.
     *
     * @param string $type       The type of the form element. It defaults to 'input'.
     * @param array  $attributes An associative array of attributes to set for the form element.
     */
    public function __construct(string $type = 'input', array $attributes = [])
    {
        $this->type = $type;

        foreach ($attributes as $k => $v) {
            $this->setAttribute($k, $v);
        }
    }

    /**
     * Sets an attribute for the form element.
     *
     * @param string $name  The name of the attribute.
     * @param string $value The value of the attribute.
     *
     * @return $this
     */
    public function setAttribute(string $name, string $value)
    {
        $name = strip_tags($name);
        $value = strip_tags($value);

        if ($name == 'id') { //autodetected id
            $this->id = $value;
        }

        if ($name == 'value') { //autodetected value
            $this->value = $value;
        }

        $this->attributes[$name] = $value;

        return $this;
    }



    public function htmlBefore(string $html)
    {
        $this->beforeHtml = $html;
    }

    public function htmlAfter(string $html)
    {
        $this->afterHtml = $html;
    }


    public function labelAfter()
    {
        $this->labelAfter = true;
    }



    /**
     * Sets the label for the form element.
     *
     * @param string $label The label text.
     */
    public function label(string $label)
    {
        $this->label = $label;
    }

    /**
     * Generates the HTML markup for the form element and returns it as a string.
     *
     * @return string The HTML markup for the form element.
     */
    public function toHtml()
    {
        $htm = '';

        //(before)
        $htm .= $this->beforeHtml;

        //Print label if set
        if ($this->label && !$this->labelAfter) {
            $htm .= '<label for="' . $this->id . '">' . $this->label . '</label>';
            $htm .= "\n";
        }

        $htm .= '<' . $this->type;
        foreach ($this->attributes as $key => $value) {
            if ($value) {
                $htm .= sprintf(' %s="%s"', $key, $value);
            } else {
                $htm .= " $key";
            }
        }
        $htm .= '>';
        $htm .= "\n";

        if ($this->type == 'select') {
            foreach ($this->options as $option) {
                $selected = $option['selected'] ? 'selected' : '';
                $htm .= '<option value="' . $option['value'] . '" ' . $selected . '>';
                $htm .= $option['name'] . '</option>';
                $htm .= "\n";
            }
        }

        if ($this->type == 'textarea') {
            $htm .= $this->value;
        }

        if (!$this->orphan) {
            $htm .= '</' . $this->type . '>';
        }

        //Print label if set
        if ($this->label && $this->labelAfter) {
            $htm .= '<label for="' . $this->id . '">' . $this->label . '</label>';
            $htm .= "\n";
        }

        $htm .= $this->afterHtml;

        return $htm;
    }

    /**
     * Outputs the HTML markup for the form element.
     */
    public function render()
    {
        echo $this->toHtml();
    }

    /**
     * Sets the type of the form element.
     *
     * @param string $type The type of the form element.
     *
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        switch (strtolower($type)) {
            case 'select':
            case 'textarea':
                $this->orphan = false;
                break;
        }

        return $this;
    }
}
