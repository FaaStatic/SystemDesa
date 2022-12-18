$(document).ready(function () {
  let body = document.querySelector("body");
  let flash = document.querySelector("#flash");
  flashcek();

  $("#gear a").on("click", function (e) {
    e.preventDefault();
    $("#modal-setting").modal("show");
  });
  function flashcek() {
    if (flash === null) {
    } else {
      body.addEventListener("click", function () {
        flash.style.display = "none";
      });
    }
  }

  $("#trigger").click(function () {
    $("#sidebar").toggleClass("active");
  });
  $("h4").css("color", "black");
  $("#gear").mouseenter(function () {
    $(this).toggleClass("active");
  });
  $("#gear").mouseleave(function () {
    $(this).toggleClass("active");
  });
  $("#poweron").mouseenter(function () {
    $(this).toggleClass("active");
  });
  $("#poweron").mouseleave(function () {
    $(this).toggleClass("active");
  });
  $("#close-setting").on("click", function () {
    $("#modal-setting").modal("hide");
    $("#form-change")[0].reset();
  });
});
