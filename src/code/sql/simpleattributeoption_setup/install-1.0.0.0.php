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
$installer = $this;
/* @var $installer MageProfis_SimpleAttributeOption_Model_Resource_Setup */
$installer->startSetup();

$observer = new MageProfis_SimpleAttributeOption_Model_Observer();

$installer->addTextAttribute($observer->getTextAttributeCode(), $observer->getTextAttributeName());
$installer->addOptionAttribute($observer->getOptionAttributeCode(), $observer->getOptionAttributeName());

$installer->endSetup();