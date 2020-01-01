<?php

namespace Emizentech\DynamicGridColumn\Ui\Component\Listing\Column\Customer;

class Options implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'Customer', 'label' => __('Customer')],
            ['value' => 'Guest', 'label' => __('Guest')]
        ];
    }
}
