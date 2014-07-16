<?php
namespace ParcelGoClient\Response\ValueObject;

class Courier
{
    private $name;
    private $slug;


    /**
     * @param $name
     * @param $slug
     * @param $countryCode
     */
    public function __construct($name, $slug, $countryCode)
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->countryCode = $countryCode;
    }

    /**
     * @return mixed
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }


}