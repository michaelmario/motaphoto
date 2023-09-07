 let currentPage = 1;
  let photoGrid = document.querySelector(".photo-grid");
  let postPage = 'page=1&per_page=12&order=asc';
  let postUrl = `http://motaphoto.local/wp-json/wp/v2/photos?${postPage}`;
  let descData = [];
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
    const categoryFilter = $("#categories-select");
    const formatFilter = $("#filter-select");
    const dateFilter = $("#sort-dates");

    const filters = {
      category: '',
      format: '',
      sort: ''
    };
   
    function updateFiltersAndLoad() {
      filters.category = categoryFilter.val();
      filters.format = formatFilter.val();
      filters.sort = dateFilter.val();
      if(filters != ''){
       photoGrid.innerHTML = ""; 
       console.log(filters)
        sendRequest(filters);
        }
    
      }

      categoryFilter.on("change", updateFiltersAndLoad);
      formatFilter.on("change", updateFiltersAndLoad);
      dateFilter.on("change", updateFiltersAndLoad);
  } }
  
 $("#load-more").on("click", (e) => {
    e.preventDefault();    
    postPage = 'page=2&per_page=8&order=asc';
     fetch("http://motaphoto.local/wp-json/wp/v2/photos?"+postPage, {
        method: 'GET',        
      }).then(function(response) {
        if (!response.ok) {
          throw new Error('Network response error.');
        } 
        return response.json();
      }).then(function(data) {
        data.forEach(function(post) {
          photoGrid.insertAdjacentHTML('beforeend', 
          `<div class="img aos-init aos-animate" data-aos="fade-right" data-offset="300" data-easing="ease-in-sine"><img src=` + post.acf.image +` alt=`+ post.title.rendered +`><div class="overlay"><div class="open-fullscreen" rel=`+ post.acf.image +`><img rel=`+ post.acf.image +` class="fullscreen" src="http://motaphoto.local/wp-content/uploads/2023/08/fullscreen.png" alt="Fullscreen"></div><div class="eye"><a href=`+ post.acf.image +`><img src="http://motaphoto.local/wp-content/themes/motaphoto/assets/images/images/picture-eye.svg" alt="Eye"></a></div><div class="links"><p class="ref-val">`+post.acf.reference +`</p>   <p class="titleName">`+post.title.rendered+`</p><p class="categorie">`+post.acf.categorie+`</p></div></div></div>`);
        })
      }).catch(function(error) {
        console.error('There was a problem with the fetch operation: ', error);
      });
    });
    
    function createHTML(filters, element) {
     let retournerHTML = `<div class="img aos-init aos-animate" data-aos="fade-right" data-offset="300" data-easing="ease-in-sine">
     <img src=` + element.acf.image +` alt=`+ element.title.rendered +`>
     <div class="overlay"><div class="open-fullscreen" rel=`+ element.acf.image +`>
     <img rel=`+ element.acf.image +` class="fullscreen" src="http://motaphoto.local/wp-content/uploads/2023/08/fullscreen.png" alt="Fullscreen">
     </div><div class="eye">
     <a href=`+ element.acf.image +`><img src="http://motaphoto.local/wp-content/themes/motaphoto/assets/images/images/picture-eye.svg" alt="Eye"></a>
     </div><div class="links">
     <p class="ref-val">`+element.acf.reference +`</p>
     <p class="titleName">`+element.title.rendered+`</p>
     <p class="categorie">`+element.acf.categorie+`</p>
     </div></div></div>`;  
   if (filters.category === element.acf.categorie ){       
    $(".photo-grid").append(retournerHTML);    
      }
      let filtersFormat = filters.format;
      let formatlowerCase = filtersFormat.toLowerCase();
      if(formatlowerCase === element.acf.format){
        $(".photo-grid").html('');
        $(".photo-grid").append(retournerHTML); 
      }
       if(filters.sort === 'DESC'){
       $(".photo-grid").html('');
        descData.push(element);
        let newData = descData.reverse();
         newData.forEach((newpost)=>{
          
         if(newData.length){ 
                    //c
          $(".photo-grid").append( `<div class="img aos-init aos-animate" data-aos="fade-right" data-offset="300" data-easing="ease-in-sine">
          <img src=` +
                newpost.acf.image +
                ` alt=` +
                newpost.title.rendered +
                `>
          <div class="overlay"><div class="open-fullscreen" rel=` +
                newpost.acf.image +
                `>
          <img rel=` +
                newpost.acf.image +
                ` class="fullscreen" src="http://motaphoto.local/wp-content/uploads/2023/08/fullscreen.png" alt="Fullscreen"></div>
          <div class="eye"><a href=` +
                newpost.acf.image +
                `><img src="http://motaphoto.local/wp-content/themes/motaphoto/assets/images/images/picture-eye.svg" alt="Eye"></a></div>
          <div class="links"><p class="ref-val">` +
                newpost.acf.reference +
                `</p>
          <p class="titleName">` +
                newpost.title.rendered +
                `</p>
          <p class="categorie">` +
                newpost.acf.categorie +
                `</p></div></div></div>`);
          }
        })     
      }
     
      if(filters.sort === 'date'){
         if(element.date){  
          $(".photo-grid").html('');
          $(".photo-grid").append(retournerHTML); 
        }                
        
      }
    }   
  });
  
  
  


