// ----------------- POP UP SIGN-IN ------------------

const openSignIn = document.getElementById('open');
const closeSignIn = document.querySelector('.close-button');
const overlay = document.getElementById('overlay');
const openPanel = document.querySelector('.modal');

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