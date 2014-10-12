<?php
namespace Post2GoClient\Response\ValueObject;

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
     * @var string
     */
    private $countryCode;

    /**
     * @var string
     */
    private $normalizedTrackingNumber;

    /**
     * @param $name
     * @param $slug
     * @param $countryCode
     * @param string $tracking
     */
    public function __construct($name, $slug, $countryCode, $tracking = '')
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->countryCode = $countryCode;
        $this->normalizedTrackingNumber = $tracking;
    }

    /**
     * @return string
     */
    public function getNormalizedTrackingNumber()
    {
        return $this->normalizedTrackingNumber;
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