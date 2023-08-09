/*let url ="http://motaphoto.local/wp-json/wp/v2/categories/";
fetch(url)
  .then(response => {
    if (!response.ok) {
      throw new Error(`Network response was not ok: ${response.status}`);
    }
    return response.json();
  })
  .then(data => {
    // Use the JSON data
    data.forEach(ele => {
        let optioncategory = document.querySelector('#categories-select');
        let option = document.createElement('option');
          //  option.className = "letters-transform";
            option.value = ele.name;
            option.innerHTML = ele.name;  
           
            optioncategory.appendChild(option);
          
    });
  
  })
  .catch(error => {
    console.error('There was a problem fetching the data:', error);
  });*/

  
    $(window).on('load',function() {
        $.ajax({
            url: 'http://motaphoto.local/wp-json/wp/v2/photos/',
            type: "GET",
            dataType: "json",
            success: function(data) {
               createHTML(data);
                //console.log(data);               
            },
            error: function(xhr, status, error) {
                console.error("Error fetching data:", error);
            }
        });
    });
   
  let gridHtml = document.querySelector('.photo-grid');
  var imgBox; 
   function createHTML(data){     
   data.forEach(element => {
    imgBox = document.createElement('div');    
        imgBox.className = "img-box"; 
    var imgView = document.createElement('img');
        imgView.className = "w3-images";
      imgView.src = element.acf.image;
     
     creteaHTMLoutPut(element);
     creteaHTMLeye(element);    
     if(imgBox){ 
     imgBox.append(imgView);
     gridHtml.append(imgBox);
     }else{
      console.log('sa va pas');
     }
   }); 
   
  
   
   //photogrid.append(imgBox);
  function creteaHTMLoutPut(ele){ 
     let  firstdiv = document.createElement('div');
      firstdiv.className ="overlay"
    let  openFullScreen = document.createElement('div');
     openFullScreen.className = "open-fullscreen";

     let  imgFull = document.createElement('img');
     imgFull.rell ='';
     imgFull.className = "fullscreen";     
     imgFull.src = "http://motaphoto.local/wp-content/uploads/2023/08/fullscreen.png"; 
      imgFull.alt="Fullscreen";
    
    
     firstdiv.append(openFullScreen);
      openFullScreen.append(imgFull);
      imgBox.append(firstdiv);
     
      
  }
     function creteaHTMLeye(ele){
         console.log(ele)
      let diveEye = document.createElement('div');
      diveEye.className = "eye";
      let linkData = document.createElement('a');
      linkData.href = ele.link;
      let divlinks = document.createElement('div');
      divlinks.className = "links";
      let imgEye = document.createElement('img');
      imgEye.src = "http://motaphoto.local/wp-content/uploads/2023/08/picture-eye.png";
      imgEye.alt="Eye"; 

      diveEye.append(linkData);
      linkData.append(imgEye); 
      imgBox.append(diveEye);
     

      }
    }
    