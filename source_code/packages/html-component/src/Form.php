<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 23/02/19
 * Time: 18:35
 */

namespace BlackBear\HtmlComponent;

use BlackBear\HtmlComponent\Exception\WrongTypeFormItemException;

class Form
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var array
     */
    protected $items;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var string
     */
    protected $action;

    /**
     * @var string
     */
    protected $enctype;

    /**
     * @var array
     */
    protected $attrs;

    public function __construct(
        $type = 'horizontal',
        array $items = [],
        $method = "POST",
        $action = "",
        $enctype = "multipart/form-data",
        array $attrs = []
    ) {
        $attrs['method'] = $method;
        $attrs['action'] = $action;
        $attrs['enctype'] = $enctype;
        $this->type = $type;
        $this->items = $items;
        $this->method = $method;
        $this->action = $action;
        $this->enctype = $enctype;
        $this->attrs = $attrs;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param array $items
     */
    public function setItems($items)
    {
        $this->items = $items;
    }

    public function render() {
        $defaultLabelClass = "col-lg-3";
        $defaultContentClass = "col-lg-9";
        $defaultContainerClass = "";
        $formClass = "form form-horizontal";
        $items = $this->getItems();
        if($this->getType() === 'vertical') {
            $defaultLabelClass = 'col-xs-12';
            $defaultContentClass = 'col-xs-12';
            $defaultContainerClass = 'row';
            $formClass = "form";
        }

        $content = [];
        foreach ($items as $k => $item) {
            if(!$item instanceof FormItem) {
                throw new WrongTypeFormItemException("Item {$k} is not instance of FormItem");
            } else {
                $item->setContainerClass($defaultContainerClass);
                $item->setLabelWrapperClass($defaultLabelClass);
                $item->setContentWrapperClass($defaultContentClass);
                $content[] = $item->render();
            }
        }

        return "<form ".$this->makeAttributes($this->getAttrs(), $formClass).">".implode('', $content)."</form>";
    }

    protected function makeAttributes(array $attr, $defaultClass = "") {
        if(!array_key_exists('class', $attr)) {
            $attr['class'] = $defaultClass;
        } else {
            $attr['class'] = $defaultClass.' '.$attr['class'];
        }
        return makeAttributes($attr);
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param string $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return string
     */
    public function getEnctype()
    {
        return $this->enctype;
    }

    /**
     * @param string $enctype
     */
    public function setEnctype($enctype)
    {
        $this->enctype = $enctype;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return array
     */
    public function getAttrs()
    {
        return $this->attrs;
    }

    /**
     * @param array $attrs
     */
    public function setAttrs($attrs)
    {
        $this->attrs = $attrs;
    }
}