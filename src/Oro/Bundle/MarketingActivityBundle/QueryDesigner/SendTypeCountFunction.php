<?php

namespace Oro\Bundle\MarketingActivityBundle\QueryDesigner;

use Oro\Bundle\MarketingActivityBundle\Entity\MarketingActivity;

class SendTypeCountFunction extends AbstractTypeCountFunction
{
    /**
     * {@inheritdoc}
     */
    protected function getType()
    {
        return MarketingActivity::TYPE_SEND;
    }
}
