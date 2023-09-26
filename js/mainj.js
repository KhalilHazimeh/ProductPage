
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


//Change the active state on click
$('.option1').click(function(){
    $('.option1').removeClass("active");
    $(this).addClass("active");
    var valueId = $(this).data("id");
    $("input[name=option1]").val($(this).text());
    $("input[name=option1_Id]").val(valueId);

});

$(document).on('click', '.option2', function(){
    $('.option2').removeClass("active");
    $(this).addClass("active");
    var valueId2 = $(this).data("id");
    $("input[name=option2]").val($(this).text());
    $("input[name=option2_Id]").val(valueId2);

});




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
                cartHtml += '<div class="item" data-index="' + index + '" id="item-' + index + '">';
                cartHtml += '<p>Name: ' + item.Product_Name + '</p>';
                cartHtml += '<p>Size: ' + item.Product_Option1 + '</p>';
                cartHtml += '<p>Quantity: ' + item.Product_Quantity + '</p>';
                cartHtml += '<p>Flavor: ' + item.Product_Option2 + '</p>';
                cartHtml += '<p>Price: $' + item.Product_Price + '</p>';
                cartHtml += '<button type="button" style="width:100%; padding:10px" class="remove-item" data-id="' + item.Proudct_Id + '">Remove Item</button>';
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
    $('#offcanvas-cart').on('click', '.remove-item', function() {
        var product_id = $(this).data('id');
        var itemDiv = $(this).closest('.item');
        var index = itemDiv.data('index');
        
        $.ajax({
            url: 'remove_item.php',
            type: 'POST',
            data: { product_id: product_id },
            dataType: 'json',
            success: function(data) {
                if (data.status === 'success') {
                    itemDiv.remove(); // Remove the item by index
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error: ' + textStatus, errorThrown);
            }
        });
    });
});


$(document).ready(function() {
    $(".option1").click(function() {
        var valueId = $(this).data("id");
        $.ajax({
            url: "get_second_option_values.php",
            type: "POST",
            data: { valueId: valueId, product_id: productId },
            success: function(data) {
                var secondOptionValues = JSON.parse(data);

                $("#optionList2").empty();

                for (var i = 0; i < secondOptionValues.length; i++) {
                    var value_id = secondOptionValues[i].id;
                    var value_name = secondOptionValues[i].name;

                    $("#optionList2").append(
                        '<li id="li_option2_' + value_id + '" data-id="' + value_id + '" class="option2">' +
                        '<span href="#" class="option-label">' + value_name + ' </span>' +
                        '</li>'
                    );
                }
            }
        });
    });
});


document.getElementById('checkoutButton').addEventListener('click', function() {
    window.location.href = 'checkout.php';
});
