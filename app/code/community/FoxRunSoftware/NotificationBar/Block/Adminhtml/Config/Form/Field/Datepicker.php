<?php
/**
 * Datepicker adminhtml configuration control 'model' based on the 
 * Mage_Adminhtml_Block_Report_Config_Form_Field_YtdStart control.
 * 
 * Use this control to add a Magento configuration Year Month Day selector, 
 * configured in a system.xml as follows:
 * 
 * <frontend_type>select</frontend_type>
 * <frontend_model>notificationbar/adminhtml_config_form_field_datepicker</frontend_model>
 *
 * @author Justin Stern (www.foxrunsoftware.net)
 * @copyright  Copyright (c) 2012 All Rights Reserved, http://www.foxrunsoftware.net
 * @license    FoxRunSoftware License Agreement
 * 
 * THIS CODE AND INFORMATION ARE PROVIDED "AS IS" WITHOUT WARRANTY OF ANY 
 * KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND/OR FITNESS FOR A
 * PARTICULAR PURPOSE.
 * 
 * @category    FoxRunSoftware
 * @package     FoxRunSoftware_NotificationBar
 */
class FoxRunSoftware_NotificationBar_Block_Adminhtml_Config_Form_Field_Datepicker extends Mage_Adminhtml_Block_System_Config_Form_Field
{

    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $_years = array(null => "Year");
        for($i = 0, $y = (int)date("Y"); $i < 5; $i++, $y++) {
            $_years[$y] = $y;
        }
        
        $_months = array(null => "Month");
        for ($i = 1; $i <= 12; $i++) {
            $_months[$i] = Mage::app()->getLocale()
                ->date(mktime(null,null,null,$i))
                ->get(Zend_date::MONTH_NAME);
        }

        $_days = array(null => "Day");
        for ($i = 1; $i <= 31; $i++) {
            $_days[$i] = $i < 10 ? '0'.$i : $i;
        }

        if ($element->getValue()) {
            $values = explode(',', $element->getValue());
        } else {
            $values = array();
        }

        $element->setName($element->getName() . '[]');

        $_yearsHtml = $element->setStyle('width:75px;')
            ->setValues($_years)
            ->setValue(isset($values[0]) ? $values[0] : null)
            ->getElementHtml();

        $_monthsHtml = $element->setStyle('width:100px;')
            ->setValues($_months)
            ->setValue(isset($values[1]) ? $values[1] : null)
            ->getElementHtml();

        $_daysHtml = $element->setStyle('width:50px;')
            ->setValues($_days)
            ->setValue(isset($values[2]) ? $values[2] : null)
            ->getElementHtml();

        return sprintf('%s %s %s', $_yearsHtml, $_monthsHtml, $_daysHtml);
    }
}