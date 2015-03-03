<?php
namespace Post2GoClient\Tests;

class LastCheckpointTest extends Base
{

    public function testGet()
    {
        $response = $this->getClient()->lastCheckpoint()->get(self::USPS_SLUG, self::USPS_TRACKING_NUMBER);

        $this->assertInstanceOf('\Post2GoClient\Response\LastCheckPoint', $response);
        $this->assertNotEmpty($response->getTrackingNumber());
        $this->assertNotEmpty($response->getCourierSlug());
        $this->assertNotEmpty($response->getStatus());
        $this->assertNotEmpty($response->getCheckpoint());
        $checkpoint = ($response->getCheckpoint());
        $this->assertNotEmpty($checkpoint->getTime());
        $this->assertNotEmpty($checkpoint->getStatus());
        $this->assertNotEmpty($checkpoint->getCountryCode());
        $this->assertNotEmpty($checkpoint->getCourierSlug());
        $this->assertNotEmpty($checkpoint->getMessage());
    }

    /**
     * @expectedException \Post2GoClient\Exception\EmptyTrackingNumber
     * @throws \Post2GoClient\Exception\EmptyTrackingNumber
     */
    public function testGetEmptyTrackingNumber(){
         $this->getClient()->lastCheckpoint()->get(self::USPS_SLUG, '');
    }

    /**
     * @expectedException \Post2GoClient\Exception\EmptySlug
     * @throws \Post2GoClient\Exception\EmptySlug
     */
    public function testGetEmptySlug(){
        $this->getClient()->lastCheckpoint()->get('', '');
    }

}