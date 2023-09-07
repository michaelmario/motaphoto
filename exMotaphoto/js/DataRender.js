$(document).ready(function () {
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
      if (filters != "") {
        $(".photo-grid").html("");
        console.log(filters);
        sendRequest(filters);
      }
    }

    categoryFilter.on("change", updateFiltersAndLoad);
    formatFilter.on("change", updateFiltersAndLoad);
    dateFilter.on("change", updateFiltersAndLoad);
  }

  initFilters();

  function sendRequest(filters) {
    $.ajax({
      url: "http://motaphoto.local/wp-json/wp/v2/photos",
      method: "GET",
      dataType: "json",
      success: function (data) {
        retournerHTML(filters, data);
      },
      error: function (xhr, status, error) {
        console.error("Error fetching data:", error);
      },
    });
  }

   function retournerHTML(filters, data) {

    data.forEach((post) => {
      console.log(post);
      let returnModule =
        `<div class="img aos-init aos-animate" data-aos="fade-right" data-offset="300" data-easing="ease-in-sine">
  <img src=` +
        post.acf.image +
        ` alt=` +
        post.title.rendered +
        `>
  <div class="overlay"><div class="open-fullscreen" rel=` +
        post.acf.image +
        `>
  <img rel=` +
        post.acf.image +
        ` class="fullscreen" src="http://motaphoto.local/wp-content/uploads/2023/08/fullscreen.png" alt="Fullscreen"></div>
  <div class="eye"><a href=` +
        post.acf.image +
        `><img src="http://motaphoto.local/wp-content/themes/motaphoto/assets/images/images/picture-eye.svg" alt="Eye"></a></div>
  <div class="links"><p class="ref-val">` +
        post.acf.reference +
        `</p>
  <p class="titleName">` +
        post.title.rendered +
        `</p>
  <p class="categorie">` +
        post.acf.categorie +
        `</p></div></div></div>`;
      if (filters.category === post.acf.categorie) {
        $(".photo-grid").append(returnModule); 
        console.log(post.acf.categorie)      
      }
      let filtersFormat = filters.format;
      let formatlowerCase = filtersFormat.toLowerCase();
      if(formatlowerCase === post.acf.format){
        $(".photo-grid").html('');
           $(".photo-grid").append(returnModule);
        }
        let descData = [];
        if(filters.sort === 'DESC'){
          $(".photo-grid").html('');
            descData.push(post);
            let newData = descData.reverse();
             newData.forEach((newpost)=>{
              $(".photo-grid").html('');
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
             })
            }
            if(filters.sort === 'date'){
              $(".photo-grid").html('');
               $(".photo-grid").append(returnModule);
            }
    });
  }

  
});
