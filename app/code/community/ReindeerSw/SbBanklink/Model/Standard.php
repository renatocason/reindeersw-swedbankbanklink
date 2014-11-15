<?php
/**
 * @copyright Copyright (c) 2014 Reindeer Software (http://reindeersw.com)
 */
class ReindeerSw_SbBanklink_Model_Standard extends Mage_Payment_Model_Method_Abstract {
    protected $_code = 'reindeersw_sbbanklink';
    protected $_isInitializeNeeded = true;
    protected $_canUseInternal = false;
    protected $_canUseForMultishipping = false;
    protected $_infoBlockType = 'reindeersw_sbbanklink/payment_info';
    
    protected $_config;
    
    public function getConfig() {
        if($this -> _config == null)
            $this -> _config = Mage::getModel('reindeersw_sbbanklink/config');
        
        return $this -> _config;
    }
    
    public function getOrderPlaceRedirectUrl() {
        return Mage::getUrl('sbbanklink/standard/redirect', array('_secure' => true));
    }
    
    /**
     * Instantiate state and set it to state object
     * @param string $paymentAction
     * @param Varien_Object
     */
    public function initialize($paymentAction, $stateObject) {
        $stateObject -> setState(Mage_Sales_Model_Order::STATE_PENDING_PAYMENT);
        $stateObject -> setStatus('pending_payment');
        $stateObject -> setIsNotified(false);
    }
    
    public function getCheckoutFormFields() {
        $mac_helper = Mage::helper('reindeersw_sbbanklink/mac');
        $checkout = Mage::getSingleton('checkout/session');
        $orderIncrementId = $checkout -> getLastRealOrderId();
        $order = Mage::getModel('sales/order')
            -> loadByIncrementId($orderIncrementId);
        
        // Form fields
        $fields = array(
                'VK_SERVICE' => '1002',
                'VK_VERSION' => '008',
                'VK_SND_ID' => $this -> getConfig() -> getVkSndID(),
                'VK_STAMP' => $order -> getIncrementId(),
                'VK_AMOUNT' => number_format($order -> getGrandTotal(), 2),
                'VK_CURR' => $order -> getOrderCurrencyCode(),
                'VK_REF' => $order -> getIncrementId(),
                'VK_MSG' => $mac_helper -> __('Payment for order #%s', $order -> getIncrementId()),
                'VK_MAC' => '',
                'VK_RETURN' => Mage::getUrl('sbbanklink/standard/return', array('_secure' => true)),
            );
        
        // MAC Field
        // $fields['VK_MAC_PLAIN'] = $mac_helper -> Compose($fields);
        $fields['VK_MAC'] = $mac_helper -> Sign($mac_helper -> Compose($fields));
        
        return $fields;
    }
}