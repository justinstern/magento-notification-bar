<?php
/**
 * Styles block
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
class FoxRunSoftware_NotificationBar_Block_Html_Styles extends Mage_Core_Block_Template
{
    const XML_PATH_NOTIFICATIONBAR_DEFAULT_STYLE = 'design/notificationbar/default_style';
    const XML_NOTIFICATIONBAR_BLOCK_NAME         = 'notificationbar_notifications';
    
    /**
     * Return true if the default styling should be used
     *
     * @return boolean
     */
    public function useDefaultStyles()
    {
        return Mage::getStoreConfig(self::XML_PATH_NOTIFICATIONBAR_DEFAULT_STYLE);
    }
    
    /**
     * Return true if the notification bar should be fixed in place at the top
     * 
     * @return boolean
     */
    public function isFixed() {
        return $this->_getNotificationBlock()->isFixed();
    }
    
    /**
     * Check if the notifications bar should be displayed
     *
     * @return boolean
     */
    public function displayNotifications()
    {
        return $this->_getNotificationBlock()->displayNotifications();
    }
    
    /**
     * Return the notification bar block object, which is used to query the
     * state of the notification bar configurations
     * 
     * @return FoxRunSoftware_NotificationBar_Block_Html_Notifications
     */
    protected function _getNotificationBlock() {
        return $this->getLayout()->getBlock(self::XML_NOTIFICATIONBAR_BLOCK_NAME);
    }
}
