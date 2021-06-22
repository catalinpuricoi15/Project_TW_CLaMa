
let selectedStudent = -1;
let selection = document.querySelector('select');
let results = document.querySelectorAll('h3');

results.forEach((result, index) => {
    result.addEventListener('click', function () {
        selectedStudent = index;
    })
});

let calculator = document.getElementById('calculator');

function insertCatalog(num) {
    if (document.getElementById("textViewCalculator").value.length < 20)
        document.getElementById("textViewCalculator").value = document.getElementById("textViewCalculator").value + num;
}

function equal() {
    var exp = document.getElementById("textViewCalculator").value;
    if (exp) {
        document.getElementById("textViewCalculator").value = eval(exp);
        document.getElementById("textViewCalculator").value = document.getElementById("textViewCalculator").value.substring(0, 15);
        if (selectedStudent != -1 && selection.options[selection.selectedIndex].value === "calculator") {
            results[selectedStudent].innerText = document.getElementById("textViewCalculator").value.substring(0, 15);
        }
    }
}

function clean() {
    document.getElementById("textViewCalculator").value = "";
}

function deleteDigit() {
    var numberDigits = document.getElementById("textViewCalculator").value.length - 1;
    document.getElementById("textViewCalculator").value = document.getElementById("textViewCalculator").value.substring(0, numberDigits);
}

function round() {
    document.getElementById("textViewCalculator").value = Math.round(document.getElementById("textViewCalculator").value);
}

function floor() {
    document.getElementById("textViewCalculator").value = Math.floor(document.getElementById("textViewCalculator").value);
}

results.forEach((result, index) => {
    selection.addEventListener('change', () => {
            if (selection.options[selection.selectedIndex].value === "mediaArtimetica") {
                result.innerText = mediaAritmetica(index);
                calculator.classList = "hidden";
            }
            if (selection.options[selection.selectedIndex].value === "mediaPatratica") {
                result.innerText = mediaPatratica(index);
                calculator.classList = "hidden";
            }
            if (selection.options[selection.selectedIndex].value === "calculator") {
                calculator.classList = "main-calculator";
            }
        }
    );
});

function mediaAritmetica(index) {
    let studentGrades = grades[index];
    let sum = 0;

    for (let i = 0; i < studentGrades.length; i++) {
        if ((typeof studentGrades[i]) != "string") {
            sum += studentGrades[i];
        }
    }
    return Math.round(sum / studentGrades.length);
}

function mediaPatratica(index) {
    let studentGrades = grades[index];
    let sum = 0;
    for (let i = 0; i < studentGrades.length; i++) {
        if ((typeof studentGrades[i]) != "string") {
            sum *= studentGrades[i] * studentGrades[i];
        }
    }
    return Math.round(Math.sqrt(sum / studentGrades.length));
}

function createPDF() {
    var doc = new jsPDF({orientation: "landscape"});

    doc.setFontSize(6)
    doc.autoTable({
        html: "#tblCatalog",
        styles: {fontSize: 7},
        pageBreak: "auto"
    });
    doc.save('Catalog.pdf');
}

function createCSV() {

}

function createHTML() {
    var elHtml = document.getElementById("catalog").innerHTML;
    var link = document.createElement('a');
    mimeType = 'text/plain';

    link.setAttribute('download', "Catalog_" + ".html");
    link.setAttribute('href', 'data:' + mimeType + ';charset=utf-8,' + encodeURIComponent(elHtml));
    link.click();
}