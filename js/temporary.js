













function myFunction() {
    $.post("temporary.php", {
        sampleVar: "123"
    }, function (data) {
        var jsonArray = JSON.parse(data);

    });
}

myFunction();

