<?php
  $key = 'f7457d9234d816aa44f4673e0c5983d4a4a7404e';
  
  class Block {
    private $idx;
    private $timestamp;
    private $data;
    private $nonce;
    public $previousHash;
    public $hash;
    
    public function __construct($idx, $timestamp, $data, $previousHash = '') {
      $this->idx = $idx;
      $this->timestamp = $timestamp;
      $this->data = $data;
      $this->previousHash = $previousHash;
      $this->nonce = 0;
      $this->hash = $this->calculateHash();
    }

    public function calculateHash() {
      $data = [
        'idx' => $this->idx,
        'previousHash' => $this->previousHash,
        'timestamp' => $this->timestamp,
        'data' => $this->data,
        'nonce' => $this->nonce
      ];
      $dataToString = serialize($data);
      $hashed = hash_hmac('sha256', $dataToString, $GLOBALS['key']);
      return $hashed;
    }

    public function mineBlock($difficulty) {
      print("Mining block...\n");
      while (substr($this->hash, 0, $difficulty) !== str_repeat('0', $difficulty)) {
        $this->nonce++;
        $this->hash = $this->calculateHash();
      }
      echo "BLOCK MINED!\n";
      print_r($this->hash."\n");
    }
  }
?>