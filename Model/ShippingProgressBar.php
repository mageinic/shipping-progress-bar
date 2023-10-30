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

use MageINIC\ShippingProgressBar\Api\Data\ShippingProgressBarInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Class ShippingProgressBar Model File.
 */
class ShippingProgressBar extends AbstractModel implements ShippingProgressBarInterface
{
    /**
     * @inheritdoc
     */
    public function getInitialMessage(): mixed
    {
        return $this->getData(self::INITIALMESSAGE);
    }

    /**
     * @inheritdoc
     */
    public function setInitialMessage($initialMessage): mixed
    {
        return $this->setData(self::INITIALMESSAGE, $initialMessage);
    }

    /**
     * @inheritdoc
     */
    public function getInProgressMessage(): mixed
    {
        return $this->getData(self::INPROGRESSMESSAGE);
    }

    /**
     * @inheritdoc
     */
    public function setInProgressMessage($inProgressMessage): mixed
    {
        return $this->setData(self::INPROGRESSMESSAGE, $inProgressMessage);
    }

    /**
     * @inheritdoc
     */
    public function getAchievedMessage(): mixed
    {
        return $this->getData(self::ACHIEVEDMESSAGE);
    }

    /**
     * @inheritdoc
     */
    public function setAchievedMessage($achievedMessage): mixed
    {
        return $this->setData(self::ACHIEVEDMESSAGE, $achievedMessage);
    }
}
