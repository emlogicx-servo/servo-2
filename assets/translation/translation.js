// JavaScript Document
/*
document.getElementsByClass('t_orderid').innerHTML = document.getElementsByClass('t_orderid').innerHTML.replace(/Order/gi, 'Commande');
*/

//Table Header Values with classes
/*

    <script defer type="text/javascript">
    function tabletrans() {

            $("#cashierorders tr > td:contains('Ordered')").each(function () {
            $(this).replaceWith($(this).html("Commandé"));
            });

            $("#cashierorders tr > td:contains('Paid')").each(function () {
            $(this).replaceWith($(this).html("Payé"));
            });

            console.log('translated');
           }

    </script>
    
window.onload = function () {

    $("#cashierorders tr > td:contains('Ordered')").each(function () {
        $(this).replaceWith($(this).html("Commandé"));
    });

    $("#cashierorders tr > td:contains('Paid')").each(function () {
        $(this).replaceWith($(this).html("Payé"));
    });

    console.log('translated');


};
*/

$('document').ready(function () {
    //values in table cells
    //ordered

    //values in other elements
    $('.t_orderid').each(function () { $(this).replaceWith($(this).html('Commande')); });
    $('.t_table').each(function () { $(this).replaceWith($(this).html('Table Client')); });
    $('.t_waiter').each(function () { $(this).replaceWith($(this).html('Serveur')); });
    $('.t_time').each(function () { $(this).replaceWith($(this).html('Heure')); });

});
