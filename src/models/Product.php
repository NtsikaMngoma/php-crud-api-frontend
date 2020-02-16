<?php

require_once 'APIClient.php';

class Product
{
    var $BASE_URL;
    var $apiClient;

    function __construct()
    {
        $this->BASE_URL = "http://localhost:8083/v1/product/";
        $this->apiClient = new APIClient();
    }

    function findAll() {
        return $this->apiClient->call('GET', $this->BASE_URL.'/');
    }

    function find($id) {
        return $this->apiClient->call('GET', $this->BASE_URL.'find/'.$id);
    }

    function create($product = array()) {
        return $this->apiClient->call('POST', $this->BASE_URL.'create', $product);
    }

    function update($product = array()) {
        return $this->apiClient->call('PUT', $this->BASE_URL.'update', $product);
    }

    function delete($id) {
        return $this->apiClient->call('DELETE', $this->BASE_URL.'delete'.$id);
    }


}