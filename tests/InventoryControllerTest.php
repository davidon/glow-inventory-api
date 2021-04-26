<?php
declare(strict_types=1);

/**
 * Class InventoryControllerTest
 */
class InventoryControllerTest extends TestCase
{
    public function testCalculate()
    {

        $rawJson = <<<JSON
{
  "name": "Beetroot Dip",
  "ingredients": {
    "beetroot": 440,
    "cheese": 250,
    "mint": 1
  }
}
JSON;

        // create  http client (Guzzle)
        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://localhost:8000/api/inventory', [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => $rawJson
        ]);
        $resData = json_decode((string) $response->getBody());
        static::assertSame('Beetroot Dip', $resData->name);
        static::assertSame(530, $resData->cost);
    }
}
