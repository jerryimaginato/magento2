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
 * @copyright Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Magento\Webapi\Model\Acl\Resource;

class Provider implements \Magento\Webapi\Model\Acl\Resource\ProviderInterface
{
    /**
     * @var \Magento\Webapi\Model\Acl\Resource\Config\Reader\Filesystem
     */
    protected $_configReader;

    /**
     * @var \Magento\Acl\Resource\TreeBuilder
     */
    protected $_resourceTreeBuilder;

    /**
     * @var \Magento\Config\ScopeInterface
     */
    protected $_scope;

    /**
     * @param \Magento\Webapi\Model\Acl\Resource\Config\Reader\Filesystem $configReader
     * @param \Magento\Config\ScopeInterface $scope
     * @param \Magento\Acl\Resource\TreeBuilder $resourceTreeBuilder
     */
    public function __construct(
        \Magento\Webapi\Model\Acl\Resource\Config\Reader\Filesystem $configReader,
        \Magento\Config\ScopeInterface $scope,
        \Magento\Acl\Resource\TreeBuilder $resourceTreeBuilder
    ) {
        $this->_configReader = $configReader;
        $this->_scope = $scope;
        $this->_resourceTreeBuilder = $resourceTreeBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function getAclResources()
    {
        $aclResourceConfig = $this->_configReader->read();
        if (!empty($aclResourceConfig['config']['acl']['resources'])) {
            return $this->_resourceTreeBuilder->build($aclResourceConfig['config']['acl']['resources']);
        }
        return array();
    }

    /**
     * {@inheritdoc}
     */
    public function getAclVirtualResources()
    {
        $aclResourceConfig = $this->_configReader->read();
        return isset($aclResourceConfig['config']['mapping']) ? $aclResourceConfig['config']['mapping'] : array();
    }
}
