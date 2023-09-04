<?php
namespace Techvoot\Customer\Block\Customer\Widget;

use Magento\Customer\Model\AddressFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Landmarkin extends Template
{
    /**
     * @var AddressFactory
     */
    protected $_addressFactory;

    /**
     * Constructor Initialize
     *
     * @param Context $context
     * @param AddressFactory $addressFactory
     * @param array $data
     * @return void
     */
    public function __construct(
        Context $context,
        AddressFactory $addressFactory,
        array $data = []
    ) {
        $this->_addressFactory = $addressFactory;
        parent::__construct($context, $data);
    }

    /**
     * Set custom template
     *
     * @return void
     */
    public function _construct()
    {
        parent::_construct();

        // default template location
        $this->setTemplate('Techvoot_Customer::widget/landmarkno.phtml');
    }

    /**
     * Return landmarkin number from address
     *
     * @return string|null
     */
    public function getValue()
    {
        $addressId = $this->getRequest()->getParam('id');
        if ($addressId) {
            $addressCollection = $this->_addressFactory->create()->load($addressId);
            $landmarkin = $addressCollection->getLandmark();
            if ($landmarkin) {
                return $landmarkin;
            }
        }
        return null;
    }
}