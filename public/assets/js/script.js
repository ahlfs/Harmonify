// document.getElementById("two").onclick=function(){
//   document.getElementById("two").style.pointerEvents="none";
//   document.getElementById("two").style.opacity="0.5";
//   document.querySelector(".responsive-search-bar").style.top="0px";
// }
// document.querySelector(".close").onclick=function(){
//   document.getElementById("two").style.pointerEvents="auto";
//   document.getElementById("two").style.opacity="1";
//   document.querySelector(".responsive-search-bar").style.top="-300px";
// }

function redirectToPage(pageUrl) {
  window.location.href = pageUrl;
}

function checkAddOption(selectBox) {
    var selectedOption = selectBox.options[selectBox.selectedIndex].value;
    
    if (selectedOption === 'addNewOption') {
        document.getElementById('newOption').style.display = 'block';
    } else {
        document.getElementById('newOption').style.display = 'none';
    }
}

function getRandomColor() {
    const colors = [];
    const randomColor = colors[Math.floor(Math.random() * colors.length)];
    return randomColor;
  }