// ** @license 
// *  Copyright 2020 Guido Amodio
// *
// *  Licensed under the Apache License, Version 2.0 (the "License");
// *  you may not use this file except in compliance with the License.
// *  You may obtain a copy of the License at1
// *
// *    http://www.apache.org/licenses/LICENSE-2.0
// *
// *  Unless required by applicable law or agreed to in writing, software
// *  distributed under the License is distributed on an "AS IS" BASIS,
// *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// *  See the License for the specific language governing permissions and
// *  limitations under the License.
// */


$(document).ready(function() {
  
  // validazione dei campi e creazione della linea all'evento desiderato
  $('#addvoice').on('click',function(){

    if(!$('#i-name').val() || isNaN($('#i-quantity').val()) || isNaN($('#i-price').val()) || !$('#i-type').val()){
      if(!$('#i-name').val()){
        alert("Devi inserire il nome")
      }
      if(isNaN($('#i-quantity').val()) || !$('#i-quantity').val()){
        alert("Devi inserire la quantità e dev'essere un numero")
      } 
      if(isNaN($('#i-price').val()) || !$('#i-price').val()){
        alert("Devi inserire il prezzo e dev'essere un numero")
      }
      if(!$('#i-type').val()){
        alert("Devi inserire la tipologia")
      }
    } else {
      create_line();
    }
  });

  // svuotamento dei dati in anteprima e del form da inviare
  $('#delete').on('click',function(){
    $('.rows').remove();
    $('#taxtotal').text('0');
    $('#maintotal').text('0');

  });


  // funzione che crea il form compilato che sarà inviato all app server, utilizzo lo stessa per avere un anteprima,
  // ho usato la libreria handlebars per clonare e rimpire con i campi desiderati
  function create_line(){

    // per comodità di lettura, mi creo le variabili con i valori da usare
    var type = $('#i-type').val();
    var duty = $('#i-duty').val();
    var quantity = $('#i-quantity').val();
    var price = parseFloat($('#i-price').val()).toFixed( 2 );
    var taxes = tax(type, duty);
    var total =  totals(taxes, price, quantity);

    //HANDLEBARS
    var source = $('#template-row').html();
    var template = Handlebars.compile(source);
    var context = { 
      quantity: quantity,
      name: $('#i-name').val(), 
      price: price,
      type: $('#i-type').val(), 
      duty: duty,
      tax: (taxes * 100) + '%',
      total: total,
    };
    var html = template(context);
    $('#t-pre').append(html);
    
    // svuoto i campi un volta inviato il prodotto
    remove_value()
   }

  // Svuota i campi
  function remove_value(){
    $('#i-quantity').val('');
    $('#i-name').val('');
    $('#i-price').val('');
    $('#i-type').val('');
  }

  // funzione che calcola la tassa
  // non serve per l'invio di dati al server, che fa i calcoli da se, ma solo per l'anteprima
  function tax(type, duty){
    var tax = 0;
    array_type = ['books', 'food', 'medical'];
    if ($.inArray(type, array_type) < 0){
      tax = 0.10;
    }
    if (duty == 'true'){
      tax += 0.05; 
    }
    return tax.toFixed(2);
  }

  // funzione che calcola i totali, delle singole linee e totale ricevuta
  // non serve per l'invio di dati al server, che fa i calcoli da se, ma solo per l'anteprima
  function totals(taxes, price, quantity){
    
    var unit_tax =  unitTax(taxes, price);
    
    var tot_tax = unit_tax * quantity;
    var tot_net = price * quantity;

    var tot_tax_dom = parseFloat($('#taxtotal').text());
    tot_tax_dom += tot_tax;
    $('#taxtotal').empty();
    $('#taxtotal').text(tot_tax_dom.toFixed(2));

    var main_tot = parseFloat($('#maintotal').text());
    main_tot += tot_net + tot_tax;
    $('#maintotal').empty();
    $('#maintotal').text(main_tot.toFixed(2));

    return (tot_tax + tot_net).toFixed(2);
  }

  //calcola la tassa con l'arrotondamento richiesto allo 0.05 superiore piu vicino

  function unitTax(taxes, price){
    return Math.ceil((price * taxes) / 0.05) * 0.05; 
  }
});