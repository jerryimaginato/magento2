<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Magento
 * @package     Magento_Core
 * @copyright   Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Message model
 *
 * @category   Magento
 * @package    Magento_Core
 * @author      Magento Core Team <core@magentocommerce.com>
 */
namespace Magento\Core\Model;

class Message
{
    const ERROR     = 'error';
    const WARNING   = 'warning';
    const NOTICE    = 'notice';
    const SUCCESS   = 'success';
    
    protected function _factory($code, $type, $class='', $method='')
    {
        switch (strtolower($type)) {
            case self::ERROR :
                $message = new \Magento\Core\Model\Message\Error($code);
                break;
            case self::WARNING :
                $message = new \Magento\Core\Model\Message\Warning($code);
                break;
            case self::SUCCESS :
                $message = new \Magento\Core\Model\Message\Success($code);
                break;
            default:
                $message = new \Magento\Core\Model\Message\Notice($code);
                break;
        }
        $message->setClass($class);
        $message->setMethod($method);
        
        return $message;
    }
    
    public function error($code, $class='', $method='')
    {
        return $this->_factory($code, self::ERROR, $class, $method);
    }

    public function warning($code, $class='', $method='')
    {
        return $this->_factory($code, self::WARNING, $class, $method);
    }

    public function notice($code, $class='', $method='')
    {
        return $this->_factory($code, self::NOTICE, $class, $method);
    }

    public function success($code, $class='', $method='')
    {
        return $this->_factory($code, self::SUCCESS, $class, $method);
    }
}
