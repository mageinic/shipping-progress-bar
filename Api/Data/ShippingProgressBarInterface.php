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

namespace MageINIC\ShippingProgressBar\Api\Data;

/**
 * ShippingProgressBarInterface Interface file.
 */
interface ShippingProgressBarInterface
{
    public const INITIALMESSAGE = 'initial_message';

    public const INPROGRESSMESSAGE = 'in_progress_message';

    public const ACHIEVEDMESSAGE = 'achieved_message';

    /**
     * Get the Initial Message
     *
     * @return mixed
     */
    public function getInitialMessage(): mixed;

    /**
     * Set the Initial Message
     *
     * @param mixed $initialMessage
     * @return $this
     */
    public function setInitialMessage($initialMessage): mixed;

    /**
     * Get in Progress Message
     *
     * @return mixed
     */
    public function getInProgressMessage(): mixed;

    /**
     * Set in Progress Message
     *
     * @param mixed $inProgressMessage
     * @return $this
     */
    public function setInProgressMessage($inProgressMessage): mixed;

    /**
     * Get in Achieved Message
     *
     * @return mixed
     */
    public function getAchievedMessage(): mixed;

    /**
     * Set in Achieved Message
     *
     * @param mixed $achievedMessage
     * @return $this
     */
    public function setAchievedMessage($achievedMessage): mixed;
}
