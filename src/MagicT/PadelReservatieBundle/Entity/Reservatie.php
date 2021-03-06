<?php

namespace MagicT\PadelReservatieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\MaxDepth;

/**
 * Reservatie
 *
 * 
 * @ORM\Entity(repositoryClass="MagicT\PadelReservatieBundle\Entity\ReservatieRepository")
 * @ExclusionPolicy("all")
 * 
 */
class Reservatie
{
    /**
     * @var integer
     *
     * @ORM\Column(type="integer", name="id")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true, name="DateCreated")
     */
    private $dateCreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true, name="DateUpdated")
     */
    private $dateUpdated;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="MagicT\PadelUserBundle\Entity\PadelUser", inversedBy="reservatie"
     * )
     * 
     */
    private $createdBy;

    /**
     * @var integer
     *
     * 
     */
    
    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=true, name="Betaald")
     */
    private $betaald;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Expose
     */
    private $datum;

    /**
     * @ORM\Column(type="time", nullable=true)
     * @Expose
     */
    private $startuur;

    /**
     * @ORM\ManyToOne(targetEntity="MagicT\PadelReservatieBundle\Entity\Veld", inversedBy="reservatie")
     * @ORM\JoinColumn(name="veld_id", referencedColumnName="id")
     * @Expose
     * @MaxDepth(2)
     */
    private $veld;

    /**
     * @ORM\ManyToOne(targetEntity="MagicT\PadelReservatieBundle\Entity\ReservatieType", inversedBy="reservaties")
     * @ORM\JoinColumn(name="reservatie_type_id", referencedColumnName="id")
     * @MaxDepth(1)
     * @Expose
     */
    private $reservatieType;

    /**
     * @ORM\ManyToMany(targetEntity="MagicT\PadelUserBundle\Entity\PadelUser", inversedBy="reservatie", orphanRemoval=true, fetch="EAGER")
     * @ORM\JoinTable(
     *     name="ReservatieUsers",
     *     joinColumns={@ORM\JoinColumn(name="reservatie_id", referencedColumnName="id", nullable=false,onDelete="CASCADE")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="padel_user_id", referencedColumnName="id", nullable=false)}
     * )
     * @MaxDepth(2) 
     * @Expose
     */
    private $padelUser;

    public function __construct(){
        $this->dateCreated = new \DateTime("now");
        $this->padelUser = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * 
     */
    public function setCreatedAtValue()
    {
        $this->dateUpdated = new \DateTime("now");
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
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return Reservatie
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime 
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set dateUpdated
     *
     * @param \DateTime $dateUpdated
     * @return Reservatie
     */
    public function setDateUpdated($dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    /**
     * Get dateUpdated
     *
     * @return \DateTime 
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }

    

    /**
     * Set speler1
     *
     * @param integer $speler1
     * @return Reservatie
     */
    public function setSpeler1($speler1)
    {
        $this->speler1 = $speler1;

        return $this;
    }

    /**
     * Get speler1
     *
     * @return integer 
     */
    public function getSpeler1()
    {
        return $this->speler1;
    }

    /**
     * Set speler2
     *
     * @param string $speler2
     * @return Reservatie
     */
    public function setSpeler2($speler2)
    {
        $this->speler2 = $speler2;

        return $this;
    }

    /**
     * Get speler2
     *
     * @return string 
     */
    public function getSpeler2()
    {
        return $this->speler2;
    }

    /**
     * Set speler3
     *
     * @param string $speler3
     * @return Reservatie
     */
    public function setSpeler3($speler3)
    {
        $this->speler3 = $speler3;

        return $this;
    }

    /**
     * Get speler3
     *
     * @return string 
     */
    public function getSpeler3()
    {
        return $this->speler3;
    }

    /**
     * Set speler4
     *
     * @param string $speler4
     * @return Reservatie
     */
    public function setSpeler4($speler4)
    {
        $this->speler4 = $speler4;

        return $this;
    }

    /**
     * Get speler4
     *
     * @return string 
     */
    public function getSpeler4()
    {
        return $this->speler4;
    }

    /**
     * Set betaald
     *
     * @param boolean $betaald
     * @return Reservatie
     */
    public function setBetaald($betaald)
    {
        $this->betaald = $betaald;

        return $this;
    }

    /**
     * Get betaald
     *
     * @return boolean 
     */
    public function getBetaald()
    {
        return $this->betaald;
    }

    /**
     * Set datum
     *
     * @param \DateTime $datum
     * @return Reservatie
     */
    public function setDatum($datum)
    {
        $this->datum = $datum;

        return $this;
    }

    /**
     * Get datum
     *
     * @return \DateTime 
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * Set startuur
     *
     * @param \DateTime $startuur
     * @return Reservatie
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
     * Set veld
     *
     * @param \MagicT\PadelReservatieBundle\Entity\Veld $veld
     * @return Reservatie
     */
    public function setVeld(\MagicT\PadelReservatieBundle\Entity\Veld $veld = null)
    {
        $this->veld = $veld;

        return $this;
    }

    /**
     * Get veld
     *
     * @return \MagicT\PadelReservatieBundle\Entity\Veld 
     */
    public function getVeld()
    {
        return $this->veld;
    }

    /**
     * Set reservatieType
     *
     * @param \MagicT\PadelReservatieBundle\Entity\ReservatieType $reservatieType
     * @return Reservatie
     */
    public function setReservatieType(\MagicT\PadelReservatieBundle\Entity\ReservatieType $reservatieType = null)
    {
        $this->reservatieType = $reservatieType;

        return $this;
    }

    /**
     * Get reservatieType
     *
     * @return \MagicT\PadelReservatieBundle\Entity\ReservatieType 
     */
    public function getReservatieType()
    {
        return $this->reservatieType;
    }

    /**
     * Add padelUser
     *
     * @param \MagicT\PadelUserBundle\Entity\PadelUser $padelUser
     * @return Reservatie
     */
    public function addPadelUser(\MagicT\PadelUserBundle\Entity\PadelUser $padelUser)
    {
        $this->padelUser[] = $padelUser;

        return $this;
    }

    /**
     * Remove padelUser
     *
     * @param \MagicT\PadelUserBundle\Entity\PadelUser $padelUser
     */
    public function removePadelUser(\MagicT\PadelUserBundle\Entity\PadelUser $padelUser)
    {
        $this->padelUser->removeElement($padelUser);
    }

    /**
     * Get padelUser
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPadelUser()
    {
        return $this->padelUser;
    }

    /**
     * Set createdBy
     *
     * @param \MagicT\PadelUserBundle\Entity\PadelUser $createdBy
     * @return Reservatie
     */
    public function setCreatedBy(\MagicT\PadelUserBundle\Entity\PadelUser $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return \MagicT\PadelUserBundle\Entity\PadelUser 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }
}
