<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * User
 *
 * @ORM\Table(name="links")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LinksRepository")
 * @UniqueEntity(
 *     fields={"short_url"},
 *     message="Такаой short_url уже занят."
 * )
 */
class Links
{
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
     * @ORM\Column(name="url", type="text")
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="short_url", type="string")
     */
    private $short_url;

    /**
     * @param int $id
     * @return Links
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $url
     * @return Links
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $short_url
     * @return Links
     */
    public function setShortUrl($short_url)
    {
        $this->short_url = $short_url;
        return $this;
    }

    /**
     * @return string
     */
    public function getShortUrl()
    {
        return $this->short_url;
    }
}