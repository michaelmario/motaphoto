// (function($) {
//     'use strict';
// ============== Fermeture de pop-up ================= //
document.addEventListener('DOMContentLoaded', () => {
    const closeButton = document.getElementById('close');
    // HTMLButtonElement object
    // console.log(closeButton); 

    //  Works as expected
    closeButton.addEventListener('click', function () {
        const popupOverlay = document.querySelector('.popup');
        // console.log(popupOverlay);
        popupOverlay.classList.remove('active');
    })
})

// ==================== Pop-up Contact button with ref ==================== //

document.addEventListener('DOMContentLoaded', () => {
    const contactBtn = document.querySelector('.contact');
    if (document.getElementById('contact-filled')) {
        const filledBtn = document.getElementById('contact-filled');
        
       

        filledBtn.addEventListener('click', function () {
            const popupOverlay = document.querySelector('.popup');
            popupOverlay.classList.add('active');
            // ici le code pour afficher la ref
            // afficher la ref d'image : single.php -> class ref && contenu && ce centenu passe (injecter) en value dans le formulaire champs ref
            const reference = document.querySelector('.ref-val').innerText;
            // console.log(reference);
            document.querySelector('input[name="reference"]').value = reference;
        })
    }
    contactBtn.addEventListener('click', function (e) {
        // console.log('you are clicking on contact');
        e.preventDefault();
        const popupOverlay = document.querySelector('.popup');
        popupOverlay.classList.add('active');
        // console.log('you have activated popup'); 
        console.log(contactBtn);
    })
})


// ===================== AJAX load more page & filtres front-page.php  =================================== //

