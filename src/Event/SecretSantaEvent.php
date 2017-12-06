<?php
/**
 * Created by PhpStorm.
 * User: geoffrey.polan
 * Date: 06/12/17
 * Time: 09:26
 */

namespace App\Event;


use Symfony\Component\EventDispatcher\Event;

class SecretSantaEvent extends Event
{
    private $arg;

    /**
     * SecretSantaEvent constructor.
     * @param $arg
     */
    public function __construct($arg)
    {
        $this->arg = $arg;
    }

    /**
     * @return mixed
     */
    public function getArg()
    {
        return $this->arg;
    }

}