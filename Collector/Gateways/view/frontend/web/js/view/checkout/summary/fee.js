/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
/*jshint browser:true jquery:true*/
/*global alert*/
define(
    [
        'Magento_Checkout/js/view/summary/abstract-total',
        'Magento_Checkout/js/model/quote',
        'Magento_Catalog/js/price-utils',
        'Magento_Checkout/js/model/totals'
    ],
    function (Component, quote, priceUtils, totals) {
        "use strict";
        return Component.extend({
            defaults: {
                isFullTaxSummaryDisplayed: window.checkoutConfig.isFullTaxSummaryDisplayed || false,
                template: 'Collector_Gateways/checkout/summary/fee'
            },
            totals2: quote.getTotals(),
            isTaxDisplayedInGrandTotal: window.checkoutConfig.includeTaxInGrandTotal || false,
            isDisplayed: function () {
                return this.isFullMode();
            },
            getValue: function () {
                var price = 0;
                try {
                    if (this.totals()) {
                        if (totals2.getSegment('fee')) {
                            price = totals2.getSegment('fee').value;
                        }
                    }
                }
                catch (err){
                    price = 0;
                }
                return this.getFormattedPrice(price);
            },
            getBaseValue: function () {
                var price = 0;
                try {
                    if (this.totals()) {
                        price = this.totals().base_fee;
                    }
                }
                catch (err){
                    price = 0;
                }
                return priceUtils.formatPrice(price, quote.getBasePriceFormat());
            }
        });
    }
);