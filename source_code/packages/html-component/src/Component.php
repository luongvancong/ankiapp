<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 23/02/19
 * Time: 16:00
 */

namespace BlackBear\HtmlComponent;


class Component
{
    public function input($mode = 'text', $name, $value = "", array $attr = []) {
        $attr['value'] = $value ? $value : old($name, array_get($attr, 'value', ''));
        $attr['name'] = $name;

        switch ($mode) {
            case 'text':
                $template = '<input type="text" %s />'.$this->error($name);
                return sprintf($template, $this->makeAttributes($attr));
            case 'password':
                $template = '<input type="password" %s />'.$this->error($name);
                return sprintf($template, $this->makeAttributes($attr));
            case 'textarea':
            case 'editor':
                $value = array_get($attr, 'value', '');
                if(array_key_exists('value', $attr)) unset($attr['value']);
                $template = '<textarea %s>%s</textarea>'.$this->error($name);
                if($mode === 'editor') {
                    return sprintf($template, $this->makeAttributes($attr, true, 'ckeditor'), $value);
                }
                return sprintf($template, $this->makeAttributes($attr), $value);
        }
    }

    public function text($name, $value = "", array $attr = []) {
        return $this->input('text', $name, $value, $attr);
    }

    public function textarea($name, $value = "", array $attr = []) {
        return $this->input('textarea', $name, $value, $attr);
    }

    public function editor($name, $value = "", array $attr = []) {
        return $this->input('editor', $name, $value, $attr);
    }

    public function checkbox($label, $name, $defaultValue = "", $value = "", array $attr = []) {
        $attr['value'] = $defaultValue;
        $attr['name'] = $name;
        if($defaultValue == $value) {
            $attr['checked'] = 'checked';
        }
        $template = '<label><input type="checkbox" %s /> %s</label>';
        return sprintf($template, $this->makeAttributes($attr, false), $label);
    }

    public function radio($label, $name, $defaultValue = "", $value = "", array $attr = []) {
        $attr['value'] = $defaultValue;
        $attr['name'] = $name;
        if($defaultValue == $value) {
            $attr['checked'] = 'checked';
        }
        $template = '<label><input type="radio" %s /> %s</label>';
        return sprintf($template, $this->makeAttributes($attr, false), $label);
    }

    public function select($name, array $data, $value = "", array $attr = [], array $attrOption = []) {
        $attr['value'] = $value ? $value : old($name, array_get($attr, 'value', ''));
        $attr['name'] = $name;
        $template = "<select %s>%s</select>".$this->error($name);
        $optionTemplate = "<option %s>%s</option>";
        $arrHtmlOption = [];
        foreach($data as $k => $v) {
            $attrOption['value'] = $k;
            if($value == $k) {
                $attrOption['selected'] = 'selected';
            } else {
                if(array_key_exists('selected', $attrOption)) unset($attrOption['selected']);
            }
            $arrHtmlOption[] = sprintf($optionTemplate, $this->makeAttributes($attrOption, false), $v);
        }

        return sprintf($template, $this->makeAttributes($attr), implode('', $arrHtmlOption));
    }

    public function selectMulti($name, array $data, array $value = [], array $attr = [], array $attrOption = []) {
        $attr['name'] = $name;
        $attr['multiple'] = 'multiple';
        $template = "<select %s>%s</select>".$this->error(str_replace('[]', '', $name));
        $optionTemplate = "<option %s>%s</option>";
        $arrHtmlOption = [];
        foreach($data as $k => $v) {
            $attrOption['value'] = $k;
            if(in_array($k, $value)) {
                $attrOption['selected'] = 'selected';
            } else {
                if(array_key_exists('selected', $attrOption)) unset($attrOption['selected']);
            }
            $arrHtmlOption[] = sprintf($optionTemplate, $this->makeAttributes($attrOption, false), $v);
        }

        return sprintf($template, $this->makeAttributes($attr), implode('', $arrHtmlOption));
    }

    public function selectGroup($name, array $data, $value = "", array $attr = [], array $attrOption = []) {
        $attr['value'] = $value ? $value : old($name, array_get($attr, 'value', ''));
        $attr['name'] = $name;
        $template = "<select %s>%s</select>".$this->error($name);
        $optionTemplate = "<option %s>%s</option>";
        $arrHtmlOption = [];
        foreach($data as $group => $list) {
            $arrHtmlOption[] = "<optgroup label='".$group."'>";
            foreach($list as $k => $v) {
                $attrOption['value'] = $k;
                if($value == $k) {
                    $attrOption['selected'] = 'selected';
                } else {
                    if(array_key_exists('selected', $attrOption)) unset($attrOption['selected']);
                }
                $arrHtmlOption[] = sprintf($optionTemplate, $this->makeAttributes($attrOption, false), $v);
            }
            $arrHtmlOption[] = "</optgroup>";
        }

        return sprintf($template, $this->makeAttributes($attr), implode('', $arrHtmlOption));
    }

    public function error($key) {
        return alertError($key);
    }

    public function space($width = 10) {
        return "<span style='display: inline-block; width: {$width}px'></span>";
    }

    protected function makeAttributes(array $attr, $includeDefaultClass = true, $defaultClass = "") {
        if($includeDefaultClass) {
            $defaultClass = $defaultClass ? $defaultClass . ' form-control' : 'form-control';
        }
        if(!array_key_exists('class', $attr)) {
            $attr['class'] = $defaultClass;
        } else {
            $attr['class'] = $defaultClass.' '.$attr['class'];
        }
        return makeAttributes($attr);
    }
}