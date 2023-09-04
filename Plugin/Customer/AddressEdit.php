<?php
namespace Techvoot\Customer\Plugin\Customer;

use Magento\Framework\View\LayoutInterface;
use Techvoot\Customer\Block\Customer\AddressEdit as CustomerAddress;

class AddressEdit
{
    /**
     * @var LayoutInterface
     */
    private $layout;

    /**
     * Constructor Initialize
     *
     * @param LayoutInterface $layout
     * @return void
     */
    public function __construct(
        LayoutInterface $layout
    ) {
        $this->layout = $layout;
    }

    /**
     * Append landmark field
     *
     * @param \Magento\Customer\Block\Address\Edit $edit
     * @param string $result
     * @return mixed|string
     */
    public function afterGetNameBlockHtml(
        \Magento\Customer\Block\Address\Edit $edit,
        $result
    ) {
        $customBlock =  $this->layout->createBlock(
            CustomerAddress::class,
            'wklandmark_address_edit_landmarkin'
        );
        
        return $result.$customBlock->toHtml();
    }
}