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

use PHPUnit\Framework\TestCase;

class ReceiptTest extends TestCase
{
  public function outputData()
  {
    return  [
      [
        [
          [ 2, 'book',                        12.49, 0.00, 0.00, 24.98, 0.00, 24.98 ],
          [ 1, 'music CD',                    14.99, 0.10, 0.00, 14.99, 1.50, 16.49 ],
          [ 1, 'chocolate bar',                0.85, 0.00, 0.00,  0.85, 0.00,  0.85 ]
        ],
        40.82, 1.50, 42.32
      ],
      [
        [
          [ 1, 'imported box of chocolates',  10.00, 0.00, 0.05, 10.00, 0.50, 10.50 ],
          [ 1, 'imported bottle of perfume',  47.50, 0.10, 0.05, 47.50, 7.15, 54.65 ]
        ],
        57.50, 7.65, 65.15
      ],
      [
        [
          [ 1, 'imported bottle of perfume',  27.99, 0.10, 0.05, 27.99, 4.20, 32.19 ],
          [ 1, 'bottle of perfume',           18.99, 0.10, 0.00, 18.99, 1.90, 20.89 ],
          [ 1, 'packet of headache pills',     9.75, 0.00, 0.00,  9.75, 0.00,  9.75 ],
          [ 3, 'box of imported chocolates',  11.25, 0.00, 0.05, 33.75, 1.80, 35.55 ]
        ],
        90.48, 7.90, 98.38
      ]
    ];
  }

  /**
  * @dataProvider outputData
  */

  public function testReceipt($lines, $net, $taxes, $total)
  {

    $receipt = new Receipt();

    foreach ($lines as $key => $line) 
    {

      $receiptLine = $receipt->addLine($line[0], $line[1], $line[2], $line[3], $line[4]);
      
      $this->assertSame($line[0], $receiptLine->getQuantity());
      $this->assertSame($line[1], $receiptLine->getProduct());
      
      $this->assertSame($line[5], $receiptLine->getNet());
      $this->assertSame($line[6], $receiptLine->getTaxes());
      $this->assertSame($line[7], $receiptLine->getTotal());
    }

    $this->assertSame($net, $receipt->getNet());
    $this->assertSame($taxes, $receipt->getTaxes());
    $this->assertSame($total, $receipt->getTotal());
  } 
}
