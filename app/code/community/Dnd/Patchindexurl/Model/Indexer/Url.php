<?php
class Dnd_Patchindexurl_Model_Indexer_Url extends Mage_Catalog_Model_Indexer_Url
{
    protected function _registerProductEvent(Mage_Index_Model_Event $event)
    {
        $product = $event->getDataObject();

        $dataChange = $product->dataHasChangedFor('url_key')
            || $product->getIsChangedCategories()
            || $product->getIsChangedWebsites()
            || ( $product->dataHasChangedFor('status') && $product->getData('status') == 1 )
            || ( $product->dataHasChangedFor('visibility') && $product->getData('visibility') != 1 );

        if (!$product->getExcludeUrlRewrite() && $dataChange) {
            $event->addNewData('rewrite_product_ids', array($product->getId()));
        }
    }
}

