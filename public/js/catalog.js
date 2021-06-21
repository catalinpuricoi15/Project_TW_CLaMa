function createPDF(){

}

function createCSV(){

}

function createHTML(){

}

function insertCatalog(num){
    if( document.getElementById("textViewCalculator").value.length < 20)
    document.getElementById("textViewCalculator").value = document.getElementById("textViewCalculator").value + num;
}

function equal(){
    var exp = document.getElementById("textViewCalculator").value;
    if(exp){
        document.getElementById("textViewCalculator").value = eval(exp);
        document.getElementById("textViewCalculator").value = document.getElementById("textViewCalculator").value.substring(0,15);
    }
}
function clean(){
    document.getElementById("textViewCalculator").value = "";
}

function deleteDigit(){
    var numberDigits = document.getElementById("textViewCalculator").value.length - 1;
    document.getElementById("textViewCalculator").value = document.getElementById("textViewCalculator").value.substring(0,numberDigits);
}