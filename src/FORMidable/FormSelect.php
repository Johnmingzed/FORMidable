<?php

namespace FORMidable;

/**
 * Class FormSelect
 *
 * This class represents a select dropdown form element.
 */
class FormSelect extends FormElement
{
    /**
     * FormSelect constructor.
     *
     * @param array       $attributes An associative array of attributes to set for the select element.
     * @param string|null $label      The label text for the select element. (optional)
     */
    public function __construct(array $attributes, ?string $label = null)
    {
        $this->setType('select');

        foreach ($attributes as $k => $v) {
            $this->setAttribute($k, $v);
        }
    }

    /**
     * FormSelect setOptions
     *
     * @param array $options An array of array attributes to set <option> for the select element.
     * Each individual option must be an array following the format['name', ('value'), ('selected')] 
     * @return void
     */
    public function setOptions(array $options)
    {
        $this->options=[];//reset options
        foreach($options as $opt){
            $name=$opt[0];
            @$value=$opt[1];
            if(!$value)$value=$name;
            @$sel=(bool)$opt[2];//selected?
            $this->options[]=['name'=>$name,'value'=>$value,'selected'=>$sel];
        }
        return $this;
    }
}
