(function () {
  document.addEventListener("DOMContentLoaded", function () {

    let currentSheet         =  document.getElementById("stylesheet");
    let switcher             =  document.getElementById("styleswitcher");
    let ToggleContainerLeft  =  document.getElementById("left-container-fix");
    let ToggleBtn            =  document.getElementById("fixed-sidebar-left-toggle");
   

    function loadStyle () {
      if (localStorage.getItem("stylez")) {
        console.log(localStorage.getItem("stylez"));
        currentSheet.href = localStorage.getItem("stylez");
        ToggleContainer();
       }
    }

    function ToggleContainer () {
       ToggleContainerLeft.style.display = "none";
       ToggleBtn.classList.remove("slide-open");
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