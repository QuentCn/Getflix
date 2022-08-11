const onglets = document.querySelectorAll('.onglets');
const contenu = document.querySelectorAll('.contenu');
let index = 0;

// ----------------------- ONGLETS ----------------------

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

const openSignIn = document.getElementById('openFaq');
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

const openSignUp = document.getElementById('watchFree'); // bouton watch for 30 free days
const logTabButton = document.querySelector('.logTabButton'); // le bouton d'onglet login
const subTabButton = document.querySelector('.subTabButton'); // le bouton d'onglet sign up
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

let checkSubFields = document.getElementById("subscribeButton"); // bouton de confirmation d'inscription
let inputSubFields = document.querySelectorAll(".subField"); // les inputs de l'onglet sign up
let checkTypeOfAccount = document.getElementById("typeOfAccount"); // le selecteur de type de comptes
let free = document.getElementById("optionFree"); // l'option free du selecteur
let premium = document.getElementById("optionPremium"); // l'option premium du selecteur
let admin = document.getElementById("optionAdmin"); // l'option administrateur du selecteur


checkSubFields.addEventListener("click", () => { // Evenement déclenché par un clic sur le bouton d'inscription
     for (var i=0; i < inputSubFields.length; i++){ // vérifie chaque champ de texte
        if (inputSubFields[i].value == ""){ // si le champ est vide alors les bordures passent en rouge
            inputSubFields[i].style.borderColor ="red";
            // document.querySelectorAll(".hideError")[i].innerHTML="Please,complete the field.";
        }
        else if (inputSubFields[i].value.length >= 1){ // si le champ contient au moins un caractère les bordures passent en vert
            inputSubFields[i].style.borderColor ="green";
            // document.querySelectorAll(".hideError")[i].innerHTML="";
        }
    }
});

// --------------- LOGIN ERROR---------------------

let checkLogFields = document.getElementById("loginButton"); // le bouton login de l'onglet login
let inputLogFields = document.querySelectorAll(".logField"); // les input de l'onglet login

checkLogFields.addEventListener("click", () => { // Evenement déclenché par un clic sur le bouton de connexion
     for (var i=0; i < inputLogFields.length; i++){ // vérifie chaque champ de texte
        if (inputLogFields[i].value == ""){ // si le champ est vide alors les bordures passent en rouge
            inputLogFields[i].style.borderColor ="red";
            // document.querySelectorAll(".errorLog")[i].innerHTML="Please,complete the field.";
        }
        else if (inputLogFields[i].value.length >= 1){ // si le champ contient au moins un caractère les bordures passent en vert
            inputLogFields[i].style.borderColor ="green";
            // document.querySelectorAll(".errorLog")[i].innerHTML="";
        }
    }
});