<?php

namespace PctmonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Site
 *
 * @ORM\Table(name="site")
 * @ORM\Entity(repositoryClass="PctmonBundle\Repository\SiteRepository")
 *
 */
class Site
{
    /**
     * Many Site have Many Destinatari
     * @ORM\ManyToMany(targetEntity="Destinatari", cascade={"persist"}, inversedBy="sites")
     * @ORM\JoinTable(name="site_destinataris")
     */
    private $destinataris;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=255)
     *@Assert\NotBlank()
     */
    private $text;

    /**
     * @var string
     *
     * @ORM\Column(name="nota", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $nota;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->destinataris = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set url
     *
     * @param string $url
     *
     * @return Site
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Site
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set nota
     *
     * @param string $nota
     *
     * @return Site
     */
    public function setNota($nota)
    {
        $this->nota = $nota;

        return $this;
    }

    /**
     * Get nota
     *
     * @return string
     */
    public function getNota()
    {
        return $this->nota;
    }

    /**
     * Add destinatari
     *
     * @param \PctmonBundle\Entity\Destinatari $destinatari
     *
     * @return Site
     */
    public function addDestinatari(\PctmonBundle\Entity\Destinatari $destinatari)
    {
        if (!$this->destinataris->contains($destinatari)) {

            $destinatari->addSite($this);
            $this->destinataris->add($destinatari);
        }

        return $this;
    }

    /**
     * Remove destinatari
     *
     * @param \PctmonBundle\Entity\Destinatari $destinatari
     */
    public function removeDestinatari(\PctmonBundle\Entity\Destinatari $destinatari)
    {
        $this->destinataris->removeElement($destinatari);
    }

    /**
     * Get destinataris
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDestinataris()
    {

        return $this->destinataris;
    }
    public function clearDestinataris(){
        $this->destinataris->clear();
    }

    public function getIp($url){
        return gethostbynamel($url);
    }



}
