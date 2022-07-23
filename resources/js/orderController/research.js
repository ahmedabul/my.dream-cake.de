//get the baseUrl of website
var baseUrl = window.location.origin;
$(".order-goToResearch input[name='research']").keyup(function() {
    $.ajax({
        type: 'post',
        url: baseUrl + '/order/research',
        data: {
            research: $(this).val()
        },
        success: function(invoices) {
            $(".order-goToResearch .body").empty();
            console.log(invoices);
            $(invoices).each(function(invoice, orders) {
                var invoiceString = "<table class='table text-center mb-5'>" +
                    "<thead>" +
                    "<tr>" +
                    "<th>Article</th>" +
                    "<th>RechnungNr</th>" +
                    "<th>BestellungNr" +
                    "<th>Vorname <i class='fa fa-truck aria-hidden=true' style='font-size: 20px;'></i></th>" +
                    "<th>Nachname <i class='fa fa-truck aria-hidden=true' style='font-size: 20px;'></i></th>" +
                    "<th>Strasse <i class='fa fa-truck aria-hidden=true' style='font-size: 20px;'></i></th>" +
                    "<th>Stadt <i class='fa fa-truck aria-hidden=true' style='font-size: 20px;'></i></th>" +
                    "<th>Bestellungsdatum</th>" +
                    "<th>Update</th>"
                "</tr>" +
                "</thead><tbody>";
                $(orders).each(function(orders, order) {
                    invoiceString +=
                        "<tr>" +
                        "<td>" + order.articleName + "</td>" +
                        "<td>" + order.invoiceId + "</td>" +
                        "<td>" + order.orderId + "</td>" +
                        "<td>" + order.firstName + "</td>" +
                        "<td>" + order.lastName + "</td>" +
                        "<td>" + order.street + order.hausNr + "</td>" +
                        "<td>" + order.city + order.plz + "</td>" +
                        "<td>" + order.orderDate + "</td>" +
                        "<td><a class='btn btn-danger' href=" + baseUrl + "/order/show/" + order.orderId + ">Update</a></td>" +
                        "</tr>"
                });
                invoiceString += "</tbody></table>";
                console.log(invoiceString);
                $(".order-goToResearch .body").append(invoiceString);
            });
        }
    })
})