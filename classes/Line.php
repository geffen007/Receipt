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

class Line
{
  //Uso il trait Taxes
  use Taxes;

  //Dichiaro le variabili che mi servono per creare la classe
  private $quantity ;
  private $productName ;
  private $price;
  private $salesTax;
  private $dutyTax;


  //costruttore a cui passo le variabili dell'input
  public function __construct($_quantity, $_productName, $_price, $_type, $_duty)
  {
    //variabili uguali all'input
    $this->quantity = $_quantity;
    $this->productName = $_productName;
    $this->price = $_price;

    //usando le funzioni del trait taxes mi trovo le tassazioni e i totali
    $this->salesTax = $this->findTax($_type);
    $this->dutyTax = $this->imported($_duty);
    $this->addNet($this->quantity * $this->price);
    $this->addTaxes($this->computeTaxes($this->quantity, $this->price, $this->salesTax, $this->dutyTax));
    $this->getTotal();

    
  }

  //creo le funzioni che mi serviranno per la stampa
  public function getQuantity()
  {
    return $this->quantity;
  }

  public function getProduct()
  {
    return $this->productName;
  }

  //Calcola la tassa arrotondando allo 0.05 superiore più vicino di un singolo
  //prodotto e lo calcola per la quantità, ottenendo il totale
  public function computeTaxes($quantity, $net, $salesTax, $dutyTax)
  {
    return (ceil(($net * ($salesTax + $dutyTax)) / 0.05) * 0.05) * $quantity;
  }
}