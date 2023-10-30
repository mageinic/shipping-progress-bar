<?php
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

namespace MageINIC\ShippingProgressBar\Block\Cart;

use Magento\Framework\App\Request\Http;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Sidebar Block file.
 */
class Sidebar extends Template
{
    public const CORE_FREE_SHIPPING_STATUS = 'carriers/freeshipping/active';
    public const PRICE_SHIPPING_BAR = 'carriers/freeshipping/free_shipping_subtotal';
    public const SHIPPING_BAR_INITIAL_MESSAGE = 'shippingbar/shippingsection/initial_message';
    public const SHIPPING_IN_PROGRESS_MESSAGE = 'shippingbar/shippingsection/in_progress_message';
    public const SHIPPING_ACHIEVED_MESSAGE = 'shippingbar/shippingsection/achieved_message';
    public const SHIPPING_PROGRESS_BAR_ENABLE = 'shippingbar/shippingsection/shipping_progress_bar_enable';

    /**
     * PriceCurrencyInterface
     *
     * @var PriceCurrencyInterface
     */
    protected PriceCurrencyInterface $priceCurrency;

    /**
     * HttpRequest
     *
     * @var Http
     */
    protected Http $request;

    /**
     * Sidebar construct.
     *
     * @param Context $context
     * @param PriceCurrencyInterface $priceCurrency
     * @param Http $request
     * @param array $data
     */
    public function __construct(
        Context       $context,
        PriceCurrencyInterface $priceCurrency,
        Http                   $request,
        array                  $data = []
    ) {
        $this->priceCurrency = $priceCurrency;
        $this->request = $request;
        parent::__construct($context, $data);
    }

    /**
     * GetPriceForShippingProgressBar
     *
     * @return mixed
     */
    public function getPriceForShippingProgressBar(): mixed
    {
        return $this->_scopeConfig->getValue(
            self::PRICE_SHIPPING_BAR,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * GetInitialMessage
     *
     * @return mixed
     */
    public function getInitialMessage(): mixed
    {
        return $this->_scopeConfig->getValue(
            self::SHIPPING_BAR_INITIAL_MESSAGE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * InProgressMessage
     *
     * @return mixed
     */
    public function inProgressMessage(): mixed
    {
        return $this->_scopeConfig->getValue(
            self::SHIPPING_IN_PROGRESS_MESSAGE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * GetAchievedMessage
     *
     * @return mixed
     */
    public function getAchievedMessage(): mixed
    {
        return $this->_scopeConfig->getValue(
            self::SHIPPING_ACHIEVED_MESSAGE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get Shipping Progress Bar Enable Or Disable
     *
     * @return mixed
     */
    public function getShippingProgressBarEnable(): mixed
    {
        return $this->_scopeConfig->getValue(
            self::SHIPPING_PROGRESS_BAR_ENABLE,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get Core Free Shipping Method Status Enable Or Disable
     *
     * @return mixed
     */
    public function getCoreFreeShippingStatus(): mixed
    {
        return $this->_scopeConfig->getValue(
            self::CORE_FREE_SHIPPING_STATUS,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * GetCurrentCurrencySymbol
     *
     * @return mixed
     */
    public function getCurrentCurrencySymbol(): mixed
    {
        return $this->priceCurrency->getCurrency()->getCurrencySymbol();
    }
}
