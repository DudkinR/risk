
// SVG Statistic
    // Установка значения атрибута points для внутреннего шестиугольника
    function genPoligon(data,polygonId){
      const maxDistance = 50; // Максимальное расстояние от центра в пикселях
      const innerHex = document.getElementById(polygonId); // Элемент внутреннего шестиугольника
      // Генерация строкового значения атрибута points для внутреннего шестиугольника
      const points = [];
      for (let i = 0; i < 6; i++) {
      const angle = i * 60; // Угол между вершиной и осью X в градусах
      const distance = maxDistance * (data[i] / 100); // Расстояние от центра
      const x = 50 + distance * Math.cos(angle * Math.PI / 180); // Координата X вершины
      const y = 50 + distance * Math.sin(angle * Math.PI / 180); // Координата Y вершины
      points.push(`${x},${y}`);
      }
      // Установка значения атрибута points для внутреннего шестиугольника
      innerHex.setAttribute('points', points.join(' '));
  }
  function opositeLine(data,line0,line60,line120){
    const maxDistance = 50; // Максимальное расстояние от центра в пикселях
    const liner0 = document.getElementById(line0); // Элемент line  angle 0
    const liner60 = document.getElementById(line60); // Элемент line  angle 60
    const liner120 = document.getElementById(line120); // Элемент line  angle 120
    const points = [];
    for (let i = 0; i < 6; i++) {
    const angle = i * 60; // Угол между вершиной и осью X в градусах
    const distance = maxDistance * (data[i] / 100); // Расстояние от центра
    const x = Math.ceil(50 + distance * Math.cos(angle * Math.PI / 180));
    const y = Math.ceil(50 + distance * Math.sin(angle * Math.PI / 180));
    points.push(x);
    points.push(y);
    }
    console.log(points);
    liner0.setAttribute('x1', points[0]);
    liner0.setAttribute('y1', points[1]);
    liner0.setAttribute('x2', points[6]);
    liner0.setAttribute('y2', points[7]);
    liner60.setAttribute('x1', points[2]);
    liner60.setAttribute('y1', points[3]);
    liner60.setAttribute('x2', points[8]);
    liner60.setAttribute('y2', points[9]);
    liner120.setAttribute('x1', points[4]);
    liner120.setAttribute('y1', points[5]);
    liner120.setAttribute('x2', points[10]);
    liner120.setAttribute('y2', points[11]);
}

function changePoligon(event){

  const full=document.getElementById('full');
  const dificult=document.getElementById('dificult');
  const usefull=document.getElementById('usefull');
  const understand=document.getElementById('understand');
  const detail=document.getElementById('detail');
 const popular = document.getElementById('popular');
   if (full) {
    const mass = [
     full.value,
     dificult.value,
     usefull.value,
     understand.value,
     detail.value,
     popular.value];
    //  console.log(mass);
    genPoligon(mass, 'innerHex');
   }
  }


 ////////////////////////////////////////////////////////////////////////////////////       
function send_to_route(route, method, mass) {
  var xhr = new XMLHttpRequest();
  xhr.open(method, route);
  xhr.setRequestHeader('Content-Type', 'application/json');

  // Получить CSRF-токен из метатега на странице
  var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  
  // Добавить CSRF-токен в объект mass
  mass['_token'] = csrfToken;

  xhr.onreadystatechange = function() {
    if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
      var response = JSON.parse(this.responseText);
      console.log(response);
    }
  };
  xhr.send(JSON.stringify(mass));
}
/**
 * Пример использования функции send_to_route
 send_to_route(route, 'POST', {'param1': 'value1', 'param2': 'value2'}, function(response) {
  console.log(response); // Выводим ответ от сервера в консоль
});

 */

