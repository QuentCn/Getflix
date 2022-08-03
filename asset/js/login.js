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

// ------------------ IF THE INPUT FIELD IS EMPTY ----------------------
