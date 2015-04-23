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
class MageProfis_SimpleAttributeOption_Model_Resource_Setup
extends Mage_Catalog_Model_Resource_Setup
{
    /**
     * Create Text Attribute
     * 
     * @param string $code
     * @param string $name
     * @return MageProfis_SimpleAttributeOption_Resource_Setup
     */
    public function addTextAttribute($code, $name)
    {
        $this->addAttribute(
            'catalog_product',
            $code,
            array(
                'label'                      => $name,
                'input'                      => 'text',
                'required'                   => false,
                'user_defined'               => true,
                'default'                    => '',
                'group'                      => 'General',
                'global'                     => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,
                'visible'                    => true,
                'filterable'                 => false,
                'searchable'                 => false,
                'comparable'                 => false,
                'visible_on_front'           => false,
                'visible_in_advanced_search' => false,
                'used_in_product_listing'    => false,
                'is_html_allowed_on_front'   => false,
            )
        );
        return $this;
    }

    /**
     * Create DropDown Attribute
     * 
     * @param string $code Attribute Code
     * @param string $name Attribute Label/Name
     * @return MageProfis_SimpleAttributeOption_Resource_Setup
     */
    public function addOptionAttribute($code, $name)
    {
        $this->addAttribute(
            'catalog_product',
            $code,
            array(
                'label'                     => $name,
                'input'                     => 'select',
                'type'                      => 'int',
                'required'                  => false,
                'user_defined'              => true,
                'default'                   => '',
                'group'                     => 'General',
                'global'                    => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_WEBSITE,                
                'frontend_class'            => '',
                'source'                    => 'eav/entity_attribute_source_table',
                'backend'                   => '',
                'frontend'                  => '',
                'visible'                    => true,
                'filterable'                 => false,
                'searchable'                 => false,
                'comparable'                 => false,
                'visible_on_front'           => false,
                'visible_in_advanced_search' => false,
                'used_in_product_listing'    => false,
                'is_html_allowed_on_front'   => false,
                'apply_to'                  => 'simple',
            )
        );
        return $this;
    }
}