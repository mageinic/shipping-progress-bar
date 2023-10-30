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

namespace MageINIC\ShippingProgressBar\Model;

use MageINIC\ShippingProgressBar\Api\ShippingProgressBarRepositoryInterface;
use MageINIC\ShippingProgressBar\Block\Cart\Sidebar;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Api\CartRepositoryInterface;

/**
 * Class ShippingProgressBarRepository Repository file.
 */
class ShippingProgressBarRepository implements ShippingProgressBarRepositoryInterface
{
    /**
     * @var Sidebar
     */
    private Sidebar $sidebar;

    /**
     * @var ShippingProgressBar
     */
    private ShippingProgressBar $shippingProgressBar;

    /**
     * @var CartRepositoryInterface
     */
    private CartRepositoryInterface $cartRepository;

    /**
     * ShippingProgressBarRepository Construct
     *
     * @param Sidebar $sidebar
     * @param ShippingProgressBar $shippingProgressBar
     * @param CartRepositoryInterface $cartRepository
     */
    public function __construct(
        Sidebar                 $sidebar,
        ShippingProgressBar     $shippingProgressBar,
        CartRepositoryInterface $cartRepository
    ) {
        $this->sidebar = $sidebar;
        $this->shippingProgressBar = $shippingProgressBar;
        $this->cartRepository = $cartRepository;
    }

    /**
     * @inheritdoc
     */
    public function getShippingProgressBarInfo(string $id): mixed
    {
        $shippingProgressBar = $this->shippingProgressBar;
        $moduleEnable = $this->sidebar->getShippingProgressBarEnable();
        $coreShippingMethodStatus = $this->sidebar->getCoreFreeShippingStatus();
        if (!$coreShippingMethodStatus) {
            throw new NoSuchEntityException(__('Free Shipping Method Is Disable.'));
        }
        if (!$moduleEnable) {
            throw new NoSuchEntityException(__('Module is disable.'));
        }
        if (!$id) {
            throw new NoSuchEntityException(__('Quote ID is missing.'));
        }
        $orderMinimunAmount = $this->sidebar->getPriceForShippingProgressBar();
        if (!$orderMinimunAmount) {
            throw new NoSuchEntityException(__('Order minimum amount is missing.'));
        }
        $quote = $this->cartRepository->get($id);
        $currencySymbol = $this->sidebar->getCurrentCurrencySymbol();
        if ($quote->getSubtotal() >= $orderMinimunAmount) {
            if ($this->sidebar->getAchievedMessage()) {
                $shippingProgressBar->setAchievedMessage($this->sidebar->getAchievedMessage());
            }
        } else {
            $remainingPrice = ($orderMinimunAmount - $quote->getSubtotal());
            if ($this->sidebar->inProgressMessage() && ($orderMinimunAmount != $remainingPrice)) {
                $price = $currencySymbol . $remainingPrice;
                $shippingProgressBar->setInProgressMessage(
                    strtr($this->sidebar->inProgressMessage(), ['{{price}}' => $price])
                );
            }
            if ($this->sidebar->getInitialMessage() && ($orderMinimunAmount == $remainingPrice)) {
                $price = $currencySymbol . $remainingPrice;
                $shippingProgressBar->setInitialMessage(
                    strtr($this->sidebar->getInitialMessage(), ['{{price}}' => $price])
                );
            }
        }

        return $shippingProgressBar;
    }
}

