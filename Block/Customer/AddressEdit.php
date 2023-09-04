<?php
namespace Techvoot\Customer\Block\Customer;

use Magento\Framework\View\Element\Template;
use Techvoot\Customer\Block\Customer\Widget\Landmarkin;

class AddressEdit extends Template
{
    /**
     * To html
     *
     * @return string
     */
    protected function _toHtml()
    {
        $landmarkinWidgetBlock = $this->getLayout()->createBlock(Landmarkin::class);
        return $landmarkinWidgetBlock->toHtml();
    }
}