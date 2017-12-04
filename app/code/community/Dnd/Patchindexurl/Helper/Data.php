<?php
class Dnd_Patchindexurl_Helper_Data {
    public function isEnabled() {
        return Mage::getStoreConfigFlag('dev/index/enable');
    }

    public function excludeDisabledProducts() {
        return $this->isEnabled() && Mage::getStoreConfigFlag('dev/index/disable');
    }

    public function excludeInvisibleProducts() {
        return $this->isEnabled() && Mage::getStoreConfigFlag('dev/index/notvisible');
    }

    public function useCategoriesInUrl() {
        return $this->isEnabled() && Mage::getStoreConfig('catalog/seo/product_use_categories');
    }
}

