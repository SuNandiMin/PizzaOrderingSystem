$(document).ready(function () {
    //when click + - btn
    $(".btn-plus, .btn-minus").click(function () {
        $parentNode = $(this).parents("tr");
        totalPriceChange($parentNode);
        allTotalPriceChange();
    });

    //total prce for each item change function by qty changing
    function totalPriceChange($parentNode) {
        $price = Number($parentNode.find("#price").text().replace("Kyats", ""));
        $qty = Number($parentNode.find("#qty").val());
        $total = $price * $qty;
        $parentNode.find("#total").html($total + " Kyats");
    }

    //remove product in cart when click cross btn
    $(".btnRemove").click(function () {
        $parentNode = $(this).parents("tr");
        $parentNode.remove();
        allTotalPriceChange();
        $.ajax({
            type:'get',
            url:'/pizza/cart/clear',
            data:{
                product_id : $parentNode.find('#product_id').val(),
            },
            dataType:'json',
        })
        location.reload();
    });

    //all total price change function by qty changing
    function allTotalPriceChange() {
        $totalPrice = 0;
        $("#dataTable tr").each(function (index, row) {
            $totalPrice += Number(
                $(row).find("#total").text().replace("Kyats", "")
            );
        });
        $("#subTotalPrice").html(`${$totalPrice} Kyats`);

        $("#allTotalPrice").html(`${$totalPrice + 3000} Kyats`);
    }
});
