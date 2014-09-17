<?php
namespace Post2GoClient\Tests;

class TrackingTest extends Base
{

    public function testCreate()
    {
        $response = $this->getClient()->tracking()->create(self::USPS_SLUG, self::USPS_TRACKING_NUMBER);
        $this->assertInstanceOf('\Post2GoClient\Response\TrackingSimple', $response);
        $this->assertNotEmpty($response->getTracking());
        $track = $response->getTracking();
        $this->assertNotEmpty($track->getCourierSlug());
        $this->assertNotEmpty($track->getTrackingNumber());
    }

    public function testEdit()
    {
        $trackingRequest = new \Post2GoClient\Core\RequestParam\Tracking();
        $trackingRequest->setTitle('test edit title1');
        $response = $this->getClient()->tracking()->edit(self::USPS_SLUG, self::USPS_TRACKING_NUMBER, $trackingRequest);
        $this->assertInstanceOf('\Post2GoClient\Response\TrackingSimple', $response);
        $this->assertNotEmpty($response->getTracking());
        $track = $response->getTracking();
        $this->assertNotEmpty($track->getCourierSlug());
        $this->assertNotEmpty($track->getTrackingNumber());
    }

    public function testGet()
    {
        $response = $this->getClient()->tracking()->get(self::USPS_SLUG, self::USPS_TRACKING_NUMBER);
        $this->assertInstanceOf('\Post2GoClient\Response\Tracking', $response);
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

        $this->assertInstanceOf('\Post2GoClient\Response\TrackingSimple', $response);
        $this->assertNotEmpty($response->getTracking());
        $track = $response->getTracking();
        $this->assertNotEmpty($track->getCourierSlug());
        $this->assertNotEmpty($track->getTrackingNumber());
    }

    public function testDelete()
    {
        $response = $this->getClient()->tracking()->delete(self::USPS_SLUG, self::USPS_TRACKING_NUMBER);
        $this->assertInstanceOf('\Post2GoClient\Response\TrackingSimple', $response);
        $this->assertNotEmpty($response->getTracking());
        $track = $response->getTracking();
        $this->assertNotEmpty($track->getCourierSlug());
        $this->assertNotEmpty($track->getTrackingNumber());
        $this->createTrack();
    }

    /**
     * @expectedException \Post2GoClient\Exception\EmptyTrackingNumber
     * @throws \Post2GoClient\Exception\EmptyTrackingNumber
     */
    public function testGetEmptyTrackingNumber()
    {
        $this->getClient()->tracking()->get(self::USPS_SLUG, '');
    }

    /**
     * @expectedException \Post2GoClient\Exception\EmptySlug
     * @throws \Post2GoClient\Exception\EmptySlug
     */
    public function testGetEmptySlug()
    {
        $this->getClient()->tracking()->get('', '');
    }

    /**
     * @expectedException \Post2GoClient\Exception\EmptyTrackingNumber
     * @throws \Post2GoClient\Exception\EmptyTrackingNumber
     */
    public function testCreateEmptyTrackingNumber()
    {
        $this->getClient()->tracking()->create(self::USPS_SLUG, '');
    }

    /**
     * @expectedException \Post2GoClient\Exception\EmptySlug
     * @throws \Post2GoClient\Exception\EmptySlug
     */
    public function testCreateEmptySlug()
    {
        $this->getClient()->tracking()->create('', '');
    }

    /**
     * @expectedException \Post2GoClient\Exception\EmptyTrackingNumber
     * @throws \Post2GoClient\Exception\EmptyTrackingNumber
     */
    public function testReactivateEmptyTrackingNumber()
    {
        $this->getClient()->tracking()->reactivate(self::USPS_SLUG, '');
    }

    /**
     * @expectedException \Post2GoClient\Exception\EmptySlug
     * @throws \Post2GoClient\Exception\EmptySlug
     */
    public function testReactivateEmptySlug()
    {
        $this->getClient()->tracking()->reactivate('', '');
    }

}