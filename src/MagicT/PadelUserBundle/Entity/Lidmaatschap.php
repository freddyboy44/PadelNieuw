<?php
namespace MagicT\PadelUserBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 */
class Lidmaatschap
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true, length=255, nullable=true)
     */
    private $Naam;

    /**
     * @ORM\Column(type="boolean", nullable=true, options={"default":1})
     */
    private $Zichtbaar;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $Periode;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Uitleg;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Prijs;

    /**
     * @ORM\OneToMany(targetEntity="MagicT\PadelUserBundle\Entity\LidmaatschapTransactie", mappedBy="lidmaatschap")
     */
    private $lidmaatschapTransactie;
    /**
     * Constructor
     */
    
    public function __construct()
    {
        $this->lidmaatschapTransactie = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {   
        return $this->Naam;
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
     * @return Lidmaatschap
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
     * Set Zichtbaar
     *
     * @param boolean $zichtbaar
     * @return Lidmaatschap
     */
    public function setZichtbaar($zichtbaar)
    {
        $this->Zichtbaar = $zichtbaar;

        return $this;
    }

    /**
     * Get Zichtbaar
     *
     * @return boolean 
     */
    public function getZichtbaar()
    {
        return $this->Zichtbaar;
    }

    /**
     * Set Periode
     *
     * @param string $periode
     * @return Lidmaatschap
     */
    public function setPeriode($periode)
    {
        $this->Periode = $periode;

        return $this;
    }

    /**
     * Get Periode
     *
     * @return string 
     */
    public function getPeriode()
    {
        return $this->Periode;
    }

    /**
     * Set Uitleg
     *
     * @param string $uitleg
     * @return Lidmaatschap
     */
    public function setUitleg($uitleg)
    {
        $this->Uitleg = $uitleg;

        return $this;
    }

    /**
     * Get Uitleg
     *
     * @return string 
     */
    public function getUitleg()
    {
        return $this->Uitleg;
    }

    /**
     * Add lidmaatschapTransactie
     *
     * @param \MagicT\PadelUserBundle\Entity\LidmaatschapTransactie $lidmaatschapTransactie
     * @return Lidmaatschap
     */
    public function addLidmaatschapTransactie(\MagicT\PadelUserBundle\Entity\LidmaatschapTransactie $lidmaatschapTransactie)
    {
        $this->lidmaatschapTransactie[] = $lidmaatschapTransactie;

        return $this;
    }

    /**
     * Remove lidmaatschapTransactie
     *
     * @param \MagicT\PadelUserBundle\Entity\LidmaatschapTransactie $lidmaatschapTransactie
     */
    public function removeLidmaatschapTransactie(\MagicT\PadelUserBundle\Entity\LidmaatschapTransactie $lidmaatschapTransactie)
    {
        $this->lidmaatschapTransactie->removeElement($lidmaatschapTransactie);
    }

    /**
     * Get lidmaatschapTransactie
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLidmaatschapTransactie()
    {
        return $this->lidmaatschapTransactie;
    }

    /**
     * Set Prijs
     *
     * @param float $prijs
     * @return Lidmaatschap
     */
    public function setPrijs($prijs)
    {
        $this->Prijs = $prijs;

        return $this;
    }

    /**
     * Get Prijs
     *
     * @return float 
     */
    public function getPrijs()
    {
        return $this->Prijs;
    }
}
