<?php
namespace Post2GoClient\Tests;

use Post2GoClient\Core\RequestParam\Tracking;

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

    public function testCreateWithData()
    {
        $trackingData = array(
            'title' => 'Test parcel title',
            'orderCode' => '#123DCV',
            'orderUrl' => 'http://my-store.com/order/123DCV',
            'customerName' => 'Obi Van',
            'emails' => array('user1@my-store.com', 'user2@my-store.com'),
        );
        $tracking = new Tracking();
        $tracking->setTitle($trackingData['title']);
        $tracking->setOrderCode($trackingData['orderCode']);
        $tracking->setOrderUrl($trackingData['orderUrl']);
        $tracking->setCustomerName($trackingData['customerName']);
        $tracking->setEmails($trackingData['emails']);

        $response = $this->getClient()->tracking()->create(self::USPS_SLUG, self::USPS_TRACKING_NUMBER);
        $this->assertInstanceOf('\Post2GoClient\Response\TrackingSimple', $response);
        $this->assertNotEmpty($response->getTracking());
        $track = $response->getTracking();
        $this->assertNotEmpty($track->getCourierSlug());
        $this->assertNotEmpty($track->getTrackingNumber());
    }

    public function testEdit()
    {
        $trackingData = array(
            'title' => 'Test parcel title',
            'orderCode' => '#123DCV',
            'orderUrl' => 'http://my-store.com/order/123DCV',
            'customerName' => 'Obi Van',
            'emails' => array('user1@my-store.com', 'user2@my-store.com'),
        );

        $tracking = new \Post2GoClient\Core\RequestParam\Tracking();
        $tracking->setTitle($trackingData['title']);
        $tracking->setOrderCode($trackingData['orderCode']);
        $tracking->setOrderUrl($trackingData['orderUrl']);
        $tracking->setCustomerName($trackingData['customerName']);
        $tracking->setEmails($trackingData['emails']);

        $this->assertEquals($trackingData, $tracking->toArray());

        $response = $this->getClient()->tracking()->edit(self::USPS_SLUG, self::USPS_TRACKING_NUMBER, $tracking);
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