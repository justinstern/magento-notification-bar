<?php
/**
 * Notifications block
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
class FoxRunSoftware_NotificationBar_Block_Html_Notifications extends Mage_Core_Block_Template
{
    
    const XML_PATH_NOTIFICATIONBAR_DISPLAY       = 'design/notificationbar/display';
    const XML_PATH_NOTIFICATIONBAR_CONTENT       = 'design/notificationbar/content';
    const XML_PATH_NOTIFICATIONBAR_CLEAR_CONTROL = 'design/notificationbar/clearcontrol';
    const XML_PATH_NOTIFICATIONBAR_IDENTIFIER    = 'design/notificationbar/identifier';
    const XML_PATH_NOTIFICATIONBAR_FIXED         = 'design/notificationbar/fixed';
    const XML_PATH_NOTIFICATIONBAR_START_DATE    = 'design/notificationbar/start_date';
    const XML_PATH_NOTIFICATIONBAR_END_DATE      = 'design/notificationbar/end_date';
    const XML_PATH_NOTIFICATIONBAR_CLEAR_LIFETIME    = 'design/notificationbar/clear_lifetime';
    
    /**
     * Check if the notifications bar should be displayed
     *
     * @return boolean
     */
    public function displayNotifications()
    {
        // notification bar enabled
        // AND bar is either not cleared OR bar is not allowed to be cleared
        // AND after start date
        // AND before end date
        return Mage::getStoreConfig(self::XML_PATH_NOTIFICATIONBAR_DISPLAY) && 
               $this->_hasNotificationContent() &&
               (!$this->isNotificationCleared() || !$this->allowClearControl()) &&
               $this->_afterStartDate() &&
               $this->_beforeEndDate();
    }
    
    /**
     * Fetches the notification bar content
     * 
     * @return string
     */
    public function getNotificationContent()
    {
        $content = Mage::getStoreConfig(self::XML_PATH_NOTIFICATIONBAR_CONTENT);
        
        // tentatively translate Template Tags, using the CMS helper (tried with catalog helper but no-go)
        $helper = Mage::helper('cms');
        if($helper) {
            $processor = $helper->getBlockTemplateProcessor();
            if($processor) {
                $content = $processor->filter($content); 
            }
        }
        
        return $content;
    }
    
    /**
     * Returns true if there is notification content to display
     * 
     * @return boolean
     */
    protected function _hasNotificationContent() {
        $content = $this->getNotificationContent();
        return !empty($content);
    }
    
    /**
     * Returns true if the notification bar should be able to be closed/cleared
     * 
     * @return boolean
     */
    public function allowClearControl() {
        return Mage::getStoreConfig(self::XML_PATH_NOTIFICATIONBAR_CLEAR_CONTROL);
    }
    
    /**
     * Returns the notification bar cookie name, which includes the current
     * notification bar identifier, if any.
     * 
     * @return string
     */
    public function getNotificationClearCookieName() {
        return 'clear_notification_bar_'.preg_replace("/\W/", '', Mage::getStoreConfig(self::XML_PATH_NOTIFICATIONBAR_IDENTIFIER));
    }
    
    /**
     * Returns true if the currently identified notification bar has been cleared
     * by the client, false otherwise
     * 
     * @return boolean
     */
    public function isNotificationCleared() {
        return Mage::getSingleton('core/cookie')->get($this->getNotificationClearCookieName());
    }

    /**
     * Returns the setttings for clear cookie lifetime
     * @return mixed
     */
    public function getNotificationClearLifetime() {
        return Mage::getStoreConfig(self::XML_PATH_NOTIFICATIONBAR_CLEAR_LIFETIME);
    }
    
    /**
     * Return true if the notification bar should be fixed in place at the top
     * 
     * @return boolean
     */
    public function isFixed() {
        return Mage::getStoreConfig(self::XML_PATH_NOTIFICATIONBAR_FIXED);
    }
    
    /**
     * Returns true if the notification bar should be displayed based on the
     * start_date.
     * 
     * @return boolean true if either no start date is defined, or the current
     *         date is after the start date, false otherwise.
     */
    protected function _afterStartDate() {
        list($year,$month,$day) = explode(',',Mage::getStoreConfig(self::XML_PATH_NOTIFICATIONBAR_START_DATE));
        $str = null;
        if($year) {
            $str .= $year;
            if($month) {
                $str .= "-".$month;
                if($day) $str .= "-".$day;
            }
            
            return time() >= strtotime($str);  // current time is after the start date?
        }
        return true;  // no start date set, so the notification bar is always on
    }

    /**
     * Returns true if the notification bar should be displayed based on the
     * end_date.
     * 
     * @return boolean true if either no end date is defined, or the current
     *         date is after the start date, false otherwise.
     */
    protected function _beforeEndDate() {
        list($year,$month,$day) = explode(',',Mage::getStoreConfig(self::XML_PATH_NOTIFICATIONBAR_END_DATE));
        $str = null;
        if($year) {
            $str .= $year;
            if($month) {
                $str .= "-".$month;
                if($day) $str .= "-".$day;
            }
            
            return time() < strtotime($str);  // current time is before end date?
        }
        return true;  // no end date set, so the notification bar is always on
    }
}
