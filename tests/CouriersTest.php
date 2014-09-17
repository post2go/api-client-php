<?php
namespace Post2GoClient\Tests;

class CourierTest extends Base
{

    public function testGet()
    {
        $response = $this->getClient()->couriers()->get();
        $this->assertInstanceOf('\Post2GoClient\Response\Couriers', $response);
        $this->assertNotEmpty($response->getCouriers());
        foreach ($response->getCouriers() as $couriers) {
            $this->assertNotEmpty($couriers->getName());
            $this->assertNotEmpty($couriers->getSlug());
            $this->assertNotEmpty($couriers->getCountryCode());
        }
    }

    public function testDetect()
    {
        $response = $this->getClient()->couriers()->detect(self::USPS_TRACKING_NUMBER);
        $this->assertInstanceOf('\Post2GoClient\Response\CourierDetect', $response);
        $this->assertNotEmpty($response->getTotal());
        $this->assertNotEmpty($response->getTrackingNumber());
        $this->assertNotEmpty($response->getCouriers());
        foreach ($response->getCouriers() as $couriers) {
            $this->assertNotEmpty($couriers->getName());
            $this->assertNotEmpty($couriers->getSlug());
            $this->assertNotEmpty($couriers->getCountryCode());
        }
    }

    /**
     * @expectedException \Post2GoClient\Exception\EmptyTrackingNumber
     * @throws \Post2GoClient\Exception\EmptyTrackingNumber
     */
    public function testDetectEmptyTrackingNumber(){
        $this->getClient()->couriers()->detect('');
    }


}