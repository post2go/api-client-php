<?php
namespace ParcelGoClient\Tests;

class LastCheckpointTest extends Base
{

    public function testGet()
    {
        $response = $this->getClient()->lastCheckpoint()->get(self::USPS_SLUG, self::USPS_TRACKING_NUMBER);

        $this->assertInstanceOf('\ParcelGoClient\Response\LastCheckPoint', $response);
        $this->assertNotEmpty($response->getTrackingNumber(), 'tracking number field');
        $this->assertNotEmpty($response->getCourierSlug(), 'courierSlug field');
        $this->assertNotEmpty($response->getStatus(), 'status field');
        $this->assertNotEmpty($response->getCheckpoint(), 'checkpoint field');
        $checkpoint = ($response->getCheckpoint());
        $this->assertNotEmpty($checkpoint->getTime(), 'checkpoint -> time field');
        $this->assertNotEmpty($checkpoint->getStatus(), 'checkpoint -> status field');
        $this->assertThat(
            $checkpoint->getLocation(),
            $this->logicalOr(
                $this->logicalNot($this->isEmpty()),
                $this->isNull()
            ), 'checkpoint -> location field'
        );
        $this->assertThat(
            $checkpoint->getZipCode(),
            $this->logicalOr(
                $this->logicalNot($this->isEmpty()),
                $this->isNull()
            ), 'checkpoint -> zipCode field'
        );
        $this->assertNotEmpty($checkpoint->getCountryCode(), 'checkpoint -> countryCode field');
        $this->assertNotEmpty($checkpoint->getCourierSlug(), 'checkpoint -> courierSlug field');
        $this->assertThat(
            $checkpoint->getMessage(),
            $this->logicalOr(
                $this->logicalNot($this->isEmpty()),
                $this->isNull()
            ), 'checkpoint -> message field'
        );
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