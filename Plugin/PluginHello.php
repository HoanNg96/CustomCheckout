<?php

namespace AHT\CustomCheckout\Plugin;

class PluginHello
{
    public function beforeHello(\AHT\CustomCheckout\Block\Index $subject, $name)
    {
        return ['My name is ' . $name];
    }

    /* public function afterHello(\AHT\CustomCheckout\Block\Index $subject, $result)
    {
        return $result . '- zzz';
    } */

    /* public function aroundHello(\AHT\CustomCheckout\Block\Index $subject, callable $proceed, $name)
    {
        $name = 'haha';
        $returnValue = $proceed($name);
        return $returnValue;
    } */
}
