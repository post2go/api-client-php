<?php
namespace ParcelGoClient\Tests;

class TrackingTest extends Base
{

    public function testCreate()
    {
        $response = $this->getClient()->tracking()->create(self::USPS_SLUG, self::USPS_TRACKING_NUMBER);
        $this->assertInstanceOf('\ParcelGoClient\Response\TrackingCreate', $response);
        $this->assertNotEmpty($response->getTracking());
        $track = $response->getTracking();
        $this->assertNotEmpty($track->getCourierSlug());
        $this->assertNotEmpty($track->getTrackingNumber());
    }

    public function testGet()
    {
        $response = $this->getClient()->tracking()->get(self::USPS_SLUG, self::USPS_TRACKING_NUMBER);
        $this->assertInstanceOf('\ParcelGoClient\Response\Tracking', $response);
        $this->assertNotEmpty($response->getTrackingNumber());
        $this->assertNotEmpty($response->getCourierSlug());
        $this->assertNotEmpty($response->isDelivered());
        $this->assertNotEmpty($response->getLastCheck());
        $this->assertInstanceOf('\DateTime', $response->getLastCheck());
        $this->assertNotEmpty($response->getCheckpoints());
        foreach ($response->getCheckpoints() as $checkpoints) {
            $this->assertNotEmpty($checkpoints->getTime());
            $this->assertNotEmpty($checkpoints->getStatus());
            $this->assertThat(
                $checkpoints->getLocation(),
                $this->logicalOr(
                    $this->logicalNot($this->isEmpty()),
                    $this->isNull()
                )
            );
            $this->assertThat(
                $checkpoints->getZipCode(),
                $this->logicalOr(
                    $this->logicalNot($this->isEmpty()),
                    $this->isNull()
                )
            );
            $this->assertNotEmpty($checkpoints->getCountryCode());
            $this->assertNotEmpty($checkpoints->getCourierSlug());
            $this->assertNotEmpty($checkpoints->getMessage());
        }
    }

    public function testReactivate()
    {
        $response = $this->getClient()->tracking()->reactivate(self::USPS_SLUG, self::USPS_TRACKING_NUMBER);

        $this->assertInstanceOf('\ParcelGoClient\Response\TrackingReactivate', $response);
        $this->assertNotEmpty($response->getCourierSlug());
        $this->assertNotEmpty($response->getTrackingNumber());
    }


    /**
     * @expectedException \ParcelGoClient\Exception\EmptyTrackingNumber
     * @throws \ParcelGoClient\Exception\EmptyTrackingNumber
     */
    public function testGetEmptyTrackingNumber()
    {
        $this->getClient()->tracking()->get(self::USPS_SLUG, '');
    }

    /**
     * @expectedException \ParcelGoClient\Exception\EmptySlug
     * @throws \ParcelGoClient\Exception\EmptySlug
     */
    public function testGetEmptySlug()
    {
        $this->getClient()->tracking()->get('', '');
    }

    /**
     * @expectedException \ParcelGoClient\Exception\EmptyTrackingNumber
     * @throws \ParcelGoClient\Exception\EmptyTrackingNumber
     */
    public function testCreateEmptyTrackingNumber()
    {
        $this->getClient()->tracking()->create(self::USPS_SLUG, '');
    }

    /**
     * @expectedException \ParcelGoClient\Exception\EmptySlug
     * @throws \ParcelGoClient\Exception\EmptySlug
     */
    public function testCreateEmptySlug()
    {
        $this->getClient()->tracking()->create('', '');
    }

    /**
     * @expectedException \ParcelGoClient\Exception\EmptyTrackingNumber
     * @throws \ParcelGoClient\Exception\EmptyTrackingNumber
     */
    public function testReactivateEmptyTrackingNumber()
    {
        $this->getClient()->tracking()->reactivate(self::USPS_SLUG, '');
    }

    /**
     * @expectedException \ParcelGoClient\Exception\EmptySlug
     * @throws \ParcelGoClient\Exception\EmptySlug
     */
    public function testReactivateEmptySlug()
    {
        $this->getClient()->tracking()->reactivate('', '');
    }

}