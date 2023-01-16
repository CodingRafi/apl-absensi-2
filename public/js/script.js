// open & close submenu sidebar
var dropdown = document.getElementsByClassName("nav-link");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
// end open & close submenu sidebar

// open & close sidebar
var btnCLose    = document.querySelector(".minimize");
var btnOpen     = document.querySelector(".maximize");
var sidebar     = document.querySelector(".sidebar");
var wrapper     = document.querySelector(".main-panel");
var mobileOpen  = document.querySelector(".mobileOpen");
var mobileClose = document.querySelector(".mobileClose");
  // (close sidebar)
btnCLose.addEventListener("click", () => {
  sidebar.style.width    = "0px";
  wrapper.style.width    = "100%";
  btnCLose.style.display = "none";
  btnOpen.style.display  = "block";
})
// (open sidebar)
btnOpen.addEventListener("click", () => {
  sidebar.style.width    = "290px";
  wrapper.style.width    = "calc(100% - 235px)";
  btnCLose.style.display = "block";
  btnOpen.style.display  = "none";
})
  // (open sidebar mobile)
mobileOpen.addEventListener("click", () => {
  sidebar.style.width    = "30rem";
  mobileOpen.style.display  = "none";
  mobileClose.style.display = "block";
})
  //  (close sidebar mobile)
mobileClose.addEventListener("click", () => {
  sidebar.style.width    = "0px";
  mobileOpen.style.display  = "block";
  mobileClose.style.display = "none";
})
// end open & close sidebar