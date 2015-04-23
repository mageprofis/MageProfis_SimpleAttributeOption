<?php
/**
  * MageProfis_SimpleAttributeOption
  *
  * @category  MageProfis
  * @package   MageProfis_SimpleAttributeOption
  * @author    Mathis Klooss <mathis@mage-profis.de>
  * @copyright 2015 Mage-Profis GmbH (http://www.mage-profis.de/). All rights served.
  * @license   https://github.com/mklooss/MageProfis_SimpleAttributeOption/blob/master/README.md
  */
class MageProfis_SimpleAttributeOption_Model_Observer
{
    protected $_text_attribute = 'create_varselect';
    protected $_text_attribute_name = 'Create Variant';
    protected $_option_attribute = 'varselect';
    protected $_option_attribute_name = 'Variant';

    /**
     * @mageEvent: catalog_product_save_before
     * @param Varien_Event_Observer $event
     */
    public function onBeforeProductSave(Varien_Event_Observer $event)
    {
        $_product = $event->getProduct();
        /* @var $_product Mage_Catalog_Model_Product */
        $_create_variante = $_product->getData($this->_text_attribute);
        if(!is_null($_create_variante) && strlen($_create_variante) > 0)
        {
            $option = $this->addAttributeValue($this->_option_attribute, $_create_variante);
            $_product->setData($this->_option_attribute, $option);
            $_product->setData($this->_text_attribute, null);
            unset($option);
        }
        unset($_create_variante);
    }

    /**
     * add Value to Dropdown Attribute
     * 
     * @param string $arg_attribute Attribute Code
     * @param string $arg_value Attribute Value as Text
     * @return boolean
     */
    protected function addAttributeValue($arg_attribute, $arg_value)
    {
        $attribute        = Mage::getModel('eav/entity_attribute');
        /* @var $attribute Mage_Eav_Model_Entity_Attribute */

        $attribute_code = $attribute->getIdByCode('catalog_product', $arg_attribute);
        $attribute->load($attribute_code);

        $options = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $arg_attribute)->getSource()->getAllOptions(false);
        foreach($options as $option)
        {
            if ($option['label'] == $arg_value)
            {
                return $option['value'];
            }
        }

        $value['option'] = array($arg_value);
        $result = array('value' => $value);
        $attribute->setData('option', $result);
        $attribute->save();

        Mage::app()->getCacheInstance()->cleanType('eav');
        Mage::getSingleton('catalog/product')->getResource()->unsetAttributes();
        Mage::getSingleton('eav/config')->clear();

        return $this->addAttributeValue($arg_attribute, $arg_value);
    }

    /**
     * get text Attribute Name
     * 
     * @return string
     */
    public function getTextAttributeName()
    {
        return $this->_text_attribute_name;
    }

    /**
     * get Text Attribute Code
     * 
     * @return string
     */
    public function getTextAttributeCode()
    {
        return $this->_text_attribute;
    }

    /**
     * get Option Attribute Name
     * 
     * @return string
     */
    public function getOptionAttributeName()
    {
        return $this->_option_attribute_name;
    }

    /**
     * get Option Attribute Code
     * 
     * @return string
     */
    public function getOptionAttributeCode()
    {
        return $this->_option_attribute;
    }
}