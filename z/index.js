const companyNameSelect = document.getElementById('companyNameSelect')

function populateSelect() {
    $.post("./classes/load-company-select.class.php", {
    }, function (data1) {

        var jsonArray1 = JSON.parse(data1);

        for (var i = 0; i < jsonArray1.length; i++) {
            var newOption = document.createElement("option");
            newOption.value = jsonArray1[i][0];
            newOption.innerHTML = jsonArray1[i][0];
            companyNameSelect.options.add(newOption);
        }

        //closeSelect();
    });
}
populateSelect();