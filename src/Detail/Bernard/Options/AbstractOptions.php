<?php

namespace Detail\Bernard\Options;

use Zend\Stdlib\AbstractOptions as Options;

abstract class AbstractOptions extends Options
{
    /**
     * {@inheritDoc}
     */
    public function __construct($options = null)
    {
        $this->__strictMode__ = false;
        parent::__construct($options);
    }
}
