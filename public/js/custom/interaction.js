
$(document).ready(function(){
    $(document).on('click', '.addToWishlist', function(e){
        var product = $(this).data('product');
        var customer = $('#customer').val();
        axios.post('/add-to-wishlist', {product:product, customer:customer})
            .then(response=>{
                Toastify({
                    text: response.data.message,
                    duration: 3000,
                    newWindow: true,
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: "right", // `left`, `center` or `right`
                    backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    onClick: function(){} // Callback after click
                }).showToast();
            })
            .catch(error=>{
                Toastify({
                    text: error.response.data.error,
                    duration: 3000,
                    newWindow: true,
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: "right", // `left`, `center` or `right`
                    backgroundColor: "linear-gradient(to right, #ff0000, #ff0000)",
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    onClick: function(){} // Callback after click
                }).showToast();
            });
    });
});
