// Admin - Add Product Sizes
var addProductSizeForm      = document.getElementById('basicform');
var addProductSizeInput     = document.getElementById('productSize');
var addProductSizeAddButton = document.getElementById('addButton');
var addProductSizeError     = document.getElementById('formError');
var outputElement           = document.getElementById('sizeTable');

function showSizes() {
  outputElement.innerHTML = "";
  var sizes = JSON.parse(localStorage.getItem('productSizes'));

  var number = 1;
  for (var index = sizes.length - 1; index >= 0; index--) {
    const size = sizes[index];
    var row = document.createElement('tr');
    var numberTd = document.createElement('td');
    numberTd.innerHTML = number;
    var sizeTd = document.createElement('td');
    sizeTd.innerHTML = size.product_size;
    var scopeAttribute = document.createAttribute('scope');
    scopeAttribute.value = "col";
    sizeTd.setAttributeNode(scopeAttribute);

    row.appendChild(numberTd);
    row.appendChild(sizeTd);

    outputElement.appendChild(row);

    number++;
  }

  number = 1;
}

function doesExist() {
  var value = addProductSizeInput.value.trim().toUpperCase();
  var sizes = localStorage.getItem('productSizes'); 
  if(sizes !== null) {
    sizes = JSON.parse(sizes);
    for (let index = 0; index < sizes.length; index++) {
      const size = sizes[index];
      if(size.product_size == value) {
        return true;
      }
    }
  }
}

function validateInput() {
  if(addProductSizeInput.value === '' || addProductSizeInput.value == null) {
    addProductSizeError.innerHTML = "<strong>Please enter the value first!</strong>"
    return false;
  } else if(!addProductSizeInput.value.replace(/\s/g, '').length) {
    addProductSizeError.innerHTML = "<strong>Name Contains only whitespaces. Enter valid input!</strong>"
    return false;
  } else if(doesExist()) {
    addProductSizeError.innerHTML = "<strong>Size already exists. Enter different values.</strong>"
    return false;
  } else {
    return true;
  }
}

function addSize() {

  addProductSizeError.innerHTML = "";
  
  if(!validateInput()) {
    return;
  }
  validateInput();

  var sizeName = addProductSizeInput.value.trim().toUpperCase();
  var size = {
    "product_size" : sizeName,
  }
  // Setting localstorage
  if(localStorage.getItem('productSizes') === null) {
    var sizes = new Array();
    sizes.push(size);
    localStorage.setItem('productSizes', JSON.stringify(sizes));
    showSizes();
  } else {
    var sizes = JSON.parse(localStorage.getItem('productSizes'));
    sizes.push(size);
    localStorage.setItem('productSizes', JSON.stringify(sizes));
    showSizes();
  }
  
  addProductSizeInput.value = "";
  addProductSizeInput.focus();

}


addProductSizeAddButton.addEventListener('click', function(e) {
  e.preventDefault();
  addSize();
});
addProductSizeInput.onkeypress = function(e) {
  var key = e.charCode || e.keyCode || 0;     
  if (key == 13) {
    e.preventDefault();
    addSize();
  }
}

addProductSizeForm.onsubmit = function() {
  localStorage.removeItem('productSizes');
}