<?php
namespace MagicT\PadelUserBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class LidmaatschapTransactie
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $userCreated;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $DatumGeldig;

    /**
     * @ORM\Column(type="boolean", nullable=true, options={"default":0})
     */
    private $Betaald;

    /**
     * @ORM\ManyToOne(targetEntity="MagicT\PadelUserBundle\Entity\Lidmaatschap", inversedBy="lidmaatschapTransactie")
     * @ORM\JoinColumn(name="lidmaatschap_id", referencedColumnName="id")
     */
    private $lidmaatschap;

    /**
     * @ORM\ManyToOne(targetEntity="MagicT\PadelUserBundle\Entity\PadelUser", inversedBy="lidmaatschapTransactie")
     * @ORM\JoinColumn(name="padel_user_id", referencedColumnName="id")
     */
    private $padelUser;

    public function __construct()
    {
        $this->setDateCreated(new \DateTime());
        
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
     * @return LidmaatschapTransactie
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
     * Set userCreated
     *
     * @param integer $userCreated
     * @return LidmaatschapTransactie
     */
    public function setUserCreated($userCreated)
    {
        $this->userCreated = $userCreated;

        return $this;
    }

    /**
     * Get userCreated
     *
     * @return integer 
     */
    public function getUserCreated()
    {
        return $this->userCreated;
    }

    /**
     * Set DatumGeldig
     *
     * @param \DateTime $datumGeldig
     * @return LidmaatschapTransactie
     */
    public function setDatumGeldig($datumGeldig)
    {
        $this->DatumGeldig = $datumGeldig;

        return $this;
    }

    /**
     * Get DatumGeldig
     *
     * @return \DateTime 
     */
    public function getDatumGeldig()
    {
        return $this->DatumGeldig;
    }

    /**
     * Set Betaald
     *
     * @param boolean $betaald
     * @return LidmaatschapTransactie
     */
    public function setBetaald($betaald)
    {
        $this->Betaald = $betaald;

        return $this;
    }

    /**
     * Get Betaald
     *
     * @return boolean 
     */
    public function getBetaald()
    {
        return $this->Betaald;
    }

    /**
     * Set lidmaatschap
     *
     * @param \MagicT\PadelUserBundle\Entity\Lidmaatschap $lidmaatschap
     * @return LidmaatschapTransactie
     */
    public function setLidmaatschap(\MagicT\PadelUserBundle\Entity\Lidmaatschap $lidmaatschap = null)
    {
        $this->lidmaatschap = $lidmaatschap;

        return $this;
    }

    /**
     * Get lidmaatschap
     *
     * @return \MagicT\PadelUserBundle\Entity\Lidmaatschap 
     */
    public function getLidmaatschap()
    {
        return $this->lidmaatschap;
    }

    /**
     * Set padelUser
     *
     * @param \MagicT\PadelUserBundle\Entity\PadelUser $padelUser
     * @return LidmaatschapTransactie
     */
    public function setPadelUser(\MagicT\PadelUserBundle\Entity\PadelUser $padelUser = null)
    {
        $this->padelUser = $padelUser;

        return $this;
    }

    /**
     * Get padelUser
     *
     * @return \MagicT\PadelUserBundle\Entity\PadelUser 
     */
    public function getPadelUser()
    {
        return $this->padelUser;
    }
}
