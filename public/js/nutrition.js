
function recordMeal(row) {

    let qty = document.getElementById("qty-" + row).value;

    console.log("\n Recording for " + row + ", qty: " + qty);
}



function mealItemsFilter() {

    var input, filter, table, tr, td, i, txtValue;
    
    input = document.getElementById("mealItemsInput");
    filter = input.value.toUpperCase();

    table = document.getElementById("mealItemsTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
      
        td = tr[i].getElementsByTagName("td")[1];

        if (td) {

            txtValue = td.innerText;

            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
