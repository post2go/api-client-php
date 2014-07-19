<?php
namespace ParcelGoClient\Tests;

class LastCheckpointTest extends Base
{

    public function testGet()
    {
        $response = $this->getClient()->lastCheckpoint()->get(self::USPS_SLUG, self::USPS_TRACKING_NUMBER);

        $this->assertInstanceOf('\ParcelGoClient\Response\LastCheckPoint', $response);
        $this->assertNotEmpty($response->getTrackingNumber());
        $this->assertNotEmpty($response->getCourierSlug());
        $this->assertNotEmpty($response->getStatus());
        $this->assertNotEmpty($response->getCheckpoint());
        $checkpoint = ($response->getCheckpoint());
        $this->assertNotEmpty($checkpoint->getTime());
        $this->assertNotEmpty($checkpoint->getStatus());
        $this->assertThat(
            $checkpoint->getLocation(),
            $this->logicalOr(
                $this->logicalNot($this->isEmpty()),
                $this->isNull()
            )
        );
        $this->assertThat(
            $checkpoint->getZipCode(),
            $this->logicalOr(
                $this->logicalNot($this->isEmpty()),
                $this->isNull()
            )
        );
        $this->assertNotEmpty($checkpoint->getCountryCode());
        $this->assertNotEmpty($checkpoint->getCourierSlug());
        $this->assertNotEmpty($checkpoint->getMessage());
    }

    /**
     * @expectedException \ParcelGoClient\Exception\EmptyTrackingNumber
     * @throws \ParcelGoClient\Exception\EmptyTrackingNumber
     */
    public function testGetEmptyTrackingNumber(){
         $this->getClient()->lastCheckpoint()->get(self::USPS_SLUG, '');
    }

    /**
     * @expectedException \ParcelGoClient\Exception\EmptySlug
     * @throws \ParcelGoClient\Exception\EmptySlug
     */
    public function testGetEmptySlug(){
        $this->getClient()->lastCheckpoint()->get('', '');
    }

}