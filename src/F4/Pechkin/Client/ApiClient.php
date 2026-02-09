<?php

declare(strict_types=1);

namespace F4\Pechkin\Client;

// Documentation: https://core.telegram.org/bots/api

use Throwable,
    F4\Pechkin\Client\ClientException,
    GuzzleHttp\Client as Guzzle,
    GuzzleHttp\Exception\RequestException
;
use function
    array_filter,
    array_map,
    is_array,
    json_decode,
    sprintf
;

class ApiClient
{
    protected const string BASE_URL = 'https://api.telegram.org/bot';
    protected const string API_VERSION = '9.3';
    protected const int REQUEST_TIMEOUT = 60;

    public function __construct(protected readonly string $token) {}

    // strip null values by default
    protected static function convertToArray(mixed $value): mixed
    {
        return match (true) {
            $value instanceof AbstractDataType => $value->toArray(compact: true),
            is_array($value) => array_filter(
                array: array_map(
                    array: $value,
                    callback: self::convertToArray(...),
                ),
                callback: fn(mixed $item): bool => $item !== null,
            ),
            default => $value,
        };
    }
    // todo: file uploading, according to the docs (https://core.telegram.org/bots/api#making-requests) must use multipart/form-data
    public function sendJsonRequest(string $method, array $parameters = []): mixed
    {
        $requestMethod = 'POST';
        $requestURL = sprintf(self::BASE_URL . '%s/%s', $this->token, $method);
        $requestOptions = [
            'connect_timeout' => static::REQUEST_TIMEOUT,
            'headers' => [
                'Content-Type' => 'application/json; charset=utf-8',
            ],
            'json' => self::convertToArray($parameters),
        ];
        try {
            $clientResponse = new Guzzle()->request($requestMethod, $requestURL, $requestOptions);
            $responseBody = json_decode((string) $clientResponse->getBody(), true, JSON_THROW_ON_ERROR);
            return match ($responseBody['ok'] ?? false) {
                true => $responseBody['result'],
                false => throw new ClientException(
                    message: $responseBody['description'] ?? 'Uknown error',
                    code: $responseBody['error_code'] ?? 500,
                ),
            };
        }
        catch (RequestException $e) {
            if($e->hasResponse()) {
                // extract full error message
                throw new ClientException(message: $e->getResponse()->getBody()->getContents(), code: $e->getcode(), previous: $e);
            }
            throw new ClientException(message: $e->getMessage(), code: $e->getcode(), previous: $e);
        }
        catch (Throwable $e) {
            throw new ClientException(message: $e->getMessage(), code: $e->getcode(), previous: $e);
        }
    }

}
