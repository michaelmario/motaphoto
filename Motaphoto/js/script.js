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
             console.log(reference);
            let ref = document.querySelector('#refference');
            ref.setAttribute("placeholder", reference);
           // document.querySelector('input[name="reference"]').value = reference;
        })
    }
    contactBtn.addEventListener('click', function (e) {
        // console.log('you are clicking on contact');
        e.preventDefault();
        const popupOverlay = document.querySelector('.popup');
        popupOverlay.classList.add('active');
        

        // console.log('you have activated popup'); 
        //console.log(contactBtn);
    })
})

// ============================== Lightbox =================================== //

function openLightbox(){
    
    document.querySelectorAll('.fullscreen').forEach(open => {
         open.addEventListener('click', function (e) {
            const lightboxSpace = document.querySelector('.lightbox');
           let overlayImg  = e.target.parentNode.getAttribute('rel');
              lightboxImage = document.querySelector('.image-lightbox');
              lightboxImage.src = overlayImg;            
              lightboxSpace.classList.add('active');
                           
            })
    });
    const closeLightbox = document.getElementById('close-lightbox');
    closeLightbox.addEventListener('click', ()=>{
        const lightboxSpace = document.querySelector('.lightbox');
        lightboxSpace.classList.remove('active');
        
    })
}

//====================================== Burger menu =========================//
 let openMenuIcons = document.querySelector('.burger-menu-icons');
 const burgerMenuIcon = document.querySelector('.burger-menu-open');
 const headerLogoClose = document.querySelector('.header-logo-close');
 const logomain = document.querySelector('.logo'); 
 const closeIcon = document.querySelector('.burger-menu-close');
 const menu = document.querySelector('.burger-menu-opened');
 const Mobilemenu = document.querySelector('.Mobile-menu');
 const burgerMenuLink = document.querySelector('.burger-menu-links');
 

function openBurgerMenu() {
  const openMenuIcons = document.querySelector('.burger-menu-icons');
  openMenuIcons.addEventListener('click', () => {     
    burgerMenuIcon.classList.add('active');
    if (burgerMenuIcon.classList.contains('active')) {
       logomain.style.display = 'none';
    openMenuIcons.classList.add('active'); 
    closeIcon.classList.add('active');
    headerLogoClose.classList.add('active');
    burgerMenuIcon.classList.remove('active');
    openMenuIcons.classList.remove('active');
    Mobilemenu.style.display = 'block';
    burgerMenuLink.classList.add('active')
    }else{
      logomain.style.display = 'block';
      openMenuIcons.classList.remove('active'); 
      closeIcon.classList.remove('active');
      headerLogoClose.classList.remove('active');
      burgerMenuIcon.classList.add('active');
      openMenuIcons.classList.add('active');
      Mobilemenu.style.display = 'none';
      burgerMenuLink.classList.remove('active');
      closeBurgerMenu();
    }
   

  });
    

    
  }
  openBurgerMenu();

  function linkClicked(){
    const links = document.querySelectorAll("a");
    
    for (let i = 0; i < links.length; i++) {
      links[i].addEventListener('click', () => {
        // console.log('clicked');
        closeBurgerMenu();
      });
    }
  }
  linkClicked();
  closeBurgerMenu();
  function closeBurgerMenu(){
    const closeIcon = document.querySelector(".burger-menu-close");       
    closeIcon.addEventListener('click',function(){
      closeIcon.classList.remove('active'); 
      logomain.style.display = 'block';
      openMenuIcons.classList.remove('active'); 
      closeIcon.classList.remove('active');
      headerLogoClose.classList.remove('active');
      burgerMenuIcon.classList.add('active');
      openMenuIcons.classList.add('active');
      Mobilemenu.style.display = 'none';
      burgerMenuLink.classList.remove('active');
       console.log('fermer');
    });
    
  }


  
   let slideIndex = 0;
   showSlides();
   
   function showSlides() {
    if(window.location == "http://motaphoto.local/"){
     let slides = document.querySelectorAll('.mySlides');
     
     for (let i = 0; i < slides.length; i++) {
       slides[i].style.display = "none";
     }
     
     slideIndex++;
     
     if (slideIndex > slides.length) {
       slideIndex = 1;
     }
     
     slides[slideIndex - 1].style.display = "block";
     setTimeout(showSlides, 6000); // Change image every 2 seconds
   
    } }
   
   
   
   
    
   