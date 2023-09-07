$(document).ready(function () {
  AOS.init({
    initClassName: "aos-init",
    startEvent: "DOMContentLoaded",
  });

  let postPage = 2;
  let orderBY = "&orderby = rand";
  let order = "&order = desc";
  let postUrl = "http://motaphoto.local/wp-json/wp/v2/photos?";
  let currentPage = 1;
  let photoGrid = $(".photo-grid");
  let descData = [];
  const xhr = new XMLHttpRequest();
  $("#load-more").on("click", (e) => {
    e.preventDefault();    
    postPage ='page=2&per_page=8&order=asc';
    $.ajax({
      url: postUrl+ postPage,
      method: "GET",        
      dataType: "JSON",
      success: function (data) {
        if(currentPage = currentPage +1){
        data.forEach((post) => {
          photoGrid.append( 
          `<div class="img aos-init aos-animate" data-aos="fade-right" data-offset="300" data-easing="ease-in-sine"><img src=` + post.acf.image +` alt=`+ post.title.rendered +`><div class="overlay"><div class="open-fullscreen" rel=`+ post.acf.image +`><img rel=`+ post.acf.image +` class="fullscreen" src="http://motaphoto.local/wp-content/uploads/2023/08/fullscreen.png" alt="Fullscreen"></div><div class="eye"><a href=`+ post.acf.image +`><img src="http://motaphoto.local/wp-content/themes/motaphoto/assets/images/images/picture-eye.svg" alt="Eye"></a></div><div class="links"><p class="ref-val">`+post.acf.reference +`</p>   <p class="titleName">`+post.title.rendered+`</p><p class="categorie">`+post.acf.categorie+`</p></div></div></div>`);
        });
      }
      }
        }).catch(function(error) {
        console.error('There was a problem with the fetch operation: ', error);
      });
    });


   function requestData(filters){
     $.ajax({
        url: postUrl+ postPage + order,
        method: "GET",        
        dataType: "JSON",
        success: function (res) {
          res.forEach((element) => {
            console.log(element);
            createHTML(filters, element);
          });
        },
        error: function (xhr, status, error) {
          console.error("Error fetching data:", error);
        },
      });
   }
   if(window.location.href == "http://motaphoto.local/"){
    initFilters();
  function initFilters() {
    const categoryFilter = $("#categories-select");
    const formatFilter = $("#filter-select");
    const dateFilter = $("#sort-dates");

    const filters = {
      category: "",
      format: "",
      sort: "",
    };

    function updateFiltersAndLoad() {
      filters.category = categoryFilter.val();
      filters.format = formatFilter.val();
      filters.sort = dateFilter.val();
      if(filters != ''){
        photoGrid.innerHTML = ""; 
        requestData(filters);
         }
         console.log(filters);
     }
    categoryFilter.on("change", updateFiltersAndLoad);
    formatFilter.on("change", updateFiltersAndLoad);
    dateFilter.on("change", updateFiltersAndLoad);
    
  }
}
  var imgBox;
  var relImag;

  function createHTML(filters, element) {        
    if (filters.category === element.acf.categorie) {
       console.log(filters);
      createImg(element);
      creteaHTMLoutPut(element);
      creteaHTMLeye(element);
      creatLink(element);
    }
    let filtersFormat = filters.format;
    let formatlowerCase = filtersFormat.toLowerCase();
    if (formatlowerCase === element.acf.format) {
      createImg(element);
      creteaHTMLoutPut(element);
      creteaHTMLeye(element);
      creatLink(element);
    }
    if (filters.sort === "DESC") {
      descData.push(element);
      let newData = descData.reverse();
      newData.forEach((newEle) => {
        if (newData.length >= 12) {
          //c
          createImg(newEle);
          creteaHTMLoutPut(newEle);
          creteaHTMLeye(newEle);
          creatLink(newEle);
        }
      });
    }

    if (filters.sort === "date") {
      if (element.date) {
        createImg(element);
        creteaHTMLoutPut(element);
        creteaHTMLeye(element);
        creatLink(element);
      }
    }
    //});

    function createImg(element) {
      linkimg = document.createElement("a");
      linkimg.href = element.link;
      imgBox = document.createElement("div");
      imgBox.className = "img";
      var imgView = document.createElement("img");
      imgView.className = "w3-images";
      imgBox.setAttribute("data-Aos", "fade-right");
      imgBox.setAttribute("data-offset", "300");
      imgBox.setAttribute("data-easing", "ease-in-sine");

      imgView.src = element.acf.image;
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
      openFullScreen.setAttribute("rel", relImag);
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
      let links = document.createElement("div");
      links.className = "links";
      let p_first = document.createElement("p");
      let p_last = document.createElement("p");
      p_first.innerHTML = ele.title.rendered;
      p_last.innerHTML = ele.acf.categorie;
      links.append(p_first);
      links.append(p_last);
      imgBox.append(links);
    }
  }

 
});
