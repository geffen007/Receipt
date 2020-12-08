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

use PHPUnit\Framework\TestCase;

class LinesTest extends TestCase
{
    public function outputData()
    {

        return  [
            [ 2, 'book',                       12.49, 0.00, 0.00, 24.98, 0.00, 24.98 ],
            [ 1, 'music CD',                   14.99, 0.10, 0.00, 14.99, 1.50, 16.49 ],
            [ 1, 'chocolate bar',               0.85, 0.00, 0.00,  0.85, 0.00,  0.85 ],
            [ 1, 'imported box of chocolates', 10.00, 0.00, 0.05, 10.00, 0.50, 10.50 ],
            [ 1, 'imported bottle of perfume', 47.50, 0.10, 0.05, 47.50, 7.15, 54.65 ],
            [ 1, 'imported bottle of perfume', 27.99, 0.10, 0.05, 27.99, 4.20, 32.19 ],
            [ 1, 'bottle of perfume',          18.99, 0.10, 0.00, 18.99, 1.90, 20.89 ],
            [ 1, 'packet of headache pills',    9.75, 0.00, 0.00,  9.75, 0.00,  9.75 ],
            [ 3, 'box of imported chocolates', 11.25, 0.00, 0.05, 33.75, 1.80, 35.55 ]
        ];
    }

    /**
     * @dataProvider outputData
     */

    public function testLine($quantity, $description, $price, $salesTax, $dutyTax, $net, $taxes, $total) 
    {
        //Crea Line
        $receiptLine = new Line($quantity, $description, $price, $salesTax, $dutyTax);

        //Verifica che i valori di input corrispondano
        $this->assertSame($quantity, $receiptLine->getQuantity());
        $this->assertSame($description, $receiptLine->getProduct());

        //Verifa che le funzioni per i totali corrispondano
        $this->assertSame($net, $receiptLine->getNet());
        $this->assertSame($taxes, $receiptLine->getTaxes());
        $this->assertSame($total, $receiptLine->getTotal());
    }
}