function to_slug(text) {
  // Remove all non-Latin letters
  var slug = text.replace(/[^\u0000-\u007F]+/g, '');

  // Replace spaces and non-word characters with a hyphen
  slug = slug.replace(/[\s\W-]+/g, '-');

  // Remove any leading or trailing hyphens
  slug = slug.replace(/^-+|-+$/g, '');

  // Convert to lowercase
  slug = slug.toLowerCase();

  return slug;
}
function fetchwork(blank) {
// Create a new XMLHttpRequest object
var xhr = new XMLHttpRequest();
// Set the HTTP method and URL for the request
xhr.open("GET","/work/add?blank=" + encodeURIComponent(blank), true);
// Set the response type to JSON
xhr.responseType = "json";
// Add an event listener for when the response is received
xhr.addEventListener("load", function() {
    // Handle the response
    if (xhr.status === 200) {
    displaycats(xhr.response);
    }
});
// Send the request
xhr.send();

//xhr.response for blank chenge count
}

function hidePanel(id) {
  var navbar = document.getElementById(id);
  var type=0;
  if (navbar.classList.contains("d-none")) {
    navbar.classList.remove("d-none");
    type=1;
  } else {
    navbar.classList.add("d-none");
    type=0;
  }
  fetcpanel(id,type);
}
function fetcpanel(panel,type) {
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();
    // Set the HTTP method and URL for the request
    xhr.open("GET","/profile/ch?panel=" + encodeURIComponent(panel)+'&t='+type, true);
    // Set the response type to JSON
    xhr.responseType = "json";
    // Add an event listener for when the response is received
    xhr.addEventListener("load", function() {
        // Handle the response
        if (xhr.status === 200) {
        displaycats(xhr.response);
        }
    });
    // Send the request
    xhr.send();

    //xhr.
}
function displaycats(cats) {
  
}
function svg_my(event){
  const bg_color=document.getElementById('bg_color');
  const text_color=document.getElementById('text_color');
  const text_own=document.getElementById('text_own');
  const rect_my_svg=document.getElementById('rect_my_svg');
  const text_my_svg=document.getElementById('text_my_svg');
  rect_my_svg.setAttribute('fill',bg_color.value);
  text_my_svg.setAttribute('fill',text_color.value);
  text_my_svg.textContent=text_own.value;
  if(text_own.value.length == 1)
  text_my_svg.setAttribute('font-size',110);
  if(text_own.value.length == 2)
  text_my_svg.setAttribute('font-size',90);
  
  if(text_own.value.length == 3)
  text_my_svg.setAttribute('font-size',80);
  if(text_own.value.length == 4)
  text_my_svg.setAttribute('font-size',70);
  if(text_own.value.length == 5)
  text_my_svg.setAttribute('font-size',50);

}
function displayIcons(icons) {

iconsContainer1.innerHTML = "";
icons.forEach(function(icon) {
  var iconElement = document.createElement("x-icon.main");
  iconElement.className='icofont-'+icon.name;
  iconElement.style.fontSize = "3rem";
  iconElement.style.color = "red";
  var radioElemment = document.createElement("input");
  radioElemment.type = "radio";
  radioElemment.name = "image";
  radioElemment.id = "image_"+icon.id;
  radioElemment.value = icon.id;
  radioElemment.className = "form-check-input";
  iconsContainer1.appendChild(radioElemment);
  var labelElement = document.createElement("h6");
  //  labelElement.className = "form-check-label";
  //  labelElement.for = "image_"+icon.id;
  labelElement.textContent = icon.name;
  var divElement = document.createElement("div");
  divElement.className = "form-check";
  divElement.className = "col-sm-1";
  divElement.appendChild(radioElemment);
  divElement.appendChild(labelElement);
  divElement.appendChild(iconElement);
  iconsContainer1.appendChild(divElement);
});
}
function fetchIcons() {
  // Get the input value
  var words = document.querySelector('input[name="refresh"]').value;

  // Create a new XMLHttpRequest object
  var xhr = new XMLHttpRequest();
  // Set the HTTP method and URL for the request
  xhr.open("GET", "/icons/show?words=" + encodeURIComponent(words), true);
  // Set the response type to JSON
  xhr.responseType = "json";
  // Add an event listener for when the response is received
  xhr.addEventListener("load", function() {
      // Handle the response
      if (xhr.status === 200) {
      displayIcons(xhr.response);
      }
  });
  // Send the request
  xhr.send();
  }