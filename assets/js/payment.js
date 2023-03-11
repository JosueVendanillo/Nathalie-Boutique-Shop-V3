// ES6 JavaScript code
const phoneInput = document.getElementById('phone');
const addressInput = document.getElementById('address');
const confirmBtn = document.getElementById('confirmBtn');
const phoneError = document.getElementById('phone-error');

const purchaseBtn = document.getElementById('purchaseBtn');


confirmBtn.addEventListener('click', () => {

    // Validate phone number input
    // pattern for 09XX-XXX-XXXX / 09XXXXXXXXX / (+63)9XX-XXX-XXXX
    const phoneNumberRegex = /^(\+63)?\(?09\d{2}\)?[- ]?\d{3}[- ]?\d{4}$/;

    function telephoneCheck(str) {
      return phoneNumberRegex.test(str);
    }

    console.log("1" + telephoneCheck(phoneInput.value));
  
    if (!telephoneCheck(phoneInput.value)) {
      phoneError.textContent = 'Invalid phone number';
      return;
    }
     else {
      phoneError.textContent = '';
    }

    // Display input values
    console.log('Phone number:', phoneInput.value);
    console.log('Address:', addressInput.value);
  
    document.getElementById("outputPhone").textContent = phoneInput.value;
    document.getElementById("outputAddress").textContent = addressInput.value;
  });
  
  

  
let customerPhoneNumber = document.getElementById("outputPhone").textContent;
let customerAddress = document.getElementById("outputAddress").textContent;


  // while(typeof customerPhoneNumber){

  //   purchaseBtn.disabled = true;


  // }



  if(customerPhoneNumber.textContent == "" && customerAddress == ""){

    purchaseBtn.disabled = true;

  }else{


    purchaseBtn.addEventListener('click',() => {
  
        if(confirm('Do you want to proceed?')){

          window.location.href = "http://localhost:8080/nathalie%20shop%20v3/resultpage.php";
        }else{
          return false;
        }

    });
    
  }








