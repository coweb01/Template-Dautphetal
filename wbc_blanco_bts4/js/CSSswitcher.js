(function () {
  document.addEventListener("DOMContentLoaded", function () {

    let currentSheet          =  document.getElementById("stylesheet");
    let switcher              =  document.getElementById("styleswitcher");
    let ToggleContainerLeft   =  document.getElementById("left-container-fix");
    let ToggleContainerRight  =  document.getElementById("right-container-fix");
    let ToggleLeft            =  document.getElementById("fixed-sidebar-left-toggle");
    let ToggleRight           =  document.getElementById("fixed-sidebar-right-toggle");

   

    function loadStyle () {
      if (localStorage.getItem("stylez")) {
        //console.log(localStorage.getItem("stylez"));
        currentSheet.href = localStorage.getItem("stylez");
        ToggleContainer();
       }
    }

    function ToggleContainer () {
    if (ToggleContainerLeft != undefined || ToggleContainerLeft != null) {
       ToggleContainerLeft.style.display = "none";
       ToggleLeft.classList.remove("slide-open");
     }

    if (ToggleContainerRight != undefined || ToggleContainerRight != null) {
       ToggleContainerRight.style.display = "none";
       ToggleRight.classList.remove("slide-open");
      }

    }

    // only continue if required elements are present
    if (currentSheet && switcher) {

      // set previously stored stylesheet?
      loadStyle();

      // listen for clicks on buttons
      switcher.addEventListener("click", function (ev) {
        let b = ev.target; // button

        if (b && b.hasAttribute("data-stylesheet")) {

          // save value
          localStorage.setItem(
            "stylez",
            b.getAttribute("data-stylesheet")
          );

          loadStyle();
        }
      });
    }
  });
}());