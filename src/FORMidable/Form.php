<?php

namespace FORMidable;

use FORMidable\FormElement;

/**
 * Class Form
 *
 * This class represents an HTML form. Default beahaviour is GET.
 * Use its set(Methods) to define main form attributes.
 * Use its add(Methods) to create various kind of fields.
 * 
 */
class Form
{
    /**
     * The HTTP method of the form.
     *
     * @var string
     */
    private string $method = 'GET';

    /**
     * The form action URL.
     *
     * @var string
     */
    private string $action = '';

    /**
     * The ID attribute of the form.
     *
     * @var string
     */
    private string $id = '';

    /**
     * The name attribute of the form.
     *
     * @var string
     */
    private string $name = '';

    /**
     * The enctype attribute of the form.
     *
     * @var string
     */
    private string $enctype = '';

    /**
     * The class attribute of the form.
     *
     * @var string
     */
    private string $class = '';

    /**
     * The legend text for the fieldset element.
     *
     * @var string
     */
    private string $legend = '';

    /**
     * The HTML code to be placed before the form element.
     *
     * @var string
     */
    private string $htmlBeforeElement = '';

    /**
     * The HTML code to be placed after the form element.
     *
     * @var string
     */
    private string $htmlAfterElement = '';

    /**
     * List of form elements.
     *
     * @var array
     */
    private $list = [];

    /**
     * Set the legend for the fieldset element.
     *
     * @param string $legend The legend text.
     * @return self
     */
    public function fieldset(string $legend): self
    {
        $this->legend = $legend;
        return $this;
    }

    /**
     * Set nesting for the form element.
     *
     * @param string $html The HTML code to be placed before the form element.
     * @return void
     */
    public function nest(string $html)
    {
        $this->htmlBeforeElement = $html;

        preg_match("/<([a-z]+)/i", $html, $o);

        if ($o[1]) {
            $this->htmlAfterElement = sprintf("</%s>", $o[1]);
        }
    }

    /**
     * Add an input form element.
     *
     * @param array  $attributes An associative array of attributes for the input element.
     * @param string $label      The label text for the input element. (optional)
     */
    public function addInput(array $attributes, string $label = '')
    {
        $el = new FormInput($attributes);

        $el->label($label);

        $this->list[] = $el;

        return $el;
    }

    /**
     * Add a textarea form element.
     *
     * @param array  $attributes An associative array of attributes for the textarea element.
     * @param string $label      The label text for the textarea element. (optional)
     */
    public function addTextarea(array $attributes, string $label = '')
    {
        $el = new FormTextarea($attributes);

        $el->label($label);

        $this->list[] = $el;

        return $el;
    }

    /**
     * Add a select form element.
     *
     * @param array  $attributes An associative array of attributes for the select element.
     * @param string $label      The label text for the select element. (optional)
     */
    public function addSelect(array $attributes, string $label = '')
    {
        $el = new FormSelect($attributes);

        $el->label($label);

        $this->list[] = $el;

        return $el;
    }


    /**
     * Generate the HTML code for the form.
     *
     * @return string The HTML code of the form.
     */
    public function toHtml(): string
    {
        $htm = '<form';

        if ($this->method) {
            $htm .= sprintf(' method="%s"', $this->method);
        }

        if ($this->action) {
            $htm .= sprintf(' action="%s"', $this->action);
        }

        if ($this->name) {
            $htm .= sprintf(' name="%s"', $this->name);
        }

        if ($this->id) {
            $htm .= sprintf(' id="%s"', $this->id);
        }

        if ($this->enctype) {
            $htm .= sprintf(' enctype="%s"', $this->enctype);
        }

        $htm .= '>';
        $htm .= "\n";

        if ($this->legend) {
            $htm .= '<fieldset>';
            $htm .= "\n";
            $htm .= '<legend>' . $this->legend . '</legend>';
            $htm .= "\n";
        }

        foreach ($this->list as $el) {
            $htm .= $this->htmlBeforeElement;
            $htm .= "\n";
            $htm .= $el->toHtml();
            $htm .= "\n";
            $htm .= $this->htmlAfterElement;
            $htm .= "\n";
        }

        if ($this->legend) {
            $htm .= '</fieldset>';
            $htm .= "\n";
        }

        $htm .= '</form>';
        $htm .= "\n";
        return $htm;
    }

    /**
     * Render the form by echoing the generated HTML code.
     */
    public function render()
    {
        echo $this->toHtml();
    }

    /**
     * Set the HTTP method of the form.
     *
     * @param string $method The HTTP method.
     * @return self
     */
    public function setMethod(string $method): self
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Set the action URL of the form.
     *
     * @param string $action The action URL.
     * @return self
     */
    public function setAction(string $action): self
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Set the ID attribute of the form.
     *
     * @param string $id The ID attribute.
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set the name attribute of the form.
     *
     * @param string $name The name attribute.
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set the class attribute of the form.
     *
     * @param string $class The class attribute.
     * @return self
     */
    public function setClass(string $class): self
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Set the enctype attribute of the form.
     *
     * @param string $enctype The enctype attribute.
     * @return self
     */
    public function setEnctype(string $enctype): self
    {
        $this->enctype = $enctype;

        return $this;
    }
}
