const onglets = document.querySelectorAll('.onglets');

const contenu = document.querySelectorAll('.contenu');

let index = 0;

onglets.forEach(onglet => {
    onglet.addEventListener('click', () => {
        if(onglet.classList.contains('active')){
            return;
        } else {
            onglet.classList.add('active')
        }

        index = onglet.getAttribute('data-anim');

        for(i = 0; i < onglets.length; i++){
            if(onglets[i].getAttribute('data-anim')!= index){
                onglets[i].classList.remove('active');
            }
        }

        for(j = 0; j < contenu.length; j++){
            if(contenu[j].getAttribute('data-anim') == index){
                 contenu[j].classList.add('activateContenu');
                 contenu[j].classList.remove('desactivateContenu');
            } else {
                 contenu[j].classList.remove('activateContenu');
                 contenu[j].classList.add('desactivateContenu');
            }
        }
    })
});

// ----------------- POP UP SIGN-IN ------------------

const openSignIn = document.getElementById('open');
const closeSignIn = document.querySelector('.close-button');
const overlay = document.getElementById('overlay');
const openPanel = document.querySelector('.modal');

console.log(openSignIn);
console.log(closeSignIn);

openSignIn.addEventListener('click', () => {
    openModal();
    subTabButton.classList.remove("active");
    logTabButton.classList.add("active");
    contenuLog.classList.add('activateContenu');
    contenuSub.classList.add('desactivateContenu');
    contenuLog.classList.remove('desactivateContenu');
    contenuSub.classList.remove('activateContenu');
});

overlay.addEventListener('click', () => {
const modals = document.querySelectorAll('.modal.activer');
    closeModal()
});

closeSignIn.addEventListener('click', () => {
    closeModal();
});

function openModal(){
    return openPanel.classList.add('activer'), overlay.classList.add('activer');
}; 

function closeModal(modal) {
    return openPanel.classList.remove('activer'), overlay.classList.remove('activer');
};

// ----------------- POP UP WATCH FREE ------------------

const openSignUp = document.getElementById('watchFree');
const logTabButton = document.querySelector('.logTabButton');
const subTabButton = document.querySelector('.subTabButton');
const contenuLog = document.querySelector('.contenuLog');
const contenuSub = document.querySelector('.contenuSub');

openSignUp.addEventListener('click', () => {
    openModal();
    subTabButton.classList.add("active");
    logTabButton.classList.remove("active");
    contenuSub.classList.add('activateContenu');
    contenuLog.classList.add('desactivateContenu');
    contenuSub.classList.remove('desactivateContenu');
    contenuLog.classList.remove('activateContenu');
});

// --------------------------   ERROR   ------------------------------
// ------------------ IF THE INPUT FIELD IS EMPTY ----------------------

// ----------------------- INSCRIPTION ERROR --------------------

let checkSubFields = document.getElementById("subscribeButton");
let inputSubFields = document.querySelectorAll(".subField");
let checkTypeOfAccount = document.getElementById("typeOfAccount");
let free = document.getElementById("optionFree");
let premium = document.getElementById("optionPremium");
let admin = document.getElementById("optionAdmin");


checkSubFields.addEventListener("click", () => {
    //  if(document.getElementById("subName").value == ""){
    // document.getElementById("errorNameSub").classList.remove("hideError");
    //  }
    //  if(document.getElementById("subName").value.length >= 1){
    // document.getElementById('errorNameSub').classList.add("hideError");
    //  }
     for (var i=0; i < inputSubFields.length; i++){
        if (inputSubFields[i].value == ""){
            inputSubFields[i].style.borderColor ="red";
            // document.querySelectorAll(".hideError")[i].innerHTML="Please,complete the field.";
        }
        else if (inputSubFields[i].value.length >= 1){
            inputSubFields[i].style.borderColor ="green";
            // document.querySelectorAll(".hideError")[i].innerHTML="";
        }
    }
    // if (checkTypeOfAccount != free.innerHTML || checkTypeOfAccount != premium.innerHTML || checkTypeOfAccount != admin.innerHTML){
    //     checkTypeOfAccount.style.borderColor = "red";
    // }
    // else if (checkTypeOfAccount = free.innerHTML || checkTypeOfAccount == premium.innerHTML || checkTypeOfAccount == admin.innerHTML){
    //     checkTypeOfAccount.style.borderColor = "green";
    // }
});

// --------------- LOGIN ERROR---------------------

let checkLogFields = document.getElementById("loginButton");
let inputLogFields = document.querySelectorAll(".logField");

checkLogFields.addEventListener("click", () => {
     for (var i=0; i < inputLogFields.length; i++){
        if (inputLogFields[i].value == ""){
            inputLogFields[i].style.borderColor ="red";
            // document.querySelectorAll(".errorLog")[i].innerHTML="Please,complete the field.";
        }
        else if (inputLogFields[i].value.length >= 1){
            inputLogFields[i].style.borderColor ="green";
            // document.querySelectorAll(".errorLog")[i].innerHTML="";
        }
    }
});