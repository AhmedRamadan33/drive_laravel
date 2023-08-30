let costInputs = document.querySelectorAll("#cost input");


let getCost = () => {


    let gross = costInputs[0].value;
    let tax = costInputs[1].value;
    let bouns = costInputs[2].value;
    let net = costInputs[3];




    let TaxValue = +gross * (+tax / 100);
    let salaryAfterTax = gross - TaxValue;
    let TotalSalary = +salaryAfterTax + +bouns;

    net.value = Math.round(TotalSalary);


}
for (let i = 0; i < costInputs.length; i++) {
    costInputs[i].addEventListener("keyup", getCost);

}