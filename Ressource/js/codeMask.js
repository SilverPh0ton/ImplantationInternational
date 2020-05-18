$('#code_activation').keyup(function () {
    var inputVal = $(this).val();
    var outputval = '';

    if(inputVal.length===5){
        inputVal += inputVal.charAt(4)
    }
    if(inputVal.length===10){
        inputVal += inputVal.charAt(9)
    }

    for (let i = 0; i < inputVal.length; i++) {
        var asciiCode = inputVal.charCodeAt(i);
        if(i===4 || i ===9){
            outputval += '-';
        }
        else if(asciiCode>=97 && asciiCode<=122){
            outputval += String.fromCharCode(asciiCode-32);
        }
        else if((asciiCode>=65 && asciiCode<=90) || (asciiCode>=48 && asciiCode<=57)){
            outputval += String.fromCharCode(asciiCode);
        }
        else{
            outputval += '';
        }
    }

    $(this).val(outputval);
});