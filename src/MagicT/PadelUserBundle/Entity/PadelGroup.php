<?php


namespace MagicT\PadelUserBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Sonata\UserBundle\Entity\BaseGroup as BaseGroup;

/**
 * @ORM\Entity
 * @ORM\Table(name="padelgroup")
 */
class PadelGroup extends BaseGroup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Get id     
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }
}
