
//counter starts from 1 till 10 not lower nor higher
var counter = 1;
var counterElement = document.getElementById('counter');
var originalPrice = document.getElementById('originalPrice');

function increment() {
    if (counter < 10) {
        counter++;
        counterElement.textContent = counter;
        $("input[name=quantity]").val(counter)
        updatePrice(counter);
    }
}

function decrement() {
    if (counter > 1) {
        counter--;
        counterElement.textContent = counter;
        $("input[name=quantity]").val(counter)
        updatePrice(counter);
    } 
}

//alert on search

function searchText() {
    var searchInput = document.$('#searchInput');
    var searchValue = searchInput.value;
    if (searchValue.trim() !== '') {
        alert("You searched for: " + searchValue);
    }
}

//add price on counter adding
var priceInt = parseInt(originalPrice.textContent);
function updatePrice(counter){
    var newPrice = priceInt * counter; 
    originalPrice.textContent = newPrice;
    $("input[name=price]").val(newPrice)
}

$(document).ready(function() {
    var activeSizeDataId = $("#sizeList li.active").attr("data-id");
    $(".flavor").each(function() {
        var flavorDataSize = $(this).attr("data-size");
        if (flavorDataSize === activeSizeDataId) {
            $(this).removeClass("hidden");
        } else {
            $(this).addClass("hidden");
        }
    });
});


//Change the active state on click
$('.option').click(function(){
    $('.option').removeClass("active");
    $(this).addClass("active");
    var activeSizeDataId = $("#sizeList li.active").attr("data-id");
    $(".flavor").each(function() {
        var flavorDataSize = $(this).attr("data-size");
        if (flavorDataSize === activeSizeDataId) {
            $(this).removeClass("hidden");
            //$(".flavor").addClass("active");
        } else {
            $(this).addClass("hidden");
            
        }
    });
    $("input[name=size]").val($(this).text());
});

//change flavors ready state
$('.flavor').click(function(){
    $('.flavor').removeClass("active");
    $(this).addClass("active")
    $("input[name=flavor]").val($(this).text())
} )



/*function addToCart(productID) {
    
    var activeSize = $("#sizeList li.active");
    var activeFlavor = $("#flavorList li.active");
    var activeQuantity = $("#counter");


    var activeSizeText = activeSize ? activeSize.text() : 'No active size selected';
    var activeFlavorText = activeFlavor ? activeFlavor.text() : 'No active flavor selected';
    var activeQuantityText= activeQuantity ? activeQuantity.text() : 'No quantity chosen';


    var alertMessage = 'Active Size: ' + activeSizeText + '\nActive Flavor: ' + activeFlavorText + '\nActive Quantity: ' + activeQuantityText ;
    alert(alertMessage);
    
    const product = {
        id: productID, 
        name: $("#product-title").text(),    
        price: originalPrice.textContent,          
        quantity : activeQuantityText,
        size: activeSizeText,
        flavor: activeFlavorText
    };

    var form = document.createElement('form');
            form.method = 'post';
            form.action = 'store_product.php';



            var inputProductName = document.createElement('input');
            inputProductName.type = 'hidden';
            inputProductName.name = 'product_name';
            inputProductName.value = $("#product-title").text();
            form.appendChild(inputProductName);

            var inputPrice = document.createElement('input');
            inputPrice.type = 'hidden';
            inputPrice.name = 'price';
            inputPrice.value = originalPrice.textContent;
            form.appendChild(inputPrice);

            var inputQuantity = document.createElement('input');
            inputQuantity.type = 'hidden';
            inputQuantity.name = 'quantity';
            inputQuantity.value = activeQuantityText;
            form.appendChild(inputQuantity);

            var inputSize = document.createElement('input');
            inputSize.type = 'hidden';
            inputSize.name = 'size';
            inputSize.value = activeSizeText;
            form.appendChild(inputSize);

            var inputFlavor = document.createElement('input');
            inputFlavor.type = 'hidden';
            inputFlavor.name = 'flavor';
            inputFlavor.value = activeFlavorText;
            form.appendChild(inputFlavor);

            document.body.appendChild(form);
            form.submit();
}*/



