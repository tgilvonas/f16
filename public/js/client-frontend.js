$(document).ready(function(){
    $('.select2').select2();

    let districtCoefficient = 1;
    let printFormatCoefficient = 1;
    let printTypeCoefficient = 1;
    let amountCoefficient = 1;
    let amount = 1;

    findAmountAndItsCoefficient();
    findPrintFormatCoefficient();
    findPrintTypeCoefficient();
    calculateTotalSumAndOutputItToHtmlElement();

    $('.districts').change(function(){
        console.log('Districts were changed');
        console.log($(this).val());
    });
    $('.amount').change(function(){
        findAmountAndItsCoefficient();
        calculateTotalSumAndOutputItToHtmlElement();
    });
    $('.print_format').change(function(){
        findPrintFormatCoefficient();
        calculateTotalSumAndOutputItToHtmlElement();
    });
    $('.print_type').change(function(){
        findPrintTypeCoefficient();
        calculateTotalSumAndOutputItToHtmlElement();
    });

    function findAmountAndItsCoefficient() {
        let coefficient = 1;
        let id = $('.amount').val();

        for (let i = 0; i < dataOfCoefficients['amounts'].length; i++) {
            if (dataOfCoefficients['amounts'][i]['id'] == id) {
                coefficient = dataOfCoefficients['amounts'][i]['coefficient'];
                amount = dataOfCoefficients['amounts'][i]['amount'];
                break;
            }
        }
        amountCoefficient = coefficient;
    }
    function findPrintFormatCoefficient() {
        // code was repeated intentionally (we don't know the final structure of JSON and types of inputs):
        let coefficient = 1;
        let id = $('.print_format:checked').val();

        for (let i = 0; i < dataOfCoefficients['printFormats'].length; i++) {
            if (dataOfCoefficients['printFormats'][i]['id'] == id) {
                coefficient = dataOfCoefficients['printFormats'][i]['coefficient'];
                break;
            }
        }
        printFormatCoefficient = coefficient;
    }
    function findPrintTypeCoefficient() {
        // code was repeated intentionally (we don't know the final structure of JSON and types of inputs):
        let coefficient = 1;
        let id = $('.print_type:checked').val();

        for (let i = 0; i < dataOfCoefficients['printTypes'].length; i++) {
            if (dataOfCoefficients['printTypes'][i]['id'] == id) {
                coefficient = dataOfCoefficients['printTypes'][i]['coefficient'];
                break;
            }
        }
        printTypeCoefficient = coefficient;
    }
    function calculateTotalSumAndOutputItToHtmlElement() {
        let total = amount * amountCoefficient * districtCoefficient * printFormatCoefficient * printTypeCoefficient;
        //console.log(amount, amountCoefficient, districtCoefficient, printFormatCoefficient, printTypeCoefficient)
        $('.total_sum').text(total.toFixed(2));
    }
});
