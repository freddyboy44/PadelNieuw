<?php
namespace MagicT\PadelReservatieBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 */
class ReservatieType
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Naam;

    /**
     * @ORM\OneToMany(targetEntity="MagicT\PadelReservatieBundle\Entity\Reservatie", mappedBy="reservatieType")
     */
    private $reservaties;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->reservaties = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set Naam
     *
     * @param string $naam
     * @return ReservatieType
     */
    public function setNaam($naam)
    {
        $this->Naam = $naam;

        return $this;
    }

    /**
     * Get Naam
     *
     * @return string 
     */
    public function getNaam()
    {
        return $this->Naam;
    }

    /**
     * Add reservaties
     *
     * @param \MagicT\PadelReservatieBundle\Entity\Reservatie $reservaties
     * @return ReservatieType
     */
    public function addReservaty(\MagicT\PadelReservatieBundle\Entity\Reservatie $reservaties)
    {
        $this->reservaties[] = $reservaties;

        return $this;
    }

    /**
     * Remove reservaties
     *
     * @param \MagicT\PadelReservatieBundle\Entity\Reservatie $reservaties
     */
    public function removeReservaty(\MagicT\PadelReservatieBundle\Entity\Reservatie $reservaties)
    {
        $this->reservaties->removeElement($reservaties);
    }

    /**
     * Get reservaties
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReservaties()
    {
        return $this->reservaties;
    }
}
