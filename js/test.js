
let sampleContainer = document.getElementById('sampleContainer');


function generatePayslipList1() {
    $.post("./classes/load-payslip.class.php", {
    }, function (data) {

        var jsonArray = JSON.parse(data);
        //alert('call success');
        let temp_array1 = [];
        let temp_array2 = [];
        let temp_array3 = []; // will hold the current billing and owner name

        for (var i = 0; i < jsonArray.length; i++) {

            //SELECT BILLING
            if (temp_array1.includes(jsonArray[i][1]) == false) {

                temp_array1.push(jsonArray[i][1]);
                temp_array3.push(jsonArray[i][1]);

                //SELECT OWNER
                if (temp_array2.includes(jsonArray[i][2]) == false) {

                    temp_array2.push(jsonArray[i][2]);
                    temp_array3.push(jsonArray[i][2]);

                    //GENERATE SHIPMENT UNDER THAT BILLING AND OWNER

                    for (var i2 = 0; i2 < jsonArray.length; i2++) {

                        if (jsonArray[i2][1] == temp_array3[0] && jsonArray[i2][2] == temp_array3[1]) {
                            var newHeader = document.createElement("h1");
                            newHeader.innerHTML = jsonArray[i2][0] + jsonArray[i2][1] + jsonArray[i2][2];
                            sampleContainer.appendChild(newHeader);


                        }
                    }

                }

                temp_array3 = [];
                var newHeader2 = document.createElement("h1");
                newHeader2.innerHTML = "--------------------------------------------------------";
                sampleContainer.appendChild(newHeader2);
            }

            //alert(i);
        };

    });
}

function generatePayslipList2() {
    $.post("./classes/load-payslip.class.php", {
    }, function (data) {

        var jsonArray = JSON.parse(data);
        //alert('call success');
        let temp_array1 = [];
        let temp_array2 = [];
        let temp_array3 = []; // will hold the current billing and owner name

        for (var i = 0; i < jsonArray.length; i++) {

            //SELECT BILLING
            if (temp_array1.includes(jsonArray[i][1]) == false) {

                temp_array1.push(jsonArray[i][1]);
                /*
                                var newHeader2 = document.createElement("h1");
                                newHeader2.innerHTML = jsonArray[i][1];
                                sampleContainer.appendChild(newHeader2);
                                */
            }

            //alert(i);
        };

        for (var i2 = 0; i2 < temp_array1.length; i2++) {

            //FILL UP ARRAY 2 WITH PLATE NUMBERS
            for (var i3 = 0; i3 < jsonArray.length; i3++) {

                if(jsonArray[i3][1] == temp_array1[i2]){

                    if (temp_array2.includes(jsonArray[i3][2]) == false) {

                        temp_array2.push(jsonArray[i3][2]);
/*
                        var newHeader2 = document.createElement("h1");
                        newHeader2.innerHTML = temp_array2[i3];
                        sampleContainer.appendChild(newHeader2);*/


                        //GENERATE BILLING ID HERE
                    }

                }
            }

            //LOOP THROUGH ARRAY 2 AND GENERATE PAYSLIP FOR EACH VEHICLE
            for (var i4 = 0; i4 < temp_array2.length; i4++) {

                //GENERATE PLATE NUMBER HERE

                for (var i5 = 0; i5 < jsonArray.length; i5++) {

                    if(jsonArray[i5][2] == temp_array2[i4]){

                        //GENERATE SHIPMENT DETAILS HERE
                        
                        var newHeader1 = document.createElement("h1");
                        newHeader1.innerHTML = "Shipment Number: " + jsonArray[i5][0] + "<br>" + "Billing Id: " + temp_array1[i2] + "<br>" + "Plate Number: " + temp_array2[i4];
                        sampleContainer.appendChild(newHeader1);

                    }; //multiple shipments in a single payslip already works

                }
                
                var newHeader2 = document.createElement("h1");
                newHeader2.innerHTML = "--------------------------------------------------------";
                sampleContainer.appendChild(newHeader2);
            }

        }

    });
}

generatePayslipList2();

//const id_val = [1, 2, 3];

//alert(id_val.includes(3));