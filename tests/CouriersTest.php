<?php
namespace ParcelGoClient\Tests;

class CourierTest extends Base
{

    public function testGet()
    {
        $response = $this->getClient()->couriers()->get();
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('meta', $response);
        $this->assertEquals(['code' => 200, 'message' => 'Success'], $response['meta']);
        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']);
        foreach ($response['data'] as $courier) {
            $this->assertArrayHasKey('slug', $courier);
            $this->assertArrayHasKey('name', $courier);
            $this->assertArrayHasKey('country_code', $courier);
        }


    }

    public function testDetect()
    {
        $response = $this->getClient()->couriers()->detect(self::USPS_TRACKING_NUMBER);
        $this->assertNotEmpty($response);
        $this->assertArrayHasKey('meta', $response);
        $this->assertEquals(['code' => 200, 'message' => 'Success'], $response['meta']);
        $this->assertArrayHasKey('total', $response['data']);
        $this->assertArrayHasKey('tracking_number', $response['data']);
        $this->assertArrayHasKey('couriers', $response['data']);
        $this->assertNotEmpty($response['data']);
        foreach ($response['data']['couriers'] as $courier) {
            $this->assertArrayHasKey('slug', $courier);
            $this->assertArrayHasKey('name', $courier);
            $this->assertArrayHasKey('country_code', $courier);
        }
    }

    /**
     * @expectedException \ParcelGoClient\Exception\EmptyTrackingNumber
     * @throws \ParcelGoClient\Exception\EmptyTrackingNumber
     */
    public function testDetectEmptyTrackingNumber(){
        $this->getClient()->couriers()->detect('');
    }


}