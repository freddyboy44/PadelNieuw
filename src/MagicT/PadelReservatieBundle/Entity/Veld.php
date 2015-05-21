<?php

namespace MagicT\PadelReservatieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Veld
 *
 * 
 * @ORM\Entity(repositoryClass="MagicT\PadelReservatieBundle\Entity\VeldRepository")
 */
class Veld
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer", name="id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true, name="Naam")
     */
    private $naam;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="time", nullable=false, name="Startuur")
     */
    private $startuur;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true, name="Beschikbaar")
     */
    private $beschikbaar;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true, name="Volgorde")
     */
    private $volgorde;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $overdekt;

    /**
     * @ORM\OneToMany(targetEntity="MagicT\PadelReservatieBundle\Entity\Reservatie", mappedBy="veld")
     */
    private $reservatie;

    /**
     * @ORM\ManyToOne(targetEntity="MagicT\PadelReservatieBundle\Entity\TypeVeld", inversedBy="velden")
     * @ORM\JoinColumn(name="type_veld_id", referencedColumnName="id")
     */
    private $typeVeld;

    public function __construct()
    {
        $this->startuur  = "08:00";
        $this->reservatie = new ArrayCollection();
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
     * Set naam
     *
     * @param string $naam
     * @return Veld
     */
    public function setNaam($naam)
    {
        $this->naam = $naam;

        return $this;
    }

    /**
     * Get naam
     *
     * @return string 
     */
    public function getNaam()
    {
        return $this->naam;
    }

    /**
     * Set startuur
     *
     * @param \DateTime $startuur
     * @return Veld
     */
    public function setStartuur($startuur)
    {
        $this->startuur = $startuur;

        return $this;
    }

    /**
     * Get startuur
     *
     * @return \DateTime 
     */
    public function getStartuur()
    {
        return $this->startuur;
    }

    /**
     * Set beschikbaar
     *
     * @param boolean $beschikbaar
     * @return Veld
     */
    public function setBeschikbaar($beschikbaar)
    {
        $this->beschikbaar = $beschikbaar;

        return $this;
    }

    /**
     * Get beschikbaar
     *
     * @return boolean 
     */
    public function getBeschikbaar()
    {
        return $this->beschikbaar;
    }

    /**
     * Set volgorde
     *
     * @param integer $volgorde
     * @return Veld
     */
    public function setVolgorde($volgorde)
    {
        $this->volgorde = $volgorde;

        return $this;
    }

    /**
     * Get volgorde
     *
     * @return integer 
     */
    public function getVolgorde()
    {
        return $this->volgorde;
    }

    /**
     * Add reservatie
     *
     * @param \MagicT\PadelReservatieBundle\Entity\Reservatie $reservatie
     * @return Veld
     */
    public function addReservatie(\MagicT\PadelReservatieBundle\Entity\Reservatie $reservatie)
    {
        $this->reservatie[] = $reservatie;

        return $this;
    }

    /**
     * Remove reservatie
     *
     * @param \MagicT\PadelReservatieBundle\Entity\Reservatie $reservatie
     */
    public function removeReservatie(\MagicT\PadelReservatieBundle\Entity\Reservatie $reservatie)
    {
        $this->reservatie->removeElement($reservatie);
    }

    /**
     * Get reservatie
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReservatie()
    {
        return $this->reservatie;
    }

    /**
     * Set typeVeld
     *
     * @param \MagicT\PadelReservatieBundle\Entity\TypeVeld $typeVeld
     * @return Veld
     */
    public function setTypeVeld(\MagicT\PadelReservatieBundle\Entity\TypeVeld $typeVeld = null)
    {
        $this->typeVeld = $typeVeld;

        return $this;
    }

    /**
     * Get typeVeld
     *
     * @return \MagicT\PadelReservatieBundle\Entity\TypeVeld 
     */
    public function getTypeVeld()
    {
        return $this->typeVeld;
    }

    /**
     * Set overdekt
     *
     * @param boolean $overdekt
     * @return Veld
     */
    public function setOverdekt($overdekt)
    {
        $this->overdekt = $overdekt;

        return $this;
    }

    /**
     * Get overdekt
     *
     * @return boolean 
     */
    public function getOverdekt()
    {
        return $this->overdekt;
    }
}
