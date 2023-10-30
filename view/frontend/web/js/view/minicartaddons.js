/**
 * MageINIC
 * Copyright (C) 2023 MageINIC <support@mageinic.com>
 *
 * NOTICE OF LICENSE
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see https://opensource.org/licenses/gpl-3.0.html.
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category MageINIC
 * @package MageINIC_ShippingProgressBar
 * @copyright Copyright (c) 2023 MageINIC (https://www.mageinic.com/)
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
 * @author MageINIC <support@mageinic.com>
 */
define([
    'jquery',
    'ko',
    'uiComponent',
    'Magento_Customer/js/customer-data'
], function ($, ko, Component, customerData) {
    'use strict';

    var subtotalAmount;
    var maxPrice = maxpriceShipping;
    var getStoreCurrencySymbol = window.getStoreCurrencySymbol;
    var inProgressMessage = window.inProgressMessage;
    var percentage;
    var totalAmount;

    return Component.extend({
        displaySubtotal: ko.observable(true),
        maxprice: getStoreCurrencySymbol + maxPrice.toFixed(2),

        /**
         * @override
         */
        initialize: function () {
            this._super();
            this.cart = customerData.get('cart');
        },

        /**
         * @returns {number|*}
         */
        getTotalCartItems: function () {
            return customerData.get('cart')().summary_count;
        },

        /**
         * @returns {number}
         */
        getpercentage: function () {
            subtotalAmount = customerData.get('cart')().subtotalAmount;

            if (subtotalAmount > maxPrice) {
                subtotalAmount = maxPrice;
            }
            this.totalAmount();
            percentage = ((subtotalAmount * 100) / maxPrice);
            return percentage;
        },

        /**
         * @returns {string}
         */
        totalAmount: function () {
            subtotalAmount = customerData.get('cart')().subtotalAmount;
            totalAmount = maxPrice - subtotalAmount;
            var remainingAmount = getStoreCurrencySymbol + totalAmount;
            return inProgressMessage.replace('{{price}}', remainingAmount);
        },

        /**
         * @return void
         */
        messageHide: function () {
            $('.free-shipping-ext').hide();
        }
    });
});
