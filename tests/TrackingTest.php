<?php
namespace ParcelGoClient\Tests;

class TrackingTest extends Base
{

    public function testCreate()
    {
        $response = $this->getClient()->tracking()->create(self::USPS_SLUG, self::USPS_TRACKING_NUMBER);
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('meta', $response);
        $this->assertArrayHasKey('data', $response);
        $this->assertArrayHasKey('tracking', $response['data']);
        $this->assertArrayHasKey('tracking_number', $response['data']['tracking']);
        $this->assertArrayHasKey('slug', $response['data']['tracking']);

    }

    public function testGet()
    {
        $response = $this->getClient()->tracking()->get(self::USPS_SLUG, self::USPS_TRACKING_NUMBER);
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('meta', $response);
        $this->assertEquals(array('code' => 200, 'message' => 'Success'), $response['meta']);
        $this->assertArrayHasKey('data', $response);
        $this->assertArrayHasKey('tracking', $response['data']);
        $this->assertArrayHasKey('tracking_number', $response['data']['tracking']);
        $this->assertArrayHasKey('courier_slug', $response['data']['tracking']);
        $this->assertArrayHasKey('is_active', $response['data']['tracking']);
        $this->assertArrayHasKey('is_delivered', $response['data']['tracking']);
        $this->assertArrayHasKey('last_check', $response['data']['tracking']);
        $this->assertArrayHasKey('checkpoints', $response['data']['tracking']);
        $this->assertNotEmpty($response['data']['tracking']['checkpoints']);
        foreach ($response['data']['tracking']['checkpoints'] as $checkpoints) {
            $this->assertArrayHasKey('checkpoint_time', $checkpoints);
            $this->assertArrayHasKey('status', $checkpoints);
            $this->assertArrayHasKey('location', $checkpoints);
            $this->assertArrayHasKey('zip_code', $checkpoints);
            $this->assertArrayHasKey('country_code', $checkpoints);
            $this->assertArrayHasKey('courier_slug', $checkpoints);
            $this->assertArrayHasKey('message', $checkpoints);
        }
    }

    public function testReactivate()
    {
        $response = $this->getClient()->tracking()->reactivate(self::USPS_SLUG, self::USPS_TRACKING_NUMBER);
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('meta', $response);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);

        $this->assertArrayHasKey('tracking_number', $response['data']);
        $this->assertArrayHasKey('courier_slug', $response['data']);
        $this->assertArrayHasKey('is_active', $response['data']);
    }


    /**
     * @expectedException \ParcelGoClient\Exception\EmptyTrackingNumber
     * @throws \ParcelGoClient\Exception\EmptyTrackingNumber
     */
    public function testGetEmptyTrackingNumber(){
        $this->getClient()->tracking()->get(self::USPS_SLUG, '');
    }

    /**
     * @expectedException \ParcelGoClient\Exception\EmptySlug
     * @throws \ParcelGoClient\Exception\EmptySlug
     */
    public function testGetEmptySlug(){
        $this->getClient()->tracking()->get('', '');
    }

    /**
     * @expectedException \ParcelGoClient\Exception\EmptyTrackingNumber
     * @throws \ParcelGoClient\Exception\EmptyTrackingNumber
     */
    public function testCreateEmptyTrackingNumber(){
        $this->getClient()->tracking()->create(self::USPS_SLUG, '');
    }

    /**
     * @expectedException \ParcelGoClient\Exception\EmptySlug
     * @throws \ParcelGoClient\Exception\EmptySlug
     */
    public function testCreateEmptySlug(){
        $this->getClient()->tracking()->create('', '');
    }

    /**
     * @expectedException \ParcelGoClient\Exception\EmptyTrackingNumber
     * @throws \ParcelGoClient\Exception\EmptyTrackingNumber
     */
    public function testReactivateEmptyTrackingNumber(){
        $this->getClient()->tracking()->reactivate(self::USPS_SLUG, '');
    }

    /**
     * @expectedException \ParcelGoClient\Exception\EmptySlug
     * @throws \ParcelGoClient\Exception\EmptySlug
     */
    public function testReactivateEmptySlug(){
        $this->getClient()->tracking()->reactivate('', '');
    }

}