<?php

namespace MagicT\PadelReservatieBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeVeld
 *
 * 
 * @ORM\Entity(repositoryClass="MagicT\PadelReservatieBundle\Entity\TypeVeldRepository")
 */
class TypeVeld
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
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true, name="AantalSpelers")
     */
    private $aantalSpelers;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true, name="Beschikbaar")
     */
    private $beschikbaar;

    /**
     * @var  integer
     * @ORM\Column(type="integer", nullable=false, name="MinimumSpelers", options={"default":0})
     */
    private $minimumspelers;

    /**
     * @ORM\OneToMany(targetEntity="MagicT\PadelReservatieBundle\Entity\Veld", mappedBy="typeVeld")
     */
    private $velden;

    /**
     * 
     */
    private $veld;

    public function __toString() {
        return $this->naam;
    }

    public function __construct() {
        $this->velden = new ArrayCollection();
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
     * @return TypeVeld
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
     * Set aantalSpelers
     *
     * @param integer $aantalSpelers
     * @return TypeVeld
     */
    public function setAantalSpelers($aantalSpelers)
    {
        $this->aantalSpelers = $aantalSpelers;

        return $this;
    }

    /**
     * Get aantalSpelers
     *
     * @return integer 
     */
    public function getAantalSpelers()
    {
        return $this->aantalSpelers;
    }

    /**
     * Set beschikbaar
     *
     * @param boolean $beschikbaar
     * @return TypeVeld
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
     * Add velden
     *
     * @param \MagicT\PadelReservatieBundle\Entity\Veld $velden
     * @return TypeVeld
     */
    public function addVelden(\MagicT\PadelReservatieBundle\Entity\Veld $velden)
    {
        $this->velden[] = $velden;

        return $this;
    }

    /**
     * Remove velden
     *
     * @param \MagicT\PadelReservatieBundle\Entity\Veld $velden
     */
    public function removeVelden(\MagicT\PadelReservatieBundle\Entity\Veld $velden)
    {
        $this->velden->removeElement($velden);
    }

    /**
     * Get velden
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVelden()
    {
        return $this->velden;
    }

    /**
     * Set minimumspelers
     *
     * @param integer $minimumspelers
     * @return Veld
     */
    public function setMinimumspelers($minimumspelers)
    {
        $this->minimumspelers = $minimumspelers;

        return $this;
    }

    /**
     * Get minimumspelers
     *
     * @return integer 
     */
    public function getMinimumspelers()
    {
        return $this->minimumspelers;
    }
}
