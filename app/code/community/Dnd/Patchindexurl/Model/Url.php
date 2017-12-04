<?php
/**
 * @version         1.0.0.0
 * @copyright         Copyright (c) 2012 Agence Dn'D
 * @author             Agence Dn'D - Conseil en création de site e-Commerce Magento : http://www.dnd.fr/
 * @license         http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
 
class Dnd_Patchindexurl_Model_Url extends Mage_Catalog_Model_Url
{
    protected function _refreshProductRewrite(Varien_Object $product, Varien_Object $category)
    {
        $helper = Mage::helper('patchindexurl');

        // Optimisation: Do not create urls with categories /[category-1]/[category-2]/my-product
        if (
            !$helper->useCategoriesInUrl()
            && $this->getStores($product->getStoreId())->getRootCategoryId() != $category->getId()
        ) {
            return $this;
        }

        // Optimisation: Exclude disabled products
        if ($helper->excludeDisabledProducts()
            && $product->getData('status') == Mage_Catalog_Model_Product_Status::STATUS_DISABLED
        ) {
            return $this;
        }

        // Optimisation: Exclude invisible products
        if ($helper->excludeInvisibleProducts()
            && $product->getData('visibility') == Mage_Catalog_Model_Product_Visibility::VISIBILITY_NOT_VISIBLE
        ) {
            return $this;
        }

        return parent::_refreshProductRewrite($product, $category);
    }
}

