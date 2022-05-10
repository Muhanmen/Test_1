<?php
namespace NoSQL;

use Predis\Client;

class Redis implements Strategy
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }
    
    public function set($key, $value, $expire): void
    {
        $this->client->set($key, $value); 
        $this->client->expire($key, $expire);
    }  

    public function get($key)
    {
       return $this->client->get($key);
    }  

    public function getAll(): array
    {
       $keys = $this->client->keys('*');

       foreach ($keys as $value) {
         $datas[$value] = $this->client->get($value); 
       }

       return $datas;
    }  

    public function del($key): void
    {
       $this->client->del($key);
    }   
}