<?php

/** @license
 *  Copyright 2020 Guido Amodio
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *    http://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 */

require_once 'classes/Taxes.php';
require_once 'classes/Line.php';
require_once 'classes/Receipt.php';

if (empty($_POST['quantity'])){
  echo ('Non hai inserito nessun campo, ricontrolla');
  exit();
};

$quantity = $_POST['quantity'];
$productName = $_POST['productName'];
$price = $_POST['price'];
$type = $_POST['type'];
$duty = $_POST['duty'];


$inputs;

for ($i = 0; $i < count($productName); $i++) {
  $inputs[$i] =     [
    'quantity' => $quantity[$i],
    'product_name' => $productName[$i],
    'price' => $price[$i],
    'type' => $type[$i],
    'imported' => $duty[$i]
  ];
};

$lines = [];
$receipt = new Receipt();

foreach ($inputs as $line) {
  $quantity = $line['quantity'];
  $productName = $line['product_name'];
  $price = $line['price'];
  $type = $line['type'] ;
  $duty = $line['imported'];
  $line = $receipt->addLine($quantity, $productName, $price, $type, $duty); 
  $lines[] = $line;  
}

$receipts[$i]= $lines;

unset($lines);

$totals = [
  'net' => $receipt->getNet(), 
  'taxes' => $receipt->getTaxes(), 
  'total' => $receipt->getTotal()
];

$rec = $receipts[$i];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/receipt.css">
  <title>Scontrino</title>
</head>
<body>
  <div class="container">
    <h4>Reviva Test</h4>
    <p>------------------------</p>
    <p>Scontrino n. <?php echo rand(1, 100) ?></p>
    <p><?php echo date("m.d.y  g:i a")  ?></p>
    <p>------------------------</p>
    <div class="acquisti">
      <table>
        <?php foreach ($rec as $line) {?>
        <tr>
          <td>x<?php echo $line->getQuantity()?></td>
          <td><?php echo $line->getProduct()?></td>
          <td class="tot"><?php echo number_format($line->getTotal(), 2); }?></td>
        </tr>
      </table>
      <p class="right p">Tasse: <span class="tot"><?php echo number_format($totals['taxes'], 2) ?></span> </p>
      <p class="right">TOTALE: <span class="tot"><?php echo number_format($totals['total'], 2) ?></span> </p>
      <p>------------------------</p>
      <p>ARRIVEDERCI E BUONA GIORNATA</p>

    </div>

  </div> 
  
</body>
</html>