<?php

namespace App\Helper;

class Asset {

    protected $version = '1.0';

    protected $styles = [];

    protected $scripts = [];

    public function __construct($version = null)
    {
        $this->version = $version;
    }

    public function addStyle($url, $version = null)
    {
        $this->styles[] = [
            'url' => $url,
            'version' => $version ? $version : $this->getVersion()
        ];
    }

    public function addScript($url, $version = null)
    {
        $this->scripts[] = [
            'url' => $url,
            'version' => $version ? $version : $this->getVersion()
        ];
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function setVersion($version)
    {
        $this->version = $version;
    }

    public function render()
    {
        $styles = [];
        foreach($this->styles as $value) {
            $styles[] = '<link rel="stylesheet" type="text/css" href="'.$value['url'].'?v='.$value['version'].'">';
        }

        $scripts = [];
        foreach($this->scripts as $value) {
            $scripts[] = '<script src="'.$value['url'].'?v='.$value['version'].'"></script>';
        }

        return implode('', $styles).implode('', $scripts);
    }

}