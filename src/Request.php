<?php

namespace U89Man\TBot;

use U89Man\TBot\Entities\Response;
use U89Man\TBot\Exceptions\CurlException;
use U89Man\TBot\Exceptions\JsonException;
use U89Man\TBot\Exceptions\ResponseException;

class Request
{
    /**
     * Экземпляр cUrl.
     *
     * @var resource
     */
    protected $curl;

    /**
     * Опции cUrl.
     *
     * @var array
     */
    protected $options = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_CONNECTTIMEOUT => 5,
        CURLOPT_POST => null,
        CURLOPT_POSTFIELDS => null
    ];


    /**
     * Конструктор.
     *
     * @param string $url
     * @param array $data
     */
    public function __construct($url, array $data = array())
    {
        $this->options[CURLOPT_URL] = $url;

        $data = $this->clearData($data);

        if ($data) {
            $this->options = array_replace($this->options, [
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $data
            ]);
        }
    }

    /**
     * Очищает данные от пустых значений.
     *
     * @param array $data
     *
     * @return array
     */
    protected function clearData(array $data)
    {
        foreach ($data as $k => $v) {
            if ($v == null) {
                unset($data[$k]);
            } else {
                if (is_array($v)) {
                    $data[$k] = $this->clearData($v);
                }
            }
        }

        return $data;
    }

    /**
     * Отправляет запрос на сервер телеграм.
     *
     * @return Response
     */
    public function send()
    {
        $this->curl = curl_init();

        if ($this->curl === false) {
            throw new CurlException('Ошибка инициализации cUrl.');
        }

        curl_setopt_array($this->curl, $this->options);

        $json = curl_exec($this->curl);

        if ($json === false) {
            throw new CurlException(curl_error($this->curl), curl_errno($this->curl));
        }

        $data = json_decode($json, true);

        if (json_last_error()) {
            throw new JsonException(json_last_error_msg(), json_last_error());
        }

        $response = new Response($data);

        if (! $response->getOk()) {
            throw new ResponseException($response);
        }

        return $response;
    }

    /**
     * Деструктор.
     */
    public function __destruct()
    {
        if ($this->curl) {
            curl_close($this->curl);
        }
    }
}
