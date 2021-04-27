<?php
declare(strict_types=1);

/**
 * Class InventoryControllerTest
 */
class InventoryControllerTest extends TestCase
{
    /**
     * Test calculate api endpoint.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
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

        $resData = $this->requestCalculate($rawJson);
        static::assertSame('Beetroot Dip', $resData->name);
        static::assertSame(530, $resData->cost);
    }

    /**
     * Test calculation with non-existing nutrition in the recipe.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testCalculateWithNonExistingNutrition()
    {

        $rawJson = <<<JSON
{
  "name": "Beetroot Dip",
  "ingredients": {
    "beetroot": 440,
    "cheese": 250,
    "mint": 1,
    "non-existing": 10
  }
}
JSON;

        $resData = $this->requestCalculate($rawJson);
        static::assertSame('Beetroot Dip', $resData->name);
        static::assertSame(530, $resData->cost);
    }

    /**
     * Test calculation when nutrition of the recipe is less than the ingredients of DB.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testCalculateWithLessNutrition()
    {

        $rawJson = <<<JSON
{
  "name": "Beetroot Dip",
  "ingredients": {
    "beetroot": 440,
    "cheese": 250
  }
}
JSON;

        $resData = $this->requestCalculate($rawJson);
        static::assertSame('Beetroot Dip', $resData->name);
        // 350
        static::assertSame((float) (440*(520/1760)+250*(660/750)), (float) $resData->cost);
    }

    /**
     * Request to calculate API endpoint and get response.
     *
     * @param string $rawJson
     *
     * @return mixed
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function requestCalculate(string $rawJson)
    {
        // create  http client (Guzzle)
        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://localhost:8000/api/inventory', [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => $rawJson
        ]);
        return json_decode((string) $response->getBody());
    }
}
