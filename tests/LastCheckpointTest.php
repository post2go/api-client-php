<?php
namespace ParcelGoClient\Tests;

class LastCheckpointTest extends Base
{

    public function testGet()
    {
        $response = $this->getClient()->lastCheckpoint()->get(self::USPS_SLUG, self::USPS_TRACKING_NUMBER);
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('meta', $response);
        $this->assertEquals(['code' => 200, 'message' => 'Success'], $response['meta']);
        $this->assertArrayHasKey('tracking_number', $response['data']);
        $this->assertArrayHasKey('courier_slug', $response['data']);
        $this->assertArrayHasKey('status', $response['data']);
        $this->assertArrayHasKey('checkpoint', $response['data']);
        $this->assertArrayHasKey('checkpoint_time', $response['data']['checkpoint']);
        $this->assertArrayHasKey('status', $response['data']['checkpoint']);
        $this->assertArrayHasKey('location', $response['data']['checkpoint']);
        $this->assertArrayHasKey('zip_code', $response['data']['checkpoint']);
        $this->assertArrayHasKey('country_code', $response['data']['checkpoint']);
        $this->assertArrayHasKey('courier_slug', $response['data']['checkpoint']);
        $this->assertArrayHasKey('message', $response['data']['checkpoint']);
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