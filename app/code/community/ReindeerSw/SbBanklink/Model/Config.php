<?php
/**
 * @copyright Copyright (c) 2014 Reindeer Software (http://reindeersw.com)
 */
class ReindeerSw_SbBanklink_Model_Config {
    
    /**
     * 
     * @return boolean
     */
    public function getEnabled() {
        return Mage::getStoreConfig('payment/reindeersw_sbbanklink/active');
    }
    
    /**
     * 
     * @return boolean
     */
    public function getTestMode() {
        return Mage::getStoreConfig('payment/reindeersw_sbbanklink/test_mode');
    }
    
    /**
     * 
     * @return string
     */
    public function getSubmitUrl() {
        return Mage::getStoreConfig('payment/reindeersw_sbbanklink/submit_url');
    }
    
    /**
     * 
     * @return integer
     */
    public function getVkSndID() {
        return Mage::getStoreConfig('payment/reindeersw_sbbanklink/vk_snd_id');
    }
    
    /**
     * 
     * @return string
     */
    public function getClientPrivateKey() {
        return Mage::getStoreConfig('payment/reindeersw_sbbanklink/client_private_key');
    }
    
    /**
     * 
     * @return string
     */
    public function getClientKeyPassphrase() {
        return Mage::getStoreConfig('payment/reindeersw_sbbanklink/client_key_passphrase');
    }
    
    /**
     * 
     * @return string
     */
    public function getBankPublicKey() {
        return Mage::getStoreConfig('payment/reindeersw_sbbanklink/bank_public_key');
    }
}