<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 17/03/19
 * Time: 09:39
 */

namespace BlackBear\HtmlComponent;


class FormItem
{
    private $label;
    private $content;
    private $required;
    private $labelWrapperClass;
    private $contentWrapperClass;
    private $containerClass;

    public function __construct(array $options)
    {
        $defaultLabelWrapperClass = "col-xs-12 col-sm-2";
        $defaultContentWrapperClass = "col-xs-12 col-sm-10";
        $this->label = array_get($options, 'label');
        $this->content = array_get($options, 'content');
        $this->required = array_get($options, 'required');
        $this->labelWrapperClass = array_get($options, 'label_wrapper_class', $defaultLabelWrapperClass);
        $this->contentWrapperClass = array_get($options, 'content_wrapper_class', $defaultContentWrapperClass);
        $this->containerClass = array_get($options, 'container_class');
    }

    public function render()
    {
        $label = $this->getLabel();
        $content = $this->getContent();
        $required = $this->getRequired();
        $labelWrapperClass = $this->getLabelWrapperClass();
        $contentWrapperClass = $this->getContentWrapperClass();
        $containerClass = $this->getContainerClass();
        $htmlRequired = $required ? "<b class='text-danger'>*</b>" : "";

        $template = "<div class='form-group ".$containerClass."'>
                <div class='".$labelWrapperClass."'><div class='control-label'>%s%s</div></div>
                <div class='".$contentWrapperClass."'>%s</div>
            </div>";

        return sprintf($template, $label, $htmlRequired, $content);
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getRequired()
    {
        return $this->required;
    }

    /**
     * @param mixed $required
     */
    public function setRequired($required)
    {
        $this->required = $required;
    }

    /**
     * @return mixed
     */
    public function getLabelWrapperClass()
    {
        return $this->labelWrapperClass;
    }

    /**
     * @param mixed $labelWrapperClass
     */
    public function setLabelWrapperClass($labelWrapperClass)
    {
        $this->labelWrapperClass = $labelWrapperClass;
    }

    /**
     * @return mixed
     */
    public function getContentWrapperClass()
    {
        return $this->contentWrapperClass;
    }

    /**
     * @param mixed $contentWrapperClass
     */
    public function setContentWrapperClass($contentWrapperClass)
    {
        $this->contentWrapperClass = $contentWrapperClass;
    }

    /**
     * @return mixed
     */
    public function getContainerClass()
    {
        return $this->containerClass;
    }

    /**
     * @param mixed $containerClass
     */
    public function setContainerClass($containerClass)
    {
        $this->containerClass = $containerClass;
    }
}