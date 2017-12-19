<?php
  
  class Blockchain {
    private $chain;
    private $difficulty;

    public function __construct() {
      $this->chain = [$this->initFirstBlock()];
      $this->difficulty = 4; // block is mined when the starting 4 numbers (specified difficulty) of the hash are zeros
    }
    
    public function initFirstBlock() {
      return new Block(0, time(), 'first data', '0');
    }

    public function getLastBlock() {
      return $this->chain[count($this->chain) - 1];
    }
      
    public function add($newblock) {
      $newblock->previousHash = $this->getLastBlock()->hash; // Set new block's previous hash as the current latest block
      $newblock->mineBlock($this->difficulty);
      array_push($this->chain, $newblock);
    }

      
    public function isBlockChainValid() {
      for ($i = 1; $i < count($this->chain); $i++) {
        $currentBlock = $this->chain[$i];
        $previousBlock = $this->chain[$i - 1];

        if ($currentBlock->hash !== $currentBlock->calculateHash()) {
          return false;
        }

        if ($currentBlock->previousHash !== $previousBlock->hash) {
          return false;
        }
      }
      return true;
    }
    
    
  }

?>
