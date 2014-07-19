<?php
namespace ParcelGoClient\Response\ValueObject;

class Courier
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $slug;


    /**
     * @param string $name
     * @param string $slug
     * @param string $countryCode
     */
    public function __construct($name, $slug, $countryCode)
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->countryCode = $countryCode;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

}