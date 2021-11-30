<?php

namespace AHT\CustomCheckout\Plugin;

class PluginHoan
{
    public function beforeHoantest(\AHT\CustomCheckout\Block\Test $subject, $status)
    {
        return ['before ' . $status];
    }

    /* public function afterHoantest(\AHT\CustomCheckout\Block\Test $subject, $result)
    {
        return 'after';
    } */

    public function aroundHoantest(\AHT\CustomCheckout\Block\Test $subject, $proceed, $status)
    {
        $status = 'around';
        $returnValue = $proceed($status);
        return $returnValue;
    }
}