/*function displaySelectedItems() {
    const selectedItemsDisplay = document.getElementById('offcanvas-body');
    const storedSelectedProducts = getUserSelectionsFromLocalStorage();

    let innerHTML = '<ul>';
    storedSelectedProducts.forEach((product) => {
    innerHTML += `<h4>${product.name} </h4>`;
    innerHTML += `<li>Price: $${product.price} </li>`;
    innerHTML += `<li>Size: ${product.size}</li>`;
    innerHTML += `<li>Quantity: $${product.quantity}</li>`;
    innerHTML += `<li>Flavor: $${product.flavor}</li>`;
    });
    innerHTML += '</ul>';

    selectedItemsDisplay.innerHTML = innerHTML;
}*/


$(document).ready(function() {
    $("#addToCartForm").submit(function(event) {
    event.preventDefault();
    $("#addToCartButton").hide();
    $("#loading").show();
    $.ajax({
        url: 'store_product.php',
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json', 
    })
    .done(function(response) {
        $("#loading").hide();
        $("#addToCartButton").show();
        if (response.status === 'success') {
            showSuccessMessage('Product added to cart successfully!');
        } else {
            showFailureMessage('Failed to add product to cart.');
        }
    })
    .fail(function() {
        $("#loading").hide();
        $("#addToCartButton").show();
        showFailureMessage('Failed to add product to cart.');
        });
    });

    function showSuccessMessage(message) {
        $("#message").html('<div class="success">' + message + '</div>');
        $("#message .success").fadeOut(3000);
    }
    function showFailureMessage(message) {
        $("#message").html('<div class="failure">' + message + '</div>');
        $("#message .failure").fadeOut(3000);
    }
});


var myOffcanvas = $('#myNav');
var openNavBtn = $('#openNavBtn');
function updateOffCanvasCart() {
    $.ajax({
        url: 'get_cart_data.php', 
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            let cartHtml = '';
            if (data.cartItems.length > 0) {
                cartHtml += '<div class="cart-items">';
                data.cartItems.forEach(function(item, index) {
                cartHtml += '<div class="item" id="item-' + index + '">';
                cartHtml += '<p>Name: ' + item.Product_Name + '</p>';
                cartHtml += '<p>Size: ' + item.Product_Size + '</p>';
                cartHtml += '<p>Quantity: ' + item.Product_Quantity + '</p>';
                cartHtml += '<p>Flavor: ' + item.Product_Flavor + '</p>';
                cartHtml += '<p>Price: $' + item.Product_Price + '</p>';
                cartHtml += '<button type="button" class="btn-add-to-cart remove-item" data-id="' + index + '">Remove Item</button>';
                cartHtml += '<hr>';
                cartHtml += '</div>';
                });
                cartHtml += '</div>';
            } else {
                cartHtml = '<p>Your cart is empty.</p>';
            }
    
            $('#offcanvas-cart').html(cartHtml);
        },
        error: function(xhr, status, error) {
            console.error('Error fetching cart data:', error);
        }
    });
    }

openNavBtn.on('click', function () {
    var bootstrapOffcanvas = new bootstrap.Offcanvas(myOffcanvas.get(0));
    bootstrapOffcanvas.show();
    updateOffCanvasCart();
});


$(document).ready(function() {
    $('#offcanvas-cart').on('click', '.remove-item', function(data) {
        var item_id = $(this).data('id');
        $.post('remove_item.php', { item_id: item_id }, function(data) {
            if (data.status === 'success') {
                $('#item-' + item_id).remove();
            }
        });
    });
});

$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});

$(document).ready(function() {
    $('.delete_inside').on('click', function(data) {
        var item_id = $('.delete').data('id');
        $.post('admin/delete_product.php', { delete_product_id: item_id }, function(data) {
            if (data.status === 'success') {
                $('#' +item_id).remove();
            }
        });
    });
});

