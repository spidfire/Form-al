<?php

namespace FormAl\Elements;

use FormAl\FormAlAbstract;
use FormAl\Validators\ValidPhoneNumber;

/**
 * Class PhoneNumber
 *
 * @package FormAl\Elements
 */
class PhoneNumber extends Input
{
    /**
     * @param string         $name
     * @param FormAlAbstract $formal
     */
    public function __construct($name, FormAlAbstract $formal)
    {
        parent::__construct($name, $formal);

        $this->addValidator(new ValidPhoneNumber());
    }
}
