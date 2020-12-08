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

//includo il file inputs che uso come similare di un database
include __DIR__ .'/inputs.php';

// richiamo le classi e i trait che mi servono
require_once 'classes/Taxes.php';
require_once 'classes/Line.php';
require_once 'classes/Receipt.php';

//scorro il nostro database in modo da creare le istanze
foreach ($inputs as $key => $input) {

    // per ogni key creo una nuova istanza, in questo caso 3
    $receipt = new Receipt();
    
    //dichiaro un array vuoto, che si svuoterà ad ogni ciclo, dove salvare le linee della ricevuta
    $lines = [];

    //carico i dati per creare le nuove Receipt
    foreach ($input as $line) {
        $quantity = $line['quantity'];
        $productName = $line['product_name'];
        $price = $line['price'];
        $type = $line['type'] ;
        $duty = $line['imported'];
        $line = $receipt->addLine($quantity, $productName, $price, $type, $duty); 

        //pusho le singole linee nel array che si svuoterà
        $lines[] = $line;  
    }

    //salvo l'array in un array che conterrà tutte le voci delle ricevute divise per ricevute
    $receipts[$key] = $lines;

    //distruggo l'array che non mi serve più
    unset($lines);

    //salvo i totali in un altro array, uso $key per evitare che le chiavi non combacino con l'array delle voci  
    $totals[$key] = [
        'net' => $receipt->getNet(), 
        'taxes' => $receipt->getTaxes(), 
        'total' => $receipt->getTotal()
    ];
}

//Stampo il tutto
for ($i = 0; $i < count($inputs); $i++) {
    $rec = $receipts[$i];
   
    echo 'Output ' . ($i + 1) . ':' . "<br>";

    foreach ($rec as $line) {
        echo  $line->getQuantity() . " - " . $line->getProduct(). " - " . $line->getTotal() ."<br>";
    }
    echo 'Sales Taxes: '. $totals[$i]['taxes'] . '<br>';
    echo 'Total: '. $totals[$i]['total'];
    echo "<hr>";
}


