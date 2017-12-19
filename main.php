<?php
  require('Block.php');
  require('Blockchain.php');
    
  $digitalCoin = new Blockchain();
  $digitalCoin->add(new Block(1, time(), [ 'amount' => 4.00 ] ));
  $digitalCoin->add(new Block(2, time(), [ 'amount' => 12.00 ] ));
?>
