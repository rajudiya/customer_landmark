<?php 
declare(strict_types=1);

/**
 * Patch to create Customer Address Attribute
 *
 * Creates landmark custom address attribute
 *
 * @author Rohan Ajudiya
 * @package Techvoot_Customer
 */

namespace Techvoot\Customer\Setup\Patch\Data;

use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
 * Class AddressAttribute
 */
class AddressAttribute implements DataPatchInterface
{
    /**
     * @var Config
     */
    private $eavConfig;

    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * AddressAttribute constructor.
     *
     * @param Config              $eavConfig
     * @param EavSetupFactory     $eavSetupFactory
     */
    public function __construct(
        Config $eavConfig,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->eavConfig = $eavConfig;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        
        $eavSetup = $this->eavSetupFactory->create();

        // delete
        $eavSetup->removeAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            'landmark'
        );
        
        $eavSetup->removeAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            'nickname'
        );
        // delete
        
        $eavSetup->addAttribute('customer_address', 'landmark', [
            'type'             => 'varchar',
            'input'            => 'text',
            'label'            => 'Landmark',
            'visible'          => true,
            'required'         => false,
            'user_defined'     => true,
            'system'           => false,
            'group'            => 'General',
            'global'           => true,
            'visible_on_front' => true,
        ]);

        $customAttribute = $this->eavConfig->getAttribute('customer_address', 'landmark');

        $customAttribute->setData(
            'used_in_forms',
            ['adminhtml_customer',
             'adminhtml_checkout',
             'adminhtml_customer_address',
             'customer_account_edit',
             'customer_address_edit',
             'customer_register_address']
        );
        $customAttribute->save();
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases(): array
    {
        return [];
    }
}