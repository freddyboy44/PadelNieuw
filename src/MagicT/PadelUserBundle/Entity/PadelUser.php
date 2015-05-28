<?php


namespace MagicT\PadelUserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Sonata\UserBundle\Entity\BaseUser as BaseUser;
use Sonata\UserBundle\Entity\BaseGroup as BaseGroup;
use MagicT\PadelUserBundle\Entity\PadelGroup;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;


/**
 * @ORM\Entity
 * @ORM\Table(name="padeluser",indexes={@ORM\Index(name="username_idx", columns={"username"})})
 * @ORM\Entity(repositoryClass="MagicT\PadelUserBundle\Entity\PadelUserRepository")
 * @ORM\HasLifecycleCallbacks()
 * @ExclusionPolicy("all") 
 */
class PadelUser extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    protected $id;

    /** 
     * @ORM\Column(type="string", length=255, nullable=true, name="facebook_id") */
    protected $facebook_id;

    /** 
     * @ORM\Column(type="string", length=255, nullable=true, name="facebook_access_token") */
    protected $facebook_access_token;

    /** 
     * @ORM\Column(type="string", length=255, nullable=true, name="google_id") */
    protected $google_id;

    /** 
     * @ORM\Column(type="string", length=255, nullable=true, name="google_access_token") */
    protected $google_access_token;

    /** 
     * @ORM\Column(type="string", length=255, nullable=true, name="adres") */
    protected $adres;
    /** 
     * @ORM\Column(type="string", length=255, nullable=true, name="huisnr") */
    protected $huisnr;
    /** 
     * @ORM\Column(type="integer", nullable=true, name="postcode") */
    protected $postcode;
    /** 
     * @ORM\Column(type="string", length=255, nullable=true, name="gemeente") */
    protected $gemeente;
    
    /** 
     * @ORM\Column(type="boolean", nullable=true, name="emailadres") */
    protected $actief;
    
    /** 
     * @ORM\Column(type="string", length=255, nullable=true, name="avatar") */
    protected $avatar;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Expose
     */
    private $Lidnummer;

    /**
     * @ORM\Column(type="date",nullable=true, name="LidTot")
     */
    protected $lidtot;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $Bevestigingscode;

    /**                                                 
     * @ORM\ManyToMany(targetEntity="PadelGroup")            
     * @ORM\JoinTable(name="padel_user_group")       
     */                                                 
    protected  $groups; 

    /**
     * @ORM\OneToMany(targetEntity="MagicT\PadelUserBundle\Entity\LidmaatschapTransactie", mappedBy="padelUser")
     */
    protected $lidmaatschapTransacties;


    

    public function __construct()
    {
        parent::__construct();
        $this->islid = $this->getIsLid();
        // your own logic
        
    }
    public function __toString()
    {
        return $this->firstname . " " . $this->lastname;
    }
    
    /**
     * @VirtualProperty
     */
    public function getVolledigeNaam(){
        return $this->firstname . " " . $this->lastname;
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
     * Set facebook_id
     *
     * @param string $facebookId
     * @return User
     */
    public function setFacebookId($facebookId)
    {
        $this->facebook_id = $facebookId;

        return $this;
    }

    /**
     * Get facebook_id
     *
     * @return string 
     */
    public function getFacebookId()
    {
        return $this->facebook_id;
    }

    /**
     * Set facebook_access_token
     *
     * @param string $facebookAccessToken
     * @return User
     */
    public function setFacebookAccessToken($facebookAccessToken)
    {
        $this->facebook_access_token = $facebookAccessToken;

        return $this;
    }

    /**
     * Get facebook_access_token
     *
     * @return string 
     */
    public function getFacebookAccessToken()
    {
        return $this->facebook_access_token;
    }

    /**
     * Set google_id
     *
     * @param string $googleId
     * @return User
     */
    public function setGoogleId($googleId)
    {
        $this->google_id = $googleId;

        return $this;
    }

    /**
     * Get google_id
     *
     * @return string 
     */
    public function getGoogleId()
    {
        return $this->google_id;
    }

    /**
     * Set google_access_token
     *
     * @param string $googleAccessToken
     * @return User
     */
    public function setGoogleAccessToken($googleAccessToken)
    {
        $this->google_access_token = $googleAccessToken;

        return $this;
    }

    /**
     * Get google_access_token
     *
     * @return string 
     */
    public function getGoogleAccessToken()
    {
        return $this->google_access_token;
    }

    

    /**
     * Set adres
     *
     * @param string $adres
     * @return User
     */
    public function setAdres($adres)
    {
        $this->adres = $adres;

        return $this;
    }

    /**
     * Get adres
     *
     * @return string 
     */
    public function getAdres()
    {
        return $this->adres;
    }

    /**
     * Set huisnr
     *
     * @param string $huisnr
     * @return User
     */
    public function setHuisnr($huisnr)
    {
        $this->huisnr = $huisnr;

        return $this;
    }

    /**
     * Get huisnr
     *
     * @return string 
     */
    public function getHuisnr()
    {
        return $this->huisnr;
    }

    /**
     * Set postcode
     *
     * @param integer $postcode
     * @return User
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return integer 
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * Set gemeente
     *
     * @param string $gemeente
     * @return User
     */
    public function setGemeente($gemeente)
    {
        $this->gemeente = $gemeente;

        return $this;
    }

    /**
     * Get gemeente
     *
     * @return string 
     */
    public function getGemeente()
    {
        return $this->gemeente;
    }

    

    

    /**
     * Set actief
     *
     * @param boolean $actief
     * @return User
     */
    public function setActief($actief)
    {
        $this->actief = $actief;

        return $this;
    }

    /**
     * Get actief
     *
     * @return boolean 
     */
    public function getActief()
    {
        return $this->actief;
    }

    

    /**
     * Set avatar
     *
     * @param string $avatar
     * @return PadelUser
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string 
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    

    /**
     * Set Lidnummer
     *
     * @param integer $lidnummer
     * @return PadelUser
     */
    public function setLidnummer($lidnummer)
    {
        $this->Lidnummer = $lidnummer;

        return $this;
    }

    /**
     * Get Lidnummer
     *
     * @return integer 
     */
    public function getLidnummer()
    {
        return $this->Lidnummer;
    }

    /**
     * Set Bevestigingscode
     *
     * @param string $bevestigingscode
     * @return PadelUser
     */
    public function setBevestigingscode($bevestigingscode)
    {
        $this->Bevestigingscode = $bevestigingscode;

        return $this;
    }

    /**
     * Get Bevestigingscode
     *
     * @return string 
     */
    public function getBevestigingscode()
    {
        return $this->Bevestigingscode;
    }

    
    /*
     * @ORM\postLoad
     */
    public function setIsLid()
    {
       
        $lidtot = $this->getLidTot();
        if($lidtot>new \DateTime()){
            return true;
        }else{
            return false;
        }
    }

    public function getDatumLidTot()
    {
        $transacties = $this->getLidmaatschapTransacties();

        foreach($transacties as $transactie) {
            $begindatum = $transactie->getDatumGeldig();

            //dump($transactie);
            
            $duur = $transactie->getLidmaatschap()->getPeriode();
            $lidtot = $begindatum->add(new \DateInterval($duur));
            return $lidtot;
        }
        
    }



    /**
     * Add lidmaatschapTransacties
     *
     * @param \MagicT\PadelUserBundle\Entity\LidmaatschapTransactie $lidmaatschapTransacties
     * @return PadelUser
     */
    public function addLidmaatschapTransacty(\MagicT\PadelUserBundle\Entity\LidmaatschapTransactie $lidmaatschapTransacties)
    {
        $this->lidmaatschapTransacties[] = $lidmaatschapTransacties;

        return $this;
    }

    /**
     * Remove lidmaatschapTransacties
     *
     * @param \MagicT\PadelUserBundle\Entity\LidmaatschapTransactie $lidmaatschapTransacties
     */
    public function removeLidmaatschapTransacty(\MagicT\PadelUserBundle\Entity\LidmaatschapTransactie $lidmaatschapTransacties)
    {
        $this->lidmaatschapTransacties->removeElement($lidmaatschapTransacties);
    }

    /**
     * Get lidmaatschapTransacties
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLidmaatschapTransacties()
    {
        return $this->lidmaatschapTransacties;
    }

    

    /**
     * Set lidtot
     *
     * @param \DateTime $lidtot
     * @return PadelUser
     */
    public function setLidtot($lidtot)
    {
        $this->lidtot = $lidtot;

        return $this;
    }

    /**
     * Get lidtot
     *
     * @return \DateTime 
     */
    public function getLidtot()
    {
        return $this->lidtot;
    }

    
}
