<?php
/**
 * Created by PhpStorm.
 * User: geoffrey.polan
 * Date: 06/12/17
 * Time: 09:03
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Participant
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="participant")
 */
class Participant
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @var string
     * @ORM\Column(type="string",length=40)
     */
    protected $name;
    /**
     * @var Participant
     * @ORM\OneToOne(targetEntity="Participant")
     */
    protected $target;
    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    protected $enable;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return Participant
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @param Participant $target
     */
    public function setTarget($target)
    {
        $this->target = $target;
    }

    /**
     * @return boolean
     */
    public function isEnable()
    {
        return $this->enable;
    }

    /**
     * @param boolean $enable
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;
    }


}