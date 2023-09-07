let currentPage = 1;
  let photoGrid = document.querySelector(".photo-grid");
  let postPage = 'page=1&per_page=12&order=asc';
  let postUrl = `http://motaphoto.local/wp-json/wp/v2/photos?${postPage}`;
  let descData = [];
  let result = "";
$(window).ready(()=> {
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
        // descData = data;
         data.forEach((element)=>{                 
          createHTML(filters, element);        
        })
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
       console.log(filters)
        sendRequest(filters);
        }
    
      }

    categoryFilter.addEventListener('change', updateFiltersAndLoad);
    formatFilter.addEventListener('change', updateFiltersAndLoad);
    dateFilter.addEventListener('change', updateFiltersAndLoad);
    

  } }
  
 $("#load-more").on("click", (e) => {   
    e.preventDefault();    
    postPage = 'page=2&per_page=12';
     fetch("http://motaphoto.local/wp-json/wp/v2/photos?"+ postPage, {
        method: 'GET',
         }).then(function(response) {
        if (!response.ok) {
          throw new Error('Network response error.');
        } 
        return response.json();
      }).then(function(data) {
        data.forEach(function(post) {
          console.log(post.id);
         
          if(post.id !== result.type){
              photoGrid.insertAdjacentHTML('beforeend', 
              `<div class="img aos-init aos-animate" data-aos="fade-right" data-offset="300" data-easing="ease-in-sine"><img src=` + post.acf.image +` class="realImg" alt=`+ post.title.rendered +` data-type=`+post.id+`><div class="overlay"><div class="open-fullscreen" rel=`+ post.acf.image +`><img rel=`+ post.acf.image +` class="fullscreen" src="http://motaphoto.local/wp-content/uploads/2023/08/fullscreen.png" alt="Fullscreen"></div><div class="eye"><a href=`+ post.acf.image +`><img src="http://motaphoto.local/wp-content/themes/motaphoto/assets/images/images/picture-eye.svg" alt="Eye"></a></div><div class="links"><p class="ref-val">`+post.acf.reference +`</p>   <p class="titleName">`+post.title.rendered+`</p><p class="categorie">`+post.acf.categorie+`</p></div></div></div>`);
            
            }else{
              console.log(result.type);
            }
      });     
      
      }).catch(function(error) {
        console.error('There was a problem with the fetch operation: ', error);
      });
    });
    
   


  var imgBox;
  var relImag;

  function createHTML(filters, element) {
     // console.log(element);
    // datas.forEach((element) => {
      
   if (filters.category === element.acf.categorie ){
        createImg(element);
        creteaHTMLoutPut(element);
        creteaHTMLeye(element);
        creatLink(element);        
      }
      let filtersFormat = filters.format;
      //let formatlowerCase = filtersFormat.toLowerCase();
      if(filtersFormat === element.acf.format){
        createImg(element);
        creteaHTMLoutPut(element);
        creteaHTMLeye(element);
        creatLink(element);
      }
       if(filters.sort === 'DESC'){
        descData.push(element);
        let newData = descData.reverse();
         newData.forEach((newEle)=>{
         if(newData.length >=12){          //c
          createImg(newEle);
          creteaHTMLoutPut(newEle);
          creteaHTMLeye(newEle);
          creatLink(newEle);
          }
        })     
      }
     
      if(filters.sort === 'date'){
         if(element.date){  
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
      imgBox.setAttribute('data-Aos',"fade-right") ;
      imgBox.setAttribute('data-offset',"300") ;
      imgBox.setAttribute('data-easing',"ease-in-sine") ; 
      
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
 
  
  const datasetRequest = document.querySelectorAll('.realImg');
  datasetRequest.forEach(reslelem=>{
    result = reslelem.dataset;
    console.log(result.type);
  })
  
 

/*  function recreateHTML(elements) {
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
   
  
  
  $('select[id$=-status][id^=id_item-]').change(function (){
    var color = $(this).find('option:selected').val();

    $(this).removeClass('o1 o2 o3').addClass('o' + $(this).find('option:selected').val());
}).change();*/
  
})

