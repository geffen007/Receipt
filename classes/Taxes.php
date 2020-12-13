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



trait Taxes
{
  public $net;
  public $taxes;
  public $total;

  //Se il prodotto si trova nell'array indicato da $types la tassazione è 0, 
  //modificabile in futuro aggiungendo altre voci o anche altre tassazioni con ifelse
  public function findTax($type){
    $types = ['books', 'food', 'medical'];
    if (in_array($type, $types)){
      return 0;
    } else {
      return 0.1;
    }
  }

  //Se il prodotto è importato restituisce , 
  //modificabile in futuro aggiungendo altre voci o anche altre tassazioni con ifelse
  public function imported($duty){
    if ($duty == 'true'){
      return 0.05;
    } else {
      return 0;
    }
  }
  
  //Richiamata nella classe Line e Receipt, salva in $net il totale progressivo del netto delle Line in Receipt
  public function addNet($net)
  {
    $this->net += $net;
    return $this->net;
  }

  //Richiamata nella classe Line e Receipt, salva in $taxes il totale progressivo delle tasse delle Line in Receipt
  public function addTaxes($taxes)
  {
    $this->taxes += $taxes;
    return $this->taxes;
  }

  public function addTotal($total)
  {
    $this->total += $total;
    return $this->total;
  }

  //creo le funzioni che mi serviranno per la stampa
  public function getNet()
  {
    return $this->net;
  }

  public function getTaxes()
  {
    return $this->taxes;
  }

  //Calcola e prende il totale
  public function getTotal()
  {
    return $this->total = $this->net + $this->taxes;
  }


}
