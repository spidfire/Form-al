<?php

namespace FormAl\Elements;

/**
 * Class Password
 *
 * @package FormAl\Elements
 */
class Password extends Input
{
    /** @var string */
    public $type = "password";
    /** @var string */
    private $encodeType = 'plain';
    /** @var string */
    private $encodePreSalt = '';
    /** @var string */
    private $encodePostSalt = '';

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return null|string
     * @throws \Exception
     */
    public function getValue()
    {
        $submit = $this->getSubmitValue();
        if ($submit !== null) {
            return $this->encode($submit);
        } else {
            return $this->value;
        }
    }

    /**
     * @param $data
     *
     * @return string
     * @throws \Exception
     */
    private function encode($data)
    {
        switch ($this->encodeType) {
            case 'md5':
                return md5(
                    $this->encodePreSalt . $data . $this->encodePostSalt
                );
                break;
            case 'sha1':
                return sha1(
                    $this->encodePreSalt . $data . $this->encodePostSalt
                );
                break;
            case 'plain':
                return $data;
                break;
        }
        throw new \Exception("No valid encryption method has been chosen", 1);

    }

    /**
     * @param string $method
     * @param string $preSalt
     * @param string $postSalt
     */
    public function setEncryption(
        $method = 'plain',
        $preSalt = '',
        $postSalt = ''
    ) {
        $this->encodeType = $method;
        $this->encodePreSalt = $preSalt;
        $this->encodePostSalt = $postSalt;
    }
}
