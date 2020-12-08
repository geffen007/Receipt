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

class Receipt

{
  //Uso il trait Taxes
  use Taxes;

  //Dichiaro la variabile $lines che conterrà tutte le voci della ricevuta
  public $lines;
  
  //creo una funzione che aggiunge le singole linee all'array $lines
  public function addLine($quantity, $productName, $price, $type, $duty)
  {
    $line = new Line($quantity, $productName, $price, $type, $duty);
    $this->lines[] = $line;

    //in  contemporanea aggiungo progressivamente il netto, le tasse e il totale 
    $this->net = $this->addNet($line->getNet());
    $this->addTaxes($line->getTaxes());
    $this->addTotal($line->getTotal());
    
    //Ritorna la linea che mi servirà per la stampa
    return $line;
  }

}
