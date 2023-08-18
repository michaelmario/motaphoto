let currentPage = 1;
  let photoGrid = document.querySelector(".photo-grid");
  let postPage = 'page=1&&per_page=8';
  let postUrl = `http://motaphoto.local/wp-json/wp/v2/photos?${postPage}`;
$(window).on("load", function () {
  AOS.init({
    initClassName: "aos-init",
    startEvent: "DOMContentLoaded",
  });
  setInterval(() => {
    openLightbox();
  }, "1000"); 
  function sendRequest(filters) {
    $.ajax({
      url: postUrl,
      method: "GET",
      dataType: "json",
      success: function (data) {
        if (currentPage === 1) {         
          createHTML(filters, data);
        }

      },
      error: function (xhr, status, error) {
        console.error("Error fetching data:", error);
      },
    });
  }
  
  if(window.location.href == "http://motaphoto.local/"){
  initFilters();
  function initFilters() {
    const categoryFilter = document.getElementById('categories-select');
    const formatFilter = document.getElementById('filter-select');
    const dateFilter = document.getElementById('sort-dates');

    const filters = {
      category: '',
      format: '',
      sort: ''
    };

    function updateFiltersAndLoad() {
      filters.category = categoryFilter.value;
      filters.format = formatFilter.value;
      filters.sort = dateFilter.value;
      if(filters != ''){
        photoGrid.innerHTML = ""; 
        sendRequest(filters)
        }
    
      }

    categoryFilter.addEventListener('change', updateFiltersAndLoad);
    formatFilter.addEventListener('change', updateFiltersAndLoad);
    dateFilter.addEventListener('change', updateFiltersAndLoad);
    if(filters != ''){
      photoGrid.innerHTML = ""; 
      sendRequest(filters);
      }


  }
  
 $("#load-more").on("click", (e) => {
    e.preventDefault();    
    postPage = 'page=2&&per_page=4';
    $.ajax({
      url: `http://motaphoto.local/wp-json/wp/v2/photos?${postPage}`,
      method: "GET",
      dataType: "json",
      success: function (elements) {
        if (currentPage = currentPage + 1) {
          photoGrid.insertAdjacentHTML("beforeend", recreateHTML(elements));

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

  function createHTML(filters, datas) {
    console.log(datas);
    datas.forEach((element) => {
      if (element.acf) {
         createImg(element);
        creteaHTMLoutPut(element);
        creteaHTMLeye(element);
        creatLink(element);

      }
     else{
      createImg(element);
      creteaHTMLoutPut(element);
      creteaHTMLeye(element);
      creatLink(element);
      }
    });
    function createImg(element) {
      linkimg = document.createElement("a");
      linkimg.href = element.link;
      imgBox = document.createElement("div");
      imgBox.className = "img";
      var imgView = document.createElement("img");
      imgView.className = "w3-images";        
      imgView.src = element.acf.image;
      imgBox.setAttribute('data-Aos',"fade-right") ;
      imgBox.setAttribute('data-offset',"300") ;
      imgBox.setAttribute('data-easing',"ease-in-sine") ; 
      relImag = element.acf.image;
      if (window.location == "http://motaphoto.local/") {
        imgBox.append(linkimg);
        linkimg.append(imgView);

        photoGrid.append(imgBox);

      } else {
        console.log("Page single");
      }
    }
    function creteaHTMLoutPut(ele) {
      let firstdiv = document.createElement("div");
      firstdiv.className = "overlay";
      let openFullScreen = document.createElement("div");
      openFullScreen.className = "open-fullscreen";
      openFullScreen.setAttribute('rel', relImag);
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
    function creatLink(ele) {
      let links = document.createElement('div');
      links.className = "links";
      let p_first = document.createElement('p');
      let p_last = document.createElement('p');
      p_first.innerHTML = ele.title.rendered;
      p_last.innerHTML = ele.acf.categorie;
      links.append(p_first);
      links.append(p_last);
      imgBox.append(links);

    }
  }


  function recreateHTML(elements) {
    elements.forEach((element) => {
        recreateImg(element);
        recreteaHTMLoutPut(element);
        recreteaHTMLeye(element);
        recreatLink(element);      
    });

    function recreateImg(element) {
      linkimg = document.createElement("a");
      linkimg.href = element.link;
      imgBox = document.createElement("div");
      imgBox.className = "img";
      var imgView = document.createElement("img");
      imgView.className = "w3-images";
      imgView.src = element.acf.image;
      imgBox.setAttribute('data-Aos',"fade-right") ;
      imgBox.setAttribute('data-offset',"300") ;
      imgBox.setAttribute('data-easing',"ease-in-sine") ;
      relImag = element.acf.image;
      if (window.location == "http://motaphoto.local/") {
        imgBox.append(linkimg);
        linkimg.append(imgView);

        photoGrid.append(imgBox);

      } else {
        console.log("Page single");
      }
    }
    function recreteaHTMLoutPut(ele) {
      let firstdiv = document.createElement("div");
      firstdiv.className = "overlay";
      let openFullScreen = document.createElement("div");
      openFullScreen.className = "open-fullscreen";
      openFullScreen.setAttribute('rel', relImag);
      let imgFull = document.createElement("img");
      imgFull.className = "fullscreen";
      imgFull.src =
        "http://motaphoto.local/wp-content/uploads/2023/08/fullscreen.png";
      imgFull.alt = "Fullscreen";

      firstdiv.append(openFullScreen);
      openFullScreen.append(imgFull);
      imgBox.append(firstdiv);
    }
    function recreteaHTMLeye(ele) {
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
    function recreatLink(ele) {
      let links = document.createElement('div');
      links.className = "links";
      let p_first = document.createElement('p');
      let p_last = document.createElement('p');
      p_first.innerHTML = ele.title.rendered;
      p_last.innerHTML = ele.acf.categorie;
      links.append(p_first);
      links.append(p_last);
      imgBox.append(links);
      
    }
  }
   
});