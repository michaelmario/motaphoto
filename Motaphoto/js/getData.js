$(window).on("load", function () {
  setInterval(() => {        
    openLightbox();
  }, "1000");
  let currentPage = 1;
  let gridHtml = document.querySelector(".photo-grid");
   function sendRequest() {
    $.ajax({
      url: "http://motaphoto.local/wp-json/wp/v2/photos?per_page=8",
      type: "GET",
      dataType: "json",
      success: function (data) {
        if (currentPage === 1) {
          createHTML(data);
         } 
      },
      error: function (xhr, status, error) {
        console.error("Error fetching data:", error);
      },
    });
  }
  
  if (window.location == "http://motaphoto.local/") {
 $("#load-more").on("click", (e) => {
   
    $.ajax({
      url: "http://motaphoto.local/wp-json/wp/v2/photos?page=2&&per_page=8",
      type: "GET",
      dataType: "json",
      success: function (data) {
        if (currentPage = currentPage + 1) {
          gridHtml.insertAdjacentHTML("beforeend", createHTML(data));
         
         } 
      },
      error: function (xhr, status, error) {
        console.error("Error fetching data:", error);
      },
    });
   
    
   
  });
}

  var imgBox;
  var relImag;
  function createHTML(data) {
    data.forEach((element) => {
      imgBox = document.createElement("div");
      imgBox.className = "img-box";
      var imgView = document.createElement("img");
      imgView.className = "w3-images";
      imgView.src = element.acf.image;
      relImag = element.acf.image;
       if (window.location == "http://motaphoto.local/") {
      creteaHTMLoutPut(element);
      creteaHTMLeye(element);
     
        imgBox.append(imgView);
        gridHtml.append(imgBox);
      } else {
       console.log("Page single");
      }
    });

   
    function creteaHTMLoutPut(ele) {
      let firstdiv = document.createElement("div");
      firstdiv.className = "overlay";
      let openFullScreen = document.createElement("div");
      openFullScreen.className = "open-fullscreen";
      openFullScreen.setAttribute('rel',relImag);
      let imgFull = document.createElement("img");
       imgFull.className = "fullscreen";
      imgFull.src =
        "http://motaphoto.local/wp-content/uploads/2023/08/fullscreen.png";
      imgFull.alt = "Fullscreen";
           
      firstdiv.append(openFullScreen);
      openFullScreen.append(imgFull);
      imgBox.append(firstdiv);
    }
    function creteaHTMLeye(ele) {
      let diveEye = document.createElement("div");
      diveEye.className = "eye";
      let linkData = document.createElement("a");
      linkData.href = ele.link;
      let divlinks = document.createElement("div");
      divlinks.className = "links";
      let imgEye = document.createElement("img");
      imgEye.src =
        "http://motaphoto.local/wp-content/uploads/2023/08/picture-eye.png";
      imgEye.alt = "Eye";

      diveEye.append(linkData);
      linkData.append(imgEye);
      imgBox.append(diveEye);
    }
  }
  sendRequest();

  return;
});


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

function closeBurgerMenu(){
  const burgerMenuIcon = document.querySelector('.burger-menu-open');
  const closeIcon = document.querySelector(".burger-menu-close");
  const menu = document.querySelector('.burger-menu-opened');

  burgerMenuIcon.classList.add("active");
  closeIcon.classList.remove("active");
  menu.classList.remove('active');
}