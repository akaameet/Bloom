const nameInput = document.getElementById('name');
const emailInput = document.getElementById('email');
const oldPasswordInput = document.getElementById('old_password');
const passwordInput = document.getElementById('password');
const confirmPasswordInput = document.getElementById('confirm_password');
const address=document.getElementById('address');
const contact=document.getElementById('phone');

const updateProfileForm = document.getElementById('update_profile');
updateProfileForm.addEventListener('submit', function (event) {
    if (!validateName() || !validateEmail() || !validatePhone() || !validateAddress()) {
        event.preventDefault();
    }
});

const changePasswordForm = document.getElementById('change_password');
changePasswordForm.addEventListener('submit', function (event) {
    if (!validateOldPassword() || !validatePassword() || !validateConfirmPassword()) {
        event.preventDefault();
    }
});


function validateName(){
  const namevalue = nameInput.value.trim();
  const nameregex = /^[a-zA-Z\s]+$/;
  if(namevalue === ''){
    setError(nameInput,'Name needs to be filled out', 'name-error');
    return false;
  } else if (!nameregex.test(namevalue)){
   setError(nameInput,"Name shouldn't contain number.", 'name-error');
   return false;
  }else{
   removeError(nameInput, 'name-error');
   return true;
  }
}

function validateEmail(){
   const emailValue = emailInput.value.trim();
   const emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
   if (emailValue === ''){
       setError(emailInput,"Email is required", 'email-error');
   } else if(!emailRegex.test(emailValue)) {
       setError(emailInput,"Invalid email format!", 'email-error');
   } else {
       removeError(emailInput, 'email-error');
       return true;
   }
}

function validatePhone(){
  const phonevalue = contact.value.trim();
  const phoneRegex = /^9\d{9}$/;
  if (phonevalue == ''){
      setError(contact, "Phone number is required", 'phone-error');
      return false;
  } else if(!phoneRegex.test(phonevalue)) {
      setError(contact, "Incorrect Phone Number", 'phone-error');
      return false;
  } else {
      removeError(contact, 'phone-error');
      return true;
  }
}
function validateOldPassword() {
  const oldPassValue = oldPasswordInput.value.trim();
  if (oldPassValue === '') {
      setError(oldPasswordInput, "Old Password is required", 'old-password-error');
      return false;
  } else {
      removeError(oldPasswordInput, 'old-password-error');
      return true;
  }
}
function validatePassword(){
   const passValue = passwordInput.value.trim();
   const passRegex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_])/;
   if(passValue === ''){
       setError(passwordInput,"Password is required", 'password-error');
       return false;
   } else if(passValue.length < 8){
       setError(passwordInput," Password must be atleast 8 characters", 'password-error');
       return false;
   } else if(!passRegex.test(passValue)){
    setError(passwordInput,"Password must contain at least least one uppercase letter, one lowercase letter, one digit, and one special character.", 'password-error');
    return false;
   } else {
       removeError(passwordInput, 'password-error');
       return true;
   }
  }

function validateConfirmPassword() {
   const confirmPassValue = confirmPasswordInput.value.trim();
     const passValue = passwordInput.value.trim();
     if (confirmPassValue === '') {    
     setError(confirmPasswordInput, "Confirm password is required", 'confirm-password-error');
     return false;
      } else if (confirmPassValue !== passValue) {
       setError(confirmPasswordInput, "Passwords do not match", 'confirm-password-error');
       return false;
    } else {
      removeError(confirmPasswordInput, 'confirm-password-error');
     return true;
    }
    }

    function validateGender() {
      const genderOptions = document.getElementsByName('gender');
      let isChecked = false;
  
      for (let i = 0; i < genderOptions.length; i++) {
          if (genderOptions[i].checked) {
              isChecked = true;
              break;
          }
      }
  
      if (!isChecked) {
          setError(genderOptions[0], "Please select a gender", 'gender-error');
      } else {
          removeError(genderOptions[0], 'gender-error');
          return true;
      }
  }
  
function validateAddress(){
      const addressvalue = address.value.trim();
      if (addressvalue == ''){
          setError(address, "Address is required", 'address-error');
      }  else if (addressvalue == 'Unregistered'){
          setError(address, "Address is required", 'address-error');
      }  else {
          removeError(address, 'address-error');
          return true;
      }
   }

// Set error message
function setError(inputElement, message, errorId) {
    const errorElement = document.getElementById(errorId);
    errorElement.textContent = message;
     inputElement.classList.add('error-message');
}

// Remove error message
function removeError(inputElement, errorId) {
    const errorElement = document.getElementById(errorId);
    errorElement.textContent = '';
    inputElement.classList.remove('error-message');
}

  // Event listeners
nameInput.addEventListener('blur', validateName);
emailInput.addEventListener('blur', validateEmail);
oldPasswordInput.addEventListener('blur', validateOldPassword);
passwordInput.addEventListener('blur', validatePassword);
confirmPasswordInput.addEventListener('blur', validateConfirmPassword);
address.addEventListener('blur', validateAddress);
contact.addEventListener('blur', validatePhone);

function toggleOPassword() {
  const x = oldPasswordInput;
  const show=document.getElementById('Ohideopen');
  const hide=document.getElementById('Ohideclose');
  if (x.type === "password") {
    x.type = "text";
    show.style.display="none";
    hide.style.display="block";    
  } else{
    x.type = "password";
    show.style.display="block";
    hide.style.display="none";   
  }
}
function toggleNPassword() {
  const y = passwordInput;
  const show=document.getElementById('hideopen');
  const hide=document.getElementById('hideclose');
  if (y.type === "password") {
    y.type = "text";
    show.style.display="none";
    hide.style.display="block";    
  } else{
    y.type = "password";
    show.style.display="block";
    hide.style.display="none";   
  }
}
function toggleCPassword() {
  const z= confirmPasswordInput;
  const show=document.getElementById('Chideopen');
  const hide=document.getElementById('Chideclose');
  if (z.type === "password") {
    z.type = "text";
    show.style.display="none";
    hide.style.display="block";    
  } else{
    z.type = "password";
    show.style.display="block";
    hide.style.display="none";   
  }
}


