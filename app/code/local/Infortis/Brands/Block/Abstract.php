<?php

class Infortis_Brands_Block_Abstract extends Mage_Core_Block_Template
{
    protected $_helper;
    protected $_attributeModel = NULL;
    protected $x0d;
    protected $x0e;
    protected $x0f;

    public function getBrandAttributeTitle()
    {
        return $this->_attributeModel->getStoreLabel();
    }

    public function getBrand($x10)
    {
//        $x11 = $x10->getResource()->getAttribute($this->getBrandAttributeId());
//        return trim($x11->getFrontend()->getValue($x10));
          return '';
    }

    public function getBrandImageUrl($x12)
    {
        $x13 = trim($this->_helper->getCfg('general/image_extension'));
        $x14 = $this->getBrandUrlKey($x12, $this->x0f) . '.' . $x13;
        if (file_exists($this->_getBrandImageBaseDir() . $x14)) {
            return $this->_getBrandImageBaseUrl() . $x14;
        } else {
            return '';
        }
    }

    public function getBrandUrlKey($x12, $x1b)
    {
        return $this->_formatBrandUrlKey($x12, $x1b);
    }

    protected function _formatBrandUrlKey($x12, $x1b)
    {
        $x1c = Mage::helper('catalog/product_url')->format($x12);
        $x1d = preg_replace('#[^0-9a-z]+#i', $x1b, $x1c);
        $x1d = strtolower($x1d);
        $x1d = trim($x1d, $x1b);
        return $x1d;
    }

    protected function _getBrandImageBaseDir()
    {
        return Mage::getBaseDir('media') . DS . $this->x0d;
    }

    protected function _getBrandImageBaseUrl()
    {
        return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . $this->x0d;
    }

    public function getBrandPageUrl($x12)
    {
        $x15 = '';
        $x16 = $this->_helper->getCfgLinkToSearch();
        if ($x16 == 3) {
            $x15 = '';
        } elseif ($x16 == '2') {
            $x17 = $this->getBrandAttributeId();
            $x18 = $this->_attributeModel->getSource()->getOptionId($x12);
            $x15 = Mage::getBaseUrl() . 'catalogsearch/advanced/result/?' . $x17 . urlencode('[]') . '=' . $x18;
        } elseif ($x16 == 1) {
            $x15 = Mage::getBaseUrl() . 'catalogsearch/result/?q=' . str_replace("\040", "\x2b", $x12);
        } elseif ($x16 == '0') {
            $x19 = $this->getBrandUrlKey($x12, $this->x0e);
            $x1a = trim($this->_helper->getCfg('general/page_base_path'), ' /');
            if ($x1a !== '') {
                $x1a .= '/';
            }
            $x15 = Mage::getBaseUrl() . $x1a . $x19;
            if ($this->_helper->getCfg('general/append_category_suffix')) {
                $x15 .= Mage::getStoreConfig('catalog/seo/category_url_suffix');
            }
        }
        return $x15;
    }

    protected function _construct()
    {
        $this->_helper = Mage::helper('brands');
        $this->x0d = $this->_helper->getBrandImagePath();
        $this->x0e = trim($this->_helper->getCfg('general/url_key_separator'));
        $this->x0f = trim($this->_helper->getCfg('general/img_url_key_separator'));
        $this->_getAttributeModel();
    }

    protected function _getAttributeModel()
    {
        if (NULL === $this->_attributeModel) {
            $this->_attributeModel = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $this->getBrandAttributeId());
        }
        return $this->_attributeModel;
    }

    public function getBrandAttributeId()
    {
        return $this->_helper->getCfg('general/attr_id');
    }
}