/************************************* */
var imgBox;
  var relImag;

  // function createHTML(result) {    
  //   result.forEach((element) => {
  //    // console.log(element);
  //     createImg(element);
  //     creteaHTMLoutPut(element);
  //     creteaHTMLeye(element);
  //     creatLink(element);
  //   });
    
  // }
  function createImg(element) {
    linkimg = document.createElement("a");
    linkimg.href = element.link;
    imgBox = document.createElement("div");
    imgBox.className = "img";
    var imgView = document.createElement("img");
    imgView.className = "w3-images";
    imgView.src = element.acf.image;
    /*imgBox.setAttribute("data-Aos", "fade-right");
    imgBox.setAttribute("data-offset", "300");
    imgBox.setAttribute("data-easing", "ease-in-sine");*/
    relImag = element.acf.image;
   
      imgBox.append(linkimg);
      linkimg.append(imgView);

      photoGrid.append(imgBox);
   
  }
  function creteaHTMLoutPut(ele) {
    let firstdiv = document.createElement("div");
    firstdiv.className = "overlay";
    let openFullScreen = document.createElement("div");
    openFullScreen.className = "open-fullscreen";
    relImag = ele.acf.image;
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
    p_first.className = '';
    let p_last = document.createElement("p");
    p_last.className ="";

    p_first.innerHTML = ele.title.rendered;
    p_last.innerHTML = ele.acf.categorie;
    links.append(p_first);
    links.append(p_last);
    imgBox.append(links);
  }
