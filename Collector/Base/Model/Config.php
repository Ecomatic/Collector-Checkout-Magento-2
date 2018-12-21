<?php

namespace Collector\Base\Model;

class Config
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;


    /**
     * @var Session
     */
    protected $collectorSession;
    
    /**
     * @var \Magento\Framework\App\ProductMetadataInterface
     */
    protected $productMetadata;

    /**
     * Config constructor.
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param Session $collectorSession
     * @param \Magento\Framework\App\ProductMetadataInterface $productMetadata
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Collector\Base\Model\Session $collectorSession,
        \Magento\Framework\App\ProductMetadataInterface $productMetadata
    ) {
        $this->productMetadata = $productMetadata;
        $this->collectorSession = $collectorSession;
        $this->scopeConfig = $scopeConfig;
    }

    public function getEnable()
    {
        return $this->scopeConfig->getValue(
            'collector_collectorcheckout/general/active',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    
    public function getUpdateDbCustomer()
    {
        return $this->scopeConfig->getValue(
            'collector_collectorcheckout/general/updatedbcustomer',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getAcceptStatus()
    {
        return $this->scopeConfig->getValue(
            'collector_collectorcheckout/general/acceptstatus',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    
    public function getPendingStatus()
    {
        return 'collector_pending';
    }

    public function getHoldStatus()
    {
        return $this->scopeConfig->getValue(
            'collector_collectorcheckout/general/holdstatus',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getDeniedStatus()
    {
        return $this->scopeConfig->getValue(
            'collector_collectorcheckout/general/deniedstatus',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getTestMode()
    {
        return $this->scopeConfig->getValue(
            'collector_collectorcheckout/general/testmode',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getShippingTaxClass()
    {
        return $this->scopeConfig->getValue(
            'tax/classes/shipping_tax_class',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getB2CInvoiceFeeTaxClass()
    {
        return $this->scopeConfig->getValue(
            'collector_collectorcheckout/invoice/invoice_fee_b2c_tax_class',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getUsername()
    {
        return $this->scopeConfig->getValue(
            'collector_collectorcheckout/general/username',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getStoreUsername($store)
    {
        return $this->scopeConfig->getValue(
            'collector_collectorcheckout/general/username',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store->getCode()
        );
    }

    public function getDefaultUsername()
    {
        return $this->scopeConfig->getValue(
            'collector_collectorcheckout/general/username',
            'default'
        );
    }

    public function getUsernameNotNull($store = null)
    {
        $username = $this->getUsername();
        if ($username == null) {
            $username = $this->getStoreUsername($store);
            if ($username == null) {
                $username = $this->getDefaultUsername();
            }
        }
        return $username;
    }

    public function getCustomerType()
    {
        return $this->scopeConfig->getValue(
            'collector_collectorcheckout/general/customer_type',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }


    public function getUpdateCustomer()
    {
        return $this->scopeConfig->getValue(
            'collector_collectorcheckout/general/updatecustomer',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getShowDiscount()
    {
        return $this->scopeConfig->getValue(
            'collector_collectorcheckout/styling/showdiscount',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getPassword()
    {
        return $this->scopeConfig->getValue(
            'collector_collectorcheckout/general/sharedkey',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getStorePassword($store)
    {
        return $this->scopeConfig->getValue(
            'collector_collectorcheckout/general/sharedkey',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store->getCode()
        );
    }

    public function getDefaultPassword()
    {
        return $this->scopeConfig->getValue(
            'collector_collectorcheckout/general/sharedkey',
            'default'
        );
    }

    public function getPasswordNotNull($store = null)
    {
        $password = $this->getPassword();
        if ($password == null) {
            $password = $this->getStorePassword($store);
            if ($password == null) {
                $password = $this->getDefaultPassword();
            }
        }
        return $password;
    }

    public function getB2CStoreID()
    {
        return $this->scopeConfig->getValue(
            'collector_collectorcheckout/general/b2c_storeid',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getStoreB2CStoreID($store)
    {
        return $this->scopeConfig->getValue(
            'collector_collectorcheckout/general/b2c_storeid',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store->getCode()
        );
    }

    public function getDefaultB2CStoreID()
    {
        return $this->scopeConfig->getValue(
            'collector_collectorcheckout/general/b2c_storeid',
            'default'
        );
    }

    public function getB2CStoreIDNotNull($store = null)
    {
        $storeID = $this->getB2CStoreID();
        if ($storeID == null) {
            $storeID = $this->getStoreB2CStoreID($store);
            if ($storeID == null) {
                $storeID = $this->getDefaultB2CStoreID();
            }
        }
        return $storeID;
    }

    public function getB2BStoreID()
    {
        return $this->scopeConfig->getValue(
            'collector_collectorcheckout/general/b2b_storeid',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getStoreB2BStoreID($store)
    {
        return $this->scopeConfig->getValue(
            'collector_collectorcheckout/general/b2b_storeid',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store->getCode()
        );
    }

    public function getDefaultB2BStoreID()
    {
        return $this->scopeConfig->getValue(
            'collector_collectorcheckout/general/b2b_storeid',
            'default'
        );
    }

    public function getB2BStoreIDNotNull($store = null)
    {
        $storeID = $this->getB2BStoreID();
        if ($storeID == null) {
            $storeID = $this->getStoreB2BStoreID($store);
            if ($storeID == null) {
                $storeID = $this->getDefaultB2BStoreID();
            }
        }
        return $storeID;
    }

    public function getCountryCode()
    {
        return $this->scopeConfig->getValue(
            'general/country/default',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getStoreCountryCode($store)
    {
        return $this->scopeConfig->getValue(
            'general/country/default',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store->getCode()
        );
    }

    public function getDefaultCountryCode()
    {
        return $this->scopeConfig->getValue(
            'general/country/default',
            'default'
        );
    }

    public function getCountryCodeNotNull($store = null)
    {
        $countryCode = $this->getCountryCode();
        if ($countryCode == null) {
            $countryCode = $this->getStoreCountryCode($store);
            if ($countryCode == null) {
                $countryCode = $this->getDefaultCountryCode();
            }
        }
        return $countryCode;
    }

    public function getTermsUrl()
    {
        return $this->scopeConfig->getValue(
            'collector_collectorcheckout/general/terms_url',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getInvoiceB2BFee(): float
    {
        return floatval(
            $this->scopeConfig->getValue(
                'collector_collectorcheckout/invoice/invoice_fee_b2b',
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            )
        );
    }

    public function getInvoiceB2CFee(): float
    {
        return floatval(
            $this->scopeConfig->getValue(
                'collector_collectorcheckout/invoice/invoice_fee_b2c',
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            )
        );
    }

    public function getWSDL(): string
    {
        return $this->getTestMode() ?
            "https://checkout-api-uat.collector.se" :
            "https://checkout-api.collector.se";
    }

    public function getInvoiceWSDL(): string
    {
        return $this->getTestMode() ?
            "https://ecommercetest.collector.se/v3.0/InvoiceServiceV33.svc?singleWsdl" :
            "https://ecommerce.collector.se/v3.0/InvoiceServiceV33.svc?singleWsdl";
    }

    public function getHeaderUrl(): string
    {
        return 'http://schemas.ecommerce.collector.se/v30/InvoiceService';
    }

    public function isShippingAddressEnabled(): bool
    {
        $version = $this->productMetadata->getVersion();
        $minorVersion = explode('.', $version)[1];
        if ($minorVersion < 2){
            return false;
        }
        $isEnabled = $this->scopeConfig->getValue(
            'collector_collectorcheckout/general/shippingaddress',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        if (empty($isEnabled)) {
            return false;
        }
        return boolval($isEnabled);
    }

    public function getInvoiceType()
    {
        return "0";
    }

    public function getInvoiceDeliveryMethod()
    {
        return "2";
    }

    public function getB2BrB2CStore($btype = null): int
    {
        if (empty($btype)) {
            $btype = $this->collectorSession->getBtype('');
        }
        if ($btype == \Collector\Base\Model\Session::B2B ||
            empty($btype) && $this->getCustomerType() ==
            \Collector\Iframe\Model\Config\Source\Customertype::BUSINESS_CUSTOMER
        ) {
            $this->collectorSession->setBtype(\Collector\Base\Model\Session::B2B);
            return intval($this->getB2BStoreID());
        }
        $this->collectorSession->setBtype(\Collector\Base\Model\Session::B2C);
        return intval($this->getB2CStoreID());
    }


    public function getHash($path, $json = '')
    {
        return base64_encode($this->getUsername() . ":" . hash("sha256", $json . $path . $this->getPassword()));
    }

    public function createAccount()
    {
        return $this->scopeConfig->getValue(
            'collector_collectorcheckout/general/create_account',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    
    public function getCheckoutUrl()
    {
        if ($this->getTestMode()) {
            return "https://checkout-uat.collector.se/collector-checkout-loader.js";
        } else {
            return "https://checkout.collector.se/collector-checkout-loader.js";
        }
    }
    
    public function getUseBundleParentImage()
    {
        return $this->scopeConfig->getValue(
            'checkout/cart/grouped_product_image',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    
    public function getUseConfigurableParentImage()
    {
        return $this->scopeConfig->getValue(
            'checkout/cart/configurable_product_image',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
