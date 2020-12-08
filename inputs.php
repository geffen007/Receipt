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

$inputs = 
[
  [
    [
      'quantity' => 2,
      'product_name' => 'book',
      'price' => 12.49,
      'type' => 'books',
      'imported' => false
    ],
    [
      'quantity' => 1,
      'product_name' => 'music CD',
      'price' => 14.99,
      'type' => 'item',
      'imported' => false
    ],
    [
      'quantity' => 1,
      'product_name' => 'chocolate bar',
      'price' => 0.85,
      'type' => 'food',
      'imported' => false
    ]
  ],
  [
     [
      'quantity' => 1,
      'product_name' => 'imported box of chocolates',
      'price' => 10.00,
      'type' => 'food',
      'imported' => true
    ],
    [
      'quantity' => 1,
      'product_name' => 'imported bottle of perfume',
      'price' => 47.50,
      'type' => 'item',
      'imported' => true
    ]
  ],

  [
     [
      'quantity' => 1,
      'product_name' => 'imported bottle of perfume',
      'price' => 27.99,
      'type' => 'item',
      'imported' => true
    ],
    [
      'quantity' => 1,
      'product_name' => 'bottle of perfume',
      'price' =>  18.99,
      'type' => 'item',
      'imported' => false
    ],
    [
      'quantity' => 1,
      'product_name' => 'packet of headache pills',
      'price' => 9.75,
      'type' => 'medical',
      'imported' => false
    ],
    [
      'quantity' => 3,
      'product_name' => 'imported box of chocolates',
      'price' => 11.25,
      'type' => 'food',
      'imported' => true
    ]
  ]
];

return $inputs;